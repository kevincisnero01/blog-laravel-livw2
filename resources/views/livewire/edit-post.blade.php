<div>
    <a class="btn btn-blue" wire:click="$set('open',true)"> 
        <i class="fa-regular fa-pen-to-square"></i>
    </a>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar 
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Titulo del Post"></x-jet-label>
                <x-jet-input 
                    wire:model="post.title" 
                    type="text" 
                    class="w-full"
                    placeholder="Ingrese el titulo del post">
                </x-jet-input>
                <x-jet-input-error for="title"></x-jet-input-error>
            </div>

            <div class="mb-4">
                <x-jet-label value="Contenido del Post"></x-jet-label>
                <textarea rows="6" 
                    wire:model="post.content" 
                    class="form-control w-full"
                    placeholder="Ingrese el contenido del post">
                </textarea>
                <x-jet-input-error for="content"></x-jet-input-error>
            </div>

            <div class="mb-4">
                <x-jet-label value="Imagen"></x-jet-label>
                <x-jet-input type="file"  wire:model="image" id="{{$image_id}}"></x-jet-input>
                <x-jet-input-error for="image"></x-jet-input-error>
                <br>
                <!-- Mensaje Cargando Imagen-->
                <div wire:loading wire:target="image" class="my-4 bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded">
                    <strong class="font-bold">¡Imagen Cargando...!</strong>
                    <span class="block sm:inline">Espere mientras se carga la previsualización</span>
                </div>
                <!-- Previsualizacion de Imagen-->
                @if ($image)
                    <img src="{{ $image->temporaryURL() }}" class="border-2 border-dashed border-gray-400 w-full">
                @else
                    <img src="{{ Storage::url($post->image)}}" alt="Imagen">
                @endif
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
