<?php

namespace App\Http\Livewire\Users;

use App\Models\Role;
use Livewire\Component;

class UserForm extends Component
{
    public $title = 'Usuarios';    
    public $breadcrumb = [
        "Super Administración" => null,
        "Usuarios" => "users.index", 
        "crear" => "users.create",
    ];

    public function render()
    {

        return view('livewire.users.user-form', [
            'roles' => Role::pluck('name', 'guard_name'),
        ]);
    }
}
