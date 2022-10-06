<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowPost extends Component
{   
    use WithFileUploads;
    use WithPagination;

    // Index
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $segment = '10';
    public $readyToLoad = false;

    // Edit
    public $open_edit = false;
    public $post;
    public $image, $image_id;

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required'
    ];

    protected $queryString = [
        'search'=> ['except' => ''],
        'sort' => ['except' => 'id'],
        'direction'=> ['except' => 'desc'],
        'segment'=> ['except' => '10'],
    ];
    
    // Listening Events
    protected $listeners = ['render','delete'];

    // Inicialize values
    public function mount()
    {   
        $this->post = new Post();
        $this->image_id = rand();
    }

    // Reset after searching
    public function updatingSearch()
    {   
        $this->resetPage();
    }

    // Charging states
    public function loadPost()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {   
        if($this->readyToLoad)
        {
            $posts = Post::where('title','like','%'.$this->search.'%')
            ->OrderBy($this->sort, $this->direction)
            ->paginate($this->segment);

        }else
        {
            $posts = [];
        }
  
        return view('livewire.show-post',['posts' => $posts])
        ->layout('layouts.app');
    }
    // Control sort
    public function order($sort)
    {
        if ($this->sort == $sort) {

            if ($this->direction == 'asc') {
                $this->direction = 'desc';
            } else {
                $this->direction = 'asc';
            }
        
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }
    // Modal edit
    public function edit(Post $post)
    {   
        $this->open_edit = true;
        $this->post = $post;
    }
    // Update post
    public function update()
    {   
        // Validate fields
        $this->validate();

        // Process image
        if($this->image)
        {
            Storage::delete($this->post->image);
            $this->post->image = $this->image->store('public/posts');
        }

        // Save data 
        $this->post->save();

        // Reset data
        $this->reset(['open_edit','image']);
        
        // Send message alert
        $this->emit('alert',[
            'title' => 'Editar Post',
            'text' => 'El post se actualizo correctamente',
            'icon' => 'success'
        ]);
    }

    // Delete post
    public function delete(Post $post)
    {
        $post->delete();
    }
}
