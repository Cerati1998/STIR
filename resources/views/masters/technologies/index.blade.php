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
            <x-wire-button right-icon="plus" label="Tipo" x-on:click="$openModal('portCreate')" green />
            <x-wire-button right-icon="plus" label="Tecnologia" x-on:click="$openModal('portCreate')" blue />
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
                <div class="grid lg:grid-cols-2 gap-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos aliquid hic facilis adipisci voluptas
                    repellendus, corrupti reiciendis sapiente odit. Nam dolore commodi dolor, earum voluptate assumenda
                    aspernatur quisquam recusandae atque.
                </div>
            </x-tab-content>

            <x-tab-content tab="tecnologias-contenedor">

                <div class="grid lg:grid-cols-2 gap-4">


                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Amet unde incidunt accusantium nemo
                    explicabo ex omnis consequatur vel architecto, a ipsam odio aliquam pariatur eveniet commodi. Nam
                    voluptas atque aperiam?

                </div>

            </x-tab-content>

        </x-tabs>
    </x-wire-card>




</x-dashboard-layout>
