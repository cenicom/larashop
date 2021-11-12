<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class CashoutController extends Component
{
    public $fromDate;
    public $toDate;
    public $userid;
    public $total, $items, $sales, $details;

    public function mount()
    {
        # code...
        $this->fromDate = null;
        $this->toDate = null;
        $this->userid = 0;
        $this->total = 0;
        $this->items = 0;
        $this->sales = [];
        $this->details = [];
    }

    public function render()
    {
        return view('livewire.cashout.cashout',[
            'users' => User::orderBy('name', 'asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Consultar()
    {
        # code...
        $fi = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';

        $ff = Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59';

        $this->sales = Sale::whereBetween('created_at', [$fi,$ff])
         ->where('status', 'Paid')
         ->where('user_id', $this->userid)
        ->get();

        $this->total = $this->sales ? $this->sales->sum('total') : 0;

        $this->items = $this->sales ? $this->sales->sum('items') : 0;
    }

    public function viewDetails(Sale $sale)
    {
        # code...
        $fi = Carbon::parse($this->fromDate)->format('Y-m-d') . ' 00:00:00';

        $ff = Carbon::parse($this->toDate)->format('Y-m-d') . ' 23:59:59';

        $this->details = Sale::join('sale_details as sd','sd.sale_id','sales_id')
        ->join('products as pd', 'pd.id', 'pd.product_id')
        ->select('sd.sale_id', 'pd.name as product', 'pd.quantity', 'pd.price')
        ->whereBetween('sales.created_at', [$fi, $ff])
        ->where('sales.status', 'Paid')
        ->where('sales.user_id', $this->userid)
        ->where('sales.id', $sale->id)
        ->get();

        $this->emit('show-modal','Open Modal');
    }

    public function Print()
    {
        # code...
    }
}
