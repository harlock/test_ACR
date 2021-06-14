<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Video;
use Livewire\WithFileUploads;

class VideoComponent extends Component
{
    use WithFileUploads;

    public $videos, $video, $description, $video_id, $project_id, $project;
    public $isOpen = 0, $position = 0;

    public function render()
    {
        $this->project= Video::all();
        $this->videos = Video::all();
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
        $this->position="";
        $this->video_id="";
        $this->project_id="";
    }

    public function store(){
        $this->validate([
           'video'=>'required|video|max:1000000',
           'description'=>'required',
           'position'=>'required',
           'project_id'=>'required'
        ]);


        Video::updateOrCreate(['id'=>$this->video_id],[
            'video'=>$this->video,
            'description'=>$this->description,
            'position'=>$this->position,
            'project_id'=>$this->project_id
        ]);

        session()->flash('message',
        $this->video_id ? 'Video actualizado exitosamente.': 'video generado con éxito.');

        $this->closeModal();
        $this->reseInputFields();
    }

    public function edit($id){
        $videos = Video::findOrFail($id);
        $this->video_id = $id;
        $this->video = $videos->video;
        $this->description = $videos->description;
        $this->position = $videos->position;
        $this->project_id = $videos->project_id;
        $this->openModal();
    }

    public function delete($id){
        Video::find($id)->delete();
        session()->flash('message', 'Video eliminado con éxito.');
    }
}