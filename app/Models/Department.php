<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Department
 * @package App\Models
 * @version February 27, 2020, 9:29 am UTC
 *
 * @property string faculty_id
 * @property string title
 * @property string code
 * @property string speciality
 */
class Department extends Model
{
//    use SoftDeletes;

    public $table = 'departments';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public function faculties()
    {
        return $this->hasOne(Faculty::class, 'id', 'faculty_id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'department_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'department_id', 'id');
    }

    public $fillable = [
        'faculty_id',
        'title',
        'code',
        'speciality'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'faculty_id' => 'string',
        'title' => 'string',
        'code' => 'string',
        'speciality' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'faculty_id' => 'required',
        'title' => 'required',
        'code' => 'required',
        'speciality' => 'required'
    ];

    public static function changeFaculty($faculty_id,$department_id){
        $users = User::where("department_id",$department_id)->get();

        if(count($users)>0){
            foreach ($users as $user){
                $user->faculty_id = $faculty_id;
                $user->save();
            }
        }
    }


}
