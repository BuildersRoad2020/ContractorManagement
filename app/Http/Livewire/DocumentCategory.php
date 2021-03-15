<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Documents_Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DocumentCategory extends Component
{

    use AuthorizesRequests;

    public $confirm = false;
    public $name;

    public function render()
    {
        $this->authorize('admin', App\Models\Users::class);
        return view('livewire.document-category', [
            'documents_category' => Documents_Category::all(),
        ]);
    }

    public function AddDocument() {

    
        $this->validate([
            'name' => ['required', 'string', 'max:60'],
        ]);

        $new = explode(', ', $this->name);
        foreach ($new as $id) {
            Documents_Category::firstorCreate([
                'name' => $id,
            ]);
        }
        $this->name = null;
        session()->flash('message', 'Categories have been added');
    }

    public function confirmDeleteDocument($id) {
        $this->confirm = $id;
    }

    public function DeleteDocument(Documents_Category $id) {

        $id->Documents()->delete();
        $id->delete();
        $this->confirm = false;
        session()->flash('message', 'Documents have been deleted'); 
        //dd($contractor);
    }

}
