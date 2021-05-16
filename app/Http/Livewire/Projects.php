<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Project;
use App\Models\ProjectType;
use mysql_xdevapi\Exception;

class Projects extends Component
{
    public $project, $title, $description, $slug = "hola", $project_id, $project_type, $categories;
    public $isOpen = 0;
    public $selectOpen = 0;

    public function render()
    {
        $this->project = DB::select(
            "select
		    projects.id,
		    projects.title,
            projects.description,
            projects.view_counter,
            project_types.description as type_project_description
	    from
		    project_types inner join projects on projects.project_type_id = project_types.id");
        $this->categories = ProjectType::all();
        return view('livewire.Projects.projects');
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
        $this->title="";
        $this->description="";
        $this->project_id="";
        $this->project_type="";
    }

    public function store(){
        $this->validate([
           'title'=>'required',
           'project_type'=>'required',
           'description'=>'required'
        ]);

        /*try {
            DB::select("call insertProject(?,?,?,?)", array(
                $this->title,
                $this->description,
                $this->slug,
                $this->project_type));
        }catch (\Exception $e){
        }*/

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
        $this->resetInputFields();
    }

    public function edit($id){
        $this->selectOpen=false;
        $project = Project::findOrFail($id);
        $this->project_id = $id;
        $this->title = $project->title;
        $this->description = $project->description;
        $this->openModal();
    }

    public function delete($id){
        Project::find($id)->delete();
        session()->flash('message', 'Proyecto eliminado con éxito.');
    }
}
