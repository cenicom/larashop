<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Denomination;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class CoinsController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $type, $value, $image, $search,
           $selected_id, $componentName, $pageTitle;

    private $pagination = 5;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Denominaciones';
        $this->type = 'Elegir';
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
        {
            $data = Denomination::where(
                'type', 'like' , '%' . $this->search . '%')
                ->paginate($this->pagination);
        }
        else{
            $data = Denomination::orderBy('id', 'desc')
            ->paginate($this->pagination);
        }

        return view('livewire.denominations.coins', [
            'denominations' => $data
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Edit($id){
        $record = Denomination::find($id, [
            'id','type','value','image'
        ]);
        $this->type = $record->type;
        $this->value = $record->value;
        $this->selected_id = $record->id;
        $this->image = null;

        $this->emit('show-modal', 'show modal!');
    }


    public function Store(){
        $rules = [
            'type' => 'required|not_in:Elegir',
            'value' => 'required|unique:denominations',
            'image' => 'required',
        ];

        $messages = [
            'type.required' => 'El Tipo de Denonimación es Obligatorio',
            'type.not_in' => 'Elige un Valor para el Tipo de Denominación',

            'value.required' => 'El Valor de la Denominación es Obligatorio',
            'value.unique' => 'El Valor de la Denominación es ya Existe, Campo Duplicado',

            'image.required' => 'La Imagen del Tipo de Denonimación es Obligatoria',

        ];

        $this->validate($rules, $messages);

        $denomination = Denomination::create([
            'type' => $this->type,
            'value' => $this->value,
            'image' => $this->image,
        ]);

        if ($this->image) {
            // code...
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/denominations', $customFileName);
            $denomination->image = $customFileName;
            $denomination->save();
        }

        $this->resetUI();
        $this->emit('denomination-added', 'Denominación Registrada Correctamente');
    }

    public function Update()
    {
        // code...
        $rules = [
            'type' => 'required|not_in:Elegir',
            'vale' => "required|unique:denomination,value,{$this->selected_id}",
        ];

        $messages = [
            'type.required' => 'El Tipo de Denominación es Obligatorio',
            'type.not_in' => 'Elige un Valor para el Tipo de Denominación',

            'value.required' => 'El Valor de la Denominación es Obligatorio',
            'value.unique' => 'El Valor de la Denominación es ya Existe, Campo Duplicado',

        ];

        $this->validate($rules, $messages);

        $denomination = Denomination::find($this->selected_id);

        $denomination->update([
            'type' => $this->type,
            'value' => $this->value,
            'image' => $this->image,
        ]);

        if ($this->image) {
            // code...
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/denominations', $customFileName);
            $imageName = $denomination->image;

            $denomination->image = $customFileName;
            $denomination->save();

            if ($imageName != null) {
                // code...
                if (file_exists('storage/denominatios' . $imageName)) {
                    // code...
                    unlink('storage/denominatios' . $imageName);
                }
            }
        }

        $this->resetUI();

        $this->emit('denomination-updated', 'Denominación Actualizada Correctamente');

    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy(Denomination $denomination){
        //$category = Category::find($id);
        $imageName = $denomination->image;
        $denomination->delete();

        if ($imageName != null) {
            // code...
            unlink('storage/denominatios/' . $imageName);
        }

        $this->resetUI();

        $this->emit('denomination-deleted', 'Denominación Eliminada Correctamente');
    }

    public function resetUI(){
        $this->type = '';
        $this->value = '';
        $this->image = null;
        $this->search = '';
        $this->selected_id = 0;
    }
}
