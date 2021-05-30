<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Project;
use App\Models\ProjectReference;

class ProjectReferenceComponet extends Component{

    public $description, $project_id, $projectreferences, $projects;
    public $isOpen = 0;
    public $selectOpen = 0;

    public function render(){
        $this->projectreferences=DB::
        select("select
            project_references.id,
            project_references.description,
            project_references.project_id,
            projects.title
        from
            project_references inner join projects on project_references.project_id=projects.id
        ");
        $this->projects = Project::all();
        return view('livewire.ProjectReferences.projectReferences');
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
        DB::select("insert into project_references (description,project_id) values (?,?)",array($this->description,$this->project_id));
        /*
        ProjectReferenceComponet::updateOrCreate(['id' => $this->id], [
            'description' => $this->description,
            'project_id' => $this->project_id

        ]);*/
        session()->flash('message',

            $this->id ? 'Referencia actualizada.' : 'Referencia generada con exito.');
        $this->closeModal();
        $this->resetInputFields();

    }
    public function edit($id){
        $projectreferences = ProjectReference::findOrFail($id);
        $this->id = $id;
        $this->description = $projectreferences->description;
        $this->project_id = $projectreferences->project_id;
        $this->openModal();
    }

    public function delete($id){
        ProjectReference::find($id)->delete();
        session()->flash('message', 'Referencia eliminada.');
    }

}
