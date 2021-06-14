<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tipos de redes sociales
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
        <div>
                <h2 class="font-semibold text-xl">Lista de redes sociales {{ Auth::user()->name }}</h2>
            </div>
            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear nuevo tipo de red social</button>
            @if($isOpen)
                @include('livewire.SocialNetworkTypes.create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">Descripcion de la red social</th>
                        <th class="px-4 py-2">Url</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($socialnetworktype as $index=> $SocialNetworkType)
                    <tr>
                        <td class="border px-4 py-2">{{ $index+1 }}</td>
                        <td class="border px-4 py-2">{{ $SocialNetworkType->description }}</td>
                        <td class="border px-4 py-2">{{ $SocialNetworkType->url }}</td>
                        <td class="border px-4 py-2">
                        <button wire:click="edit({{ $SocialNetworkType->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button wire:click="delete({{ $SocialNetworkType->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
