<x-mail::message>
# Halo {{ $user->name }},

Permintaan pembuatan akun **SIMBARANG** (Sistem Inventori Barang) telah kami **setujui**. Selamat bergabung!

Berikut adalah informasi akun Anda:

<x-mail::panel>
**Nama**: {{ $user->name }}  
**NIP**: {{ $user->nip }}  
**Instansi**: {{ $user->instansi }}  
**Jabatan**: {{ $user->jabatan }}  
**Email**: {{ $user->email }}  
**Password Sementara**: `{{ $password }}`  
</x-mail::panel>

🔐 **Catatan Penting**  
Segera login ke sistem dan **ganti password Anda** demi keamanan akun.

<x-mail::button :url="config('app.url') . '/login'">
Login Sekarang
</x-mail::button>

Jika Anda memiliki pertanyaan, jangan ragu menghubungi tim admin kami.

Terima kasih dan selamat menggunakan SIMBARANG 🎉

Salam hangat,  
**Admin SIMBARANG**
</x-mail::message>