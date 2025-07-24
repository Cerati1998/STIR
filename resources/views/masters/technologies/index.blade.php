<x-dashboard-layout title="Tipos y Tecnologias Contenedor | {{ session('company')->razonSocial }}" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'Tipos y Tecnologias',
    ],
]">
    <x-slot name="action">
        <div class="grid grid-cols-2 gap-2">
            <x-wire-button right-icon="plus" label="Tipo" x-on:click="$openModal('typeCreate')" green />
            <x-wire-button right-icon="plus" label="Tecnologia" x-on:click="$openModal('technologyCreate')" blue />
        </div>


    </x-slot>
    <x-wire-card>
        {{-- Tabs --}}
        <x-tabs active="tipos-contenedor">
            <x-slot name="header">
                <x-tab-link tab="tipos-contenedor">
                    <i class="fa-solid fa-table-cells-large me-2"></i>
                    Tipos de Contenedor
                </x-tab-link>
                <x-tab-link tab="tecnologias-contenedor">
                    <i class="fa-solid fa-gear me-2"></i>
                    Tecnologias
                </x-tab-link>
            </x-slot>

            <x-tab-content tab="tipos-contenedor">
                <div class="mt-4">
                    @livewire('masters.type-container-table', [], key('type-container-table'))
                </div>
            </x-tab-content>

            <x-tab-content tab="tecnologias-contenedor">
                <div class="mt-4">
                    @livewire('masters.technology-table', [], key('technology-table'))
                </div>

            </x-tab-content>

        </x-tabs>
    </x-wire-card>




</x-dashboard-layout>
