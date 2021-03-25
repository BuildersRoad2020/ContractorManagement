<?php

namespace App\Http\Livewire;

use App\Models\Contractor_Skills;
use App\Models\ContractorDocuments;
use App\Models\ContractorRates;
use Livewire\Component;


class ContractorSkillList extends Component
{

    public $contractor;

    public function mount($id)
    {
        $this->contractor = $id;
    }

    public function render()
    {
        $skills = Contractor_Skills::where('contractors_id', $this->contractor)->with('Skills')->get();
        $documents = ContractorDocuments::where('contractors_id', $this->contractor)->with('Documents')->get();
        $rates = ContractorRates::where('contractors_id', $this->contractor)->get();


        return view('livewire.contractor-skill-list', [
            'skills' => $skills,
            'documents' => $documents,
            'rates' => $rates,
        ]);
    }

 
}
