<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Image;
use App\Models\Project;

class Images extends Component
{
    public $image = "hola", $description, $position = 0,$project_id, $project, $image_id;
    public $isOpen = 0;

    public function render()
    {
        $this->project = Project::all();
        $this->image = Image::all();
        return view('livewire.Images.images');
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
        $this->image="";
        $this->description="";
        $this->image_id="";
    }

    public function store(){
        $this->validate([
           //'image'=>'required',
           'description'=>'required',
           'position'=>'required'
        ]);

        Image::updateOrCreate(['id'=>$this->image_id],[
            'image'=>$this->image,
            'description'=>$this->description,
            'position'=>$this->position,
            'project_id'=>$this->project_id
        ]);

        session()->flash('message',
        $this->project_id ? 'Imagen actualizada exitosamente.': 'Imagen generada con éxito.');

        $this->closeModal();
        $this->reseInputFields();
    }

    public function edit($id){
        $image =Image::findOrFail($id);
        $this->image_id = $id;
        $this->image = $image->image;
        $this->description = $image->description;
        $this->position = $image->position;
        $this->openModal();
    }

    public function delete($id){
        Image::find($id)->delete();
        session()->flash('message', 'Imagen eliminada con éxito.');
    }
}
