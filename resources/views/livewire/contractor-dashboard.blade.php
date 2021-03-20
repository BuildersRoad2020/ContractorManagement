<div>
    @if($contractors != null)
    <div wire:poll.1000ms>
        <div class="bg-gray-100">
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
            <div class="container mx-auto my-5 p-5 h-full">
                <div class="md:flex no-wrap md:-mx-2 ">
                    <!-- Left Side -->
                    <div class="w-full h-full md:w-3/12 md:mx-2">
                        <!-- Profile Card -->
                        <div class="bg-white p-3 border-t-4 border-indigo-400">
                            <div class="image overflow-hidden">

                                <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                                    <!-- Profile Photo File Input -->
                                    <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                                    <!-- Current Profile Photo -->
                                    <div class="mt-2" x-show="! photoPreview">
                                        <img class="h-auto w-full mx-auto" src="{{ $contractors->User->profile_photo_url }}" alt="">

                                    </div>

                                    <!-- New Profile Photo Preview -->
                                    <div class="mt-2" x-show="photoPreview">
                                        <span class="block rounded-full w-20 h-20" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{$contractors->name}}</h1>

                            <ul class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                                <li class="flex items-center py-3">
                                    <span>Technician Count:</span> <span class="ml-auto">
                                        <span class="bg-indigo-500 py-1 px-2 rounded text-white text-sm">{{$contractors->technicians_count}}</span> </span>
                                </li>
                                <li class="flex items-center py-3">

                                    <span>Status:</span>
                                    <span class="ml-auto">
                                        @if($contractors->status == 1)
                                        <span class="bg-green-500 py-1 px-2 rounded text-white text-sm">Approved</span>
                                        @endif

                                        @if($contractors->status == 0)
                                        <span class="bg-red-500 py-1 px-2 rounded text-white text-sm">onHold</span>
                                        @endif
                                    </span>
                                </li>
                                <li class="flex items-center py-2">

                                    <span class="text-sm">Contractor Since: </span>

                                    <span class="text-xs ml-auto bg-gray-500 py-1 px-2 rounded text-white"> {{ \Carbon\Carbon::parse($contractors->created_at)->format('j F, Y') }} </span>
                                </li>
                            </ul>
                        </div>
                        <!-- End of profile card -->
                        <div class="my-4"></div>



                    </div>
                    <!-- Right Side -->
                    <div class="w-full md:w-9/12 mx-2 h-full">

                        <!-- Contractor Details Section -->
                        <div class="bg-white p-3 shadow-sm rounded-sm">
                            <div class="flex justify-between space-x-2 font-semibold text-gray-900 leading-8">
                                <div class="flex no-wrap">
                                    <span clas="text-green-500">
                                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </span>
                                    <span class="tracking-wide -mt-1 ml-2">Details</span>
                                </div>
                                <div class="mt-2 mb-2 pl-2">
                                    <x-jet-button wire:click="confirmUpdateDetails" wire:loading.attr="disabled">
                                        {{ __('Update') }}
                                    </x-jet-button>
                                </div>

                            </div>


                            <div class="text-gray-700">
                                <div class="grid md:grid-cols-2 text-sm">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Contact Person</div>
                                        <div class="px-4 py-2">{{$contractors->ContractorDetails->name_primarycontact}} @if($contractors->ContractorDetails->name_secondarycontact != null )| {{$contractors->ContractorDetails->name_secondarycontact}} @endif </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Phone </div>
                                        <div class="px-4 py-2">{{$contractors->ContractorDetails->phone_primary}} @if($contractors->ContractorDetails->name_phone_secondary != null) | {{$contractors->ContractorDetails->name_phone_secondary}} @endif</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Email</div>
                                        <div class="px-4 py-2" href="mailto:{{$contractors->ContractorDetails->email_primary }}">{{$contractors->ContractorDetails->email_primary}} @if($contractors->ContractorDetails->email_secondary != null) | {{$contractors->ContractorDetails->email_secondary }} @endif</div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold"> Address </div>
                                        <div class="px-4 py-2"> {{$contractors->ContractorDetails->address }} </div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold"> City </div>
                                        <div class="px-4 py-2"> {{$contractors->cities()->pluck('name')->first() }} </div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold"> State </div>
                                        <div class="px-4 py-2">{{$contractors->states()->pluck('name')->first() }} </div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold"> Country </div>
                                        <div class="px-4 py-2"> {{$contractors->countries()->pluck('name')->first() }} </div>
                                    </div>

                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold"> POST CODE </div>
                                        <div class="px-4 py-2"> {{$contractors->ContractorDetails->postcode }} </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-2"> </div>
                        <div class="bg-white p-3 shadow-sm rounded-sm">
                            <div class="flex justify-between space-x-2 font-semibold text-gray-900 leading-8">
                                <div class="flex no-wrap">
                                    <span clas="text-green-500">
                                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </span>
                                    <span class="tracking-wide -mt-1 ml-2">Financial</span>
                                </div>
                                <div class="mt-2 mb-2 pl-2">
                                    <x-jet-button wire:click="confirmUpdateFinancial" wire:loading.attr="disabled">
                                        {{ __('Update') }}
                                    </x-jet-button>
                                </div>
                            </div>


                            <div class="text-gray-700">
                                <div class="grid md:grid-cols-2 text-sm">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">ABN</div>
                                        <div class="px-4 py-2">{{$contractors->ContractorDetails->abn}} </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Payment Terms </div>
                                        <div class="px-4 py-2">{{$contractors->ContractorDetails->terms}}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Currency </div>
                                        <div class="px-4 py-2">{{$contractors->ContractorDetails->currency}}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Bank </div>
                                        <div class="px-4 py-2">{{$contractors->ContractorDetails->bankname}}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Branch </div>
                                        <div class="px-4 py-2">{{$contractors->ContractorDetails->branch}}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Account Number </div>
                                        <div class="px-4 py-2">{{$contractors->ContractorDetails->accountnumber}}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">Account Name </div>
                                        <div class="px-4 py-2">{{$contractors->ContractorDetails->accountname}}</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">BSB </div>
                                        <div class="px-4 py-2">{{$contractors->ContractorDetails->bsb}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- End of Contractor Financial section -->
                        <div class="my-2"> </div>

                        <div class="bg-white p-3 shadow-sm rounded-sm">

                            <div>
                                <div class="flex justify-between space-x-2 font-semibold text-gray-900 leading-8 mr-4">
                                    <div class="flex no-wrap">
                                        <span clas="text-green-500">
                                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </span>
                                        <span class="tracking-wide -mt-1 ml-2">Skills</span>
                                    </div>
                                    <div class="">
                                        <x-jet-button wire:click="confirmUpdateSkills" wire:loading.attr="disabled">
                                            {{ __('Update') }}
                                        </x-jet-button>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-0 md:auto-cols-max md:grid-flow-col">

                                <div class="grid grid-cols-5"> @foreach($skills as $skill)
                                    <div class="px-1 py-1 font-semibold">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{$skill->skills->name}} </span>

                                    </div> @endforeach
                                </div>



                            </div>
                        </div>
                        <div class="my-2"> </div>

                        <div class="bg-white p-3 shadow-sm rounded-sm">
                            <div class="flex justify-between space-x-2 font-semibold text-gray-900 leading-8 mr-4">
                                <div class="flex no-wrap">
                                    <span clas="text-green-500">
                                        <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path fill="#fff" d="M12 14l9-5-9-5-9 5 9 5z" />
                                            <path fill="#fff" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                                        </svg>
                                    </span>
                                    <span class="tracking-wide -mt-1 ml-2">Documents</span>
                                </div>

                                <div class="">
                                    <x-jet-button wire:click="confirmAddDocuments" wire:loading.attr="disabled">
                                        {{ __('Update') }}
                                    </x-jet-button>
                                </div>
                            </div>

                            <div class="text-gray-700">
                                <div class="grid md:grid-cols-3 text-sm"> @foreach ($documents as $id)
                                    <div class="grid grid-cols-1">
                                        <div class="text-gray-600 text-sm font-bold "> {{$id->Documents->name}} </div>
                                        <div class="text-gray-500 text-xs">{{ucwords($id->Documents->documents_category->name)}}</div>
                                        <div class="text-gray-500 text-xs">
                                            <p class="text-xs"> Validity: {{ \Carbon\Carbon::parse($id->expiration)->format('j F, Y') }} </p>
                                        </div>
                                        <div class="text-gray-500 text-xs">

                                            @if($id->status == 0)
                                            <div class="flex no-wrap"> <a href="https://drive.google.com/uc?export=download&id={{$id->file_path}}">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                                                        For Review
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="mt-1 ml-1" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                                        </svg>
                                                        </svg>

                                                    </span> </a> </div>

                                            @endif

                                            @if($id->status == 1)
                                            <div class="flex no-wrap"> <a href="https://drive.google.com/uc?export=download&id={{$id->file_path}}">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                                                        Approved <svg xmlns="http://www.w3.org/2000/svg" class="mt-1 ml-1" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                                        </svg>
                                                        </svg>

                                                    </span> </a> </div>

                                            @endif

                                            @if($id->status == 2)
                                            <div class="flex no-wrap"> <a href="https://drive.google.com/uc?export=download&id={{$id->file_path}}">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                                                        Rejected<svg xmlns="http://www.w3.org/2000/svg" class="mt-1 ml-1" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                                        </svg>
                                                        </svg>

                                                    </span> </a> </div>
                                            @endif


                                            @if($id->status == 3)
                                            <div class="flex no-wrap"> <a href="https://drive.google.com/uc?export=download&id={{$id->file_path}}">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                                                        Expired <svg xmlns="http://www.w3.org/2000/svg" class="mt-1 ml-1" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                                        </svg>
                                                        </svg>

                                                    </span> </a> </div>
                                            @endif

                                            @if($id->status == 4)
                                            <div class="flex no-wrap"> <a href="https://drive.google.com/uc?export=download&id={{$id->file_path}}">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                                                        Expiring <svg xmlns="http://www.w3.org/2000/svg" class="mt-1 ml-1" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                                        </svg>
                                                        </svg>

                                                    </span> </a> </div>
                                            @endif
                                        </div>
                                    </div>@endforeach
                                </div>
                            </div>

                        </div>

                        <div class="my-2"> </div>
                  

                            <livewire:contractor-rates />
                        <!-- End of Contractor Skills section -->
                    </div>
                </div>
            </div>
            <!--Update Details Modal -->
            <x-jet-dialog-modal wire:model.defer="updatedetails">
                <x-slot name="title">
                    {{ __('Update Details') }}
                </x-slot>

                <x-slot name="content">
                    <div>
                        <x-jet-label for="contractorinfo.name" value="{{ __('Contractor Name') }}" />
                        <x-jet-input id="contractorinfo.name" class="block mt-1 w-full" type="text" required wire:model.defer="contractorinfo.name" />
                        <x-jet-input-error for="contractorinfo.name" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="contractordetailsinfo.address" value="{{ __('Address') }}" />
                        <x-jet-input id="contractordetailsinfo.address" class="block mt-1 w-full" type="text" required wire:model.defer="contractordetailsinfo.address" />
                        <x-jet-input-error for="contractordetailsinfo.address" class="mt-2" />
                    </div>

                    <div class="mr-2 w-full md:w-full mb-1 mt-1">
                        <x-jet-label value="{{ __('Country') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="SelectedCountry">
                            <option value="" selected>Select a Country</option>
                            @foreach ($countries as $country)
                            <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="SelectedCountry" class="mt-2" />
                    </div>

                    @if (!is_null($states))
                    <div class="mr-2 w-full md:w-full mb-1 mt-1">
                        <x-jet-label value="{{ __('State') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="SelectedState">
                            <option value="" disabled selected>Select a State</option>
                            @foreach ($states as $state)
                            <option value="{{$state->id}}">{{$state->name}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="SelectedState" class="mt-2" />
                    </div>
                    @endif
                    @if (!is_null($cities))
                    <div class="mr-2 w-full md:w-full mb-1 mt-1">
                        <x-jet-label value="{{ __('City') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="SelectedCity">
                            <option value="" disabled selected>Select a City</option>
                            @foreach ($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="SelectedCity" class="mt-2" />
                    </div>
                    @endif

                    <div class="mt-4">
                        <x-jet-label for="contractordetailsinfo.postcode" value="{{ __('POSTAL CODE') }}" />
                        <x-jet-input id="contractordetailsinfo.postcode" class="block mt-1 w-full" type="text" required wire:model.defer="contractordetailsinfo.postcode" />
                        <x-jet-input-error for="contractordetailsinfo.postcode" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="contractordetailsinfo.name_primarycontact" value="{{ __('Primary Contact') }}" />
                        <x-jet-input id="contractordetailsinfo.name_primarycontact" class="block mt-1 w-full" type="text" required wire:model.defer="contractordetailsinfo.name_primarycontact" />
                        <x-jet-input-error for="contractordetailsinfo.name_primarycontact" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="contractordetailsinfo.phone_primary" value="{{ __('Contact Number') }}" />
                        <x-jet-input id="contractordetailsinfo.phone_primary" class="block mt-1 w-full" type="text" required wire:model.defer="contractordetailsinfo.phone_primary" />
                        <x-jet-input-error for="contractordetailsinfo.phone_primary" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="contractordetailsinfo.email_primary" value="{{ __('Email') }}" />
                        <x-jet-input id="contractordetailsinfo.email_primary" class="block mt-1 w-full" type="email" required wire:model.defer="contractordetailsinfo.email_primary" />
                        <x-jet-input-error for="contractordetailsinfo.email_primary" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="contractordetailsinfo.name_secondarycontact" value="{{ __('Secondary Contact') }}" />
                        <x-jet-input id="contractordetailsinfo.name_secondarycontact" class="block mt-1 w-full" type="text" required wire:model.defer="contractordetailsinfo.name_secondarycontact" />
                        <x-jet-input-error for="contractordetailsinfo.name_secondarycontact" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="contractordetailsinfo.phone_secondary" value="{{ __('Contact Number') }}" />
                        <x-jet-input id="contractordetailsinfo.phone_secondary" class="block mt-1 w-full" type="text" required wire:model.defer="contractordetailsinfo.phone_secondary" />
                        <x-jet-input-error for="contractordetailsinfo.phone_secondary" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="contractordetailsinfo.email_secondary" value="{{ __('Email') }}" />
                        <x-jet-input id="contractordetailsinfo.email_secondary" class="block mt-1 w-full" type="email" required wire:model.defer="contractordetailsinfo.email_secondary" />
                        <x-jet-input-error for="contractordetailsinfo.email_secondary" class="mt-2" />
                    </div>

                </x-slot>

                <x-slot name="footer">

                    <x-jet-button class="ml-2" wire:click="updateDetails" wire:loading.attr="disabled">
                        {{ __('Update') }}
                    </x-jet-button>
                    <x-jet-secondary-button wire:click="$set('updatedetails', false)" wire:loading.attr="disabled">
                        {{ __('Close') }}
                    </x-jet-secondary-button>

                </x-slot>
            </x-jet-dialog-modal>

            <!--Update Financial Modal -->
            <x-jet-dialog-modal wire:model.defer="updatefinancial">
                <x-slot name="title">
                    {{ __('Update Financials') }}
                </x-slot>

                <x-slot name="content">
                    <div>
                        <x-jet-label for="contractordetailsinfo.abn" value="{{ __('Australian Busines Number') }}" />
                        <x-jet-input id="contractordetailsinfo.abn" class="block mt-1 w-full" type="text" required wire:model.defer="contractordetailsinfo.abn" />
                        <x-jet-input-error for="contractordetailsinfo.abn" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="contractordetailsinfo.terms" value="{{ __('Payment Terms') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="contractordetailsinfo.terms">
                            <option value="" selected>Select a payment term</option>
                            <option value="30 days">30 days</option>
                            <option value="45 days">45 days</option>
                            <option value="60 days">60 days</option>
                        </select>
                        <x-jet-input-error for="contractordetailsinfo.terms" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="contractordetailsinfo.currency" value="{{ __('Currency') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="contractordetailsinfo.currency">
                            <option value="" selected>Select a payment currency</option>
                            <option value="AUD">AUD</option>
                            <option value="CND">CND</option>
                            <option value="NZD">NZD </option>
                        </select>
                        <x-jet-input-error for="contractordetailsinfo.currency" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="contractordetailsinfo.bankname" value="{{ __('Bank') }}" />
                        <x-jet-input id="contractordetailsinfo.bankname" class="block mt-1 w-full" type="text" required wire:model.defer="contractordetailsinfo.bankname" />
                        <x-jet-input-error for="contractordetailsinfo.bankname" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="contractordetailsinfo.branch" value="{{ __('Branch') }}" />
                        <x-jet-input id="contractordetailsinfo.branch" class="block mt-1 w-full" type="text" required wire:model.defer="contractordetailsinfo.branch" />
                        <x-jet-input-error for="contractordetailsinfo.branch" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="contractordetailsinfo.bsb" value="{{ __('BSB') }}" />
                        <x-jet-input id="contractordetailsinfo.bsb" class="block mt-1 w-full" type="text" required wire:model.defer="contractordetailsinfo.bsb" />
                        <x-jet-input-error for="contractordetailsinfo.bsb" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="contractordetailsinfo.accountname" value="{{ __('Account Name') }}" />
                        <x-jet-input id="contractordetailsinfo.accountname" class="block mt-1 w-full" type="text" required wire:model.defer="contractordetailsinfo.accountname" />
                        <x-jet-input-error for="contractordetailsinfo.accountname" class="mt-2" />
                    </div>

                    <div>
                        <x-jet-label for="contractordetailsinfo.accountnumber" value="{{ __('Account Number') }}" />
                        <x-jet-input id="contractordetailsinfo.accountnumber" class="block mt-1 w-full" type="text" required wire:model.defer="contractordetailsinfo.accountnumber" />
                        <x-jet-input-error for="contractordetailsinfo.accountnumber" class="mt-2" />
                    </div>

                </x-slot>
                <x-slot name="footer">

                    <x-jet-button class="ml-2" wire:click="updateFinancial" wire:loading.attr="disabled">
                        {{ __('Update') }}
                    </x-jet-button>
                    <x-jet-secondary-button wire:click="$set('updatefinancial', false)" wire:loading.attr="disabled">
                        {{ __('Close') }}
                    </x-jet-secondary-button>

                </x-slot>
            </x-jet-dialog-modal>

            <x-jet-dialog-modal wire:model.defer="updateskills">
                <x-slot name="title">
                    {{ __('Update Skills') }}
                </x-slot>

                <x-slot name="content">
                    <div class="mt-4">
                        <x-jet-label for="contractordetailsinfo.skills" value="{{ __('Add Skills') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="contractordetailsinfo.skills">
                            <option value="" selected>Select a skill</option>
                            @foreach($allskills as $skill)
                            <option value="{{$skill->id}}"> {{$skill->name}} </option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="contractordetailsinfo.skills" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        @foreach($skills as $skill)
                        <span class="px-2 inline-flex text-s leading-5 font-semibold rounded-full bg-indigo-600 text-white mt-3 transition duration-500 ease-in-out transform hover:-translate-y-1"> {{$skill->Skills->name}}

                            <button type="submit" wire:click="confirmDeleteSkill( {{$skill->id}})">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 1 20 20" fill="currentColor" class="text-white h-4 w-4 fill-current">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </button>

                        </span>
                        @endforeach

                    </div>
                </x-slot>

                <x-slot name="footer">

                    <x-jet-button class="ml-2" wire:click="updateSkills" wire:loading.attr="disabled">
                        {{ __('Update') }}
                    </x-jet-button>
                    <x-jet-secondary-button wire:click="$set('updateskills', false)" wire:loading.attr="disabled">
                        {{ __('Close') }}
                    </x-jet-secondary-button>

                </x-slot>

            </x-jet-dialog-modal>

            <x-jet-dialog-modal wire:model.defer="addDocuments">
                <x-slot name="title">
                    {{ __('Add Documents') }}
                </x-slot>

                <x-slot name="content">
                    <div class="mt-4">
                        <x-jet-label for="contractordetailsinfo.documents_id" value="{{ __('Document Type') }}" />
                        <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="contractordetailsinfo.documents_id">
                            <option value="" selected>Select a document</option>
                            @foreach($alldocuments as $skill)
                            <option value="{{$skill->id}}"> {{$skill->name}} </option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="contractordetailsinfo.documents_id" class="mt-2" />
                    </div>


                    <div class="py-4 pr-2" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <x-jet-label for="contractordetailsinfo.file_path" value="{{ __('File') }}" />
                        <input id="contractordetailsinfo.file_path" class="mt-2 text-xs text-gray-600 content-center" type="file" name="contractordetailsinfo.file_path" required wire:model.defer="contractordetailsinfo.file_path">
                        <x-jet-input-error for="contractordetailsinfo.file_path" class="mt-2" />


                        <!-- Progress Bar -->
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    <div class="">
                        <x-jet-label for="expiration" value="{{ __('Expiration') }}" />
                        <input type="date" class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" required wire:model.defer="expiration">
                        <x-jet-input-error for="expiration" class="mt-2" />
                    </div>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 mt-3"> Note: Disregard if document does not have an expiration </span>

                    <hr class="mt-2 mb-2">
                    <div>
                        <x-jet-label class="font-bold" value="{{ __('My Documents') }}" />
                        @foreach ($documents as $id)
                        <div class="px-2 inline-flex text-s leading-5 font-semibold rounded-full bg-indigo-600 text-white mt-3 transition duration-500 ease-in-out transform hover:-translate-y-1"> {{$id->Documents->name}}

                            <button type="submit" wire:click="confirmRemoveDocument( {{$id->id}})">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 1 20 20" fill="currentColor" class="text-white h-4 w-4 fill-current">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </button>

                        </div>
                        <p class="text-xs px-2  leading-5 "> {{ucwords($id->Documents->documents_category->name)}}
                            @if($id->status == 0)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                                For Review </span>

                            @endif

                            @if($id->status == 1)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                                Approved </span> @endif

                            @if($id->status == 2)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                                Rejected </span> @endif

                            @if($id->status == 3)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                                Expired </span> @endif

                            @if($id->status == 4)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-gray-800 transition duration-500 ease-in-out transform hover:-translate-y-1">
                                Expiring </span> @endif
                        </p>
                        @endforeach

                    </div>
                </x-slot>

                <x-slot name="footer">

                    <x-jet-button class="ml-2" wire:click="addDocuments" wire:loading.attr="disabled">
                        {{ __('Update') }}
                    </x-jet-button>
                    <x-jet-secondary-button wire:click="$set('addDocuments', false)" wire:loading.attr="disabled">
                        {{ __('Close') }}
                    </x-jet-secondary-button>

                </x-slot>

            </x-jet-dialog-modal>

            <!--Update Details Modal -->
           
        </div>


        @endif
    </div>
</div>