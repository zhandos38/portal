<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Group
 * @package App\Models
 * @version February 27, 2020, 9:35 am UTC
 *
 * @property string department_id
 * @property string title
 * @property string language_id
 * @property string education_id
 * @property string year
 */
class Group extends Model
{
    use SoftDeletes;

    public $table = 'groups';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public function departments()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function languages()
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }
    public function educations()
    {
        return $this->hasOne(EducationTypes::class, 'id', 'education_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'group_id', 'id');
    }

    public $fillable = [
        'department_id',
        'title',
        'language_id',
        'education_id',
        'year'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'department_id' => 'string',
        'title' => 'string',
        'language_id' => 'string',
        'education_id' => 'string',
        'year' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'department_id' => 'required',
        'title' => 'required',
        'language_id' => 'required',
        'education_id' => 'required'
    ];

    public static function changeGroup($department_id,$id)
    {
        $users = User::where("group_id",$id)->get();

        if(count($users)>0){
            foreach ($users as $user)
            {
                $user->department_id = $department_id;
                $user->save();
            }
        }

    }
}
