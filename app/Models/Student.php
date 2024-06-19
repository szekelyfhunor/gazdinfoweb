<?php

namespace App\Models;

use App\Helpers\Helper;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['diplomathese', 'competitions'];

    protected $fillable = ['user_id', 'classes_id', 'workplace', 'year_of_finish', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function diplomathese()
    {
        return $this->hasMany(DiplomaThesis::class, 'student_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classes()
    {
        return $this->belongsTo(Classes::class, );
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function competitions()
    {
        return $this->belongsToMany(Competition::class, 'competitions_has_students');
    }

    public function applicants()
    {
        return $this->belongsToMany(Applicants::class, 'applicants_has_students', 'student_id', 'applicants_for_theses_id');
    }
}
