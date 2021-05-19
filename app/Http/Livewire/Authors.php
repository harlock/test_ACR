<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Author;
class Authors extends Component
{
    public $user, $project, $user_id, $project_id, $author_id, $author;
    public $isOpen = 0;
    public function render()
    {
        $this->author=DB::select("select authors.id, projects.title ,users.name from users inner join authors on authors.user_id = users.id inner join projects on authors.project_id = projects.id");
        $this->user=User::all();
        $this->project=Project::all();
        return view('livewire.Authors.authors');
    }

    public  function create(){
        $this->resetInputFields();
        $this->openModal();
    }

    public  function openModal(){
        $this->isOpen=true;
    }

    public function closeModal(){
        $this->isOpen=false;
    }

    private function resetInputFields(){
        $this->user_id="";
        $this->project_id="";
    }

    public function store(){
        $this->validate([
           'project_id'=>'required',
           'user_id'=>'required'
        ]);

        Author::updateOrCreate(['id' => $this->author_id], [
            'project_id' => $this->project_id,
            'user_id' => $this->user_id
        ]);

        session()->flash('message',
            $this->author_id ? 'Autor actualizado exitosamente.': 'Autor generado con éxito.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id){
        $author = Author::findOrFail($id);
        $this->author_id=$id;
        $this->openModal();
    }

    public function delete($id){
        Author::find($id)->delete();
        session()->flash('message', 'Autor eliminado con éxito.');
    }
}
