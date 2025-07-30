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
        <div class="grid grid-cols-3 gap-1">
            <x-wire-button label="Tipo" x-on:click="$openModal('typeContainerCreate')" green />
            <x-wire-button label="Tecno.." x-on:click="$openModal('technologyCreate')" blue />
            <x-wire-button label="Condición" x-on:click="$openModal('conditionCreate')" teal />
        </div>


    </x-slot>
    <x-wire-card>
        {{-- Tabs --}}
        <x-tabs active="tipos-contenedor">
            <x-slot name="header">
                <x-tab-link tab="tipos-contenedor">
                    <i class="fa-solid fa-table-cells-large me-1"></i>
                    Tipos
                </x-tab-link>
                <x-tab-link tab="tecnologias-contenedor">
                    <i class="fa-solid fa-gear me-1"></i>
                    <span class="truncate w-12 md:w-auto">
                        Tecnologias
                    </span>
                </x-tab-link>
                <x-tab-link tab="condicion-contenedor">
                    <i class="fa-solid fa-wrench me-1"></i>
                    Condiciones
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
            <x-tab-content tab="condicion-contenedor">
                <div class="mt-4">
                    @livewire('masters.condition-table', [], key('condition-table'))
                </div>

            </x-tab-content>

        </x-tabs>
    </x-wire-card>
    @livewire('masters.technology-create', [], 'masters.technology-create')
    @livewire('masters.type-container-create', [], 'masters.type-container-create')
    @livewire('masters.condition-create', [], 'condition-create')



</x-dashboard-layout>
