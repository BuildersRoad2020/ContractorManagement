<?php

namespace App\Http\Livewire;

use App\Models\Cities;
use App\Models\Contractor_Skills;
use App\Models\ContractorDetails;
use App\Models\ContractorDocuments;
use App\Models\ContractorRates;
use App\Models\Contractors;
use App\Models\Countries;
use App\Models\Documents;
use App\Models\Skills;
use App\Models\States;


use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;




class ContractorDashboard extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    public $contractorinfo;
    public $contractordetailsinfo;
    public $expiration;

    public $updatedetails = false; //update contractor details
    public $updatefinancial = false; //update contractor financial details
    public $updateskills = false; //update skills 
    public $addDocuments = false;
    public $addModal = false;

    public $SelectedCountry = null;
    public $SelectedState = null;
    public $SelectedCity = null;
    public $states = null;
    public $cities = null;

    public $name_secondarycontact;
    public $phone_secondary;
    public $email_secondary;

    public $rules = [
        'contractorinfo.name' => ['required'],
        'contractordetailsinfo.address' => ['required'],
        'contractordetailsinfo.postcode' => ['required'],
        'SelectedCountry' => ['required'],
        'SelectedState' => ['required'],
        'SelectedCity' => ['required'],
        'contractordetailsinfo.name_primarycontact' => ['required'],
        'contractordetailsinfo.phone_primary' => ['required', 'numeric'],
        'contractordetailsinfo.email_primary' => ['required', 'email'],
        'name_secondarycontact' => ['nullable'],
        'phone_secondary' => ['nullable', 'numeric'],
        'email_secondary' => ['nullable', 'email'],
    ];

    protected $listeners = ['added' => 'render'];

    public function render()
    {

        $this->authorize('vendor', App\Models\Users::class);

        $contractors = Contractors::with('User')->where('users_id', auth()->user()->id)->with('ContractorDetails')->with('Countries')->with('States')->with('Cities')->withCount('Technicians')->first();

        if ($contractors != null) {
            $skills = Contractor_Skills::where('contractors_id', $contractors->id)->with('Skills')->get();
        } else if ($contractors == null) {
            $skills = '';
        }
        $documents = ContractorDocuments::where('contractors_id', $contractors->id)->with('Documents')->get();
        // dd($contractors);
        return view('livewire.contractor-dashboard', [
            'contractors' => $contractors,
            'skills' => $skills,
            'countries' => Countries::get(),
            'allskills' => Skills::get(),
            'documents' => $documents,
            'alldocuments' => Documents::get(),
        ]);
    }

    public function updatedSelectedCountry($countries_id)
    {
        $this->states = States::where('countries_id', $countries_id)->get();
    }

    public function updatedSelectedState($states_id)
    {
        $this->cities = Cities::where('states_id', $states_id)->get();
    }

    public function confirmUpdateDetails()
    {
        $this->updatedetails = true;
    }

    public function updateDetails()
    {
      
        $this->validate();
        $contractors = Contractors::with('User')->where('users_id', auth()->user()->id)->select('id')->first();
        $contractors->name = $this->contractorinfo['name'];
        $contractors->save();
        $contractor = ContractorDetails::where('contractors_id', $contractors->id)->first();
        $contractor->address = $this->contractordetailsinfo['address'];
        $contractor->postcode = $this->contractordetailsinfo['postcode'];
        $contractor->country = $this->SelectedCountry;
        $contractor->state = $this->SelectedState;
        $contractor->city = $this->SelectedCity;
        $contractor->name_primarycontact = $this->contractordetailsinfo['name_primarycontact'];
        $contractor->phone_primary = $this->contractordetailsinfo['phone_primary'];
        $contractor->email_primary = $this->contractordetailsinfo['email_primary'];

        $contractor->name_secondarycontact = $this->name_secondarycontact;
        $contractor->phone_secondary = $this->phone_secondary;
        $contractor->email_secondary = $this->email_secondary;

        $contractor->save();
        $this->updatedetails = false;
        session()->flash('message', 'Details has been updated');
    }

    public function confirmUpdateFinancial()
    {
        $this->updatefinancial = true;
    }

    public function updateFinancial()
    {
        $validatedData = $this->validate([
            'contractordetailsinfo.abn' => ['required'],
            'contractordetailsinfo.terms' => ['required'],
            'contractordetailsinfo.currency' => ['required'],
            'contractordetailsinfo.bankname' => ['required'],
            'contractordetailsinfo.branch' => ['required'],
            'contractordetailsinfo.accountname' => ['required'],
            'contractordetailsinfo.bsb' => ['required'],
            'contractordetailsinfo.accountnumber' => ['required', 'numeric'],
        ]);
        $contractors = Contractors::with('User')->where('users_id', auth()->user()->id)->select('id')->first();
        $contractor = ContractorDetails::where('contractors_id', $contractors->id)->first();
        $contractor->abn = $this->contractordetailsinfo['abn'];
        $contractor->terms = $this->contractordetailsinfo['terms'];
        $contractor->currency = $this->contractordetailsinfo['currency'];
        $contractor->bankname = $this->contractordetailsinfo['bankname'];
        $contractor->branch = $this->contractordetailsinfo['branch'];
        $contractor->accountname = $this->contractordetailsinfo['accountname'];
        $contractor->bsb = $this->contractordetailsinfo['bsb'];
        $contractor->accountnumber = $this->contractordetailsinfo['accountnumber'];
        $contractor->save();

        $this->updatefinancial = false;
        session()->flash('message', 'Financials has been updated');
    }

    public function confirmUpdateSkills()
    {
        $this->updateskills = true;
    }

    public function updateSkills()
    {
        $validatedData = $this->validate([
            'contractordetailsinfo.skills' => ['required'],
        ]);
        $contractors = Contractors::with('User')->where('users_id', auth()->user()->id)->select('id')->first();
        $skills = new Contractor_Skills;
        $skills->skills_id = $this->contractordetailsinfo['skills'];
        $skills->contractors_id = $contractors->id;
        $skills->save();
        session()->flash('message', 'Skills have been updated');
    }

    public function confirmDeleteSkill(Contractor_Skills $id)
    {
        $id->delete();
        $this->reset('updateskills');
        $this->updateskills = true;
        session()->flash('message', 'Skills have been updated');
    }

    public function confirmAddDocuments()
    {
        $this->reset('contractordetailsinfo');
        $this->addDocuments = true;
    }

    public function addDocuments()
    {

        $contractors = Contractors::with('User')->where('users_id', auth()->user()->id)->select('id', 'name')->first();
        $validatedData = $this->validate([
            'contractordetailsinfo.documents_id' => ['required'],
            'contractordetailsinfo.file_path' => ['nullable', 'mimes:pdf', 'max:2000'],
            'expiration' => 'nullable|date|after:tomorrow',
        ]);
        $documents = new ContractorDocuments;
        $documents->documents_id = $this->contractordetailsinfo['documents_id'];

        if ($this->expiration !== "") {
            $documents->expiration = $this->expiration;
        }

        $documents->contractors_id = $contractors->id;

        $documentstable = Documents::where('id', $this->contractordetailsinfo['documents_id'])->pluck('name')->first();

        if ($this->contractordetailsinfo['file_path'] != null) {
            $File = $this->contractordetailsinfo['file_path'];
            $FileName = $documentstable . '_' . $contractors->name . '_' . time() . '.' . $File->getClientOriginalExtension();

            Storage::disk("google")->putFileAs("", $this->contractordetailsinfo['file_path'],  $FileName); //save the file to google drive

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

    public function confirmRemoveDocument(ContractorDocuments $id)
    {
        //  dd($id);
        $this->emit('added');
        $id->delete();
        $this->reset('addDocuments');
        $this->addDocuments = true;
    }
}
