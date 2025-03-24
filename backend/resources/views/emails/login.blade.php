@component('mail::message')
# Notificación de Inicio de Sesión

Hola, {{ $user->name }}.

Hemos detectado un inicio de sesión en tu cuenta.

Si no fuiste tú, por favor contacta con el soporte.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
