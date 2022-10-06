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
                <div wire:ignore>
                <textarea rows="6" 
                    wire:model.defer="content" 
                    id="editor"
                    class="form-control w-full"
                    placeholder="Ingrese el contenido del post">
                </textarea>
                </div>
                <x-jet-input-error for="content"></x-jet-input-error>
            </div>

            <div class="mb-4">
                <x-jet-label value="Imagen de Post"></x-jet-label>
                <input type="file" id="{{$image_id}}" wire:model="image" class="mb-4">
                <x-jet-input-error for="image"></x-jet-input-error>
                <!-- Image loading message-->
                <div wire:loading wire:target="image" class="my-4 bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded">
                    <strong class="font-bold">¡Imagen Cargando...!</strong>
                    <span class="block sm:inline">Espere mientras se carga la previsualización</span>
                </div>
                <!-- Image Preview (create)-->
                @if ($image)
                    <img src="{{ $image->temporaryURL() }}" class="border-2 border-dashed border-gray-400 w-full">
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
                wire:target="save,image"
                class="disabled:opacity-25 bg-green-500 hover:bg-green-600 active:bg-green-800 ml-2">
                Guardar
            </x-jet-button>
        </x-slot>

    </x-jet-dialog-modal>

    @push('js')
        <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then(function(editor){
                    editor.model.document.on('change:data', () => {
                        @this.set('content', editor.getData());
                    });

                    Livewire.on('resetCKEditor', () => {
                        editor.setData('');
                    });
                })
                .catch( error => {
                    console.error( error );
                } );
        </script>
    @endpush
</div>
