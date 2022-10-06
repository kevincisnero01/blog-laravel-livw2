<div wire:init='loadPost'>
    <x-slot name="header">
        <h2 class="font-semibold text-x1 text-gray-800 leading-title">
            Listado de Posts
        </h2>
    </x-slot>

    <div class="max-w-7x1 mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!--Required Tailwind CSS v0.2+ -->
    <x-table>

        <div class="px-6 py-4 flex items-center">
            <div class="flex items-center">
                <span>Mostrar</span>
                <select class="form-control mx-1" wire:model='segment'>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span>Registros</span>
            </div>

            <x-jet-input 
                type="text" 
                wire:model="search" 
                class="flex-1 mx-4" 
                placeholder="Ingrese el termino que desea buscar"/>

            @livewire('create-post')
        </div>

        @if(count($posts))
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" 
                            class="cursor-pointer px-6 py-3 tex-left text-xs text-gray-500 uppercase"
                            wire:click="order('id')">
                            id
                            {{-- Icon for sort --}}
                            @if ($sort == 'id')
                                @if($direction == 'asc')
                                    <i class="fa-solid fa-sort-up float-right"></i>
                                @else
                                    <i class="fa-solid fa-sort-down float-right"></i>
                                @endif
                            @else
                                <i class="fa-solid fa-sort float-right"></i>
                            @endif
                        </th>
                        <th scope="col" 
                            class="cursor-pointer px-6 py-3 tex-left text-xs text-gray-500 uppercase"
                            wire:click="order('title')">
                            Titulo
                            {{-- Icon for sort --}}
                            @if ($sort == 'title')
                                @if($direction == 'asc')
                                    <i class="fa-solid fa-sort-up float-right"></i>
                                @else
                                    <i class="fa-solid fa-sort-down float-right"></i>
                                @endif
                            @else
                                <i class="fa-solid fa-sort float-right"></i>
                            @endif
                        </th>
                        <th scope="col" 
                            class="cursor-pointer px-6 py-3 tex-left text-xs text-gray-500 uppercase"
                            wire:click="order('content')">
                            Contenido
                            {{-- Icon for sort --}}
                            @if ($sort == 'content')
                                @if($direction == 'asc')
                                    <i class="fa-solid fa-sort-up float-right"></i>
                                @else
                                    <i class="fa-solid fa-sort-down float-right"></i>
                                @endif
                            @else
                                <i class="fa-solid fa-sort float-right"></i>
                            @endif
                        </th>
                        <th scope="col" class="cursor-pointer px-6 py-3 tex-left text-xs text-gray-500 uppercase">
                            Imagen
                        </th>  
                        <th scope="col"
                            class="relative px-6 py-3 text-xs text-gray-500 uppercase">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($posts as $item)     
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"> 
                                {{ $item->id }} 
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"> 
                                {{ $item->title }} 
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">
                                {!! $item->content !!}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">
                                <img src="{{ Storage::url($item->image) }}" height="48" width=48 alt="Photo">
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">
                            <!-- Action buttons-->
                            <a class="btn btn-blue" wire:click="edit({{ $item }})"> 
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            <a class="btn btn-red ml-2" wire:click="$emit('deletePost',{{ $item }})"> 
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($posts->hasPages())
            <div class="px-4 py-2">
                {{ $posts->links() }}
            </div>
            @endif
        @else
            <div class="px-6 py-4 bg-white">
                No existe existe ningun registro que coincida con la busqueda.
            </div>
        @endif
        
   

    </x-table>
    </div><!--.max-w-7x1-->

    <!-- Modal Edit Post -->
    <x-jet-dialog-modal wire:model="open_edit">
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

                <!-- Imagen loading message-->
                <div wire:loading wire:target="image" class="my-4 bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded">
                    <strong class="font-bold">¡Imagen Cargando...!</strong>
                    <span class="block sm:inline">Espere mientras se carga la previsualización</span>
                </div>

                <!-- Image preview (edit)-->
                @if ($image)
                    <img src="{{ $image->temporaryURL() }}" class="border-2 border-dashed border-gray-400 w-full">
                @elseif($post->image)
                    <img src="{{ Storage::url($post->image)}}" alt="Imagen">
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button 
                wire:click="$set('open_edit',false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-button 
                wire:click="update"
                wire:loading.attr="disabled"
                wire:target="update"
                class="disabled:opacity-25 bg-green-500 hover:bg-green-600 active:bg-green-800 ml-2">
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

@push('js') 
    <script>
        Livewire.on('alert', event =>{
            Swal.fire({
                title: event.title,
                text: event.text,
                icon: event.icon,
                showConfirmButton: false,
                timer: 1800,
                showCloseButton: true,
            })
        })
    </script>

    <script>
        Livewire.on('deletePost', postId =>{
            Swal.fire({
            title: '¿Esta seguro?',
            text: "¡Esta accción no se puede revertir!",
            icon: 'warning',
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ¡Eliminalo!'
            }).then((result) => {
            if (result.isConfirmed) {

                Livewire.emitTo('show-post','delete', postId);

                Swal.fire({
                    title:'¡Post Eliminado!',
                    text:'Tu archivo fue aliminado satisfactoriamente.',
                    icon:'success',
                    timer: 1800,
                    showConfirmButton: false,
                })
            }
            })
        })
    </script>
@endpush

</div>