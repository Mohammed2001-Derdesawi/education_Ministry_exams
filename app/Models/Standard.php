<?php

namespace App\Models;

use App\Models\Norm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Standard extends Model
{
    use HasFactory;
    protected $fillable=['norm_id','standard','mark'];

    /**
     * Get the norm that owns the Standard
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function norm(): BelongsTo
    {
        return $this->belongsTo(Norm::class, 'norm_id', 'id');
    }

}
