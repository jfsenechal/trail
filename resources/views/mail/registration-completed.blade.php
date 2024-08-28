<x-mail::message>
    # Introduction
    The body of your message.
    ## {{$user->first_name}} {{$user->last_name}}
    <x-mail::button :url="$url">
        {{$textbtn}}
    </x-mail::button>
    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
