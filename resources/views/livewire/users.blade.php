

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
    <div class="bg-white text-right py-4 lg:px-4 rounded animate-fade-in-down">
        <div class="p-2 bg-red-500 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
            <span class="flex rounded-full bg-red-200 uppercase px-2 py-1 text-xs font-bold mr-3">
                <svg class="h-8 w-8 text-white fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path d="M468.907 214.604c-11.423 0-20.682 9.26-20.682 20.682v20.831c-.031 54.338-21.221 105.412-59.666 143.812-38.417 38.372-89.467 59.5-143.761 59.5h-.12C132.506 459.365 41.3 368.056 41.364 255.883c.031-54.337 21.221-105.411 59.667-143.813 38.417-38.372 89.468-59.5 143.761-59.5h.12c28.672.016 56.49 5.942 82.68 17.611 10.436 4.65 22.659-.041 27.309-10.474 4.648-10.433-.04-22.659-10.474-27.309-31.516-14.043-64.989-21.173-99.492-21.192h-.144c-65.329 0-126.767 25.428-172.993 71.6C25.536 129.014.038 190.473 0 255.861c-.037 65.386 25.389 126.874 71.599 173.136 46.21 46.262 107.668 71.76 173.055 71.798h.144c65.329 0 126.767-25.427 172.993-71.6 46.262-46.209 71.76-107.668 71.798-173.066v-20.842c0-11.423-9.259-20.683-20.682-20.683z" />
                    <path d="M505.942 39.803c-8.077-8.076-21.172-8.076-29.249 0L244.794 271.701l-52.609-52.609c-8.076-8.077-21.172-8.077-29.248 0-8.077 8.077-8.077 21.172 0 29.249l67.234 67.234a20.616 20.616 0 0 0 14.625 6.058 20.618 20.618 0 0 0 14.625-6.058L505.942 69.052c8.077-8.077 8.077-21.172 0-29.249z" />
                </svg>
            </span>
            <span class="font-semibold mr-2 text-left flex-auto"> {{ session('error') }} </span>
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
            <div class="mt-2">
                <x-jet-button wire:click="confirmUserAdd" wire:loading.attr="disabled">
                    {{ __('Add User') }}
                </x-jet-button>
            </div>
        </div>

        <!--Add User Modal -->
        <x-jet-dialog-modal wire:model.defer="confirmingUserAdd">
            <x-slot name="title">
                {{ __('Add User') }}
            </x-slot>

            <x-slot name="content">
                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name"  required wire:model.defer="name" />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"  required wire:model.defer="email" />
                    <x-jet-input-error for="email" class="mt-2" />
                </div>

                <div class="mt-4">

                    <x-jet-label for="role" value="{{ __('Role') }}" />
                    <select id="role" class="form-multiselect block mt-1 w-full" multiple name="role" required wire:model.defer="role_id" />
                    <option value="1"> Admin </option>
                    <option value="2"> Vendor </option>
                    <option value="3"> Technician </option>
                    </select>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 mt-3"> You may select multiple roles</span>
                    <x-jet-input-error for="role_id" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">

                <x-jet-button class="ml-2" wire:click="UserAdd()" wire:loading.attr="disabled">
                    {{ __('Add User') }}
                </x-jet-button>
                <x-jet-secondary-button wire:click="$set('confirmingUserAdd', false)" wire:loading.attr="disabled">
                    {{ __('Close') }}
                </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal>


        <div class="mt-2">
            <table class="border-collapse w-full">
                <thead>
                    <tr>
                        <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">

                        </th>
                        <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            User
                        </th>
                        <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            Email
                        </th>
                        <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            Role
                        </th>
                        <th class="p-3 font-bold bg-gray-100 text-gray-600 border border-gray-300 hidden lg:table-cell">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody data-turbolinks="false" wire:poll.2000ms>
                    @foreach($users as $user)
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center  border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-auto left-0 bg-blue-200 px-1 py-1 text-xs font-bold"> </span>
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
                                    <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="h-8 w-8 rounded-full inline-block align-middle">
                                </div>

                                <!-- New Profile Photo Preview -->
                                <div class="mt-2" x-show="photoPreview">
                                    <span class="block rounded-full w-20 h-20" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                    </span>
                                </div>




                            </div>
                        </td>

                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-auto left-0 bg-blue-200 px-1 py-1 text-xs font-bold"> User </span>
                            {{$user->name }}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-auto left-0  bg-blue-200 px-1 py-1 text-xs font-bold">Email</span>
                            {{$user->email}}
                        </td>

                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-auto left-0  bg-blue-200 px-1 py-1 text-xs font-bold ">Role</span>
                         

                            <span class="lg:hidden absolute top-auto left-0  bg-blue-200 px-1 py-1 text-xs font-bold">Role</span>    @foreach ($user->Roles as $role)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 transition duration-500 ease-in-out transform hover:-translate-y-1"> {{$role->title}}</span>
                            @endforeach
                        </td>

                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-auto left-0  bg-blue-200 px-1 py-1 text-xs font-bold">Actions</span>
                            <x-jet-button wire:click="confirmUserEdit( {{$user->id }})" wire:loading.attr="disabled">
                                {{ __('Edit') }}
                                </x-jet-danger-button>


                                <x-jet-danger-button wire:click="confirmUserDelete( {{$user->id }})" wire:loading.attr="disabled">
                                    {{ __('Archive') }}
                                </x-jet-danger-button>

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!--Edit User Modal -->
        <x-jet-dialog-modal wire:model.defer="confirmingUserEdit">
            <x-slot name="title">
                {{ __('Edit User') }}
            </x-slot>

            <x-slot name="content">
                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required wire:model.defer="name" />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full disabled:opacity-50" type="email" name="email" :value="old('email')" required wire:model.defer="email" disabled />
                    <x-jet-input-error for="email" class="mt-2" />
                </div>

            </x-slot>

            <x-slot name="footer">

                <x-jet-danger-button class="ml-2" wire:click="EditUser({{ $confirmingUserEdit}})" wire:loading.attr="disabled">
                    {{ __('Edit Account') }}
                </x-jet-danger-button>
                <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                    {{ __('Close') }}
                </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal>

        <!--Delete User Modal -->
        <x-jet-dialog-modal wire:model.defer="confirmingUserDelete">
            <x-slot name="title">
                {{ __('Archive User') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure you want to archive this User? This will archive associated accounts') }}
            </x-slot>

            <x-slot name="footer">

                <x-jet-danger-button class="ml-2" wire:click="DeleteUser({{ $confirmingUserDelete }})" wire:loading.attr="disabled">
                    {{ __('Archive Account') }}
                </x-jet-danger-button>
                <x-jet-secondary-button wire:click="$set('confirmingUserDelete', false)" wire:loading.attr="disabled">
                    {{ __('Close') }}
                </x-jet-secondary-button>

            </x-slot>
        </x-jet-dialog-modal>
        <div class="mt-4" data-turbolinks="false">
            {{ $users->links() }}
        </div>
    </div>
</div>