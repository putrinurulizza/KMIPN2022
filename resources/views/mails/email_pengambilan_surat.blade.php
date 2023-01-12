@component('mail::message')
# Surat Anda Telah Selesai Dibuat

Keterangan:<br>
Silahkan mengambil surat di Kantor Geuchik.
 
@component('mail::button', ['url' => 'http://localhost:8000'])
Kembali Ke Website
@endcomponent
 
Hormat Kami,<br>
{{ config('app.name') }}
@endcomponent