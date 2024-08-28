<x-filament-widgets::widget>
    <x-filament::section>
        <h2 class="grid flex-1 text-2xl font-semibold leading-6 text-gray-950 dark:text-white">
            Vos joggers inscrits</h2>
        @if (count($joggers) == 0)
            <p class="text-red-500 m-3">
                Aucun
            </p>
        @endif
        <ul>
            @foreach ($joggers as $jogger)
                <li>{{ $jogger->first_name }} {{ $jogger->last_name }}</li>
            @endforeach
        </ul>
    </x-filament::section>
</x-filament-widgets::widget>
