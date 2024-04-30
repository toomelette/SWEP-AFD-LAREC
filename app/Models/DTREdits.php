<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DTREdits extends Model
{
    public static function boot(){
        parent::boot();
        static::updating(function($a){
            $a->user_updated = \Auth::user()->user_id;;
            $a->updated_at = \Carbon::now();
        });

        static::creating(function ($a){
            $a->user_created = \Auth::user()->user_id;
            $a->created_at = \Carbon::now();
        });
    }
    protected $table = 'hr_dtr_edits';
    protected $fillable = ['slug','employee_no','biometric_user_id','time'];

    use SoftDeletes;
}