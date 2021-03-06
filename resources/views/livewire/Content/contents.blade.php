<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Contenidos
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div>
                <h2 class="font-semibold text-xl">Contenido de {{ Auth::user()->name }}</h2>
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
            @if($isOpen)
                @include('livewire.Content.create')
            @endif
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Crear nuevo Contenido</button>
            <table class="table-fixed w-full">
                <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 w-20">Número</th>
                    <th class="px-4 py-2">Texto</th>
                    <th class="px-4 py-2">Posición</th>
                    <th class="px-4 py-2">Proyecto</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($content as $index=> $contents)
                    <tr>
                        <td class="border px-4 py-2">{{ $index+1 }}</td>
                        <td class="border px-4 py-2">{{ $contents->text }}</td>
                        <td class="border px-4 py-2">{{ $contents->position }}</td>
                        <td class="border px-4 py-2 text-center">{{ $contents->project_title }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $contents->id}})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" >Editar</button>
                            <button wire:click="delete({{ $contents->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
