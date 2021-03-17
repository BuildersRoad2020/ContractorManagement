<?php

namespace App\Http\Livewire;

use App\Models\Technician_Skills;
use App\Models\TechnicianDocuments;
use Livewire\Component;

class TechnicianSkillList extends Component
{

    public $technician;

    public function mount($id)
    {
        $this->technician = $id;
    }

    public function render()
    {
        $skills = Technician_Skills::where('technicians_id', $this->technician)->with('Skills')->get();
        $documents = TechnicianDocuments::where('technicians_id', $this->technician)->with('Documents')->get();


        return view('livewire.technician-skill-list', [
            'skills' => $skills,
            'documents' => $documents,
        ]);
    }

}
