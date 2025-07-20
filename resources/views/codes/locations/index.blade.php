<x-dashboard-layout title="Códigos de Ubicación | {{ session('company')->razonSocial }}" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'Ubicaciones',
    ],
]">
    <x-slot name="action">
        <x-wire-button label="Nuevo" x-on:click="$openModal('locationCreate')" blue />
    </x-slot>

    @livewire('location-table', [], key('location-table'))
</x-dashboard-layout>
