<?php

namespace App\Http\Livewire;

use App\Models\ContractorDocuments;
use App\Models\Documents;
use Livewire\Component;
use App\Models\Documents_Category;
use App\Models\TechnicianDocuments;

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

    public function AddDocument()
    {


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

    public function confirmDeleteDocument($id)
    {
        $this->confirm = $id;
    }

    public function DeleteDocument($id)
    {
       // dd($this->confirm);
        $status = Documents::where('documents__category_id', $this->confirm)->pluck('id')->toarray();
      //  dd($status);
       // dd($status);
       foreach ($status as $id => $key) {
        ContractorDocuments::where('documents_id', $key)->update(['status' => '6']);
        }
       foreach ($status as $id => $key) {
        TechnicianDocuments::where('documents_id', $key)->update(['status' => '6']);
         } 

        foreach ($status as $id => $key) {
        Documents::where('id', $key)->update(['status' => '6']);
        }

        Documents_Category::where('id', $this->confirm)->update(['status' => '6']);
        $this->confirm = false;
        session()->flash('message', 'Documents have been deleted');
        //dd($contractor);
    }
}
