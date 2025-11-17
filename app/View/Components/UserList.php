<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class UserList extends Component
{
    public $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function render(): View
    {
        return view('components.user-list');
    }
}