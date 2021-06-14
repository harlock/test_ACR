<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Content;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ContentComponent extends Component
{

    public $content, $text, $content_id, $project_id, $project;
    public $isOpen = 0, $position = 0 ;

    public function render()
    {
        $this->project = Content::all();
        $this->content = Content::all();
        return view('livewire.Content.contents');
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
        $this->text="";
        $this->postion="";
        $this->content_id="";
        $this->project_id="";
    }

    public function store(){
        $this->validate([
           'text'=>'required',
           'position'=>'required',
           'project_id'=>'required'
        ]);

        Content::updateOrCreate(['id'=>$this->content_id],[
            'text'=>$this->text,
            'position'=>$this->position,
            'project_id'=>$this->project_id
        ]);

        session()->flash('message',
        $this->content_id ? 'Contenido actualizado exitosamente.': 'contenido generado con éxito.');

        $this->closeModal();
        $this->reseInputFields();
    }

    public function edit($id){
        $content = Content::findOrFail($id);
        $this->content_id = $id;
        $this->text = $content->text;
        $this->position = $content->position;
        $this->project_id = $content->project_id;
        $this->update=true;
        $this->openModal();
    }

    public function delete($id){
        Videos::find($id)->delete();
        session()->flash('message', 'Contenido eliminado con éxito.');
    }
}