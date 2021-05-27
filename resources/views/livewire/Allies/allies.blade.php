<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Aliados
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Agregar nuevo Aliado</button>

            @if($isOpen)
                @include('livewire.Allies.create')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Imagen</th>
                        <th class="px-4 py-2">Telefono</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($allies as $ally)
                    <tr>
                        <td class="border px-4 py-2">{{ $ally->id }}</td>
                        <td class="border px-4 py-2">{{ $ally->name }}</td>     
                        <td>  
                            <a target="_blank" href="{{asset('allies').'/'}}">{{$ally->image}}</a>
                            <img src="{{asset('allies/Ya')}}">
                        </td>
                        <td class="border px-4 py-2">{{ $ally->telephone }}</td>

                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $ally->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>

                            <button wire:click="delete({{ $ally->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>
