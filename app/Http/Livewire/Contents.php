<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Content;
use App\Http\Controllers\ContentsController;


class Contents extends Component
{
    public $text,  $contents_id, $content, $position = 0, $project_id = 1;
    public $isOpen = 0;
    public function render()
    {
        $this->content = Content::all();
        return view('livewire.Contents.contents');
    }
    public function create()

    {
        $this->resetInputFields();
        $this->openModal();
    }
    public function openModal()
    {
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }
    private function resetInputFields(){
        $this->text = '';
        $this->contents_id = '';
    }
    public function store()
    {
        $this->validate([
            'text'=>'required',
            'position'=>'required'
         ]);
           content::updateOrCreate(['id' => $this->contents_id], [
            'text'=>$this->text,
            'position'=>$this->position,
            'project_id'=>$this->project_id

            ]);
        session()->flash('message',
        $this->contents_id ? 'contenido actualizado exitosamente.': 'contenido generado con éxito.');
        $this->closeModal();
        $this->reseInputFields();
}
public function edit($id){
    $content = content::findOrFail($id);
    $this->contents_id = $id;
    $this->text = $text->text;
    $this->openModal();
}
public function delete($id){
    content::find($id)->delete();
    session()->flash('message', 'contenido eliminado con éxito.');
}
}
