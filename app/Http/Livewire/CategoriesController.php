<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Unique;

class CategoriesController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name;
    public $image;
    public $search;
    public $selected_id;
    public $pageTitle;
    public $componentName;

    private $pagination = 5;

    public function mount(){
        $this->pageTitle = 'Listado';

        $this->componentName = 'Categorias';
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0){
            $data = Category::where('name','like','%'. $this->search . '%')
            ->paginate($this->pagination);
        }else{
                $data = Category::orderBy('id', 'desc')
            ->paginate($this->pagination);
        }

        return view('livewire.categories.category',[
                'categories' => $data
            ])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function Edit($id){
        $record = Category::find($id, ['id','name','image']);
        $this->name = $record->name;
        $this->selected_id = $record->id;
        $this->image = null;

        $this->emit('show-modal', 'show modal!');
    }

    public function Store(){
        $rules = [
            'name' => 'required|unique:categories|min:3',
            'image' => 'required',
        ];

        $messages = [
            'name.required' => 'Nombre de la Categoria es Obligatorio',
            'name.unique' => 'Ya Existe el Nombre de la Categoria, Campo Duplicado',
            'name.min' => 'El Nombre de la Categoria Debe de Tener Mínimo 3 Caracteres',

            'image.required' => 'La Imagen de la Categoria es Obligatoria',

        ];

        $this->validate($rules, $messages);

        $category = Category::create([
            'name' => $this->name,
            'image' => $this->image,
        ]);

        //$customFileName;

        if ($this->image) {
            // code...
            $customFileName = uniqid() . '_.' . $this->image->extension();

            $this->image->storeAs('public/categories', $customFileName);

            $category->image = $customFileName;

            $category->save();
        }

        $this->resetUI();

        $this->emit('category-added', 'Categoria Registrada Correctamente');
    }

    public function Update()
    {
        // code...
        $rules = [
            'name' => "required|min:3|unique:categories,name,{$this->selected_id}",
        ];

        $messages = [
            'name.required' => 'Nombre de la Categoria es Obligatorio',
            'name.unique' => 'Ya Existe el Nombre de la Categoria, Campo Duplicado',
            'name.min' => 'El Nombre de la Categoria Debe de Tener Mínimo 3 Caracteres',

        ];

        $this->validate($rules, $messages);

        $category = Category::find($this->selected_id);

        $category->update([
            'name' => $this->name,
            'image' => $this->image,
        ]);

        if ($this->image) {
            // code...
            $customFileName = uniqid() . '_.' . $this->image->extension();

            $this->image->storeAs('public/categories', $customFileName);

            $imageName = $category->image;

            $category->image = $customFileName;

            $category->save();

            if ($imageName != null) {
                // code...
                if (file_exists('storage/categories' . $imageName)) {
                    // code...
                    unlink('storage/categories' . $imageName);
                }
            }
        }

        $this->resetUI();

        $this->emit('category-updated', 'Categoria Actualizada Correctamente');

    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Category $category){
        //$category = Category::find($id);
        $imageName = $category->image;

        $category->delete();

        if ($imageName != null) {
            // code...
            unlink('storage/categories/' . $imageName);
        }

        $this->resetUI();

        $this->emit('category-deleted', 'Categoria Eliminada Correctamente');
    }

    public function resetUI(){
        $this->name = '';
        $this->image = null;
        $this->search = '';
        $this->selected_id = 0;
    }
}
