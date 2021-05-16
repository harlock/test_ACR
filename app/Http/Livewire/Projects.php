<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Project;

class Projects extends Component
{
    public $project, $title, $description, $view_counter = 0, $slug = "hola", $enabled = 0, $project_id, $project_type_id = 1;
    public $isOpen = 0;

    public function render()
    {
        $this->project = Project::all();
        return view('livewire.Projects.projects');
    }

    public  function create(){
        $this->reseInputFields();
        $this->openModal();
    }

    public  function openModal(){
        $this->isOpen=true;
    }

    public function closeModal(){
        $this->isOpen=false;
    }

    private function reseInputFields(){
        $this->title="";
        $this->description="";
        $this->project_id="";
    }

    public function store(){
        $this->validate([
           'title'=>'required',
           'description'=>'required'
        ]);

        Project::updateOrCreate(['id'=>$this->project_id],[
            'title'=>$this->title,
            'description'=>$this->description,
            'view_counter'=>$this->view_counter,
            'slug'=>$this->slug,
            'enabled'=>$this->enabled,
            'project_type_id'=>$this->project_type_id
        ]);

        session()->flash('message',
        $this->project_id ? 'Proyecto actualizado exitosamente.': 'Proyecto generado con éxito.');

        $this->closeModal();
        $this->reseInputFields();
    }

    public function edit($id){
        $project = Project::findOrFail($id);
        $this->project_id = $id;
        $this->title = $project->title;
        $this->description = $project->description;
        $this->openModal();
    }

    public function delete($id){
        Projects::find($id)->delete();
        session()->flash('message', 'Proyecto eliminado con éxito.');
    }
}
