@component('mail::message')
# Bienvenido a Cinema Pedralbes

Hola, {{ $user->name }}.

¡Gracias por registrarte en nuestra plataforma!

@component('mail::button', ['url' => url('/')])
Explorar
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
