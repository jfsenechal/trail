<x-filament-panels::page>
    <h2>Coucou</h2>
    <h3>Liste des inscrits</h3>

    <ul>
        @foreach ($joggers as $jogger)
            <li>{{ $jogger->first_name }} {{ $jogger->last_name }}</li>
        @endforeach
    </ul>

</x-filament-panels::page>
