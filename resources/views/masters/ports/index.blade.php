<x-dashboard-layout title="Puertos | {{ session('company')->razonSocial }}" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'portas',
    ],
]">

<x-slot name="action">
    <x-wire-button label="Nuevo" x-on:click="$openModal('portCreate')" blue />
</x-slot>

@livewire('masters.port-table',[],key('port-table'))
{{-- @livewire('masters.port-create',[],key('mastes.port-create'))--}}
</x-dashboard-layout>