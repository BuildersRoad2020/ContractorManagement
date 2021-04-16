<?php

namespace App\Http\Livewire;

use App\Models\Documents;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Forms extends Component
{
    use WithPagination;



    public function render()
    {

        $users = Auth::user()->roleuser()->pluck('roles_id')->toarray();
           
        foreach ($users as $key => $id) {
            if ($id == 1) {
                $documents = Documents::with('Documents_Category')->paginate(10);
                break;
            }
            if ($id == 2) {
                $documents = Documents::with('Documents_Category')->paginate(10);
                break;
            }
            if ($id == 3) {
                $documents = Documents::with('Documents_Category')

                    ->when('individual', function ($query) {
                        return $query->where(function ($query) {
                            $query->orwherehas('Documents_Category', function ($query) {
                                $query->where('name', 'LIKE', '%' . 'individual'. '%');
                            });
                        });
                    })->paginate(10);
                break;
            }

          //  
        }
     //  dd($documents);
            return view('livewire.forms', [
                'documents' => $documents
            ]);
    }
}
