<?php

namespace App\Http\Livewire;

use App\Models\Applicants;
use App\Models\DiplomaThesis;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ThesisTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $perPage = 5;
    public $sortBy = 'created_at';
    public $sortDir = 'DESC';

    public function render()
    {
        
        return view('livewire.thesis-table', [
            'users' => User::all(),
            'diplomaTheses' => DiplomaThesis::search($this->search)
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage),
        ]);
    }

    public function setSortBy($sortByField)
    {
        if($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == 'ASC') ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }
}




