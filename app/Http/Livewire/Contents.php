<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Content;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class Contents extends Component
{

    public $content, $text, $content_id, $projectt;
    public $isOpen = 0, $position = 0 ;
    public $update;

    public function render()
    {
        $this->content = DB::select(
            "select
            contents.id,
            contents.text,
            contents.position,
            projects.title as project_title
        from
            projects inner join contents on contents.project_id = projects.id");
        $this->projectt = Project::all();
        return view('livewire.Content.contents');
    }

    public  function create(){
        $this->update=false;
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
        $this->content_id="";
        $this->project_id="";
    }

    public function store(){
        $this->validate([
           'text'=>'required',
           'project_id'=>'required',
        ]);

        Content::create([
            'txt'=>$this->text,
            'position'=>$this->position,
            'project_id'=>$this->project_id
        ]);

        /*Contents::updateOrCreate(['id'=>$this->content_id],[
            'text'=>$this->text,
            'position'=>$this->position,
            'project_id'=>$this->project_id
        ]);*/

        session()->flash('message',
        $this->content_id ? 'Contenido actualizado exitosamente.': 'contenido generado con éxito.');

        $this->closeModal();
        $this->reseInputFields();
    }

    public function edit($id){
        $content = Content::findOrFail($id);
        $this->content_id = $id;
        $this->text = $content->text;
        $this->project_id = $content->project_id;
        $this->update=true;
        $this->openModal();
    }

    public function update(){

        $this->validate([
            'text'=>'required',
            'project_id'=>'required'
        ]);

        if ($this->content_id){
            $content = Content::find($this->project_id);
            $content->update([
                'text'=>$this->text,
                'project_id'=>$this->project_id
            ]);
        }

        session()->flash('message',
            $this->content_id ? 'Contenido actualizado exitosamente.': 'Contenido generado con éxito.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id){
        Videos::find($id)->delete();
        session()->flash('message', 'Contenido eliminado con éxito.');
    }
}

