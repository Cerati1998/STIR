<div x-data="dataCreate">
    <form wire:submit="save">

        <x-wire-modal-card title="Agregar Daño" name="damageCreate" wire:model="openModal" width="3xl">

            <x-validation-errors class="mb-4" />


            <div class="grid grid-cols-1 gap-4">


                <div class="col-span-1">
                    <x-label class="mb-1">
                        Código
                    </x-label>
                    <x-input x-model="damageEdit.code" placeholder="Ingrese el código" class="w-full" />
                </div>

                <div class="col-span-2">
                    <x-wire-input required label="Descripción" x-model="damageEdit.description"
                        placeholder="Ingrese la descripción" />
                </div>

            </div>


            <x-slot name="footer" class="flex justify-end gap-x-4">
                <x-wire-button flat label="Cancel" x-on:click="close" />

                <x-wire-button type="submit" primary label="Guardar" />
            </x-slot>

        </x-wire-modal-card>
    </form>

    @push('js')
        <script>
            function dataCreate() {
                return {

                    damage: @entangle('damage'),
                }
            }
        </script>
    @endpush
</div>
