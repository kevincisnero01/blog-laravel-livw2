<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class EditPost extends Component
{   
    public $open = false;
    public $post;
    public $title, $content; 

    protected $rules =[
        'post.title' => 'required',
        'post.content' => 'required',
    ];  

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function save()
    {   
        // == Validar campos
        $this->validate();

        // == Guardar datos
        $this->post->save();

        // == Resetear campos
        $this->reset(['open','title','content']);
        
        // === Renderizar Vista 
        $this->emitTo('show-post','render');

        // === Mostrar Mensaje
        $this->emit('alert',[
            'title' => 'Registro Actualizado', 
            'text' => 'El post se actualizo exitosamente',
            'icon' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
