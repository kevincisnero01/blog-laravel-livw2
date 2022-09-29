<div>
    <x-jet-button
        wire:click="$set('open',true)"
        class="bg-blue-500 hover:bg-blue-700">
        Crear Post
    </x-jet-button>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            <h2 class="uppercase text-2x1 font-bold">Crear Post</h2>
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Titulo del Post"></x-jet-label>
                <x-jet-input 
                    wire:model.defer="title" 
                    type="text" 
                    class="w-full"
                    placeholder="Ingrese el titulo del post">
                </x-jet-input>
            </div>

            <div class="mb-4">
                <x-jet-label value="Contenido del Post"></x-jet-label>
                <textarea rows="6" 
                    wire:model.defer="content" 
                    class="form-control w-full"
                    placeholder="Ingrese el contenido del post">
                </textarea>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button 
                wire:click="save"
                class="bg-green-500 hover:bg-green-600 ml-2">
                Guardar
            </x-jet-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>