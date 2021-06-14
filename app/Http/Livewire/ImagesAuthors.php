<?php

namespace App\Http\Livewire;

use App\Models\Image;
use App\Models\ContentAuthor;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\ImageAuthor;

class ImagesAuthors extends Component
{
    public $image, $contentauthor, $image_id, $contentauthor_id, $imagesauthors_id, $imagesauthor;
    public $isOpen = 0;
    public function render()
    {
        $this->imagesauthor=DB::select("select ia.id,images.image,content_authors.name from image_authors as ia,images,content_authors where ia.image_id = images.id and ia.content_author_id = content_authors.id ");
        $this->image=Image::all();
        $this->contentauthor=ContentAuthor::all();
        return view('livewire.ImagesAuthors.imagesAuthors');
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
        $this->image_id="";
        $this->contentauthor_id="";
        $this->imagesauthor_id="";
    }

    public function store(){
        $this->validate([
           'contentauthor_id'=>'required',
           'image_id'=>'required'
        ]);

        ImageAuthor::updateOrCreate(['id' => $this->imagesauthors_id], [
            'content_author_id' => $this->contentauthor_id,
            'image_id' => $this->image_id
        ]);

        session()->flash('message',
            $this->imagesauthors_id ? 'Autor de la Imagen actualizado exitosamente.': 'Autor de la imagen generado con éxito.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id){
        $imagesauthor = ImageAuthor::findOrFail($id);
        $this->imagesauthors_id = $id;
        $this->contentauthor = $imagesauthor->contentauthor;
        $this->image = $imagesauthor->image;
        $this->openModal();
    }

    public function delete($id){
        ImageAuthor::find($id)->delete();
        session()->flash('message', 'Autor eliminado con éxito.');
    }
}
