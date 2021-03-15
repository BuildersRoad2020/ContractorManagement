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
                <h2 class="font-semibold text-l text-blue-800 leading-tight pl-4"> Add Skills </h2>
            </div>
        </div>

        <div class="px-4">
            <div class="pt-2 relative text-gray-600">
                <input required wire:model.defer="name" class="border border-gray-300 rounded-full text-xs text-gray-600 h-8 w-full bg-white hover:border-gray-400 focus:outline-none appearance-none" type="text" name="add" placeholder="Add Skills">
              
                <button type="submit" class="absolute right-0 top-0 mt-4 mr-4" wire:click="AddSkill()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="text-gray-600 h-4 w-5 fill-current">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <x-jet-input-error for="name" class="mt-2" />
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 mt-3"> You may add multiple skills separated by a comma</span>
        </div>



        <div class="ml-4 w-full md:w-full mb-1 mt-2">
            @isset ($skills)
            @foreach ($skills as $skill)
            <span class="px-2 inline-flex text-s leading-5 font-semibold rounded-full bg-green-600 text-white mt-3 transition duration-500 ease-in-out transform hover:-translate-y-1"> {{$skill->name}} 
            
            <button type="submit" wire:click="confirmDeleteSkill( {{$skill->id}})">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 1 20 20" fill="currentColor" class="text-white h-4 w-4 fill-current">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
</svg>
                </button>

            </span> 
   
            @endforeach

        <!-- Confirmation Modal -->
        <x-jet-confirmation-modal wire:model="confirm">
            <x-slot name="title">
                {{ __('Delete Skill') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to remove this skill? This will also delete skills assigned to each contractors') }}
            </x-slot>

            <x-slot name="footer">
                <x-jet-danger-button class="ml-2" wire:click="DeleteSkill( {{$confirm}})" wire:loading.attr="disabled">
                  {{ __('Remove') }}
                </x-jet-danger-button>
                <x-jet-secondary-button wire:click="$set('confirm', false)" wire:loading.attr="disabled">
                    {{ __('Nevermind') }}
                </x-jet-secondary-button>
            </x-slot>
        </x-jet-confirmation-modal>

            @endisset
        </div>
    </div>
</div>