<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $permissionName, $search, $selected_id, $pageTitle, $componentName;

    private $pagination = 5;


    public function mount(){
        $this->pageTitle = 'Listado';

        $this->componentName = 'Permisos';
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0){
            $permisos = Permission::where('name', 'like',
                '%' . $this->search . '%')
            ->paginate($this->pagination);
        }else{
            $permisos = Permission::orderBy('name', 'asc')
            ->paginate($this->pagination);
        }

        return view('livewire.permisions.permisos', [
            'permisos' => $permisos
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function createPermission()
    {
        // code...
        $rules = ['permissionName' => 'required|min:2|unique:permissions,name'];

        $messages = [
            'permissionName.required' => 'El Nombre del Permiso es Requerido',
            'permissionName.unique' => 'El Nombre del Permiso, ya Existe',
            'permissionName.min' => 'El Nombre del Permiso Debe de Tener al Menos 2 Caracteres',
        ];

        $this->validate($rules, $messages);

        Permission::create(['name' => $this->permissionName]);

        $this->emit('permiso-added', 'Se Registro el Nuevo Permiso
            Correctamente');

        $this->resetUI();
    }

    public function Edit(Permission $permiso)
    {
        // code...
        $this->selected_id = $permiso->id;

        $this->permissionName = $permiso->name;

        $this->emit('show-modal', 'show modal!');
    }

    public function updatePermission()
    {
        // code...
        $rules = ['permissionName' => 'required|min:2|unique:permissions,name, {$this->selected_id}'];

        $messages = [
            'permissionName.required' => 'El Nombre del Permiso es Requerido',
            'permissionName.unique' => 'El Nombre del Permiso, ya Existe',
            'permissionName.min' => 'El Nombre del Permiso Debe de Tener al Menos 2 Caracteres',
        ];

        $this->validate($rules, $messages);

        $permiso = Permission::find($this->selected_id);
        $permiso->name = $this->permissionName;
        $permiso->save();

        $this->emit('permiso-updated', 'El Nombre del Permiso se Actualizo Correctamente');

        $this->resetUI();
    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy($id)
    {
        // code...
        $rolesCount = Permission::find($id)->getRoleNames()->count();

        if($rolesCount > 0){
            $this->emit('permiso-error',
            'No se Puede Eliminar el Permiso seleccionado Porque Ya Tiene Registros Seleccionados');
            return;
        }

        Permission::find($id)->delete();

        $this->emit('permiso-deleted', 'Se Elimino el Registro Seleccionado Correctamente');
    }

    public function resetUI()
    {
        // code...
        $this->permissionName = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetErrorBag();
    }
}
