<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class ReportsController extends Component
{
    public $componentName, $data, $details, $sumDetails, $countDetails,
           $reportType, $userId, $dateFrom, $dateTo, $saleId, $total;

    public function mount()
    {
        # code...
        $this->componentName = 'Reportes de Ventas';
        $this->data = [];
        $this->details = [];
        $this->sumDetails = 0;
        $this->countDetails = 0;
        $this->reportType = 0;
        $this->userId = 0;
        $this->saleId = 0;
    }

    public function render()
    {
        $this->SalesByDate();

        return view('livewire.reports.reports',[
            'users' => User::orderBy('name', 'asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function salesByDate()
    {
        # code...
        if($this->reportType == 0){
            $from = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 00:00:00';

            $to = Carbon::parse(Carbon::now())->format('Y-m-d') . ' 23:59:59';
        }else{
            $from = Carbon::parse($this->dateFrom)->format('Y-m-d') . ' 00:00:00';

            $to = Carbon::parse($this->dateTo)->format('Y-m-d') . ' 23:59:59';
        }

        if($this->reportType == 1 && ($this->dateFrom == ' ' || $this->dateTo == '')){
            return;
        }

        if($this->userId == 0){
            $this->data = Sale::join('users as us','us.id','sales.user_id')
            ->select('sales.*','us.name as user')
            ->whereBetween('sales.created_at',[$from,$to])
            ->get();
        }else{
            $this->data = Sale::join('users as us','us.id','sales.user_id')
            ->select('sales.*','us.name as user')
            ->whereBetween('sales.created_at',[$from,$to])
            ->where('user_id',$this->userId)
            ->get();
        }
    }

    public function getDetails($saleId)
    {
        # code...
        $this->details = SaleDetail::join('products as pr','pr.id','sale_details.product.id')
        ->select('sale_details.id','sale_details.price','sale_details.quantity','pr.name as product')
        ->where('sale_details_id',$saleId)
        ->get();

        $suma = $this->details->sum(function($item){
            return $item->price * $item->quantity;
        });

        $this->sumDetails = $suma;

        $this->countDetails = $this->details->sum('quantity');

        $this->saleId = $saleId;

        $this->emit('show-modal', 'details loaded');

    }
}
