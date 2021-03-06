<?php


namespace App\Http\Livewire;

use App\Models\ProjectType;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Livewire;
use Illuminate\Support\Str;

class ProjectTypeComponent extends Component{
    public $description, $slug, $home, $projecttypes,$projecttype_id;
    public $isOpen=0;
    public function render()
    {
       $this->projecttypes=ProjectType::all();
       return view('Livewire.ProjectTypes.projecttypes');
    }

    public function create(){
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
        $this->projecttype_id="";
        $this->description="";
        $this->home="";
    }

    public function store(){
        $this->validate([
            'description'=>'required',
            'home'=>'required|int'
        ]);

        ProjectType::updateOrCreate(['id'=> $this->projecttype_id],
            [
            'description'=>$this->description,
            'slug'=>Str::slug($this->description),
            'home'=>$this->home
        ]);
        session()->flash('message',
        $this->projecttype_id? 'Tipo de proyecto actualizado.' : 'Proyecto generado con exito.');
        $this->closeModal();
        $this->resetInputFields();
    }
    public function edit($id){
        $projecttypes =ProjectType::findOrFail($id);
        $this->projecttype_id=$id;
        $this->description=$projecttypes->description;
        $this->home=$projecttypes->home;
        $this->openModal();
    }

    public function delete($id){
        ProjectType::find($id)->delete();
        session()->flash('message', 'Tipo de proyecto eliminado con exito.');
    }
}
