<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ItKlub extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes, CascadeSoftDeletes;
    use InteractsWithMedia;

    protected $table = "itklubs";
    protected $fillable = ['title', 'description'];

}
