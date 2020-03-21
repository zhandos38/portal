<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * Class Material
 * @package App\Models
 * @version March 5, 2020, 5:02 pm UTC
 *
 * @property \App\Models\Group group
 * @property \App\Models\Library library
 * @property \App\Models\Semester semester
 * @property \App\Models\User teacher
 * @property integer semester_id
 * @property integer group_id
 * @property integer teacher_id
 * @property integer library_id
 * @property string title
 * @property string description
 */
class Material extends Model
{
    //use SoftDeletes;

    public $table = 'materials';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'semester_id',
        'group_id',
        'teacher_id',
        'library_id',
        'subject_id',
        'title',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'semester_id' => 'integer',
        'group_id' => 'integer',
        'teacher_id' => 'integer',
        'library_id' => 'integer',
        'title' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'semester_id' => 'required',
        'group_id' => 'required',
        'teacher_id' => 'required',
        'library_id' => 'required',
        'title' => 'required',
        'description' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function group()
    {
        return $this->belongsTo(\App\Models\Group::class, 'group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function library()
    {
        return $this->belongsTo(\App\Models\Library::class, 'library_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function semester()
    {
        return $this->belongsTo(\App\Models\Semester::class, 'semester_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function teacher()
    {
        return $this->belongsTo(\App\Models\User::class, 'teacher_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }





    public static function filterData($request){
        $subject_id = $request->get("subject_id");
        $library_id = $request->get("library_id");
        $str = "<option value='0'>Не выбранно</option>";

        if($subject_id && !$library_id){
            $semester = Semester::where("current",1)->first();
            $groupIds = array_keys(Shedule::where(["teacher_id"=>Auth::id(),"semester_id"=>$semester->id,"subject_id"=>$subject_id])->pluck("id","group_id")->all());
            $groups = Group::whereIn("id",$groupIds)->get();
            if(count($groups)>0){
                foreach ($groups as $group){
                    $str.= "<option value={$group->id}>$group->title</option>";
                }
            }
            else{
                $str = "<option>Ничего не найдено</option>";
            }
            return $str;

        }
        if($subject_id && $library_id){
            if($library_id == 1){
                $libraries = Library::where("user_id",Auth::id())->get();
            }
            if($library_id == 2){
                $libraries = Library::all();
            }
            if(count($libraries)>0){
                foreach ($libraries as $library){
                    $str.= "<option value={$library->id}>$library->title</option>";
                }
                return $str;
            }
            else{
                $str = "<option>Файлы не найдены</option>";
                return $str;
            }
        }
        else{
            $str = "<option>Ничего не найдено</option>";
            return $str;
        }
    }
}
