<x-filament-widgets::widget>
    <x-filament::section>
        <h3>Vos joggers inscrits</h3>
        @if (count($joggers) == 0)
            <p class="text-red-500">Encodez vos joggers !</p>
        @endif
        <ul>
            @foreach ($joggers as $jogger)
                <li>{{ $jogger->first_name }} {{ $jogger->last_name }}</li>
            @endforeach
        </ul>

        Puis payez
    </x-filament::section>
</x-filament-widgets::widget>
