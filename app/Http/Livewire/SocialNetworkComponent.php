<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\SocialNetwork;
use App\Models\Ally;
use App\Models\SocialNetworkType;

use mysql_xdevapi\Exception;

class SocialNetworkComponent extends Component
{
    public $socialNetwork, $allies, $socialNetworkTypes, $address, $ally_id,$ally,$social_network_type_id,$socialNetworkType,$social_network_id;
    public $isOpen = 0;
    public $selectOpen = 0;

    public function render()
    {
        $this->socialNetwork = DB::select(
            "select
		    social_networks.id,
		    social_networks.address,
            allies.name,
            social_network_types.description
	    from
        social_networks inner join allies inner join social_network_types on social_networks.ally_id = allies.id and social_networks.social_network_type_id = social_network_types.id ");
        $this->allies = Ally::all();
        $this->socialNetworkTypes = SocialNetworkType::all();
        return view('livewire.SocialNetworks.socialNetworks');
    }

    public function create(){
        $this->resetInputFields();
        $this->openModal();
        $this->selectOpen=true;
    }

    public  function openModal(){
        $this->isOpen=true;
    }

    public function closeModal(){
        $this->isOpen=false;
    }

    private function resetInputFields(){
        $this->address="";
        $this->ally_id="";
        $this->social_network_type_id="";
        $this->social_network_id="";

    }

    public function store(){
        $this->validate([
           'address'=>'required',
           'ally_id'=>'required',
           'social_network_type_id'=>'required'

        ]);

        SocialNetwork::updateOrCreate(['id'=>$this->social_network_id],[
            'address'=>$this->address,
            'ally_id'=>$this->ally_id,
            'social_network_type_id'=>$this->social_network_type_id
        ]);



        session()->flash('message',
        $this->id ? 'Red social actualizada exitosamente.': 'Red social generada con éxito.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id){
        $socialNetwork = SocialNetwork::findOrFail($id);
        $this-> id=$socialNetwork-> $id;
        $this->address = $socialNetwork->address;
        $this->ally_id = $socialNetwork->ally_id;
        $this->social_network_type_id = $socialNetwork->social_network_type_id;
        $this->openModal();
    }

    public function delete($id){
        SocialNetwork::find($id)->delete();
        session()->flash('message', 'Red social eliminada con éxito.');
    }
}
