<?php

namespace App\Exports;

use App\Models\Cities;
use App\Models\Contractors;
use App\Models\Countries;
use App\Models\States;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContractorsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array {

        return [
            'Contractor Name',
            'Status',
            'Address',
            'City',
            'State',
            'Zip',
            'Country',
            'ABN',
            'Primary Contact',
            'Phone',
            'Email',
            'Secondary Contact',
            'Phone',
            'Email',
            'Currency',
            'Bank Name',
            'Branch',
            'Account Name',
            'BSB',
            'Account Number',
            'Payment Terms',
            'Number of Technicians',
            'Contractor Skills',
    
 
        ];
    }

    public function map($contractors): array
    {
        return [
            $contractors->name,
            $contractors->status == 0 ? 'onHold' : 'Approved',
            $contractors->ContractorDetails->address,
            Cities::where('id', $contractors->ContractorDetails->city)->pluck('name')->first(),
            States::where('id', $contractors->ContractorDetails->state)->pluck('name')->first(),
            $contractors->ContractorDetails->postcode,
            Countries::where('id', $contractors->ContractorDetails->country)->pluck('name')->first(),
            $contractors->ContractorDetails->ABN,
            $contractors->ContractorDetails->name_primarycontact,
            $contractors->ContractorDetails->phone_primary,
            $contractors->ContractorDetails->email_primary,
            $contractors->ContractorDetails->name_secondarycontact,
            $contractors->ContractorDetails->phone_secondary,
            $contractors->ContractorDetails->email_secondary,
            $contractors->ContractorDetails->currency,
            $contractors->ContractorDetails->bankname,
            $contractors->ContractorDetails->branch,
            $contractors->ContractorDetails->accountname,
            $contractors->ContractorDetails->bsb,
            $contractors->ContractorDetails->accountnumber,
            $contractors->ContractorDetails->terms,
            $contractors->technicians_count,
            $contractors->ContractorSkills->pluck('name')->toarray(),
        ];
    }

    public function collection()
    {
        $contractors = Contractors::with('ContractorDetails')->with('ContractorSkills')->withCount('Technicians')->get();

       // dd($contractors);
        return $contractors;
    }
}
