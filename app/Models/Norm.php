<?php

namespace App\Models;

use App\Models\Field;
use App\Models\Standard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Norm extends Model
{
    use HasFactory;
    protected $fillable=['norm','field_id'];


    /**
     * Get all of the standards for the Norm
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function standards(): HasMany
    {
        return $this->hasMany(Standard::class, 'norm_id', 'id');
    }

    /**
     * Get the field that owns the Norm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class, 'field_id', 'id');
    }
    public function scopeSearch($query,$value)
    {
        if(request()->search)
        return $query->where('norm','LIKE', "%".$value."%");
    }
}
