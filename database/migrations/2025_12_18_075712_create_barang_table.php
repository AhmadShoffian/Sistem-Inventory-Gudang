<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('kategori_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->timestamps();
        });
        
        Schema::create('satuan_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_satuan');
            $table->timestamps();
        });
        
        Schema::create('kondisi_barang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kondisi');
            $table->timestamps();
        });
        
        Schema::create('lokasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi');
            $table->timestamps();
        });

        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->foreignId('kategori_id')->constrained('kategori_barang')->onDelete('restrict');
            $table->foreignId('satuan_id')->constrained('satuan_barang')->onDelete('restrict');
            $table->foreignId('kondisi_id')->constrained('kondisi_barang')->onDelete('restrict');
            $table->foreignId('lokasi_id')->constrained('lokasi')->onDelete('restrict');
            $table->string('status_barang')->default('Normal'); 
            $table->string('lampiran')->nullable(); 
            $table->foreignId('created_by_user_id')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_barang','satuan_barang','kondisi_barang','lokasi','barang');
    }
};
