<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Semester
 * @package App\Models
 * @version February 28, 2020, 6:08 am UTC
 *
 * @property string year_id
 * @property string title
 * @property string start
 * @property string end
 * @property string current
 * @property string step
 */
class Semester extends Model
{
//    use SoftDeletes;

    public $table = 'semesters';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public function years()
    {
        return $this->hasOne(Year::class, 'id', 'year_id');
    }

    public $fillable = [
        'year_id',
        'title',
        'start',
        'end',
        'current',
        'step'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'year_id' => 'string',
        'title' => 'string',
        'start' => 'string',
        'end' => 'string',
        'current' => 'string',
        'step' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'year_id' => 'required',
        'title' => 'required',
        'start' => 'required',
        'end' => 'required',
        'current' => 'required',
        'step' => 'required'
    ];


}
