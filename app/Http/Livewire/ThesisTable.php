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
        $diplomaTheses = DiplomaThesis::with(['topics', 'teacher.user'])
            ->where(function($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('abstract', 'like', '%' . $this->search . '%');
            })
            ->when($this->sortBy === 'topics', function($query) {
                $query->withCount('topics')->orderBy('topics_count', $this->sortDir);
            })
            ->when($this->sortBy === 'teachers', function($query) {
                $query->withCount('teacher')->orderBy('teacher_count', $this->sortDir);
            })
            ->when(!in_array($this->sortBy, ['topics', 'teachers']), function($query) {
                $query->orderBy($this->sortBy, $this->sortDir);
            })
            ->paginate($this->perPage);

        return view('livewire.thesis-table', [
            'users' => User::all(),
            'diplomaTheses' => $diplomaTheses,
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




