<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AsignarController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $role, $componentName, $permisosSelected = [], $old_permission = [];

    private $pagination = 5;

    public function mount(){
        $this->role = 'Elegir';
        $this->componentName = 'Asignar Permiso';
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        $permisos = Permission::select('name', 'id', DB::raw("0 as checked"))
        ->orderBy('name', 'asc')
        ->paginate($this->pagination);

        if ($this->role != 'Elegir') {
            // code...
            $list = Permission::join(
                    'role_has_permissions as rhp',
                    'rhp.permission_id',
                    'permissions.id'
                )
            ->where('role_id', $this->role)
            ->pluck('permissions.id')
            ->toArray();

            $this->old_permission = $list;
        }

        if ($this->role != 'Elegir') {
            // code...
            foreach($permisos as $permiso){
                $role = Role::find($this->role);
                $tienePermiso = $role->hasPermissionTo($permiso->name);

                if ($tienePermiso) {
                    // code...
                    $permiso->checked = 1;
                }
            }
        }

        return view('livewire.asignaciones.asignar',[
            'roles' => Role::orderBy('name', 'asc')->get(),
            'permisos' => $permisos
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public $listeners = ['revokeall' => 'RemoveAll'];

    public function RemoveAll()
    {
        // code...
        if ($this->role == 'Elegir') {
            // code...
            $this->emit('sync-error', 'Seleccionar un Role Válido');
        }

        $role = Role::find($this->role);
        $role->syncPermissions([0]);

        $this->emit('removeall', "Se Revocaron Todos los Permisos al Role $role->name");
    }

    public function SyncAll()
     {
         // code...
        if ($this->role == 'Elegir') {
            // code...
            $this->emit('sync-error', 'Seleccionar un Role Válido');
        }

        $role = Role::find($this->role);
        $permisos = Permission::pluck('id')->toArray();
        $role->syncPermissions($permisos);

        $this->emit('syncall', "Se Sincronizaron Todos los Permisos al Role $role->name");

     }

     public function SyncPermiso($state, $permisoName)
     {
         // code...
        if ($this->role != 'Elegir') {
            // code...
            $roleName = Role::find($this->role);

            if ($state) {
                // code...
                $roleName->gifePermissionTo($permisoName);
                $this->emit('permi', "Permiso Asignado Correctamente");
            }else{
                $roleName->revokePermissionTo($permisoName);
                $this->emit('permi', "Permiso Revocado Correctamente");
            }
        }
     }
}
