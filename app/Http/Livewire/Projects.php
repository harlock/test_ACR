<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Project;
use App\Models\ProjectType;
use mysql_xdevapi\Exception;

class Projects extends Component
{
    public $project, $title, $description, $slug, $project_id, $project_type_id, $categorie;
    public $isOpen = 0, $view_counter = "0" , $enabled = "0";
    public $update;
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
        $this->categorie = ProjectType::all();
        return view('livewire.Projects.projects');
    }

    public function create(){
        $this->update=false;
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
        $this->title="";
        $this->description="";
        $this->project_id="";
        $this->project_type_id="";
    }

    public function store(){

        $this->validate([
           'title'=>'required',
            'project_type_id'=>'required',
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

        Project::create([
            'title'=>$this->title,
            'description'=>$this->description,
            'view_counter'=>$this->view_counter,
            'slug'=>\Illuminate\Support\Str::slug($this->title),
            'enabled'=>$this->enabled,
            'project_type_id'=>$this->project_type_id
        ]);

        session()->flash('message',
        $this->project_id ? 'Proyecto actualizado exitosamente.': 'Proyecto generado con éxito.');
        $this->closeModal();
        $this->resetInputFields();
        //Aqui va a retornar a la vista de agregar textos, imagenes, videos
    }

    public function edit($id){
        $project = Project::findOrFail($id);
        $this->project_id=$id;
        $this->title = $project->title;
        $this->description = $project->description;
        $this->update=true;
        $this->openModal();
    }

    public function update(){

        $this->validate([
            'title'=>'required',
            'description'=>'required',
            'project_id'=>'required'
        ]);

        if ($this->project_id){
            $project = Project::find($this->project_id);
            $project->update([
                'title'=>$this->title,
                'description'=>$this->description
            ]);
        }

        session()->flash('message',
            $this->project_id ? 'Proyecto actualizado exitosamente.': 'Proyecto generado con éxito.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id){
        Project::find($id)->delete();
        session()->flash('message', 'Proyecto eliminado con éxito.');
    }
}
