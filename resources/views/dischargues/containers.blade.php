<x-dashboard-layout title="Contenedores Descarga | {{ session('company')->razonSocial }}" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'Descargas',
        'route' => route('dischargues.index'),
    ],
    [
        'name' => 'Contenedores',
    ],
]">

    <x-slot name="action">
        <x-wire-button label="Nueva" x-on:click="$openModal('containerCreate')" blue />
    </x-slot>

    @livewire(
        'DContainerTable',
        [
            'originType' => \App\Models\Dischargue::class,
            'originId' => $dischargue->id,
        ],
        key('dcontainers-table')
    )
</x-dashboard-layout>
