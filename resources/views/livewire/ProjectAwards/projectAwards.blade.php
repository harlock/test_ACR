<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Proyectos premiados
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
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">nuevo poryecto premiado</button>
            @if($isOpen)
                @include('livewire.ProjectAwards.create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">Fecha</th>
                        <th class="px-4 py-2">Titulo</th>
                        <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pojectAward as $pojectAwards)
                    <tr>
                        <td class="border px-4 py-2">{{ $pojectAwards->date }}</td>
                        <td class="border px-4 py-2">{{ $pojectAwards->title }}</td>
                        <td class="border px-4 py-2">{{ $pojectAwards->name }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $pojectAwards->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                            <button wire:click="delete({{ $pojectAwards->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>