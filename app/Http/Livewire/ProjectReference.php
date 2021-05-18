<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Project;
use App\Models\ProjectReferences;

class ProjectReference extends Component{

    public $description, $project_id, $projectreferences, $projects;
    public $isOpen = 0;
    public $selectOpen = 0;

    public function render(){
        $this->projectreferences=DB::
        select("select
            projectreferences.id,
            projectreferences.description,
            projectreferences.project_id,
            projects.title
        from
            projectreferences inner join projects on projectreferences.project_id=projects.id
        ");
        $this->projects = Project::all();
        return view('livewire.ProjectReferences.ProjectReferences');
    }
    public function create(){
        $this->resetInputFields();
        $this->openModal();
        $this->selectOpen=true;
    }

    public  function openModal(){
        $this->isOpen=true;
    }

    public function closeModal(){
        $this->isOpen=false;
    }

    private function resetInputFields(){
        $this->description = '';
        $this->project_id = '';
        $this->id='';
    }
    public function store(){
        $this->validate([
            'description' => 'required',
            'project_id' => 'required',
        ]);
        ProjectReferences::updateOrCreate(['id' => $this->id], [
            'description' => $this->description,
            'project_id' => $this->project_id

        ]);
        session()->flash('message',

            $this->id ? 'Referencia actualizada.' : 'Referencia generada con exito.');
        $this->closeModal();
        $this->resetInputFields();

    }
    public function edit($id){
        $projectreferences = ProjectReferences::findOrFail($id);
        $this->id = $id;
        $this->description = $projectreferences->description;
        $this->project_id = $projectreferences->project_id;
        $this->openModal();
    }

    public function delete($id){
        ProjectReferences::find($id)->delete();
        session()->flash('message', 'Referencia eliminada.');
    }

}
