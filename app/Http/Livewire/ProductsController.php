<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ProductsController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name, $barcode, $cost, $price, $stock,
            $alert, $image, $category_id, $search,
            $selected_id, $componentName, $pageTitle;

    private $pagination = 5;

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Productos';
        $this->category_id = 'Seleccionar Categoria';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
            $products = Product::join('categories as c', 'c.id', 'products.category_id')
            ->select('products.*', 'c.name as category')
            ->where('products.name', 'like', '%' . $this->search . '%')
            ->orWhere('products.barcode', 'like', '%' . $this->search . '%')
            ->orWhere('c.name', 'like', '%' . $this->search . '%')
            ->orderBy('products.name', 'asc')
            ->paginate($this->pagination);
        else
            $products = Product::join('categories as c', 'c.id', 'products.category_id')
            ->select('products.*', 'c.name as category')
            ->orderBy('products.name', 'asc')
            ->paginate($this->pagination);

        return view('livewire.products.products', [
            'data' => $products,
            'categories' => Category::orderBy('name', 'asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store(){
        $rules = [
            'name' => 'required|unique:products|min:3',
            'barcode' => 'required|unique:products|min:12',
            'cost' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'alert' => 'required',
            'category_id' => 'required|not_in:Elegir'
        ];

        $messages = [
            'name.required' => 'El Nombre del Producto es Obligatorio',
            'name.unique' => 'El Nombre del Pruducto ya Existe, Campo Duplicado',
            'name.min' => 'El Nombre del Producto Debe de Tener al Menos 3 Caracteres',

            'barcode.required' => 'El Código de Barras del Producto es Obligatorio',
            'barcode.unique' => 'El Código de Barras del Producto ya Existe, Campo Duplicado',
            'barcode.min' => 'El Nombre del Producto Debe de Tener al Menos 12 Caracteres',

            'cost.required' => 'El Costo de Compra del Producto es Obligatorio',

            'price.required' => 'El Precio de Venta del Producto es Obligatorio',

            'stock.required' => 'El Stock para el Producto es Obligatorio',

            'alert.required' => 'El Invetario (stock) Mínimo para el Producto es Obligatorio',

            'category_id.not_in' => 'Debe de Elegir una Categoria para el Producto',
        ];

        $this->validate($rules, $messages);

        $product = Product::create([
            'name' => $this->name,
            'barcode' => $this->barcode,
            'cost' => $this->cost,
            'price' => $this->price,
            'stock' => $this->stock,
            'alert' => $this->alert,
            'image' => $this->image,
            'category_id' => $this->category_id

        ]);

        if ($this->image) {
            // code...
            $customFileName = uniqid() . '_.' . $this->image->extension();

            $this->image->storeAs('public/products', $customFileName);
            $product->image = $customFileName;
            $product->save();
        }

        $this->resetUI();

        $this->emit('product-added', 'Producto Registrado Correctamente');
    }

    public function Edit(Product $product){
        $this->selected_id = $product->id;
        $this->name = $product->name;
        $this->barcode = $product->barcode;
        $this->cost = $product->cost;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->alert = $product->alert;
        $this->category_id = $product->category_id;
        $this->image = null;

        $this->emit('modal-show', 'show modal!');
    }

    public function Update(){
        $rules = [
            'name' => "required|min:3|unique:products,name,{$this->selected_id}",
            'barcode' => "required|min:12|unique:products,barcode,{$this->selected_id}",
            'cost' => "required",
            'price' => "required",
            'stock' => "required",
            'alert' => "required",
            'category_id' => "required|not_in:Elegir"
        ];

        $messages = [
            'name.required' => 'El Nombre del Producto es Obligatorio',
            'name.unique' => 'El Nombre del Pruducto ya Existe, Campo Duplicado',
            'name.min' => 'El Nombre del Producto Debe de Tener al Menos 3 Caracteres',

            'barcode.required' => 'El Código de Barras del Producto es Obligatorio',
            'barcode.unique' => 'El Código de Barras del Producto ya Existe, Campo Duplicado',
            'barcode.min' => 'El Nombre del Producto Debe de Tener al Menos 12 Caracteres',

            'cost.required' => 'El Costo de Compra del Producto es Obligatorio',

            'price.required' => 'El Precio de Venta del Producto es Obligatorio',

            'stock.required' => 'El Stock para el Producto es Obligatorio',

            'alert.required' => 'El Invetario (stock) Mínimo para el Producto es Obligatorio',

            'category_id.no_in' => 'Debe de Elegir una Categoria para el Producto',
        ];

        $this->validate($rules, $messages);

        $product = Product::find($this->selected_id);

        $product ->update([
            'name' => $this->name,
            'barcode' => $this->barcode,
            'cost' => $this->cost,
            'price' => $this->price,
            'stock' => $this->stock,
            'alert' => $this->alert,
            'image' => $this->image,
            'category_id' => $this->category_id

        ]);

        if ($this->image) {
            // code...
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/products', $customFileName);
            $imageName = $product->image;

            $product->image = $customFileName;

            $product->save();

            if ($imageName != null) {
                // code...
                if (file_exists('storage/products' . $imageName)) {
                    // code...
                    unlink('storage/products' . $imageName);
                }
            }
        }

        $this->resetUI();

        $this->emit('product-updated', 'Producto Actualizado Correctamente');
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Product $product){
        //$category = Category::find($id);
        $imageName = $product->image;

        $product->delete();

        if ($imageName != null) {
            // code...
            unlink('storage/products/' . $imageName);
        }

        $this->resetUI();

        $this->emit('product-deleted', 'Producto Eliminado Correctamente');
    }

     public function resetUI()
    {
        // code...
        $this->name = '';
        $this->barcode = '';
        $this->cost = '';
        $this->price = '';
        $this->stock = '';
        $this->alert = '';
        $this->search = '';
        $this->category_id = 'Elegir';
        $this->image = null;
        $this->selected_id = 0;
    }
}
