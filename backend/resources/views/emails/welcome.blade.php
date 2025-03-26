@component('mail::message')
# Bienvenido a Cinépolis Pedralbes

Hola, {{ $user->name }}.

Gràcies per registrar-te a la nostra plataforma!

@component('mail::button', ['url' => url('/')])
Explorar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
