<div x-data="data">

    <form @submit.prevent="save">

        <x-wire-modal-card title="Código de Daño" name="damageCreationModal" width="3xl" wire:model="openModal">

            {{-- Si hay errores, se mostrarán aquí --}}
            <div x-show="errors.length"
                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">¡Ups! Algo salió mal.</strong>
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    <template x-for="error in errors" :key="error">
                        <li x-text="error"></li>
                    </template>
                </ul>
            </div>

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

</div>

@push('js')
    <script>
        function data() {
            return {
                errors: [],

                damage: {
                    code: '',
                    description: '',
                },

                save() {

                    axios.post('/damages', this.damage).then(response => {

                        console.log(response.data.id);

                        $closeModal('damageCreationModal');

                        Livewire.dispatch('damageAdded', {
                            damageId: response.data.id,
                        });

                        this.errors = [];

                        this.damage = {
                            code: '',
                            description: ''
                        };

                    }).catch(error => {
                        if (error.response.status === 422) {
                            this.errors = Object.values(error.response.data.errors).flat();
                        }

                        console.log(error.response.data);
                    });
                },

            }
        }
    </script>
@endpush
