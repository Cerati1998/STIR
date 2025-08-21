<x-dashboard-layout title="Contenedores Descarga | {{ session('company')->razonSocial }}" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('dashboard'),
    ],
    [
        'name' => 'Descargas',
        'route' => route('discharges.index'),
    ],
    [
        'name' => 'Contenedores',
    ],
]">

    <x-slot name="action">
        <x-wire-button label="Nueva" x-on:click="$openModal('containerCreate')" blue />
    </x-slot>

    @livewire(
        'DContainerTable',
        [
            'originType' => \App\Models\Dischargue::class,
            'originId' => $dischargue->id,
        ],
        key('dcontainers-table'),
        ['wire:key' => 'dcontainers-table']
    )
    @push('js')
        <script>
            Livewire.on('bulkAnulateConsult', data => {
                console.log(data[0].msg);
                Swal.fire({
                    title: data[0].title ?? "¿Estas seguro de Anular?",
                    text: data[0].msg ?? "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, bórralo!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.dispatch('bulkAnulate');
                    }
                });
            });
        </script>
    @endpush
</x-dashboard-layout>
