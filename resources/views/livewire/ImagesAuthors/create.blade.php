<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="project_id" class="block text-gray-700 text-sm font-bold mb-2">Seleccione la imagen:</label>
                            <select class="form-control border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image_id" wire:model="image_id" required>
                                <option>Imagenes</option>
                                @foreach($image as $images)
                                    <option value="{{$images->id}}">{{$images->image}}</option>
                                @endforeach
                                @error('image_id') <span class="text-red-500"{{$message}}></span>@enderror
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="imagesAuthors_id" class="block text-gray-700 text-sm font-bold mb-2">Seleccione el autor de la imagen:</label>
                            <select class="form-control border rounded text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="contentauthor_id" wire:model="contentauthor_id" required>
                                <option>Autores de las imagenes</option>
                                @foreach($contentauthor as $imagesauthors)
                                    <option value="{{$imagesauthors->id}}">{{$imagesauthors->name}}</option>
                                @endforeach
                                @error('imagesauthors_id') <span class="text-red-500"{{$message}}></span>@enderror
                            </select>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Guardar
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Cancelar
                        </button>
                    </span>
            </form>
        </div>
    </div>
</div>
</div>
