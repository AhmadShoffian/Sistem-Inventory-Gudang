<x-mail::message>
# Hai {{ $nama }},

Terima kasih telah mengajukan permintaan pembuatan akun pada sistem **SIMBARANG**.

Namun, setelah dipertimbangkan, permintaan akun kamu **belum dapat kami setujui** untuk saat ini.

Jika kamu merasa ini adalah kekeliruan, silakan hubungi admin untuk informasi lebih lanjut.

<x-mail::button :url="config('app.url')">
Kembali ke Website
</x-mail::button>

Terima kasih atas pengertiannya.  
Salam hormat,  
**Admin SIMBARANG**
</x-mail::message>
