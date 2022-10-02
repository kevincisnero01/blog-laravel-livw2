<div>
    <x-slot name="header">
        <h2 class="font-semibold text-x1 text-gray-800 leading-title">
            Listado de Posts
        </h2>
    </x-slot>

    <div class="max-w-7x1 mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!--Required Tailwind CSS v0.2+ -->
    <x-table>

        <div class="px-6 py-4 flex items-center">

            <x-jet-input 
                type="text" 
                wire:model="search" 
                class="flex-1 mr-4" 
                placeholder="Ingrese el termino que desea buscar"/>

            @livewire('create-post')
            
        </div>

        @if($posts->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" 
                            class="cursor-pointer px-6 py-3 tex-left text-xs text-gray-500 uppercase"
                            wire:click="order('id')">
                            id
                            {{-- Sort --}}
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
                            {{-- Sort --}}
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
                            {{-- Sort --}}
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
                    @foreach ($posts as $post)     
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"> 
                                {{ $post->id }} 
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"> 
                                {{ $post->title }} 
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">
                                {{ $post->content }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">
                                <img src="{{ Storage::url($post->image) }}" height="48" width=48 alt="Photo">
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">
                            @livewire('edit-post',['post' => $post],key($post->id))
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="px-6 py-4 bg-white">
                No existe existe ningun registro que coincida con la busqueda.
            </div>
        @endif

    </x-table>
                
    </div><!--.max-w-7x1-->
</div>
