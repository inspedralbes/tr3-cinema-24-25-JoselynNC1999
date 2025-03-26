@component('mail::message')
# Notificació d'inici de sessió

Hola, {{ $user->name }}.

Hem detectat un inici de sessió al teu compte.

Si no vas ser tu, si us plau contacta amb el suport.

Gràcies,<br>
{{ config('app.name') }}
@endcomponent
