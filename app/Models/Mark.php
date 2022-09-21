<?php

namespace App\Models;

use App\Models\Norm;
use App\Models\Standard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mark extends Model
{
    use HasFactory;
    protected $fillable=['norm_id','user_id','standard_id','question_id'];

    /**
     * Get the standard that owns the Mark
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function standard(): BelongsTo
    {
        return $this->belongsTo(Standard::class, 'standard_id', 'id');
    }
    /**
     * Get the norm that owns the Mark
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function norm(): BelongsTo
    {
        return $this->belongsTo(Norm::class, 'norm_id', 'id');
    }
    /**
     * Get the user that owns the Mark
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
