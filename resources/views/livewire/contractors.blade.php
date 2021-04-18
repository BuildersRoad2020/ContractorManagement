<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
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

    @if(session()->has('error'))
    <div class="fixed top-0 right-0 bg-opacity-0 ">
        <div class="text-right py-4 lg:px-4 rounded animate-fade-in-down" wire:poll.5000ms>
            <div class="p-2 bg-red-500 items-center bg-opacity-75 text-red-100 leading-none rounded-full lg:rounded-full flex lg:inline-flex" role="alert">
                <span class="flex rounded-full bg-red-200 uppercase px-2 py-1 text-xs font-bold mr-3">
                    <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M468.907 214.604c-11.423 0-20.682 9.26-20.682 20.682v20.831c-.031 54.338-21.221 105.412-59.666 143.812-38.417 38.372-89.467 59.5-143.761 59.5h-.12C132.506 459.365 41.3 368.056 41.364 255.883c.031-54.337 21.221-105.411 59.667-143.813 38.417-38.372 89.468-59.5 143.761-59.5h.12c28.672.016 56.49 5.942 82.68 17.611 10.436 4.65 22.659-.041 27.309-10.474 4.648-10.433-.04-22.659-10.474-27.309-31.516-14.043-64.989-21.173-99.492-21.192h-.144c-65.329 0-126.767 25.428-172.993 71.6C25.536 129.014.038 190.473 0 255.861c-.037 65.386 25.389 126.874 71.599 173.136 46.21 46.262 107.668 71.76 173.055 71.798h.144c65.329 0 126.767-25.427 172.993-71.6 46.262-46.209 71.76-107.668 71.798-173.066v-20.842c0-11.423-9.259-20.683-20.682-20.683z" />
                        <path d="M505.942 39.803c-8.077-8.076-21.172-8.076-29.249 0L244.794 271.701l-52.609-52.609c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.077-8.077 21.172 0 29.249l67.234 67.234a20.616 20.616 0 0 0 14.625 6.058 20.618 20.618 0 0 0 14.625-6.058L505.942 69.052c8.077-8.077 8.077-21.172 0-29.249z" />
                    </svg>
                </span>
                <span class="font-semibold mr-2 text-left flex-auto"> {{ session('error') }} </span>
            </div>
        </div>
    </div>
    @endif
    <div class="mt-1">
        <div class="flex justify-between">
            <div class="pt-2 relative text-gray-600">
                <input wire:model.debounce.500ms="q" class="border border-gray-300 rounded-full text-xs text-gray-600 h-8 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" type="search" name="search" placeholder="Search">
                <button type="submit" class="absolute right-0 top-0 mt-4 mr-4">
                    <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                        <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                    </svg>
                </button>
            </div>


  
     

            <div class="mt-2 mb-2 flex no-wrap">

                <label class="inline-flex items-center">
                    <select class="border border-gray-300 rounded-full text-xs text-gray-600 h-8 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" wire:model="status">
                        <option value="0">Select Status</option>
                        <option>onHold</option>
                        <option value="1">Approved</option>
                    </select>
                </label>

                <div class="pl-2 mt-1" title="Export">
                <button class="text-xs text-gray-600 h-8 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" wire:click="export()"  wire:loading.attr="disabled">
<svg xmlns="http://www.w3.org/2000/svg" class="stroke-current text-indigo-500 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
</svg> 
                </button>
                </div>
      
            


            </div>
        </div>

        <div class="flex justify-between">
            <div class="flex justify-center flex-wrap gap-x-4 w-full py-2 rounded-lg bg-white border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
                <div class="flex flex-row items-center justify-between w-1/4 py-1 px-2 rounded  border-2 border-light-blue-500 border-opacity-100">
                    <div class="flex flex-col">
                        <div class="text-xs uppercase font-bold text-gray-500">
                            Total
                        </div>
                        <div class="text-xl font-bold">
                            @if(count($contractors) > 0 ) {{count($contractors)}} @endif @if(count($contractors) == 0 ) 0 @endif
                        </div>
                    </div>
                    <svg class="stroke-current text-gray-500" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2">
                        </path>
                        <circle cx="9" cy="7" r="4">
                        </circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87">
                        </path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75">
                        </path>
                    </svg>
                </div>

                <div class="flex flex-row items-center justify-between w-1/4 py-1 px-2 rounded  border-2 border-green-500 border-opacity-50">
                    <div class="flex flex-col">
                        <div class="text-xs uppercase font-bold text-green-500">
                            Approved
                        </div>
                        <div class="text-xl font-bold text-green-500">
                          {{$approved}}
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current text-green-500" fill="none" height="24" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>



                <div class="flex flex-row items-center justify-between w-1/4 py-1 px-2 rounded  border-2 border-red-500 border-opacity-50">
                    <div class="flex flex-col">
                        <div class="text-xs uppercase font-bold text-red-500">
                        onHold
                        </div>
                        <div class="text-xl font-bold text-red-500">
                        {{$onhold}}
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current text-red-500" fill="none" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>

            </div>
        </div>

        <table class="border-collapse w-full">
            <thead>
                <tr>

                    <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                        Contractor Name
                    </th>
                    <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                        Status
                    </th>
                    <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($contractors as $contractor)
                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">

                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-auto left-0 bg-blue-200 px-1 py-1 text-xs font-bold"> Contractor <br /> Name</span>
                        {{ $contractor->name }}
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-auto left-0  bg-blue-200 px-1 py-1 text-xs font-bold ">Status</span>
                        <span class="{{$contractor->status == 0 ? 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 transition duration-500 ease-in-out transform hover:-translate-y-1' : 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 transition duration-500 ease-in-out transform hover:-translate-y-1' }}"> {{$contractor->status == 0 ? 'onHold' : 'Approved' }}</span>
                    </td>

                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-auto left-0  bg-blue-200 px-1 py-1 text-xs font-bold">Actions</span>
                        <x-jet-button wire:click="view( {{$contractor->id}} )">
                            {{ __('VIEW') }}
                        </x-jet-button>
                        <x-jet-danger-button wire:click="confirmContractorDeletion( {{$contractor->id }})" wire:loading.attr="disabled">
                            {{ __('Archive') }}
                        </x-jet-danger-button>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $contractors->links() }}
    </div>

    <!--View Contractor Modal -->
    <x-jet-dialog-modal wire:model="viewContractor">
        <x-slot name="title">
            {{$name}} @if($contractorstatus == 0)
            <span class="bg-red-100 text-red-600 text-xs font-semibold rounded-2xl py-1 px-4"> onHold </span>
            @endif
            @if($contractorstatus == 1)
            <span class="bg-green-100 text-green-600 text-xs font-semibold rounded-2xl py-1 px-4"> Approved </span>
            @endif
            <hr class="w-full mt-2">
        </x-slot>

        <x-slot name="content">
            <div class="flex justify-between md:flex flex-wrap">
                <h2 class="text-gray-800 font-semibold mr-auto"> Contractor Details </h2>

                <h2 class="text-gray-800 font-semibold"> Total Technicians: <span class="bg-blue-100 text-blue-600 text-xs font-semibold rounded-2xl py-1 px-2 mx-2"> {{$countTechnicians}} </span> </h2>

            </div>
            <hr class="w-full mt-2 mb-2">
            <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                <dt class="text-sm font-medium text-gray-500"> Contact: </dt>
                <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$name_primarycontact }} @if($name_secondarycontact !=null ) | {{$name_secondarycontact}} @endif </dd>
                <dt class="text-sm font-medium text-gray-500"> Phone : </dt>
                <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$phone_primary }} @if($phone_secondary != null) | {{$phone_secondary}} @endif </dd>
                <dt class="text-sm font-medium text-gray-500"> Email : </dt>
                <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$email_primary }} @if($email_secondary !=null) | {{$email_secondary}} @endif </dd>
                <dt class="text-sm font-medium text-gray-500"> Address : </dt>
                <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$address}} </dd>
                <dt class="text-sm font-medium text-gray-500"> City : </dt>
                <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$city}} </dd>
                <dt class="text-sm font-medium text-gray-500"> State : </dt>
                <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$state}} </dd>
                <dt class="text-sm font-medium text-gray-500"> Country : </dt>
                <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$country}} </dd>
                <dt class="text-sm font-medium text-gray-500"> Post Code : </dt>
                <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$postcode}} </dd>
            </div>

            <h2 class="text-gray-800 font-semibold ml-2 mt-2"> Financial Details </h2>
            <hr class="w-full mt-2 mb-2">

            <div class="sm:grid sm:grid-cols-3 sm:gap-2 sm:px-6">
                <dt class="text-sm font-medium text-gray-500"> Payment Terms: </dt>
                <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$terms}} </dd>
                <dt class="text-sm font-medium text-gray-500"> Currency: </dt>
                <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$currency}} </dd>
                <dt class="text-sm font-medium text-gray-500"> Bank: </dt>
                <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$bankname}} </dd>
                <dt class="text-sm font-medium text-gray-500"> Branch: </dt>
                <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$branch}} </dd>
                <dt class="text-sm font-medium text-gray-500"> Account Name: </dt>
                <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$accountname}} </dd>
                <dt class="text-sm font-medium text-gray-500"> Account Number: </dt>
                <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$accountnumber}} </dd>
                <dt class="text-sm font-medium text-gray-500"> BSB: </dt>
                <dd class="mt-1 text-xs text-gray-900 sm:mt-0 sm:col-span-2"> {{$bsb}} </dd>
            </div>


            <livewire:contractor-skill-list :id="$viewContractor" :key="$viewContractor" wire:model.defer />

     

        </x-slot>

        <x-slot name="footer">

            @if($contractorstatus == 0)
            <x-jet-button class="ml-2" wire:click="approveContractor({{ $viewContractor }})" wire:loading.attr="disabled">
                {{ __('Approve Account') }}
            </x-jet-button> @endif

            @if($contractorstatus == 1)
            <x-jet-danger-button class="ml-2" wire:click="denyContractor({{ $viewContractor }})" wire:loading.attr="disabled">
                {{ __('Hold Contractor') }}
            </x-jet-danger-button> @endif

            <x-jet-secondary-button wire:click="$set('viewContractor', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>

        </x-slot>
    </x-jet-dialog-modal>


    <!--Delete Contractor Modal -->
    <x-jet-confirmation-modal wire:model="confirmingContractorDeletion">
        <x-slot name="title">
            {{ __('Archive Contractor') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to archive this contractor?') }}
        </x-slot>

        <x-slot name="footer">

            <x-jet-danger-button class="ml-2" wire:click="DeleteContractor({{ $confirmingContractorDeletion }})" wire:loading.attr="disabled">
                {{ __('Archive Account') }}
            </x-jet-danger-button>
            <x-jet-secondary-button wire:click="$set('confirmingContractorDeletion', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

        </x-slot>
    </x-jet-confirmation-modal>

</div>