<?php

namespace App\Http\Livewire;

use App\Models\ContractorRates;
use App\Models\States;


use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;


class ContractorRatesChart extends Component
{

/*     public $types =  ['0', '1',];   */

    public $colors = [
        '1' => '#488f31',
        '2' => '#6e973b',
        '3' => '#8c9e4a',
        '4' => '#a6a65c',
        '5' => '#bcae71',
        '6' => '#cfb888',
        '7' => '#ddc2a0',
        '8' => '#dcb089',
        '9' => '#db9d74',
        '10' => '#da8964',
        '11' => '#d97359',
        '12' => '#d85a53',
        '13' => '#de425b',
        '14' => '#488f31',
        '15' => '#6a9832',
        '16' => '#89a036',
        '17' => '#a6a73e',
        '18' => '#c1ae4a',
        '19' => '#dcb559',
        '20' => '#f5bc6b',
        '21' => '#f5aa60',
        '22' => '#f39659',
        '23' => '#f18255',
        '24' => '#ec6e55',
        '25' => '#e65857',
        '26' => '#de425b',
        '27' => '#6d9738',
        '28' => '#8c9e44',
        '29' => '#a7a654',
        '30' => '#bfae67',
        '31' => '#d4b77c',
        '32' => '#e5c092',
        '33' => '#e5af7f',
        '34' => '#e59c6f',
        '35' => '#e58963',
        '36' => '#e4745c',
        '37' => '#e25c5a',
        '38' => '#fc8181',
    ]; 

    public $firstRun = true;

    public $showDataLabels = false;

    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
    ];

    public function handleOnPointClick($point)
    {
      //  dd($point);
    }

    public function handleOnSliceClick($slice)
    {
     //  dd($slice);
    }

    public function handleOnColumnClick($column)
    {
     //   dd($column);
    }

    public function render()
    {
        $states = States::select('name', 'id')->get();

        $types = [];
        $colors = [];

        foreach($states as $key => $value) {
            $types = $value->pluck('id')->toarray();
        }
        foreach($types as $key => $value) {
            $colors[$value] = 'cbd5e0' ;
        }
      //  dd($colors);


        $contractorstatus = ContractorRates::whereIn('state', $types)->get();

        $columnChartModel = $contractorstatus->groupBy('state')
            ->reduce(
                function ($columnChartModel, $data) {
                    $type = $data->first()->state;
                    $title = States::where('id', $type)->pluck('name')->first();
                  //  dd($title);
                    $value = $data->unique('contractors_id')->count('contractors_id');

                    return $columnChartModel->addColumn($title, $value, $this->colors[$type]);
                },
                LivewireCharts::columnChartModel()
                    ->setTitle('Contractors per State')
                    ->setAnimated($this->firstRun)
                    ->withOnColumnClickEventName('onColumnClick')
                    ->setLegendVisibility(false)
                    ->setDataLabelsEnabled($this->showDataLabels)
                    //->setOpacity(0.25)
                    ->setColors(['#f66665', '#83af70', '#bad0af', '#f1f1f1', '#f0b8b8', '#ccd7c6', '#b3c9a8', '#f0b8b8', '#ccd7c6', '#e8b1b1', '#bad0af', '#e27b7f', '#ccd7c6' ,'#e67f83', '#f66665', '#83af70', '#bad0af', '#f1f1f1', '#f0b8b8', '#ccd7c6', '#e8b1b1', '#bad0af', '#e27b7f', '#ccd7c6' ,'#e67f83', '#f0b8b8', '#ccd7c6', '#b3c9a8', '#e67f83', '#f66665', '#83af70', '#bad0af', '#f1f1f1',])
                    ->setColumnWidth(90)
                    ->withGrid()
            );

        $this->firstRun = false;

        return view('livewire.contractor-rates-chart')
            ->with([
                'columnChartModel' => $columnChartModel
            ]);
    }
}
