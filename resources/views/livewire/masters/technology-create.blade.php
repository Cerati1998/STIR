<div x-data="data">

    <form wire:submit="save">

        <x-wire-modal-card title="Tecnología Contenedor" name="technologyCreate" width="3xl" wire:model="openModal"
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
                    <x-wire-input required label="Nombre" wire:model="technology.name"
                        placeholder="Ej: CONVENCIONAL, SEACARE, etc." />
                </div>

                <div>
                    <x-wire-input label="Descripción" wire:model="technology.description"
                        placeholder="Ej: Atmosfera controlada para Frutas" />
                </div>
            </div>
            <div class="mb-3">
                <x-wire-input label="Temperatura" wire:model="technology.temperature_range"
                    placeholder='Ej: -30°C a +30°C' />
            </div>
            <div class="mb-3">
                <x-wire-input label="Ventilación" wire:model="technology.ventilation"
                    placeholder='Ej: 25 m³/h o 50 m³/h' />
            </div>
            <div class="mb-3">
                <x-wire-input label="Humedad" wire:model="technology.humidity"
                    placeholder='Ej: No controlada' />
            </div>
            <div class="mb-3">
                <x-wire-input label="Atmosfera" wire:model="technology.atmosphere"
                    placeholder='Ej: Aire natural' />
            </div>
            <div class="mb-3">
                <x-wire-input label="Uso" wire:model="technology.usage"
                    placeholder='Ej: Carga general refrigerada...' />
            </div>

            <x-slot name="footer" class="flex justify-end gap-x-4">
                <x-wire-button flat label="Cancelar" x-on:click="close" />

                <x-wire-button type="submit" primary label="Guardar" icon="arrow-down-tray" />
            </x-slot>

        </x-wire-modal-card>
    </form>

</div>

@push('js')
    <script>
        function dataCreate() {
            return {
                technology: @entangle('technology'),
            }
        }
    </script>
@endpush
