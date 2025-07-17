<x-dashboard-layout title="Codigos de Daños | {{ session('company')->razonSocial }}" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'Codigos de Daños',
    ],
]">
    <x-slot name="action">
        <x-wire-button label="Nuevo" x-on:click="$openModal('damageCreate')" blue />
    </x-slot>
    @livewire('damage-table',[], key('damage-table'))
    @livewire('damage-create',[],key('damage-create'))
</x-dashboard-layout>