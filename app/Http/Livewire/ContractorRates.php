<?php

namespace App\Http\Livewire;

use App\Models\Cities;
use App\Models\ContractorRates as ModelsContractorRates;
use App\Models\Contractors;
use App\Models\Countries;
use App\Models\States;
use Livewire\Component;
use Livewire\WithPagination;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContractorRates extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public $addModal = false;
    public $q;

    public $contractorrates;
    public $SelectedCountry = null;
    public $SelectedState = null;
    public $SelectedCity = null;
    public $states = null;
    public $cities = null;
    public $rate2;

    protected $queryString = [  //to show query in url
        'q',
    ];


    public function render()
    {
        $this->authorize('vendor', App\Models\Users::class);
        $id = Contractors::where('users_id', auth()->user()->id)->pluck('id')->first();
        $contractors = ModelsContractorRates::where('contractors_id', $id)->with('Contractors')->with('Countries')->with('States')->with('Cities')->orderby('country', 'DESC')->orderby('state','ASC')
        ->when($this->q, function ($query) {
            return $query->where(function ($query) {
                $query->where('rate', 'LIKE', '%' . $this->q . '%')
                    ->orwherehas('countries', function ($query) {
                        $query->where('name', 'LIKE', '%' . $this->q . '%');
                    })
                    ->orwherehas('states', function ($query) {
                        $query->where('name', 'LIKE', '%' . $this->q . '%');
                    })
                    ->orwherehas('cities', function ($query) {
                        $query->where('name', 'LIKE', '%' . $this->q . '%');
                    });
            });
        })
        
        ->paginate(9); 
        return view('livewire.contractor-rates', [
            'contractors' => $contractors,
            'countries' => Countries::get(),
        ]);
    }

    public function confirmDeleteRate(ModelsContractorRates $id)
    {
        $id->delete();
        session()->flash('message', 'Rate removed');
    }

    public function updatedSelectedCountry($countries_id)
    {
        $this->states = States::where('countries_id', $countries_id)->get();
    }

    public function updatedSelectedState($states_id)
    {
        $this->cities = Cities::where('states_id', $states_id)->get();
    }

    public function confirmAddRates() 
    {
        $this->emit('added');
        $this->addModal = true;
        $this->reset('contractorrates');
        $this->reset('SelectedCountry');
        $this->reset('SelectedState');
        $this->reset('SelectedCity');
    }

    public function AddRates() 
    {
        $contractors = Contractors::with('User')->where('users_id', auth()->user()->id)->select('id', 'name')->first();
        $validatedData = $this->validate([
            'contractorrates.rate' => ['required', 'numeric', 'min:0', 'max:1000'],
            'rate2' => ['nullable', 'numeric', 'min:0', 'max:1000'],
            'SelectedCountry' => ['required'],
            'SelectedState' => ['required'],
            'SelectedCity' => ['nullable'],
        ]);
        
        $rate = new ModelsContractorRates;
        $rate->contractors_id = $contractors->id;
        $rate->rate = $this->contractorrates['rate'];
        if($this->rate2 != null) {
            $rate->rate2 = $this->rate2;
        }
        $rate->city = $this->SelectedCity;
        $rate->state = $this->SelectedState;
        $rate->country = $this->SelectedCountry;
        $rate->save();
        $this->addModal = false;
       // $this->emit('added');
        session()->flash('message', 'Rate Added');
     
        $this->resetPage();
    }


}
