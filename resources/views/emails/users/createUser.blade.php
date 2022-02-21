@component('mail::message')

# Vous avez été ajouté au système E-visa Cameroun.

Votre email d'authentification est <b>{{ $user->email }}</b>. <br>
Votre mot de passe est <b>{{ $password }}</b>.

Cliquez sur le bouton ci-dessous pour vous connecter. <br>

@component('mail::button', ['url' => route('login')])
	Accéder à la page d'authentification
@endcomponent

Cordialement, l'Equipe E-visa Cameroun. <br>

@endcomponent