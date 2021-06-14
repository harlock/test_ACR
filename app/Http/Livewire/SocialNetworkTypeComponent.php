<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SocialNetworkType;

class SocialNetworkTypeComponent extends Component
{
    public $socialnetworktype, $description, $url, $socialnetworktype_id;
    public $isOpen = 0;

    public function render()
    {
        $this->socialnetworktype = SocialNetworkType::all();
        return view('livewire.SocialNetworkTypes.social-network-types');
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
        $this->description = '';
        $this->url = '';
        $this->socialnetworktype_id = '';
    }

    public function store()
    {
        $this->validate([
            'description' => 'required',
            'url' => 'required'
        ]);

        SocialNetworkType::updateOrCreate(['id' => $this->socialnetworktype_id], [
            'description' => $this->description,
            'url' => $this->url
        ]);

        session()->flash('message',
            $this->socialnetworktype_id ? 'Social Network actualizado con exito.' : 'Social Network generado con exito.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $socialnetworktype = SocialNetworkType::findOrFail($id);
        $this->socialnetworktype_id = $id;
        $this->description = $socialnetworktype->description;
        $this->url = $socialnetworktype->url;
        $this->openModal();
    }

    public function delete($id)
    {
        SocialNetworkType::find($id)->delete();
        session()->flash('message', 'Social Network eliminada.');
    }

}
