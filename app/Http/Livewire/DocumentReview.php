<?php

namespace App\Http\Livewire;


use App\Models\ContractorDocuments;
use Carbon\Carbon;


use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DocumentReview extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $q; //searchbox
    public $status;

    public $archive = false;
    public $view = false;
    public $src;
    public $updatestatus;
    public $checkfile;
    public $days;

    protected $queryString = [  //to show query in url
        'q',
        'status'
    ];

    public function render()
    {
        $this->authorize('admin', App\Models\Users::class);
        $documents = ContractorDocuments::with('Contractors')->with('Documents')->Orderby('documents_id','ASC')->Orderby('status', 'ASC')
        ->when($this->q, function ($query) {
            return $query->where(function ($query) {
                $query->orwherehas('contractors', function ($query) {
                        $query->where('name', 'LIKE', '%' . $this->q . '%');
                    })
                    ->orwherehas('documents', function ($query) {
                        $query->where('name', 'LIKE', '%' . $this->q . '%');
                    });
            });
        }) 
        ->when($this->status, function ($query) {
            return $query->where('status', $this->status);
        })
        ->paginate('15');
        
       
        return view('livewire.document-review', [
            'documents' => $documents,
        ]);
    }

    public function view(ContractorDocuments $id)
    {
        $this->view = $id;
        $this->checkfile = $id->file_path; 
        $this->src = "https://drive.google.com/file/d/" . $id->file_path ."/preview?usp=drivesdk" ;

    }

    public function updateDocument(ContractorDocuments $id)
    {
        $validatedData = $this->validate([ 'updatestatus' => 'required', 'days' => 'nullable',]);
        $id->status = $this->updatestatus;
        if ($this->days != null) {
       
            $id->expiration = Carbon::now()->addYears($this->days);
        }
        
        $id->save();
        $this->view = false;
        session()->flash('message', 'Document status updated');    
    }

    public function closeModal() 
    {
        $this->archive = false;
        $this->view = false;
    }

    public function archiveDocument($id)
    {
        $this->archive = $id; 
    }

    public function DeleteContractor (ContractorDocuments $id) 
    {
        $id->status = '6';
        $id->save();
        $this->archive = false;
        session()->flash('message', 'Document has been archived');
    }
}
