<?php

namespace App\Http\Livewire;

use App\Models\Cities;
use App\Models\Countries;
use App\Models\Skills;
use App\Models\States;
use App\Models\Technician_Skills;
use App\Models\Technicians;
use App\Models\User;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;


class TechnicianDashboard extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use WithFileUploads;

    public $editprofile = false;
    public $editskills = false;
    public $profile;

    public $SelectedCountry = null;
    public $SelectedState = null;
    public $SelectedCity = null;
    public $states = null;
    public $cities = null;

    public $rules = [
        'profile.name' => ['required'],
        'profile.address' => ['required'],
        'profile.postcode' => ['required'],
        'SelectedCountry' => ['required'],
        'SelectedState' => ['required'],
        'SelectedCity' => ['required'],
        'profile.phone' => ['required','numeric'],
    ];

    public function render()
    {
        $this->authorize('technician', App\Models\Users::class);
        $technicians = Technicians::where('users_id', auth()->user()->id)->with('User')->with('Contractors')->with('Countries')->with('States')->with('Cities')->first();
        
        if ($technicians != null) {
            $skills = Technician_Skills::where('technicians_id', $technicians->id)->with('Skills')->get();
        } else if ($technicians == null) {
            $skills = '';
        }
        
        return view('livewire.technician-dashboard', [
            'technicians' => $technicians,
            'countries' => Countries::get(),
            'skills' => $skills,
            'allskills' => Skills::get(),

        ]);
    }

    public function updateProfile() {
       
        $this->editprofile = true; 
        $id = auth()->user()->id;
        $this->validate();       
        
        $technician = Technicians::where('users_id', $id)->with('User')->first();
        $technician->address = ucwords($this->profile['address']);
        $technician->postcode = $this->profile['postcode'];
        $technician->phone = $this->profile['phone'];
        $technician->name = $this->profile['name'];
        $technician->country = $this->SelectedCountry;
        $technician->state = $this->SelectedState;
        $technician->city = $this->SelectedCity;
        $technician->save();

        $user = User::where('id', $technician->users_id)->first();
        $user->name = ucwords($this->profile['name']);
        $user->save();

        $this->editprofile = false;
        session()->flash('message', 'Details has been updated');
    }

    public function confirmUpdateSkills()
    {
        $this->editskills = true;
    }

    public function updateSkills() 
    {
        $id = auth()->user()->id;
        $technician = Technicians::where('users_id', $id)->with('User')->first();
        $validatedData = $this->validate([
            'profile.skills' => ['required'],
        ]);
      
        $addskills = new Technician_Skills;
        $addskills->technicians_id = $technician->id;
        $addskills->skills_id = $this->profile['skills'];
        $addskills->save();
        session()->flash('message', 'Skill updated');

    }

    public function confirmDeleteSkill(Technician_Skills $id)
    {
        $id->delete();
        $this->reset('editskills');
        $this->editskills = true;
        session()->flash('message', 'Skills have been updated');
    }
    
    public function updatedSelectedCountry($countries_id)
    {
        $this->states = States::where('countries_id', $countries_id)->get();
    }

    public function updatedSelectedState($states_id)
    {
        $this->cities = Cities::where('states_id', $states_id)->get();
    }
}
