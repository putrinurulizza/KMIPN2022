@component('mail::message')
# {{ $data['msg'] }}

Keterangan:<br>
{{ $data['ket'] }}
 
@component('mail::button', ['url' => 'http://localhost:8000'])
Kembali Ke Website
@endcomponent
 
Hormat Kami,<br>
{{ config('app.name') }}
@endcomponent