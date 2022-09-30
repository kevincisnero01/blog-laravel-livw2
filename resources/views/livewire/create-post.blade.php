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
                <x-jet-input-error for="title"></x-jet-input-error>
            </div>

            <div class="mb-4">
                <x-jet-label value="Contenido del Post"></x-jet-label>
                <textarea rows="6" 
                    wire:model.defer="content" 
                    class="form-control w-full"
                    placeholder="Ingrese el contenido del post">
                </textarea>
                <x-jet-input-error for="content"></x-jet-input-error>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button 
                wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button 
                wire:click="save"
                wire:loading.attr="disabled"
                wire:target="save"
                class="disabled:opacity-25 bg-green-500 hover:bg-green-600 active:bg-green-800 ml-2">
                Guardar
            </x-jet-button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
