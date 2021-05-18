<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Awards;

class Award extends Component
{
    public $awards, $name, $description, $description_US, $image, $file;
    public $isOpen = 0;

    public function render()
    {
        $this->awards= Awards::all();
        return view('livewire.Awards.awards');
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
        $this->awards="";
        $this->name="";
        $this->description="";
        $this->description_US="";
        $this->image="";
    }

    public function store(){
        $this->validate([
           'award'=>'required',
           'description'=>'required',
           'description_US'=>'required',
           'image'=>'required'
        ]);

        Awards::updateOrCreate(['id'=>$this->awards_id],[
            'awards'=>$this->awards,
            'description'=>$this->description,
            'position'=>$this->description,
            'position'=>$this->description_US,
            'position'=>$this->image
        ]);
    }
    public function edit($id){
        $awards = Awards::findOrFail($id);
        $this->awards_id = $id;
        $this->awards = $award->awards;
        $this->description = $awards->description;
        $this->description_US= $awards->description_US;
        $this->image= $awards->image;
        $this->openModal();
    }
    public function delete($id){
        Awards::find($id)->delete();
        session()->flash('message', 'Imagen eliminada con éxito.');
    }
}
