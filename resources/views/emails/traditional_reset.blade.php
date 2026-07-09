<x-mail::message>
    # Réinitialisation de votre mot de passe 🔒

    Bonjour **{{ $user->name_users ?? $user->name }}**,

    Une demande de réinitialisation de mot de passe a été effectuée pour votre compte sur la plateforme **ENSAM ERP**.

    Conformément aux directives de l'établissement, un nouveau mot de passe vous a été attribué de manière automatique :

    <x-mail::panel>
        **Nouveau mot de passe :** {{ $newPassword }}
    </x-mail::panel>

    Vous pouvez dès à présent utiliser ce mot de passe pour vous connecter à votre espace en cliquant sur le bouton ci-dessous :

    <x-mail::button :url="route('login')" color="primary">
        Se connecter à l'ERP
    </x-mail::button>

    *Une fois connecté, nous vous recommandons de modifier ce mot de passe depuis les paramètres de votre profil.*

    Cordialement,
    L'équipe **ENSAM ERP**
</x-mail::message>
