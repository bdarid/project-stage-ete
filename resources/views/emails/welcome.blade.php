<x-mail::message>
# Bienvenue sur la plateforme !

Bonjour **{{ $user->name_users ?? $user->name }}**,

Votre compte collaborateur a été configuré avec succès par l'administration globale. Vous êtes désormais rattaché au rôle de : **{{ $role }}**.

Voici vos accès sécurisés pour vous connecter à l'infrastructure :
<x-mail::panel>
**Identifiant :** {{ $user->email }}

**Mot de passe provisoire :** {{ $password_clair }}
</x-mail::panel>

Pour commencer à utiliser vos outils opérationnels, veuillez cliquer sur le bouton ci-dessous :
<x-mail::button :url="route('login')" color="success">
Accéder à mon espace de travail
</x-mail::button>
*Par mesure de sécurité élémentaire, nous vous demandons de renouveler ce mot de passe dès votre première session depuis l'onglet "Mon Profil".*
Cordialement,<br>
L'équipe **ERP**
</x-mail::message>
