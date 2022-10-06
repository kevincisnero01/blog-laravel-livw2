<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class EditPost extends Component
{   
    use WithFileUploads;

    public $open = false;
    public $post;
    public $image, $image_id; 

    protected $rules =[
        'post.title' => 'required',
        'post.content' => 'required'
    ];  

    // Inicialize values
    public function mount(Post $post)
    {   
        $this->post = $post;
        $this->image_id = rand();
    }

    public function save()
    {   
        // Validar campos
        $this->validate();

        // Procesar imagen
        if($this->image)
        {
            Storage::delete([$this->post->image]);
            $this->post->image = $this->image->store('public/posts');
        }

        // Save data
        $this->post->save();

        // Reset fields
        $this->reset(['open','image']);

        // Render view 
        $this->emitTo('show-post','render');

        // Send message alert
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
