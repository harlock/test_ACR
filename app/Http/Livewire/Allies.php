<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\Ally;
use Illuminate\Http\Request;

class Allies extends Component
{

    use WithFileUploads;
    public $allies, $name, $image,$telephone, $ally_id;
    public $isOpen = 0;

    public function render()
    {
        $this->allies = Ally::all();
        return view('livewire.Allies.allies');
    }
    public function create(){
        $this->resetInputFields();
        $this->openModal();
    }
    public function openModal(){
        $this->isOpen = true;
    }
    public function closeModal(){
        $this->isOpen = false;
    }
    public function resetInputFields(){
        $this->name = '';
        $this->image = '';
        $this->telephone = '';
        $this->ally_id = '';
    }
    public function store(Request $request){
        $this->validate([
            'name' => 'required',
            'image' => 'image|max:1024',
            'telephone' => 'required',
        ]);  
        //$datos = request()->all(); 
        
        //$this->image->store('uploads','public');storage/uploads/h2oDW1SmHXyljfxSIFyZgihWcuwHp0XQLfGYjbvC.jpg
        /*if($request->hasFile('image')){
            $datos['image']=$request->file('image')->store('uploads','public');
        } */
        /*if ($request->hasFile('image')){
            $file=$request->file('image');
            $name=time().$file->getClientOriginalName(); 
            $file->move(public_path().'/allies/',$name);
        }  
        */

        //$file=$request->file('image');
        //$name=time().$file->getClientOriginalName();
        Ally::updateOrCreate(['id' => $this->ally_id],[
            'name' => $this->name,
            'image' => $this->image,
            'telephone' => $this->telephone
            
        ]);   
        //return response()->json($file);   
        session()->flash('message', 
        $this->ally_id ? 'Aliado actualizado.' : 'Aliado agragado con exito.');

    $this->closeModal();
    $this->resetInputFields();


    }
    public function edit($id){
        $ally = Ally::findOrFail($id);
        $this->ally_id = $id;
        $this->name = $ally->name;
        $this->image = $ally->image;
        $this->telephone = $ally->telephone;
        $this->openModal();        
    }
    public function delete($id){
        Ally::find($id)->delete();
        session()->flash('message', 'Aliado eliminado.');
    }    
}
