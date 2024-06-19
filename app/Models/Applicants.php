<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicants extends Model
{
    use HasFactory;

    protected $table = 'applicants_for_theses';
    protected $fillable = ['status'];

    public function diplomaTheses(){
        return $this->belongsToMany(DiplomaThesis::class, 'applicants_has_diploma_t', 'applicants_for_theses_id', 'diploma_theses_id');
    }

    public function student(){
        return $this->belongsToMany(Student::class, 'applicants_has_students', 'applicants_for_theses_id', 'student_id');
    }

    public function accept()
    {
        $this->status = 'accepted';
        $this->save();
    }

    public function reject()
    {
        $this->status = 'rejected';
        $this->save();
    }

}
