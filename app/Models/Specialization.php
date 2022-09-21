<?php

namespace App\Models;

use App\Models\User;
use App\Models\Field;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Specialization extends Model
{
    use HasFactory;
    protected $fillable=['name'];
    /**
     * Get all of the fields for the Specialization
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fields(): HasMany
    {
        return $this->hasMany(Field::class, 'specialization_id', 'id');
    }
    /**
     * Get all of the questions for the Specialization
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'specialization_id', 'id');
    }

    /**
     * Get all of the users for the Specialization
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        if(auth()->guard('admin')->user()->office_id)
        return $this->hasMany(User::class, 'specialization_id', 'id')->where('office_id',auth()->guard('admin')->user()->office_id);


        return $this->hasMany(User::class, 'specialization_id', 'id');
    }
    /**
     * Get all of the norms for the Specialization
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function norms(): HasManyThrough
    {
        return $this->hasManyThrough(Norm::class, Field::class,'specialization_id','field_id','id','id');
    }

    public function achieved_users(): HasMany
    {
        if(auth()->guard('admin')->user()->office_id)
        return $this->hasMany(User::class, 'specialization_id', 'id')->where('level','achieved')->where('office_id',auth()->guard('admin')->user()->office_id);

        return $this->hasMany(User::class, 'specialization_id', 'id')->where('level','achieved');
    }

    public function mastered_users(): HasMany
    {
        if(auth()->guard('admin')->user()->office_id)
        return $this->hasMany(User::class, 'specialization_id', 'id')->where('level','mastered')->where('office_id',auth()->guard('admin')->user()->office_id);


        return $this->hasMany(User::class, 'specialization_id', 'id')->where('level','mastered');
    }
    public function influential_users(): HasMany
    {
        if(auth()->guard('admin')->user()->office_id)
        return $this->hasMany(User::class, 'specialization_id', 'id')->where('level','influential')->where('office_id',auth()->guard('admin')->user()->office_id);


        return $this->hasMany(User::class, 'specialization_id', 'id')->where('level','influential');
    }



}
