<?php

namespace App\Livewire\Root;

use Livewire\Component;
use App\Models\User;
use App\Models\TipoUsuarios;
use App\Models\Personas;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Usuarios extends Component
{
    use WithFileUploads, WithPagination;

    public $tiposUsuario;
    public $modalAbierto = false;
    public $modalConfirmacion = false;
    public $editando = false;
    public $foto;
    public $usuarioEliminar;

    public $form = [
        'name' => '',
        'email' => '',
        'password' => '',
        'fk_idtipousu' => '',
        // Datos de persona
        'dni' => '',
        'nombre' => '',
        'apellidos' => '',
        'telefono' => '',
        'email_persona' => '',
    ];

    public $usuarioId;
    public $search = '';

    protected $listeners = ['confirmarEliminacion'];

    public function mount()
    {
        $this->tiposUsuario = TipoUsuarios::all();
    }
    
    public function render()
    {
        $usuarios = User::with(['tipousu', 'persona'])
            ->when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhereHas('persona', function($q) {
                          $q->where('nombre', 'like', '%' . $this->search . '%')
                            ->orWhere('apellidos', 'like', '%' . $this->search . '%')
                            ->orWhere('dni', 'like', '%' . $this->search . '%');
                      });
            })
            ->latest()
            ->paginate(5);

        // $layout = auth()->check() ? 'layouts.prueba' : 'layouts.guest';
        return view('livewire.root.usuarios', compact('usuarios'))->layout('layouts.prueba');
    }

    public function abrirModalCrear()
    {
        $this->resetValidation();
        $this->reset(['form', 'foto', 'editando', 'usuarioId']);
        $this->modalAbierto = true;
    }

    public function editar($id)
    {
        $this->resetValidation();
        $usuario = User::with('persona')->findOrFail($id);
        $this->usuarioId = $id;
        $this->editando = true;
        
        $this->form = [
            'name' => $usuario->name,
            'email' => $usuario->email,
            'fk_idtipousu' => $usuario->fk_idtipousu,
            'password' => '',
            // Datos de persona si existe
            'dni' => $usuario->persona->dni ?? '',
            'nombre' => $usuario->persona->nombre ?? '',
            'apellidos' => $usuario->persona->apellidos ?? '',
            'telefono' => $usuario->persona->telefono ?? '',
            'email_persona' => $usuario->persona->email ?? '',
        ];
        
        $this->modalAbierto = true;
    }

    public function guardar()
    {
        $rules = [
            'form.name' => 'required|string|max:255',
            'form.email' => 'required|email|unique:users,email,' . $this->usuarioId,
            'form.fk_idtipousu' => 'required|exists:tipo_usuarios,id',
            'form.password' => $this->editando ? 'nullable|min:6' : 'required|min:6',
            'foto' => 'nullable|image|max:1024',
            // Validaciones para persona
            'form.dni' => 'required|string|max:8|unique:personas,dni' . ($this->editando && isset($this->form['dni']) ? ','.User::find($this->usuarioId)->persona?->id : ''),
            'form.nombre' => 'required|string|max:255',
            'form.apellidos' => 'required|string|max:255',
            'form.telefono' => 'nullable|string|max:15',
            'form.email_persona' => 'required|email',
        ];

        $this->validate($rules);

        try {
            DB::beginTransaction();

            // Crear o actualizar persona
            if ($this->editando && $usuario = User::find($this->usuarioId)) {
                $persona = $usuario->persona ?? new Personas();
            } else {
                $persona = new Personas();
            }

            $persona->fill([
                'dni' => $this->form['dni'],
                'nombre' => $this->form['nombre'],
                'apellidos' => $this->form['apellidos'],
                'telefono' => $this->form['telefono'],
                'email' => $this->form['email_persona'],
            ]);
            $persona->save();

            // Crear o actualizar usuario
            $usuario = $this->editando ? User::findOrFail($this->usuarioId) : new User();
            
            $userData = [
                'name' => $this->form['name'],
                'email' => $this->form['email'],
                'fk_idtipousu' => $this->form['fk_idtipousu'],
                'fk_idpersona' => $persona->id,
            ];

            if (!$this->editando || !empty($this->form['password'])) {
                $userData['password'] = Hash::make($this->form['password']);
            }

            $usuario->fill($userData);

            // Guardar la foto si se cargó
            if ($this->foto) {
                // Eliminar foto anterior si existe
                if ($usuario->profile_photo_path) {
                    Storage::disk('public')->delete($usuario->profile_photo_path);
                }
                $path = $this->foto->store('profile-photos', 'public');
                $usuario->profile_photo_path = $path;
            }

            $usuario->save();

            DB::commit();

            $this->modalAbierto = false;
            $this->reset(['form', 'foto', 'usuarioId', 'editando']);
            
            $mensaje = $this->editando ? 'Usuario actualizado exitosamente.' : 'Usuario creado exitosamente.';
            session()->flash('message', $mensaje);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error al guardar: ' . $e->getMessage());
        }
    }

    public function confirmarEliminacion($id)
    {
        $this->usuarioEliminar = User::findOrFail($id);
        $this->modalConfirmacion = true;
    }

    public function eliminar()
    {
        try {
            if ($this->usuarioEliminar->profile_photo_path) {
                Storage::disk('public')->delete($this->usuarioEliminar->profile_photo_path);
            }
            
            $this->usuarioEliminar->delete();
            $this->modalConfirmacion = false;
            $this->usuarioEliminar = null;
            
            session()->flash('message', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error al eliminar usuario: ' . $e->getMessage());
        }
    }

    public function cancelarEliminacion()
    {
        $this->modalConfirmacion = false;
        $this->usuarioEliminar = null;
    }

    public function cerrarModal()
    {
        $this->modalAbierto = false;
        $this->reset(['form', 'foto', 'usuarioId', 'editando']);
        $this->resetValidation();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}