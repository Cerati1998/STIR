<div class="w-8">
    <div class="absolute">
        <x-wire-dropdown>
            <x-slot name="trigger">
                <i class="fa-solid fa-bars"></i>
            </x-slot>
            <x-wire-dropdown.item wire:click="edit({{ $line->id }})">
                <div class="flex items-center gap-2">
                    <i class="fas fa-edit mr-2 text-green-500"></i>
                    <span>Editar</span>
                </div>
            </x-wire-dropdown.item>


            <x-wire-dropdown.item href="{{ route('line.vessels', $line->id) }}">
                <div class="flex items-center gap-2">
                    <i class="fas fa-ship mr-2 text-blue-500"></i>
                    <span>Naves</span>
                </div>
            </x-wire-dropdown.item>

            <x-wire-dropdown.item wire:click="confirmDelete({{ $line->id }})">
                <div class="flex items-center gap-2">
                    <i class="fas fa-trash mr-3 text-red-500"></i>
                    <span>Eliminar</span>
                </div>
            </x-wire-dropdown.item>
        </x-wire-dropdown>
    </div>
</div>
