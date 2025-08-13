<x-dashboard-layout title="Transportistas | {{ session('company')->razonSocial }}" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'Transportistas',
        'route' => route('transports.index'),
    ],
    [
        'name' => 'Vehiculos',
    ],
]">

    <x-slot name="action">

        <x-wire-button label="Nuevo" right-icon="plus" x-on:click="$openModal('transportCreate')" blue />

    </x-slot>

    @livewire(
        'transport-table',
        [
            'identities' => $identities,
        ],
        key('transport-table')
    )

    @livewire('transport-create', ['identities' => $identities], key('transport-create'))

</x-dashboard-layout>
