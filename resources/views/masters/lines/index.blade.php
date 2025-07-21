<x-dashboard-layout title="Lineas | {{ session('company')->razon_social }}" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'Lineas',
    ],
]">

<x-slot name="action">
    <x-wire-button label="Nueva" x-on:click="$openModal('lineCreate')" blue />
</x-slot>

@livewire('masters.line-table',[],key('line-table'))
</x-dashboard-layout>