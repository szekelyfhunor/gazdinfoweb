<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserSearch extends Component
{
    use WithPagination;
    public $search = '';
    public function render()
    {
        return view('livewire.user-search',
        [
            'users' => User::search($this->search)->paginate(50)
        ]
    );
    }
}
