<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

class UserShow extends Component
{
    public $title = 'Usuarios';    
    public $breadcrumb = [
        "Usuarios" => "users.index",
        "Información" => null

    ];

    public function render()
    {
        return view('livewire.users.user-show');
    }
}
