<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Award;
use App\Models\Project;
use App\Models\ProjectAward;

use mysql_xdevapi\Exception;

class ProjectAwards extends Component
{
    public $pojectAward,$awards,$porjects,$date,$project_id,$award_id,$project_awards_id;
    public $isOpen = 0;
    public $selectOpen = 0;

    public function render()
    {
        $this->pojectAward = DB::select(
            "select
            pa.date, p.title, aw.name
        from
            project_awards as pa,
            awards as aw,
            projects as p
        where
            pa.project_id = p.id
                and pa.award_id = aw.id ");
        $this->awards = Award::all();
        $this->porjects = Project::all();
        return view('livewire.ProjectAwards.projectAwards');
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
        $this->date="";
        $this->project_id="";
        $this->award_id="";
        $this->project_awards_id="";

    }

    public function store(){
        $this->validate([
           'date'=>'required',
           'project_id'=>'required',
           'award_id'=>'required'

        ]);

        ProjectAward::updateOrCreate(['id'=>$this->project_awards_id],[
            'date'=>$this->date,
            'project_id'=>$this->project_id,
            'award_id'=>$this->award_id
        ]);



        session()->flash('message',
        $this->id ? 'Premio de proyecto actualizado exitosamente.': 'Premio de proyecto generado exitosamente.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id){
        $pojectAward = ProjectAward::findOrFail($id);
        $this-> id=$pojectAward-> $id;
        $this->date = $pojectAward->date;
        $this->project_id = $pojectAward->project_id;
        $this->award_id = $pojectAward->award_id;
        $this->openModal();
    }

    public function delete($id){
        ProjectAward::find($id)->delete();
        session()->flash('message', 'Eliminado con éxito.');
    }
}
