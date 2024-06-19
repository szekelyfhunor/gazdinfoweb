<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Applicants;
use Illuminate\Support\Facades\Auth;

class ApplicationButton extends Component
{
    
    public $thesisId;
    public $applied;

    public function mount($thesisId)
    {
        $this->thesisId = $thesisId;
        $this->applied = Applicants::whereHas('diplomaTheses', function ($query) use ($thesisId) {
                $query->where('id', $thesisId);
            })
            ->whereHas('student', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->exists();
    }

    public function apply()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('google-auth')->with('error', 'A művelet végrehajtásához be kell jelentkeznie.');
        }

        if ($user->student && $user->student->applicants()->where('id', $this->thesisId)->exists()) {
            session()->flash('message', 'Már jelentkezett erre a diplomadolgozatra!');
            return;
        }

        $applicant = Applicants::create();
        $applicant->diplomaTheses()->attach($this->thesisId);

        if ($user->student) {
            $applicant->student()->attach($user->student->id);
        } else {
            $this->addError('student', 'Ön már nem rendelkezik aktív státusszal!');
            return;
        }

        session()->flash('message', 'Sikeres jelentkezés a diplomadolgozatra!');

        $this->applied = true;
    }

    public function delete()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('google-auth')->with('error', 'A művelet végrehajtásához be kell jelentkeznie.');
        }

        Applicants::whereHas('student', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->whereHas('diplomaTheses', function ($query) {
                $query->where('id', $this->thesisId);
            })
            ->delete();

        $this->applied = false;
    }

    public function render()
    {
        return view('livewire.application-button');
    }
}
