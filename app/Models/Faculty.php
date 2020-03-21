<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Faculty
 * @package App\Models
 * @version February 27, 2020, 9:22 am UTC
 *
 * @property string title
 */
class Faculty extends Model
{
//    use SoftDeletes;

    public $table = 'faculties';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public function departments()
    {
        return $this->hasMany(Department::class, 'faculty_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'faculty_id', 'id');
    }

    public $fillable = [
        'title'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
    ];


}
