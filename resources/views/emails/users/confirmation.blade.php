@component('mail::message')

# Confirmez votre inscription.

Cliquez sur le lien ci-dessous pour confirmer votre inscription. <br>
<a href="{{ route('registrationConfirmation', ['user_id' => $user->id, 'token' => $user->token]) }}" class="">{{ route('registrationConfirmation', ['user_id' => $user->id, 'token' => $user->token]) }}</a>

@endcomponent