<?php

namespace App\Http\Livewire;

use App\Models\Contractor_Skills;
use App\Models\Skills;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class Skill extends Component
{

    use AuthorizesRequests;

    public $confirm = false;
    public $name;

    public function render()
    {
        $this->authorize('admin', App\Models\Users::class);
        return view('livewire.skill',  [
            'skills' => Skills::all(),
        ]);
    }

    public function AddSkill() {

        $this->validate([
            'name' => ['required', 'string', 'max:60'],
        ]);

        $new = explode(', ', $this->name);
        foreach ($new as $id) {
            Skills::firstorCreate([
                'name' => $id,
            ]);
        }
        $this->name = null;
        session()->flash('message', 'Skills have been added');
    }

    public function confirmDeleteSkill($id) {
        $this->confirm = $id;
    }

    public function DeleteSkill(Skills $id) {

        $ContractorSkills = Contractor_Skills::where('skills_id', $id->id);
        if($ContractorSkills != null) {
            $ContractorSkills->delete();
        }
 
        $id->delete();
        $this->confirm = false;
        session()->flash('message', 'Skills have been deleted'); 

    }
}
