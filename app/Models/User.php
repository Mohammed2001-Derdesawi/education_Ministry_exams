<?php

namespace App\Models;

use App\Models\Mark;
use App\Models\Specialization;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'specialization_id',
        'office_id',
        'level',
        'self_rating',
        'outer_rating',
    ];




    /**
     * Get all of the marks for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function marks(): HasMany
    {
        return $this->hasMany(Mark::class, 'user_id', 'id');
    }
    /**
     * Get the specialization that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }

    public function sum_marks()
    {
        return $this->belongsToMany(Standard::class,'marks','user_id','standard_id');
    }

    public function getMarkField($field)
    {

        return DB::select(DB::raw("SELECT SUM(`standards`.`mark`) as `user_mark_field` FROM `standards` INNER JOIN `marks` ON `marks`.`standard_id`=`standards`.`id` WHERE `marks`.`user_id`=".$this->id." and `standards`.`norm_id` in(SELECT `id` From `norms` WHERE `norms`.`field_id`=".$field.")"))[0]->user_mark_field;
    }

    public function scopeSearch($query,$value)
    {
        if(request()->search)
        return $query->where('name','LIKE', "%".$value."%")->orwhere('self_rating',$value);
    }
    public function scopeSort($query,$value)
    {

        if(request()->sort && in_array(request()->sort,["desc",'asc']))
        return $query->orderBy('self_rating',$value);

        return  $query->orderBy('self_rating','desc');
    }
    public function scopeLevel($query,$value)
    {
        if(request()->level && in_array($value,["achieved","mastered","influential"]))
        return $query->where('level',$value);
    }

    public function scopeInoffice($query)
    {

        if(auth()->guard('admin')->user()->office_id)
        return $query->where('office_id',auth()->guard('admin')->user()->office_id);
    }
}
