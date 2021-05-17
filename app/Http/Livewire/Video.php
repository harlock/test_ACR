<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Videos;

class Video extends Component
{
    public $videos, $video, $description, $position = 0, $video_id, $project_id = 1;
    public $isOpen = 0;

    public function render()
    {
        $this->videos = Videos::all();
        return view('livewire.Video.video');
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
        $this->video="";
        $this->description="";
        $this->video_id="";
    }

    public function store(){
        $this->validate([
           'video'=>'required',
           'description'=>'required',
           'position'=>'required'
        ]);

        Videos::updateOrCreate(['id'=>$this->video_id],[
            'video'=>$this->video,
            'description'=>$this->description,
            'position'=>$this->position,
            'project_id'=>$this->project_id
        ]);

        session()->flash('message',
        $this->project_id ? 'Video actualizado exitosamente.': 'video generado con éxito.');

        $this->closeModal();
        $this->reseInputFields();
    }

    public function edit($id){
        $videos = Videos::findOrFail($id);
        $this->video_id = $id;
        $this->video = $videos->video;
        $this->description = $videos->description;
        $this->position = $videos->position;
        $this->openModal();
    }

    public function delete($id){
        Videos::find($id)->delete();
        session()->flash('message', 'Video eliminado con éxito.');
    }
}
