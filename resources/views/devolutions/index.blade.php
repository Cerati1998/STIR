<x-dashboard-layout title="Devoluciones | {{ session('company')->razonSocial }}" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'Devoluciones',
    ],
]">
    <x-wire-alert class="mb-4"
        title="Ojo! Recuerda eliminar la fila de ejemplo de la plantilla antes de agregar tu información. Esto evitará errores en la carga masiva."
        warning />

    <div class="flex flex-wrap justify-between items-center mb-8 md:mb-3">
        <div>
            <h1 class="text-xl">Anuncios de ingreso</h1>
        </div>
        <div class="gap-4">
            <x-wire-button href="{{ route('devolution-template') }}" label="Descargar Plantilla"
                icon="arrow-down-on-square" green />
            <x-wire-button label="Subida Masiva" icon="arrow-up-on-square" x-on:click="$openModal('devolutionCreate')" />
        </div>
    </div>
    @livewire('devolution-table', [], 'devolution-table')
    @livewire('devolution-create', [], 'devolution-create')
    @livewire('custom-broker-create', ['identities' => $identities], 'custom-broker-create')
    @livewire('client-create', ['identities' => $identities], 'client-create')
    @livewire('masters.vessel-create', [], 'vessel-create')
    @livewire('masters.line-create', [], 'line-create')
</x-dashboard-layout>
