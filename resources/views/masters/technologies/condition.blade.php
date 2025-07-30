<div x-data="data">

    <form wire:submit="save">

        <x-wire-modal-card title="Condición Contenedor" name="conditionModal" width="3xl" wire:model="openModal"
            :hide-close="true">

            {{-- Si hay errores, se mostrarán aquí --}}
            {{-- <div x-show="errors.length"
                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">¡Ups! Algo salió mal.</strong>
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    <template x-for="error in errors" :key="error">
                        <li x-text="error"></li>
                    </template>
                </ul>
            </div> --}}
            <x-validation-errors class="mb-4" />

            <div class="grid grid-cols-2 gap-4 mb-3">
                <div>
                    <x-wire-input required label="Nombre" wire:model="condition.name"
                        placeholder="Ej: CONVENCIONAL, SEACARE, etc." />
                </div>

                <div>
                    <x-wire-input required label="Descripción" wire:model="condition.description"
                        placeholder="Ej: Atmosfera controlada para Frutas" />
                </div>
            </div>
            <div class="mb-3">
                <x-wire-input required label="Temperatura" wire:model="condition.temperature_range"
                    placeholder='Ej: -30°C a +30°C' />
            </div>
            <div class="mb-3">
                <x-wire-input required label="Ventilación" wire:model="condition.ventilation"
                    placeholder='Ej: 25 m³/h o 50 m³/h' />
            </div>
            <div class="mb-3">
                <x-wire-input required label="Humedad" wire:model="condition.humidity"
                    placeholder='Ej: No controlada' />
            </div>
            <div class="mb-3">
                <x-wire-input required label="Atmosfera" wire:model="condition.atmosphere"
                    placeholder='Ej: Aire natural' />
            </div>
            <div class="mb-3">
                <x-wire-input required label="Uso" wire:model="condition.usage"
                    placeholder='Ej: Carga general refrigerada...' />
            </div>


            <x-slot name="footer" class="flex justify-end gap-x-4">
                <x-wire-button flat label="Cancelar" x-on:click="close" />

                <x-wire-button type="submit" primary label="Actualizar" />
            </x-slot>

        </x-wire-modal-card>
    </form>

</div>

@push('js')
    <script>
        function data() {
            return {
                errors: [],

                // Enlace bidireccional con Livewire
                condition: @entangle('condition'),

                save() {
                    axios.post('/conditions', this.condition)
                        .then(response => {
                            $closeModal('conditionModal');

                            Livewire.dispatch('conditionAdded', {
                                conditionId: response.data.id,
                            });

                            this.errors = [];

                            // Reinicia el objeto condition (Livewire también lo hace en updated)
                            this.condition = {
                                code: '',
                                name: '',
                                country_code: ''
                            };
                        })
                        .catch(error => {
                            if (error.response.status === 422) {
                                this.errors = Object.values(error.response.data.errors).flat();
                            }

                            console.error(error.response.data);
                        });
                }
            }
        }

        function confirmDelete(conditionId) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('destroy', conditionId);
                }
            });
        }
    </script>
@endpush
