<div class="bg-gray-100 -mt-16">
    <div class="container my-5 pt-5 pb-2 pr-6 w-auto  h-full "> 
        <div class="md:flex no-wrap md:-mx-2">
            <div class="w-full h-full md:w-3/12 md:mx-2 "> 
            </div>
            <div class="w-full md:w-9/12 mx-2 h-full">

                <div class="flex justify-start mb-2">
                    <div class="pt-2 relative text-gray-600">
                        <input wire:model.debounce.500ms="q" class="border border-gray-300 rounded-full text-xs text-gray-600 h-8 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none" type="search" name="search" placeholder="Search">
                        <button type="submit" class="absolute right-0 top-0 mt-4 mr-4">
                            <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                                <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="bg-white p-3 shadow-sm rounded-sm">
                    <div class="flex justify-between space-x-2 font-semibold text-gray-900 leading-8 mr-4">
                        <div class="flex no-wrap">
                            <span clas="text-green-500">
                                <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>

                            </span>
                            <span class="tracking-wide -mt-1 ml-2">Rates</span>
                        </div>
                        <div class="">
                            <x-jet-button wire:click="confirmAddRates" wire:loading.attr="disabled">
                                {{ __('Update') }}
                            </x-jet-button>
                        </div>
                    </div>

                    <div class="text-gray-700">
                        <div class="grid md:grid-cols-3 text-sm gap-y-1"> @foreach($contractors as $contractor)
                            <div class="grid grid-cols-1">
                                <div class="text-gray-600 text-sm font-bold" title="First Hour">
                                    <div class="flex no-wrap">
                                        {{$contractor->rate }} {{$contractor->Contractors->ContractorDetails->currency }}
                                        <button type="submit" wire:click="confirmDeleteRate( {{$contractor->id}})" title="Delete" class="transition duration-500 ease-in-out transform hover:-translate-y-1">
                                            <svg class="h-3 ml-1 bg-red-100" xmlns="http://www.w3.org/2000/svg" fill="pink" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                @if($contractor->rate2 != null)
                                <div class="text-gray-500 text-xs" title="Subsequent">
                                    <div class="flex no-wrap">
                                        {{$contractor->rate2 }} {{$contractor->Contractors->ContractorDetails->currency }}
                                        <svg class="h-3 ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                @endif

                                <div class="text-gray-500 text-xs">
                                    <p class="text-xs">@if($contractor->Cities != null) {{ucfirst($contractor->Cities->name)}} @endif {{$contractor->States->name}}, {{$contractor->Countries->name}} </p>
                                </div>
                            </div>@endforeach
                        </div>

                        <div class="mt-4" data-turbolinks="false">
                            {{ $contractors->links() }}
                        </div>
                    </div>
                    <x-jet-dialog-modal wire:model.defer="addModal">
                        <x-slot name="title">
                            {{ __('Add Rates') }}
                        </x-slot>

                        <x-slot name="content">
                            <div class="flex flex-wrap gap-x-2">
                                <div>
                                    <x-jet-label for="contractorrates.rate" value="{{ __('Hourly Rate') }}" />
                                    <input type="text" class="border border-gray-300 rounded-full content-center text-xs text-gray-600  h-8 w-auto bg-white hover:border-gray-400 focus:outline-none appearance-none" type="text" required wire:model.defer="contractorrates.rate" />
                                    <x-jet-input-error for="contractorrates.rate" class="mt-2" />
                                </div>

                                <div>
                                    <x-jet-label for="rate2" value="{{ __('Subsequent Rate') }}" />
                                    <input type="text" class="border border-gray-300 rounded-full content-center text-xs text-gray-600  h-8 w-auto bg-white hover:border-gray-400 focus:outline-none appearance-none" type="text" required wire:model.defer="rate2" />
                                    <x-jet-input-error for="rate2" class="mt-2" />
                                </div>


                                <div class="mr-2 w-auto md:w-auto mb-1">
                                    <x-jet-label value="{{ __('Country') }}" />
                                    <select class="border border-gray-300 rounded-full content-center text-xs text-gray-600  h-8 w-auto bg-white hover:border-gray-400 focus:outline-none appearance-none" wire:model="SelectedCountry">
                                        <option value="" selected>Select a Country</option>
                                        @foreach ($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="SelectedCountry" class="mt-2" />
                                </div>

                                @if (!is_null($states))
                                <div class="mr-2 w-auto md:w-auto mb-1 ">
                                    <x-jet-label value="{{ __('State') }}" />
                                    <select class="border border-gray-300 rounded-full content-center text-xs text-gray-600  h-8 w-auto bg-white hover:border-gray-400 focus:outline-none appearance-none" wire:model="SelectedState">
                                        <option value="" disabled selected>Select a State</option>
                                        @foreach ($states as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="SelectedState" class="mt-2" />
                                </div>
                                @endif
                                @if (!is_null($cities))
                                <div class="mr-2 w-auto md:w-auto mb-1">
                                    <x-jet-label value="{{ __('City') }}" />
                                    <select class="border border-gray-300 rounded-full content-center text-xs text-gray-600  h-8 w-auto bg-white hover:border-gray-400 focus:outline-none appearance-none" wire:model="SelectedCity">
                                        <option value="" selected>Select a City</option>
                                        @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    <x-jet-input-error for="SelectedCity" class="mt-2" />
                                </div>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 mt-3"> You may disregard City if same rate applies to the selected State</span>

                                @endif
                            </div>

                        </x-slot>

                        <x-slot name="footer">

                            <x-jet-button class="ml-2" wire:click="AddRates" wire:loading.attr="disabled">
                                {{ __('Update') }}
                            </x-jet-button>
                            <x-jet-secondary-button wire:click="$set('addModal', false)" wire:loading.attr="disabled">
                                {{ __('Close') }}
                            </x-jet-secondary-button>

                        </x-slot>
                    </x-jet-dialog-modal>

                </div>
            </div>
        </div>
    </div>
</div>