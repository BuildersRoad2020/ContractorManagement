<?php

namespace App\Http\Livewire;

use App\Models\ContractorDocuments;
use App\Models\Documents;

use App\Models\Contractors as ModelsContractors;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Contractors extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected $queryString = [  //to show query in url
        'status',
        'q'
    ];

    public $confirmingContractorDeletion = false;
    public $viewContractor = false;

    public $status; //toggle contractor status
    public $q; //searchbox

    public $name;
    public $contractorstatus;
    public $address;
    public $city;
    public $state;
    public $country;
    public $postcode;
    public $abn;
    public $name_primarycontact;
    public $phone_primary;
    public $email_primary;
    public $name_secondarycontact;
    public $phone_secondary;
    public $email_secondary;
    public $terms;
    public $currency;
    public $bankname;
    public $branch;
    public $accountname;
    public $bsb;
    public $accountnumber;

    public $countTechnicians;

    public function render()
    {
        $this->authorize('admin', App\Models\Users::class);
        $contractors = ModelsContractors::orderby('name')->with('User') 
        ->when($this->q, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'LIKE', '%' . $this->q . '%');
            });
        })
        ->when($this->status, function ($query) {
            return $query->where('status', $this->status);
        })
        ->paginate(10);
        return view('livewire.contractors', [
            'contractors' => $contractors,
        ]);
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function view($id)
    {
      $this->viewContractor = $id;
      $contractors = ModelsContractors::where('id', $id)->with('ContractorDetails')->withCount('Technicians')->with('Countries')->with('States')->with('Cities')->first();

      $this->name = $contractors->name;
      $this->contractorstatus = $contractors->status;
      $this->address = $contractors->ContractorDetails->address;
      $this->city = $contractors->Cities->pluck('name')->first();
      $this->state = $contractors->States->pluck('name')->first();
      $this->country = $contractors->Countries->pluck('name')->first();
      $this->postcode = $contractors->postcode;
      $this->abn = $contractors->abn;
      $this->name_primarycontact = $contractors->name_primarycontact;
      $this->phone_primary = $contractors->phone_primary;
      $this->email_primary = $contractors->email_primary;
      $this->email_secondary = $contractors->email_secondary;
      $this->name_secondarycontact = $contractors->name_secondarycontact;
      $this->name_phone_secondary = $contractors->phone_secondary;
      $this->countTechnicians = $contractors->technicians_count;
      $this->terms = $contractors->terms;
      $this->currency = $contractors->currency;
      $this->bankname =$contractors->bankname;
      $this->branch = $contractors->branch;
      $this->accountname = $contractors->accountname;
      $this->bsb = $contractors->bsb;
      $this->accountnumber = $contractors->accountnumber;

    }

    public function approveContractor($id)
    {
        $this->viewContractor = $id;

        $required = Documents::where('required', 1)->pluck('id')->toarray(); //get required document IDs
        foreach($required as $id => $key) {
            $missing_id[] = ContractorDocuments::where('contractors_id', $this->viewContractor)->where('documents_id', $key)->where('status', '1')->pluck('documents_id')->first();
        }
        $missing = array_diff($required, $missing_id);
        
        if($missing == null) {
            $update = ModelsContractors::where('id', $this->viewContractor)->first();
            $update->status = '1';
            $update->save();
            $this->viewContractor = false;
            session()->flash('message', 'Contractor has been approved');
        }
        else {
            $this->viewContractor = false;
            session()->flash('error', 'Please review documents');
        }
        
    }

    public function denyContractor(ModelsContractors $id)
    {
        $this->viewContractor = $id;
        $id->status = '0';
        $id->save();
        $this->viewContractor = false;
        session()->flash('error', 'Contractor onHold');
    }


    public function confirmContractorDeletion($id)
    {
        $this->confirmingContractorDeletion = $id;
    }
  

    public function DeleteContractor(ModelsContractors $id)
    {
        $user = $id->User()->first();
        $id->status = 6;
        $id->save(); 
        $user->status = 6;
        $user->save();
        $this->confirmingContractorDeletion = false;
        session()->flash('message', 'Contractor has been archived');
    }

}
