<x-mail::message>
    # Welcome {{$user->first_name}} {{$user->last_name}}

    ## Etapes pour votre enregistrement au {{ config('app.name') }}

    - Ajouter d'autres participants
    - Payer votre participation

    ---

    ## Informations de connection

    <x-mail::panel>
        Utilisez le bouton ci dessous.

        @if ($user->plainPassword)
            Ou connectez vous avec le compte suivant:

            Login: {{$user->email}}

            Password: {{$user->plainPassword}}
        @endif

        [title](https://www.example.com)

    </x-mail::panel>

    <x-mail::button :url="$url" color="success">
        {{$textbtn}}
    </x-mail::button>
    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
