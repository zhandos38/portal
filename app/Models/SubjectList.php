<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SubjectList
 * @package App\Models
 * @version March 10, 2020, 10:21 am UTC
 *
 * @property \App\Models\Group group
 * @property \App\Models\Semester semester
 * @property \App\Models\User student
 * @property \App\Models\Subject subject
 * @property integer semester_id
 * @property integer group_id
 * @property integer subject_id
 * @property integer student_id
 * @property string credits
 * @property string ECTS
 */
class SubjectList extends Model
{
    //use SoftDeletes;

    public $table = 'subject_lists';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'semester_id',
        'group_id',
        'subject_id',
        'student_id',
        'credits',
        'ECTS'
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
        'subject_id' => 'integer',
        'student_id' => 'integer',
        'credits' => 'string',
        'ECTS' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'semester_id' => 'required',
        'group_id' => 'required',
        'subject_id' => 'required',
        'credits' => 'required',
        'ECTS' => 'required'
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
    public function semester()
    {
        return $this->belongsTo(\App\Models\Semester::class, 'semester_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function student()
    {
        return $this->belongsTo(\App\Models\User::class, 'student_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function subject()
    {
        return $this->belongsTo(\App\Models\Subject::class, 'subject_id');
    }

    public static function makeData($request){
        $students = User::where("group_id",$request->get("group_id"))->get();
        $data = [];
        if(count($students)>0){
            foreach ($students as $key=> $student){
                $data["semester_id"] = $request->get("semester_id");
                $data["group_id"] = $request->get("group_id");
                $data["subject_id"] = $request->get("subject_id");
                $data["student_id"] = $student->id;
                $data["credits"] = $request->get("credits");
                $data["ECTS"] = $request->get("ECTS");
                SubjectList::create($data);
            }
            return $data;
        }
        else{
            return false;
        }

    }

    public static function updateData($request,$id){
        $subject = SubjectList::find($id);
        $subjectLists = SubjectList::where(["semester_id"=>$subject->semester_id,"group_id"=>$subject->group_id,"subject_id"=>$subject->subject_id])->get();

        if(count($subjectLists)>0){
            foreach ($subjectLists as $subjectList){
                $subjectList->semester_id = $request->get("semester_id");
                $subjectList->subject_id = $request->get("subject_id");
                $subjectList->credits = $request->get("credits");
                $subjectList->ECTS = $request->get("ECTS");
                $subjectList->save();
            }

        }
        else{
            return false;
        }

    }

    public static function deleteData($id){
        $subject = SubjectList::find($id);
        $subjectLists = SubjectList::where(["semester_id"=>$subject->semester_id,"group_id"=>$subject->group_id,"subject_id"=>$subject->subject_id])->get();

        if(count($subjectLists)>0){
            foreach ($subjectLists as $subjectList){
                $subjectList->delete();
            }

        }
        else{
            return false;
        }

    }
}
