<x-dashboard-layout title="Descargas | {{ session('company')->razonSocial }}" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'Descargas',
    ],
]">
    <x-wire-alert class="mb-4"
        title="Ojo! Recuerda eliminar la fila de ejemplo de la plantilla antes de agregar tu información. Esto evitará errores en la carga masiva."
        warning />

    <div class="flex flex-wrap justify-between items-center mb-8 md:mb-3">
        <div>
            <h1 class="text-xl">Subida masiva</h1>
        </div>
        <div class="gap-4">
            <x-wire-button href="{{ route('dischargue-template') }}" label="Descargar Plantilla"
                icon="arrow-down-on-square" green />
            <x-wire-button label="Subida Masiva" icon="arrow-up-on-square" x-on:click="$openModal('dischargueCreate')" />
        </div>
    </div>
    @livewire('dischargue-table', [], 'dischargue-table')
    @livewire('dischargue-create', [], 'dischargue-create')
    @livewire('masters.vessel-create', [], 'vessel-create')
    @livewire('masters.line-create', [], 'line-create')
</x-dashboard-layout>
