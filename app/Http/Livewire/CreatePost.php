<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{   
    use WithFileUploads;

    public $open = false;
    public $title, $content, $image, $image_id; 

    protected $rules =[
        'title' => 'required',
        'content' => 'required',
        'image' => 'required|image|max:2048'
    ];

    public function mount()
    {
        $this->image_id = rand();
    }

    public function save()
    {   
        $this->validate();

        $image = $this->image->store('posts');

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $image
        ]);
        // == Resetear campos
        $this->reset(['open','title','content','image']);
        $this->image_id = rand();
        // === Renderizar Vista 
        $this->emitTo('show-post','render');
        // === Mostrar Mensaje
        $this->emit('alert',[
            'title' => 'Registro Exitoso', 
            'text' => 'El post se registro exitosamente',
            'icon' => 'success'
        ]);
    }
    public function render()
    {
        return view('livewire.create-post');
    }
}
