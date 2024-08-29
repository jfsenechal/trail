<x-mail::message>
    # Introduction
    The body of your message.
    ## {{$user->first_name}} {{$user->last_name}}
    <x-mail::panel>
        This is the panel content.

        Login: {{$user->email}}

        Password: {{$user->plainPassord}}

    </x-mail::panel>
    <x-mail::button :url="$url" color="success">
        {{$textbtn}}
    </x-mail::button>
    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
