<?php

namespace App\Http\Livewire;

use App\Models\Cities;
use App\Models\Countries;
use App\Models\Documents;
use App\Models\Documents_Category;
use App\Models\Skills;
use App\Models\States;
use App\Models\Technician_Skills;
use App\Models\TechnicianDocuments;
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
    public $addDocuments = false;

    public $SelectedCountry = null;
    public $SelectedState = null;
    public $SelectedCity = null;
    public $states = null;
    public $cities = null;

    public $profilename;
    public $profileaddress;
    public $profilepostcode;
    public $profilephone;

    public $technicianinfo;
    public $technicianexpiration;

    public function render()
    {
        $this->authorize('technician', App\Models\Users::class);
        $technicians = Technicians::where('users_id', auth()->user()->id)->with('User')->with('Contractors')->with('Countries')->with('States')->with('Cities')->first();
        
        if ($technicians != null) {
            $skills = Technician_Skills::where('technicians_id', $technicians->id)->with('Skills')->get();
        } else if ($technicians == null) {
            $skills = '';
        }

        $documents = TechnicianDocuments::where('technicians_id', $technicians->id)->with('Documents')->get();

        $individual = Documents_Category::where('name', 'LIKE', '%' . 'individual' . '%')->pluck('id');
        foreach ($individual as $key => $id) {
             $alldocuments = Documents::where('documents__category_id', $id)->get();
        }
       // dd($alldocuments);
         
        return view('livewire.technician-dashboard', [
            'technicians' => $technicians,
            'countries' => Countries::get(),
            'skills' => $skills,
            'allskills' => Skills::get(),
            'alldocuments' => $alldocuments,
            'documents' => $documents,
        ]);
    }

    public function updatedProfile() 
    {
        $this->reset('profile');
        $this->editprofile = true;
        $user = Technicians::where('users_id', auth()->user()->id)->first();
        $this->profileaddress = $user->address;
        $this->profilepostcode = $user->postcode;
        $this->profilephone = $user->phone;
        $this->profilename = $user->name;
        $this->SelectedCountry = $user->country;
        $this->SelectedState = $user->state;
        $this->SelectedCity = $user->city;


    }

    public function updateProfile() {
        
        $this->editprofile = true;
        $id = auth()->user()->id;
        $validatedData = $this->validate([ 
            'profilename' => ['required'],
            'profileaddress' => ['required'],
            'profilepostcode' => ['required'],
            'SelectedCountry' => ['required'],
            'SelectedState' => ['required'],
            'SelectedCity' => ['required'],
            'profilephone' => ['required','numeric'],
        ]);    
       // dd($validatedData);   
        $technician = Technicians::where('users_id', $id)->with('User')->first();
        $technician->address = ucwords($this->profileaddress);
        $technician->postcode = $this->profilepostcode;
        $technician->phone = $this->profilephone;
        $technician->name = ucwords($this->profilename);
        $technician->country = $this->SelectedCountry;
        $technician->state = $this->SelectedState;
        $technician->city = $this->SelectedCity;
        $technician->save();

        $user = User::where('id', $technician->users_id)->first();
        $user->name = ucwords($this->profilename);
        $user->save();

        $this->editprofile = false;
        session()->flash('message', 'Details has been updated');
    }

    public function confirmUpdateSkills()
    {
        $this->reset('editskills');
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
       // $this->reset('editskills');
        $this->editskills = true;
        session()->flash('message', 'Skill updated');

    }

    public function confirmDeleteSkill(Technician_Skills $id)
    {
       // dd($id);
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

    public function confirmAddDocuments()
    {
        $this->reset('technicianinfo');
        $this->addDocuments = true;
    }

    public function addDocuments()
    {
  
        $technicians = Technicians::with('User')->where('users_id', auth()->user()->id)->select('id', 'name')->first();
        $validatedData = $this->validate([
            'technicianinfo.documents_id' => ['required'],
            'technicianinfo.file_path' => ['required', 'mimes:pdf', 'max:2000'],
            'technicianexpiration' => 'nullable|date|after:tomorrow',
        ]);

        $documents = new TechnicianDocuments();
        $documents->documents_id = $this->technicianinfo['documents_id'];

        if($this->technicianexpiration != null ) {
            $documents->expiration = $this->technicianexpiration;
        }

        $documents->technicians_id = $technicians->id;

        $documentstable = Documents::where('id', $this->technicianinfo['documents_id'])->pluck('name')->first();

       
        if ($this->technicianinfo['file_path'] != null) {
            $File = $this->technicianinfo['file_path'];
            $FileName = $documentstable . '_' . $technicians->name . '_' . time() . '.' . $File->getClientOriginalExtension();

            Storage::disk("google")->putFileAs("", $this->technicianinfo['file_path'],  $FileName); //save the file to google drive

            $files = Storage::disk("google")->listContents(); //get the files uploaded in google drive
            usort($files, function ($a, $b) {
                return $a['timestamp'] <=> $b['timestamp'];
            });
            $FILEID = end($files);
        }
        $documents->file_path = $FILEID['basename'];
        $documents->save();
        $this->addDocuments = false;
        session()->flash('message', 'Documents uploaded');
    }

    public function confirmRemoveDocument(TechnicianDocuments $id)
    {
        //  dd($id);
        $id->delete();
        $this->reset('addDocuments');
        $this->addDocuments = true;
        session()->flash('message', 'Document list updated');
    }
}
