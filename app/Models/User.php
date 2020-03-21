<?php

namespace App\Models;

use App\ExpelledStudent;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class User
 * @package App\Models
 * @version February 27, 2020, 8:03 am UTC
 *
 * @property string role_id
 * @property string login
 * @property string faculty_id
 * @property string department_id
 * @property string group_id
 * @property string password
 * @property string remember_token
 */
class User extends Model
{
//    use SoftDeletes;

    public $table = 'users';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public function roles()
    {
        return $this->hasOne(Roles::class, 'id', 'role_id');
    }

    public function faculties()
    {
        return $this->hasOne(Faculty::class, 'id', 'faculty_id');
    }

    public function departments()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function groups()
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

    public function infos()
    {
        return $this->hasOne(UserInfo::class, 'user_id', 'id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'student_id', 'id');
    }

    public function expelled(){
        return $this->hasOne(ExpelledStudent::class,'student_id','id');
    }

    public static function getTeacher($user){
        $teachers = [];
        if(count($user)>0){
            foreach ($user as $item){
                if($item->infos){
                    $teachers[$item['id']] = $item->infos->lastName . ' '. $item->infos->firstName .' '. $item->infos->middleName;
                }
                else{
                    $teachers[$item['id']] = $item->login;
                }

            }
        }
        else{
            $teachers[0] = 'Создайте учителей!';
        }
        return $teachers;
    }

    public $fillable = [
        'role_id',
        'login',
        'faculty_id',
        'department_id',
        'group_id',
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'role_id' => 'string',
        'login' => 'string',
        'faculty_id' => 'string',
        'department_id' => 'string',
        'group_id' => 'string',
        'password' => 'string',
        'remember_token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'role_id' => 'required',
        'login' => 'required',
        'password' => 'required'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function makeData($input)
    {
        if($input['role_id'] == 1 || $input['role_id'] == 6 ){
            $input['faculty_id'] = null;
            $input['department_id'] = null;
            $input['group_id'] = null;
        }
        if($input['role_id'] == 2 || $input['role_id'] == 3){
            $input['department_id'] = null;
            $input['group_id'] = null;
        }
        if($input['role_id'] == 4){
            $faculty = Department::where('id',$input['department_id'])->first();
            $input['faculty_id'] = $faculty->faculty_id;
            $input['group_id'] = null;
        }
        if($input['role_id'] == 5){
            $department = Group::where('id', $input['group_id'])->first();
            if (!empty($department)) {
                $faculty = Department::where('id', $department->department_id)->first();
                $input['faculty_id'] = $faculty->faculty_id;
                $input['department_id'] = $department->department_id;
            }
        }
        $input['password'] = bcrypt($input['password']);
        return $input;
    }
}
