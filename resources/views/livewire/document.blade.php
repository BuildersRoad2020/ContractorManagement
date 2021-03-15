<div class="py-2 pb-2">

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    @if(session()->has('message')) 
    <div class="fixed top-0 right-0 bg-opacity-0 ">
    <div class="text-right py-4 lg:px-4 rounded animate-fade-in-down" wire:poll.5000ms>
        <div class="p-2 bg-green-500 items-center bg-opacity-75 text-green-100 leading-none rounded-full lg:rounded-full flex lg:inline-flex" role="alert">
            <span class="flex rounded-full bg-green-200 uppercase px-2 py-1 text-xs font-bold mr-3">
                <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M468.907 214.604c-11.423 0-20.682 9.26-20.682 20.682v20.831c-.031 54.338-21.221 105.412-59.666 143.812-38.417 38.372-89.467 59.5-143.761 59.5h-.12C132.506 459.365 41.3 368.056 41.364 255.883c.031-54.337 21.221-105.411 59.667-143.813 38.417-38.372 89.468-59.5 143.761-59.5h.12c28.672.016 56.49 5.942 82.68 17.611 10.436 4.65 22.659-.041 27.309-10.474 4.648-10.433-.04-22.659-10.474-27.309-31.516-14.043-64.989-21.173-99.492-21.192h-.144c-65.329 0-126.767 25.428-172.993 71.6C25.536 129.014.038 190.473 0 255.861c-.037 65.386 25.389 126.874 71.599 173.136 46.21 46.262 107.668 71.76 173.055 71.798h.144c65.329 0 126.767-25.427 172.993-71.6 46.262-46.209 71.76-107.668 71.798-173.066v-20.842c0-11.423-9.259-20.683-20.682-20.683z" />
                    <path d="M505.942 39.803c-8.077-8.076-21.172-8.076-29.249 0L244.794 271.701l-52.609-52.609c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.077-8.077 21.172 0 29.249l67.234 67.234a20.616 20.616 0 0 0 14.625 6.058 20.618 20.618 0 0 0 14.625-6.058L505.942 69.052c8.077-8.077 8.077-21.172 0-29.249z" />
                </svg>
            </span>
            <span class="font-semibold mr-2 text-left flex-auto"> {{ session('message') }} </span>
        </div>
    </div> 
    </div>
@endif  
        <div class="flex justify-between">
            <div class="pt-2 relative">
                <h2 class="font-semibold text-l text-blue-800 leading-tight pl-4"> Documents </h2>
            </div>
        </div>

        <div class="flex justify-between">
            <div class="pt-2 relative text-gray-600 ml-4">
                <input wire:model.debounce.500ms="q" class="border border-gray-300 rounded-full text-xs text-gray-600 h-8 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" type="search" name="search" placeholder="Search">
                <button type="submit" class="absolute right-0 top-0 mt-4 mr-4  ">
                    <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                        <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                    </svg>
                </button>
            </div>
            <div class="mt-2 mr-4">
                <x-jet-button wire:click="$set('confirm', true)" wire:loading.attr="disabled">
                    {{ __('Add Docs') }}
                </x-jet-button>
            </div>
        </div>

        <!--Add Document Modal -->
        <x-jet-dialog-modal wire:model="confirm">
            <x-slot name="title">
                {{ __('Add Documents') }}
            </x-slot>

            <x-slot name="content">
                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full rounded-full" type="text" name="name" required wire:model.defer="name" />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>

                <div class="flex items-stretch md:flex-wrap">
                    <div class="py-4 pr-2">
                        <x-jet-label for="documents__category_id" value="{{ __('Document Category') }}" />
                        <select id="documents__category_id" class="border border-gray-300 rounded-full content-center text-xs text-gray-600  h-10 w-full bg-white hover:border-gray-400 focus:outline-none appearance-none" name="documents__category_id" required wire:model.defer="documents__category_id" />
                        <option value="" selected> Select Document Category </option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}"> {{$category->name}} </option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="documents__category_id" class="mt-2" />
                    </div>

                    <div class="py-4 pr-2">
                        <x-jet-label for="required" value="{{ __('Document Required?') }}" />
                        <select id="required" class="border border-gray-300 rounded-full content-center text-xs text-gray-600 h-10 w-full bg-white hover:border-gray-400 focus:outline-none appearance-none" name="required" required wire:model.defer="required" />
                        <option value="" selected> .. </option>
                        <option value="0" > No </option>
                        <option value="1" > Yes </option>
                        </select>
                        <x-jet-input-error for="required" class="mt-2" />
                    </div>       

                    <div class="py-4 pr-2"
                    x-data="{ isUploading: false, progress: 0 }"
                    x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false"
                    x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                    >                    
                    <x-jet-label for="file_path" value="{{ __('Template') }}" />
                    <input id="file_path" class="mt-2 text-xs text-gray-600 content-center" type="file" name="file_path" required wire:model.defer="file_path" >
                    <x-jet-input-error for="file_path" class="mt-2" />


                        <!-- Progress Bar -->
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                </div>
           
            </x-slot>

            <x-slot name="footer">

                <x-jet-button class="ml-2" wire:click="DocumentAdd()" wire:loading.attr="disabled">
                    {{ __('Add Document') }}
                </x-jet-button>
                <x-jet-secondary-button wire:click="$set('confirm', false)" wire:loading.attr="disabled">
                    {{ __('Close') }}
                </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal>

        @isset ($documents)
        <div class="mt-2 p-2 sm:px-4" wire:poll.5000ms>
            <table class="border-collapse w-full">
                <thead>
                    <tr>
                        <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            Document Name
                        </th>
                        <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            Category
                        </th>
                        <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            Required
                        </th>

                        <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            Template
                        </th>

                        <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            Actions
                        </th>
                    </tr>


                </thead>
                <tbody>
                </tbody>
                @foreach ($documents as $document)

                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-auto left-0 bg-blue-200 px-1 py-1 text-xs font-bold"> Document Name </span>
                        {{ $document->name }}
                    </td>

                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-auto left-0 bg-blue-200 px-1 py-1 text-xs font-bold"> Category </span>
                        {{ $document->Documents_Category->name }}
                    </td>

                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-auto left-0  bg-blue-200 px-1 py-1 text-xs font-bold">Required</span>
                        <span class="{{$document->required == 0 ? 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-green-800' : 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800' }}"> {{$document->required == 0 ? 'No' : 'Yes' }}</span>
                    </td>

                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-auto left-0  bg-blue-200 px-1 py-1 text-xs font-bold">Template</span>

                       @if($document->file_path == !null )
                        <x-jet-button wire:click="confirmDocumentView( {{$document->id }})" wire:loading.attr="disabled">
                            {{ __('VIEW DOCUMENT') }}
                        </x-jet-button>
                        @endif

                      
                       
               
                      
                    </td>

                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-auto left-0  bg-blue-200 px-1 py-1 text-xs font-bold">Actions</span>
                        <x-jet-button wire:click="confirmDocumentEdit( {{$document->id }})" wire:loading.attr="disabled">
                            {{ __('EDIT') }}
                        </x-jet-button>
                        <x-jet-danger-button wire:click="confirmDocumentDelete( {{$document->id }})" wire:loading.attr="disabled">
                            {{ __('Delete') }}
                        </x-jet-danger-button>
                    </td>
                </tr>

                @endforeach
            </table>
        </div>

        <!--Edit Document Modal -->
        <x-jet-dialog-modal wire:model="confirmEdit">
            <x-slot name="title">
                {{ __('Edit Document') }}
            </x-slot>

            <x-slot name="content">
                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full rounded-full" type="text" name="name" required wire:model.defer="name" />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>

                <div class="mt-4 flex flex-wrap md:flex-wrap">
                    <div>
                        <x-jet-label for="documents__category_id" value="{{ __('Document Category') }}" />
                        <select id="documents__category_id" class="border border-gray-300 rounded-full content-center text-xs text-gray-600 mt-2 h-10 w-full bg-white hover:border-gray-400 focus:outline-none appearance-none" name="documents__category_id" required wire:model.defer="documents__category_id" />
                        <option value="" selected> Select Document Category </option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}"> {{$category->name}} </option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="documents__category_id" class="mt-2" />
                    </div>

                    <div class="ml-2">
                        <x-jet-label for="required" value="{{ __('Document Required?') }}" />
                        <select id="required" class="border border-gray-300 rounded-full content-center text-xs text-gray-600 mt-2 h-10 w-full bg-white hover:border-gray-400 focus:outline-none appearance-none" name="required" required wire:model.defer="required" />
                        <option value="0" selected> No </option>
                        <option value="1"> Yes </option>
                        </select>
                        <x-jet-input-error for="required" class="mt-2" />
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">

                <x-jet-button class="ml-2" wire:click="DocumentEdit( {{$confirmEdit}} )" wire:loading.attr="disabled">
                    {{ __('Edit Document') }}
                </x-jet-button>
                <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                    {{ __('Close') }}
                </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal>

       

        <!--View Document Modal -->
        <x-jet-dialog-modal wire:model="confirmView" wire:loading.attr="disabled">
            <x-slot name="title">
                {{ __('View Document') }}
            </x-slot>

            <x-slot name="content">
            <div class="h-screen w-full">  
            <iframe src="{{$pdf}}"  class="w-full h-full"> </iframe>
            </div>
            </x-slot>

            <x-slot name="footer">
   
                <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                    {{ __('Close') }}
                </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal>


        <!--Delete Document Modal -->
        <x-jet-dialog-modal wire:model="confirmDelete">
            <x-slot name="title">
                {{ __('Delete Document') }}
            </x-slot>

            <x-slot name="content">
                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full rounded-full" type="text" name="name" required wire:model.defer="name" />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>

                <div class="mt-4 flex flex-wrap md:flex-wrap">
                    <div>
                        <x-jet-label for="documents__category_id" value="{{ __('Document Category') }}" />
                        <select id="documents__category_id" class="border border-gray-300 rounded-full content-center text-xs text-gray-600 mt-2 h-10 w-full bg-white hover:border-gray-400 focus:outline-none appearance-none" name="documents__category_id" required wire:model.defer="documents__category_id" />
                        <option value="" selected> Select Document Category </option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}"> {{$category->name}} </option>
                        @endforeach
                        </select>
                        <x-jet-input-error for="documents__category_id" class="mt-2" />
                    </div>

                    <div class="ml-2">
                        <x-jet-label for="required" value="{{ __('Document Required?') }}" />
                        <select id="required" class="border border-gray-300 rounded-full content-center text-xs text-gray-600 mt-2 h-10 w-full bg-white hover:border-gray-400 focus:outline-none appearance-none" name="required" required wire:model.defer="required" />
                        <option value="0" selected> No </option>
                        <option value="1"> Yes </option>
                        </select>
                        <x-jet-input-error for="required" class="mt-2" />
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">

                <x-jet-button class="ml-2" wire:click="DocumentDelete( {{$confirmDelete}} )" wire:loading.attr="disabled">
                    {{ __('Delete Document') }}
                </x-jet-button>
                <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                    {{ __('Close') }}
                </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal>        

        <div class="mt-2 p-2 sm:px-4">
            {{ $documents->links() }}
        </div>
        @endisset

    </div>


</div>

