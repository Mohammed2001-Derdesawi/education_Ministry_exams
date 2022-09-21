<?php

namespace App\Models;

use App\Models\Norm;
use App\Models\Question;
use App\Models\Specialization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Field extends Model
{
    use HasFactory;
    protected $fillable=['name','specialization_id'];

    /**
     * Get all of the norms for the Field
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function norms(): HasMany
    {
        return $this->hasMany(Norm::class, 'field_id', 'id');
    }

    /**
     * Get all of the comments for the Field
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function questions(): HasManyThrough
    {
        return $this->hasManyThrough(Question::class, Norm::class,'question_id','norm_id','id');
    }

    /**
     * Get the specialization that owns the Field
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }

    public function scopeSearch($query,$value)
    {
        if(request()->search)
        return $query->where('name','LIKE', "%".$value."%");
    }

    public function standards()
    {
        return $this->hasManyThrough(Standard::class,Norm::class,'field_id','norm_id','id','id');
    }


}
