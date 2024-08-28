<x-mail::message>
    # Introduction
    The body of your message.
    ##{{$user->first_name}} {{$user->last_name}}

    <x-mail::button url="{{route('protected.route', ['token' => $token->plainTextToken])}}">
        {{$textbtn}}
    </x-mail::button>

    Thanks,
</x-mail::message>
