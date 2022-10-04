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

    //Index Post
    public $search = '';
    public $sort = 'id';
    public $direction = 'desc';
    public $segment = '10';

    //Edit Post
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

    public function mount()
    {   
        $this->post = new Post();
        $this->image_id = rand();
    }
    public function updatingSearch()
    {   
        $this->resetPage();
    }

    public function render()
    {   
        $posts = Post::where('title','like','%'.$this->search.'%')
            ->OrderBy($this->sort, $this->direction)
            ->paginate($this->segment);

        return view('livewire.show-post',['posts' => $posts])
        ->layout('layouts.app');
    }

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

    public function edit(Post $post)
    {   
        $this->open_edit = true;
        $this->post = $post;
    }

    public function update()
    {   
        // == Validate Fields
        $this->validate();

        // == Process Image
        if($this->image)
        {
            Storage::delete($this->post->image);
            $this->post->image = $this->image->store('public/posts');
        }

        // == Save Data 
        $this->post->save();

        // == Reset Data
        $this->reset(['open_edit','image']);
        
        // == Send Message
        $this->emit('alert',[
            'title' => 'Editar Post',
            'text' => 'El post se actualizo correctamente',
            'icon' => 'success'
        ]);
    }
}
