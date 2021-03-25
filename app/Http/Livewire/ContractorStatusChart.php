<?php

namespace App\Http\Livewire;

use App\Models\Contractors;
use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class ContractorStatusChart extends Component
{

    public $types = ['0', '1',];

    public $colors = [
        '0' => '#004c6d',
        '1' => '#fc8181',
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
    //    dd($point);
    }

    public function handleOnSliceClick($slice)
    {
     //   dd($slice);
    }

    public function handleOnColumnClick($column)
    {
      //  dd($column);
    }


    public function render()
    {
        $contractorstatus = Contractors::whereIn('status', $this->types)->get();


        $columnChartModel = $contractorstatus->groupBy('status')
            ->reduce(
                function ($columnChartModel, $data) {
                    $type = $data->first()->status;
                    if ($type == 1) {
                        $title = 'Approved';
                    }
                    if ($type == 0) {
                        $title = 'onHold';
                    }

                    $value = $data->count('name');

                    return $columnChartModel->addColumn($title, $value, $this->colors[$type]);
                },
                LivewireCharts::columnChartModel()
                    ->setTitle('Contractor Status')
                    ->setAnimated($this->firstRun)
                    ->withOnColumnClickEventName('onColumnClick')
                    ->setLegendVisibility(false)
                    ->setDataLabelsEnabled($this->showDataLabels)
                    //->setOpacity(0.25)
                    ->setColors(['#346888', '#d41b2c', '#ec3c3b', '#f66665'])
                    ->setColumnWidth(90)
                    ->withGrid()
            );

        $pieChartModel =  $contractorstatus->groupBy('status')
            ->reduce(
                function ($columnChartModel, $data) {
                    $type = $data->first()->status;
                    if ($type == 1) {
                        $title = 'Approved';
                    }
                    if ($type == 0) {
                        $title = 'onHold';
                    }

                    $value = $data->count('name');

                    return $columnChartModel->addSlice($title, $value, $this->colors[$type]);
                },
                LivewireCharts::pieChartModel()
                    ->setTitle('Contractor Status')
                    ->setAnimated($this->firstRun)
                    ->withOnSliceClickEvent('onSliceClick')
                    //->withoutLegend()
                    ->legendPositionBottom()
                    ->legendHorizontallyAlignedCenter()
                    ->setDataLabelsEnabled($this->showDataLabels)
                    ->setColors(['#346888', '#d41b2c', '#ec3c3b', '#f66665'])
            );



        $this->firstRun = false;
        //dd($columnChartModel);
        return view('livewire.contractor-status-chart')
            ->with([
                'columnChartModel' => $columnChartModel,
                'pieChartModel' => $pieChartModel,
            ]);
    }
}
