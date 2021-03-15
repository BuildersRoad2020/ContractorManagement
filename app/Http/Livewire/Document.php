<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Documents;
use App\Models\Documents_Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;



class Document extends Component
{
    //use AuthorizesRequests;
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;
    public $documents__category_id;
    public $pdf;
    public $required;
    public $name;
    public $file_path;
    public $confirm = false;
    public $confirmEdit = false;
    public $confirmDelete = false;
    public $confirmView = false;
    public $q; //searchbox

    protected $queryString = [  //to show query in url
        'q'
    ];

    public function render()
    {
        $this->authorize('admin', App\Models\Users::class);
        $documents = Documents::with('Documents_Category')
        ->when($this->q, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'LIKE', '%' . $this->q . '%');
            });
        })
        ->paginate(10);

        return view('livewire.document', [
            'documents' => $documents,
            'categories' => Documents_Category::all()
        ]);
    }

    public function closeModal() {

        $this->reset('documents__category_id');
        $this->reset('required');
        $this->reset('name');
        $this->confirmEdit = false;
        $this->confirmDelete = false;
        $this->confirmView = false;
    }

    public function DocumentAdd() {
  
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:60'],
            'documents__category_id' => ['required'],
            'required' => ['required'],
            'file_path' => ['nullable', 'mimes:pdf', 'max:2000'],
        ]);
        $new = new Documents;

        if ($validatedData['file_path'] != null ) {
            $File = $validatedData['file_path'];
            $FileName = $validatedData['name'] . '_' . time() . '_' . '.' . $File->getClientOriginalExtension();
            Storage::disk("google")->putFileAs("", $validatedData['file_path'],  $FileName); //save the file to google drive
           
            $files = Storage::disk("google")->listContents(); //get the files uploaded in google drive
            usort($files, function ($a, $b) {
                return $a['timestamp'] <=> $b['timestamp'];
            });
            $FILEID = end($files);
            $new->file_path = $FILEID['basename'];
        }

        $new->name = $validatedData['name'];
        $new->documents__category_id = $validatedData['documents__category_id'];
        $new->required = $validatedData['required'];
        $new->save();

        $this->confirm = false;
        session()->flash('message', 'Document added');
    }
        //View Template
    public function confirmDocumentView(Documents $id)
    {
        $this->confirmView = true;
        $this->pdf = "https://drive.google.com/file/d/" . $id->file_path ."/preview?usp=drivesdk" ;
    }

        //Edit Document
    public function confirmDocumentEdit(Documents $id) {
        $this->documents__category_id = $id->documents__category_id;
        $this->required = $id->required;
        $this->name = $id->name;     
        $this->confirmEdit = $id;
    }

    public function DocumentEdit(Documents $id) {

        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:60'],
            'documents__category_id' => ['required'],
            'required' => ['nullable']
        ]);

        $validatedData = Documents::find($id->id);

        $validatedData->name = ucwords($this->name);
        $validatedData->documents__category_id = $this->documents__category_id;
        $validatedData->required = $this->required;
        $validatedData->save();
        $this->confirmEdit = false;
        $this->documents__category_id = null;
        $this->required = null;
        $this->name = null;          
        $this->resetPage();
        session()->flash('message', 'Document has been updated');

    }

        //Delete Document
    public function confirmDocumentDelete(Documents $id) {
        $this->documents__category_id = $id->documents__category_id;
        $this->required = $id->required;
        $this->name = $id->name;     
        $this->confirmDelete = $id;
    }

    public function DocumentDelete(Documents $id) {

        $deleteData = Documents::find($id->id);
        $deleteData->delete();
        $this->confirmDelete = false;
        $this->documents__category_id = null;
        $this->required = null;
        $this->name = null;    
        $this->resetPage();
        session()->flash('message', 'Document has been deleted');

    }
}
