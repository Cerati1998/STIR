<div>
    <div x-data="discharguesCreate">
        <form wire:submit="save">

            <x-wire-modal-card title="Subida masiva de contenedores" name="dischargueCreate" wire:model="openModal"
                :hide-close="true" width="3xl">

                <x-validation-errors class="mb-4" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                    <!-- Línea Naviera -->
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label for="shipping_line_id" class="text-sm text-gray-700">
                                Línea <span class="text-red-500 font-semibold">*</span>
                            </label>
                            <button type="button" x-on:click="$openModal('lineCreate')"
                                class="text-xs text-blue-500 hover:underline">
                                + Nueva línea
                            </button>
                        </div>
                        <x-wire-select id="shipping_line_id" :async-data="route('line.search')" option-label="name" option-value="id"
                            placeholder="Selecciona la Línea" wire:model.live="dischargue.shipping_line_id" />
                    </div>

                    <!-- Nave -->
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label for="vessel_id" class="text-sm text-gray-700">
                                Nave <span class="text-red-500 font-semibold">*</span>
                            </label>
                            <button type="button" x-on:click="openVesselModal"
                                class="text-xs text-blue-500 hover:underline">
                                + Nueva Nave
                            </button>
                        </div>
                        <x-wire-select :options="$vessels" option-label="name" option-value="id"
                            wire:model="dischargue.vessel_id" placeholder="Selecciona la Nave" />
                    </div>

                </div>
                <div class="grid grid-cols-2 gap-4">
                    <!-- ETA -->
                    <x-wire-input type="date" label="ETA" wire:model="dischargue.eta_date" class="col-span-1" />

                    <!-- Semana -->
                    <x-wire-input label="Semana" wire:model="dischargue.week" class="col-span-1" />
                </div>

                <div
                    class="flex items-center justify-center col-span-1 bg-gray-100 shadow-md cursor-pointer sm:col-span-2 dark:bg-secondary-700 rounded-xl h-64">

                    {{-- Input oculto --}}
                    <input id="fileUpload" type="file" class="hidden" wire:model="attach" accept=".xls,.xlsx,.csv"
                        wire:loading.attr="disabled" />

                    {{-- Ícono que dispara el input al hacer click --}}
                    <label for="fileUpload" class="flex flex-col items-center justify-center cursor-pointer">
                        <x-wire-icon name="cloud-arrow-up" class="w-16 h-16 text-blue-600 dark:text-teal-600" />
                        <p class="text-blue-600 dark:text-teal-600">Click o suelta Archivo aqui</p>
                    </label>
                </div>
                <div wire:loading wire:target="attach,save" class="text-blue-500 text-sm">
                    ⏳ Procesando Data... Por favor, espere.
                </div>

                <x-slot name="footer" class="flex justify-between gap-x-4">
                    <div class="flex gap-x-4">
                        <x-wire-button flat label="Cancel" x-on:click="close" />

                        <x-wire-button primary label="Guardar" type="submit" spinner icon="arrow-down-tray"
                            wire:loading.attr="disabled" wire:target="attach,save" />
                    </div>
                </x-slot>
            </x-wire-modal-card>
        </form>
    </div>
    @push('js')
        <script>
            function discharguesCreate() {
                return {
                    dischargue: @entangle('dischargue'),
                    openVesselModal() {
                        /* if (!this.dischargue.shipping_line) {
                            alert('Debes seleccionar una línea naviera antes de crear una nave');
                            return;
                        } */
                        this.$wire.dispatch('setShippingLineId', {
                            shippingLineId: this.dischargue.shipping_line,
                            isExtern: true
                        });
                        $openModal('vesselCreate');
                    }
                }
            }
        </script>
    @endpush
</div>
