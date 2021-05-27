<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Premios
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div>
                <h2 class="font-semibold text-xl"> Lista de Premios {{ Auth::user()->name }}</h2>
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
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Agrega una imagen</button>
            @if($isOpen)
                @include('livewire.Awards.create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20"></th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Descripcion</th>
                    <th class="px-4 py-2">Descripcion_Us</th>
                    <th class="px-4 py-2">Imagen</th>
                </tr>
                </thead>
                <tbody>
                @foreach($awards as $award)
                    <tr>
                        <td class="border px-4 py-2">{{ $awards->id }}</td>
                        <td class="border px-4 py-2">{{ $awards->name }}</td>
                        <td class="border px-4 py-2">{{ $awards->description }}</td>
                        <td class="border px-4 py-2">{{ $awards->$description_US }}</td>
                        <td class="border px-4 py-2">{{ $awards->$image }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $awards->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Editar</button>
                            <button wire:click="delete({{ $awards->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>