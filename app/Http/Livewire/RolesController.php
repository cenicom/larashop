<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolesController extends Component
{
    use WithPagination;

    public $roleName, $search, $selected_id, $pageTitle, $componentName;

    private $pagination = 5;

    public function paginationView()
    {
        // code...
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        // code...
        $this-> pageTitle = 'Listado';
        $this-> componentName = 'Roles';
    }

    public function render()
    {
        if(strlen($this->search) > 0){
            $roles = Role::where('name', 'like',
                '%' . $this->search . '%')
            ->paginate($this->pagination);
        }else{
            $roles = Role::orderBy('name', 'asc')
            ->paginate($this->pagination);
        }

        return view('livewire.roles.roles', [
            'roles' => $roles
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function createRole()
    {
        // code...
        $rules = ['roleName' => 'required|min:2|unique:roles,name'];

        $messages = [
            'roleName.required' => 'El Nombre del Rol es Requerido',
            'roleName.unique' => 'El Nombre del Rol, ya Existe',
            'roleName.min' => 'El Nombre del Rol Debe de Tener al Menos 2 Caracteres',
        ];

        $this->validate($rules, $messages);

        Role::create(['name' => $this->roleName]);

        $this->emit('role-added', 'Se Registro el Nuevo Rol Correctamente');
        $this->resetUI();
    }

    public function Edit(Role $role)
    {
        // code...
        $this->selected_id = $role->id;
        $this->roleName = $role->name;

        $this->emit('show-modal', 'show modal!');
    }

    public function UpdateRole()
    {
        // code...
        $rules = ['roleName' => 'required|min:2|unique:roles,name, {$this->selected_id}'];

        $messages = [
            'roleName.required' => 'El Nombre del Rol es Requerido',
            'roleName.unique' => 'El Nombre del Rol, ya Existe',
            'roleName.min' => 'El Nombre del Rol Debe de Tener al Menos 2 Caracteres',
        ];

        $this->validate($rules, $messages);

        $role = Role::find($this->selected_id);
        $role->name = $this->roleName;
        $role->save();

        $this->emit('role-updated', 'El Nombre del Rol se Actualizo Correctamente');
        $this->resetUI();
    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy($id)
    {
        // code...
        $permissionsCount = Role::find($id)->permissions->count();

        if($permissionsCount > 0){
            $this->emit('role-error',
            'No se Puede Eliminar el Rol Seleccionado Porque Ya Tiene Registros Seleccionados');

            return;
        }

        Role::find($id)->delete();

        $this->emit('role-deleted', 'Se Elimino el Registro Seleccionado Correctamente');
    }

    public function AsignarRoles($rolesList)
    {
        // code...
        if($this->userSelected > 0){
            $user = User::find($this->userSelected);

            if($user){
                $user->syncRoles($this->userSelected);
                $this->emit('msg-ok', 'Roles Asignados Correctamente');
                $this->resetInput();
            }
        }
    }

    public function resetUI()
    {
        // code...
        $this->roleName = '';
        $this->search = '';
        $this->selected_id = 0;
        $this->resetErrorBag();
    }
}
