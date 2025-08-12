<x-dashboard-layout title="Transportistas | {{ session('company')->razonSocial }}" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'Transportistas',
    ],
]">

    <x-slot name="action">

        <x-wire-button label="Nuevo" right-icon="plus" x-on:click="$openModal('clientCreate')" blue />

    </x-slot>

   {{--  @livewire('client-table', [
        'identities' => $identities,
    ], key('client-table'))

    @livewire('client-create', ['identities' => $identities], key('client-create')) --}}

</x-dashboard-layout>