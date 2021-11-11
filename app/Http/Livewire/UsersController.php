<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class UsersController extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $name, $phone, $email, $password,
            $status, $image, $selected_id,
            $fileLoaded, $role;

    public $pageTitle, $componentName, $search;

    private $pagination = 5;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Usuarios';
        $this->status = 'Elegir';
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if (strlen($this->search) > 0) {
            // code...
            $data = User::where('name', 'like', '%' . $this->search . '%')
            ->select('*')
            ->orderBy('name', 'asc')
            ->paginate($this->pagination);
        }else{
            $data = User::select('*')
            ->orderBy('name', 'asc')
            ->paginate($this->pagination);
        }

        return view('livewire.usuarios.component', [
            'data' => $data,
            'roles' => Role::orderBy('name', 'asc')
            ->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function resetUI()
    {
        // code...
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->phone = '';
        $this->image = '';
        $this->search = '';
        $this->status = 'Elegir';
        $this->selected_id = 0;
    }

    public function edit(User $user)
    {
        // code...
        $this->selected_id = $user->id;
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->profile = $this->profile;
        $this->status = $user->status;
        $this->email = $user->email;
        $this->password = '';

        $this->emit('show-modal', 'open!');
    }

    protected $listners = [
        'deleteRow' => 'destroy',
        'resetUI' => 'resetUI',
    ];

    public function Store()
    {
        // code...
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:5',
        ];

        $messages = [
            'name.required' => 'Ingresar el Nombre Completo del Nuevo Usuario',
            'name.min' => 'El Nombre del Nuevo Usuario Debe de Tener al Menos 3 Caracteres',

            'email.required' => 'Ingresar el Correo',
            'email.email' => 'Ingresar un Correo Válido',
            'email.unique' => 'El Email Ingresado Ya Existe en Otro Usuario',

            'status.required' => 'Seleccionar el Estatus del Usuario',
            'status.not_in' => 'Seleccionar el Estatus, Distinto a Elegir',

            'profile.required' => 'Seleccionar el Perfil y/o Rol del Usuario',
            'profile.not_in' => 'Seleccionar el Perfil y/o Rol, Distinto a Elegir',

            'password.required' => 'Ingresar el Password o Clave del Usuario',
            'password.min' => 'El Password o Clave, Debe de Tener al Menos 5 Caracteres',
        ];

        $this->validate($rules, $messages);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'profile' => $this->profile,
            'password' => bcrypt($this->password),
        ]);

        if ($this->image) {
            // code...
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $user->image = $customFileName;
            $user->save();
        }

        $this->resetUI();
        $this->emit('user-added', 'Usuario Registrado Correctamente');
    }

    public function Update()
    {
        // code...
        $rules = [
            'email' => 'required|email|unique:users,email,{$this->selected_id}',
            'name' => 'required|min:3',
            'status' => 'required|not_in:Elegir',
            'profile' => 'required|not_in:Elegir',
            'password' => 'required|min:5',
        ];

        $messages = [
            'name.required' => 'Ingresar el Nombre Completo del Nuevo Usuario',
            'name.min' => 'El Nombre del Nuevo Usuario Debe de Tener al Menos 3 Caracteres',

            'email.required' => 'Ingresar el Correo',
            'email.email' => 'Ingresar un Correo Válido',
            'email.unique' => 'El Email Ingresado Ya Existe en Otro Usuario',

            'status.required' => 'Seleccionar el Estatus del Usuario',
            'status.not_in' => 'Seleccionar el Estatus, Distinto a Elegir',

            'profile.required' => 'Seleccionar el Perfil y/o Rol del Usuario',
            'profile.not_in' => 'Seleccionar el Perfil y/o Rol, Distinto a Elegir',

            'password.required' => 'Ingresar el Password o Clave del Usuario',
            'password.min' => 'El Password o Clave, Debe de Tener al Menos 5 Caracteres',
        ];

        $this->validate($rules, $messages);

        $user = User::find($selected_id);

        $user = Update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'profile' => $this->profile,
            'password' => bcrypt($this->password),
        ]);

        if ($this->image) {
            // code...
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $imageTemp = $user->image;

            $user->image = $customFileName;
            $user->save();

            if ($imageTemp != null) {
                // code...
                if (file_exists('storage/users/' . $imageTemp)) {
                    // code...
                    unlink('storage/users/' . $imageTemp);
                }
            }
        }

        $this->resetUI();
        $this->emit('user-updated', 'Usuario Actualizado Correctamente');
    }

    public function Destroy(User $user)
    {
        // code...

        if ($user) {
            // code...
            $sales = Sale::where('user_id', $user->id)->count();
            if ($sales > 0) {
                // code...
                $this->emit('user-whithsales',
                'No Se Puede Eliminar el Registro Seleccionado, Porque Ya Tiene Registros');
            }else{
                $user->delete();
                $this->resetUI();
                $this->emit('user-deleted',
                'Registro Seleccionado Fue Eliminado Correctamente');
            }
        }
    }
}
