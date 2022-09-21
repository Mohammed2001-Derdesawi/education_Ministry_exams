<?php

namespace App\Models;

use App\Models\Norm;
use App\Models\Specialization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable=['question','norm_id','specialization_id','photo'];

    /**
     * Get the norm that owns the Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function norm(): BelongsTo
    {
        return $this->belongsTo(Norm::class, 'norm_id', 'id');
    }
    /**
     * Get the specialization that owns the Question
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
        return $query->where('question','LIKE', "%".$value."%")->orwhereHas('norm',function ($q) use ($value){
            return  $q->where('norm','LIKE' ,'%'.$value ."%");


        });
    }

}
