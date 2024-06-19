<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DiplomaThesis extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['student_id', 'title', 'topic'];

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'diploma_t_has_topics');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teacher()
    {
        return $this->belongsToMany(Teacher::class, 'diploma_t_has_teachers');
    }


    public function applicants(){
        return $this->belongsToMany(Applicants::class, 'applicants_has_diploma_t', 'diploma_theses_id', 'applicants_for_theses_id');
    }

    public function scopeSearch($query, $value)
    {
        $query->where('title', 'like', "%{$value}%");
    }

    public function accept()
    {
        $this->status = 'accepted';
        $this->save();
    }
}

