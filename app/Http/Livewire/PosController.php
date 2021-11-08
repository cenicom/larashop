<?php

namespace App\Http\Livewire;

use Exception;
use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use App\Models\SaleDetail;
use App\Models\Denomination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class PosController extends Component
{
    public $total, $itemsQuantity, $efectivo, $change;

    public function mount(){
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
    }

    public function render()
    {
        return view('livewire.pos.pos',[
            'denominations' => Denomination::orderBy('value','desc')->get(),
            'cart' => Cart::getContent()->sortBy('name')
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Acash($value){
        $this->efectivo += ($value == 0 ? $this->total : $value);

        $this->change = ($this->efectivo = $this->total);
    }

    protected $listeners = [
        'scan-code' => 'ScanCode',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'saveSale' => 'saveSale',
    ];

    public function ScanCode($barcode, $cont = 1)
    {
        // code...
        $product = Product::where('barcode', $barcode)->first();

        if($product == null || empty($empty)){
            $this->emit('scan-notfound', 'El Producto No Está Registrado');
        }
        else
        {
            if($this->InCart($product->id)){
                $this->increaseQty($product->id);
                return;
            }

            if($product->stock < 1){
                $this->emit('no-stock', 'Stock Insuficiente :/');
                return;
            }

            Cart::add(
                $product->id,
                $product->name,
                $product->price,
                $cant,
                $product->image
            );

            $this->total = Cart::getTotal();

            $this->emit('scan-ok', 'Producto Agregado en el Carrito de Compras');
        }

    }

    public function InCart($productId)
    {
        // code...
        $exist = Cart::get($productId);

        if($exist){
            return true;
        }else{
            return false;
        }
    }

    public function increaseQty($productId, $cant = 1)
    {
        // code...
        $title = '';
        $product = Product::find($productId);
        $exist = Cart::get($productId);

        if($exist){
            $title = 'Cantidad Actualizada';
        }else{
            $title = 'Producto Agregado Correctamente';
        }

        if ($exist) {
            // code...
            if ($product->stock < ($cant + $exist->quantity)) {
                // code...
                $this->emit('no-stock', 'Cantidad en Stock Insuficiente :/');
                return;
            }
        }

        Cart::add(
            $product->id,
            $product->name,
            $product->price,
            $cant,
            $product->image
        );

        $this->total = Cart::getTotal();

        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', $title);
    }

    public function updateQty($productId, $cant = 1)
    {
        // code...
        $title = '';
        $product = Product::find($productId);
        $exist = Cart::get($productId);

        if($exist){
            $title = 'Cantidad Actualizada';
        }else{
            $title = 'Producto Agregado Correctamente';
        }

        if ($exist) {
            // code...
            if ($product->stock < $cant) {
                // code...
                $this->emit('no-stock', 'Cantidad en Stock Insuficiente :/');
                return;
            }
        }

        $this->removeItem($productId);

        if ($cant > 0) {
            // code...
            Cart::add(
                $product->id,
                $product->name,
                $product->price,
                $cant,
                $product->image
            );

            $this->total = Cart::getTotal();

            $this->itemsQuantity = Cart::getTotalQuantity();

            $this->emit('scan-ok', $title);
        }
    }

    public function removeItem($productId)
    {
        // code...
        Cart::remove($productId);

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Producto Eliminado del Carrito de Compras');
    }

    public function decreaseQty($productId)
    {
        // code...
        $item = Cart::get($productId);

        Cart::remove($productId);

        $newQty = ($item->quantity) - 1;

        if ($newQty > 0) {
            // code...
            Cart::add(
                $item->id,
                $item->name,
                $item->price,
                $newQty,
                $itemsQuantity->attributes[0]
            );
        }

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Cantidad Actualizda en el Carrito de Compras');
    }

    public function clearCart()
    {
        // code...
        Cart::clear();
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'Carrito de Compras Vacio');
    }

    public function saveSale()
    {
        // code...
        if ($this->total <= 0) {
            // code...
            $this->emit('sale-error', 'Agregar Productos al Carrito');
            return;
        }

        if ($this->efectivo <= 0) {
            // code...
            $this->emit('sale-error', 'Agregar el Efectivo');
            return;
        }

        if ($this->total > $this->efectivo) {
            // code...
            $this->emit('sale-error', 'El Efectivo Debe Ser Mayor o Igual al Total de la Compra');
            return;
        }

        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'total' => $this->total,
                'item' => $this->itemsQuantity,
                'cash' => $this->efectivo,
                'change' => $this->change,
                'user_id' => Auth()->user()->id,
            ]);

            if ($sale) {
                // code...
                $items = Cart::getContent();
                foreach ($items as $item){
                    SaleDetail::create([
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'product_id' => $item->id,
                        'sale_id' => $sale->id,
                    ]);

                    //update Stock...
                    $product = Product::find($item->id);
                    $product->stock = $product->stock - $item->quantity;
                }
            }

            DB::commit();

            Cart::clear();
            $this->efectivo = 0;
            $this->change = 0;
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('sale-ok', 'Venta Registrada con Éxito');
            $this->emit('print-ticket', $sale->id);

        } catch (Exception $e) {
            DB::rollback();
            $this->emit('sale-error', $e->getMessage());
        }
    }

    public function printTicket($sale)
    {
        // code...
        return Redirect::to("print://$sale->id");
    }
}
