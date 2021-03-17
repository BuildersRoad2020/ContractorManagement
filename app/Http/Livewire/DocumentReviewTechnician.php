<?php

namespace App\Http\Livewire;

use App\Models\TechnicianDocuments;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;

class DocumentReviewTechnician extends Component
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
        $documents = TechnicianDocuments::with('technicians')->with('Documents')->Orderby('documents_id','ASC')->Orderby('status', 'ASC')
        ->when($this->q, function ($query) {
            return $query->where(function ($query) {
                $query->orwherehas('technicians', function ($query) {
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
        
       
        return view('livewire.document-review-technician', [
            'documents' => $documents,
        ]);
    }

    public function view(TechnicianDocuments $id)
    {
        $this->view = $id;
        $this->checkfile = $id->file_path; 
        $this->src = "https://drive.google.com/file/d/" . $id->file_path ."/preview?usp=drivesdk" ;

    }

    public function updateDocument(TechnicianDocuments $id)
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

    public function DeleteContractor (TechnicianDocuments $id) 
    {
        $id->status = '6';
        $id->save();
        $this->archive = false;
        session()->flash('message', 'Document has been archived');
    }
}
