<x-mail::message>
    <x-mail::panel>
        ## Informations de connection
        Utilisez le bouton ci dessous.
        <x-mail::button :url="$url" color="success">
            {{$textbtn}}
        </x-mail::button>

        @if ($user->plainPassword)
            Ou connectez vous avec le compte suivant:

            Login: {{$user->email}}

            Password: {{$user->plainPassword}}
        @endif

        [title](https://www.example.com)

        # Welcome {{$user->first_name}} {{$user->last_name}}

        ## Etapes pour votre enregistrement au {{ config('app.name') }}

        - Ajouter d'autres participants
        - Payer votre participation

        ---
        <x-mail::subcopy>
            Ma subcopy
        </x-mail::subcopy>

        Thanks,<br>
        {{ config('app.name') }}</x-mail::panel>
</x-mail::message>
