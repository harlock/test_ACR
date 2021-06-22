<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Award;

class AwardComponent extends Component
{
    public $awards, $name, $description, $description_US, $award_id;
    public $image='';
    public $isOpen = 0;

    public function render()
    {
        $this->awards= Award::all();
        return view('livewire.Awards.awards');
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
        $this->award_id="";
        $this->name="";
        $this->description="";
        $this->description_US="";
    }

    public function store(){
        $this->validate([
           'name'=>'required',
           'description'=>'required',
           'description_US'=>'required'
        ]);

        Award::updateOrCreate(['id'=>$this->award_id],[
            'name'=>$this->name,
            'description'=>$this->description,
            'description_US'=>$this->description_US,
            'image'=>$this->image
        ]);
        session()->flash('message',
            $this->id ? 'Premio actualizado.': 'Premio generado con éxito.');
        $this->closeModal();
        $this->resetInputFields();
    }
    public function edit($id){
        $awards = Award::findOrFail($id);
        $this->awards_id = $id;
        $this->name = $awards->name;
        $this->description = $awards->description;
        $this->description_US= $awards->description_US;
        $this->image= $awards->image;
        $this->openModal();
    }
    public function delete($id){
        Award::find($id)->delete();
        session()->flash('message', 'Premio eliminado con éxito.');
    }
}
