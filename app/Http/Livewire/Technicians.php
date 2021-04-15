<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Contractors;
use App\Models\Technicians as ModelsTechnician;
use App\Models\RoleUser;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash; 
use App\Mail\NewUser;

class Technicians extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $confirmingTechnicianAdd = false;
    public $confirmingTechnicianDelete = false;
    public $viewTechnician = false;

    public $name;
    public $email;
    public $contractors_id;
    public $address;
    public $city;
    public $state;
    public $country;
    public $phone;
    public $postcode;


    public $q; //searchbox

    protected $queryString = [  //to show query in url
        'q'
    ];

    public function render()
    {
        $this->authorize('adminvendor', App\Models\Users::class);
        $users = auth()->user()->Roles()->pluck('id')->toarray();
        foreach ($users as $key => $role_id) {
            if ($role_id == 1 ) {   //Search all technicians and Contractors Table
                $technicians = ModelsTechnician::
                    when($this->q, function ($query) {
                        return $query->where(function ($query) {
                            $query->where('name', 'LIKE', '%' . $this->q . '%')
                                ->orwherehas('contractors', function ($query) {
                                    $query->where('name', 'LIKE', '%' . $this->q . '%');
                                });
                        });
                    })
                    ->paginate(9);
            }   

            if ($role_id == 2) {               //search Technicians table only assigned to this contractor
                $id = auth()->user()->id;       
                $contractor = Contractors::where('users_id', $id)->pluck('id');
                $technicians = ModelsTechnician::where('contractors_id', $contractor)
                    ->when($this->q, function ($query) {
                        return $query->where(function ($query) {
                            $query->where('name', 'LIKE', '%' . $this->q . '%');
                        });
                    })
                    ->paginate(9);
            } 
            break;
      }

    //  dd($technicians);
  
      return view('livewire.technicians', [
            'technicians' => $technicians,
            'checkrole' => Auth()->user()->Roles()->where('id', 1)->pluck('id')->first(),
            'adminlist' =>  Contractors::get(),
            'contractorlist' => Contractors::where('users_id', auth()->user()->id)->get(),
         
        ]);
    }

    /* Add Technician */
    public function confirmTechnicianAdd()
    {
        $this->confirmingTechnicianAdd = true;
    }

    public function TechnicianAdd()
    {
        $this->resetPage();
        $validatedData = $this->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                // 'role_users' => auth()->user()->roleuser()->firstwhere('role_id',2),
                'contractors_id' => ['required'],
            ],
            [
                'name.required' => 'Please enter a name',
                'email.required' => 'Please enter an email address',
                'contractors_id.required' => 'Please assign tech to a Contractor'
                // 'role_id.required' => 'Please select at least one role'
            ]
        );

        $password =  STR::random(10);

        $user = new User;
        $user->name = ucwords($validatedData['name']);
        $user->email = $validatedData['email'];
        $user->password =  Hash::make($password); /* '$2y$10$rhm2pp2wXz7jg5z10ca2/.NfsaXzFTPNq/q2y0ZkKSa6CBwFJYga6'; */ 
        $user->save();
        $RoleUser = $user->RoleUser()->create(['roles_id' => '3']);
        $Technician = ModelsTechnician::create([
            'contractors_id' => $validatedData['contractors_id'],
            'name' =>  $validatedData['name'],
            'users_id' => $user->id,
        ]);

        $emailuser = [
            'name' => 'Dear ' . ucwords($validatedData['name']) . ',' ,
            'body' => 'Your access to Proyekto has been created!',
            'user' => 'Your username is : ' . $validatedData['email'],
            'password' => 'Your password is : ' . $password ,
        ];
        $emailreceiver = $validatedData['email'];

        \Mail::to($emailreceiver)->send(new NewUser($emailuser));

        $this->confirmingTechnicianAdd = false;
        session()->flash('message', 'Technician has been added');
    }

        /* Delete Technician but not from Users*/
    public function confirmTechnicianDelete($id)
    {
        $this->confirmingTechnicianDelete = $id;
    }

    public function DeleteTechnician(ModelsTechnician $id)
    {
        $id->status = 6;
        $id->save();
        $user = User::where('id', $id->users_id)->first();
        $user->email = Hash::make($user->email);
        $user->status = 6;
        $user->save();
        $this->confirmingTechnicianDelete = false;
        session()->flash('message', 'Technician has been archived');
    }

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function view($id)
    {
        $this->viewTechnician = $id;
        $technician = ModelsTechnician::where('id', $this->viewTechnician)->first();
        $this->name = $technician->name;
        $this->email = $technician->User->email;
        $this->contractors_id = $technician->Contractors->name;
        $this->address = $technician->address;
        $this->postcode = $technician->postcode;
        $this->phone = $technician->phone;
          
        if($technician->Cities != null) {
            $this->city = $technician->Cities->name;
        }
        
        if($technician->States != null) {
            $this->state = $technician->States->name;
        }

        if($technician->Countries != null) {
            $this->country = $technician->Countries->name;  
        }  

      
    }

}
