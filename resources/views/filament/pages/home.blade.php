<x-filament-panels::page>
    <h2>Coucou</h2>
    <h3>Liste des inscrits</h3>

    <ul>
        @foreach ($runners as $runner)
            <li>{{ $runner->first_name }} {{ $runner->last_name }}</li>
        @endforeach
    </ul>

</x-filament-panels::page>
