<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * Class ExamSchedule
 * @package App\Models
 * @version March 3, 2020, 2:23 pm UTC
 *
 * @property string semester_id
 * @property string subject_id
 * @property string group_id
 * @property string type_id
 * @property string quiz_id
 * @property string start
 * @property string end
 * @property string time
 * @property string cabinet
 * @property string active
 */
class ExamSchedule extends Model
{
    use SoftDeletes;

    public $table = 'exam_schedules';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public function semester(){
        return $this->hasOne(Semester::class,"id","semester_id");
    }
    public function subject(){
        return $this->hasOne(Subject::class,"id","subject_id");
    }
    public function group(){
        return $this->hasOne(Group::class,"id","group_id");
    }
    public function type(){
        return $this->hasOne(ExamType::class,"id","type_id");
    }
    public function quiz(){
        return $this->hasOne(Quiz::class,"id","quiz_id");
    }

    public $fillable = [
        'semester_id',
        'subject_id',
        'group_id',
        'type_id',
        'quiz_id',
        'start',
        'end',
        'time',
        'cabinet',
        'active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'semester_id' => 'string',
        'subject_id' => 'string',
        'group_id' => 'string',
        'type_id' => 'string',
        'quiz_id' => 'string',
        'start' => 'string',
        'end' => 'string',
        'time' => 'string',
        'cabinet' => 'string',
        'active' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'semester_id' => 'required',
        'subject_id' => 'required',
        'group_id' => 'required',
        'type_id' => 'required',
        'quiz_id' => 'required',
        'start' => 'required',
        'end' => 'required',
        'time' => 'required',
        'cabinet' => 'required',
        'active' => 'required'
    ];

    public static function filterData($request){
        $semester_id = $request->get("semester_id");
        $subject_id = $request->get("subject_id");
        $group_id = $request->get("group_id");
        $test_id = $request->get("test_id");

        $str = "<option value=".null.">Не выбрано</option>";
        if($semester_id && !$subject_id && !$group_id && !$test_id){
            $schedules =Shedule::where(["semester_id"=>$semester_id])->get();
            if(count($schedules)>0){
                $group = [];
                foreach ($schedules as $schedule){
                    if(!in_array($schedule->subject_id,$group)){
                        $str.="<option value={$schedule->subject_id}>".$schedule->subjects->title."</option>";
                        $group[] = $schedule->subject_id;
                    }
                }
                return $str;
            }
            else{
                return "<optinon =0>Ничего не найдено</optinon>";
            }
        }
        elseif ($semester_id && $subject_id && !$group_id &&!$test_id){
            $schedules =Shedule::where(["semester_id"=>$semester_id,"subject_id"=>$subject_id])->get();
            if(count($schedules)>0){
                $group = [];
                foreach ($schedules as $schedule){
                    if(!in_array($schedule->group_id,$group)){
                        $str.="<option value={$schedule->group_id}>".$schedule->groups->title."</option>";
                        $group[] = $schedule->group_id;
                    }
                }
                return $str;
            }
            else{
                return "<optinon =0>Ничего не найдено</optinon>";
            }
        }
        elseif ($semester_id && $subject_id && $group_id &&!$test_id){
            foreach (ExamType::all() as $exam){
                $str.="<option value={$exam->id}>".$exam->title."</option>";
            }
            return $str;
        }
        elseif ($semester_id && $subject_id && $group_id && $test_id == 3){
            foreach (Quiz::all() as $exam){
                if(count($exam->questions)>40){
                    $str.="<option value={$exam->id}>".$exam->title."</option>";
                }
            }
            return $str;
        }
        else{
            $str = "<optinon =0>Ничего не найдено</optinon>";
            return $str;
        }
    }



    public static function makeData($request){
        $schedule = ExamSchedule::where(["semester_id"=>$request->get("semester_id"),"subject_id"=>$request->get("subject_id"),"group_id"=>$request->get("group_id")])->first();
        if($schedule){
            $schedule->type_id = $request->get("type_id");
            if($request->get("type_id") == 3){
                $schedule->quiz_id = $request->get("quiz_id");
            }
            else{
                $schedule->quiz_id = 0;
            }
            $schedule->start = $request->get("start");
            $schedule->end = $request->get("end");
            $schedule->time = $request->get("time");
            $schedule->cabinet = $request->get("cabinet");
            return $schedule->save();
        }
        else{
            $input = $request->all();
            if($request->get("type_id") != 3){
                $input["quiz_id"] =  0;
            }
            $input["active"] = 0;
            if(ExamSchedule::create($input)){
                return true;
            }
            else{
                return false;
            }
        }

    }

    public static function getStudentSubjects($group_id){
        $schedules = ExamSchedule::where("group_id",$group_id)->orderBy("semester_id","ASC")->get();
        if(count($schedules)>0){
            foreach ($schedules as $schedule){
                $scheduleinfo = Shedule::where(["semester_id"=>$schedule->semester_id,"group_id"=>$schedule->group_id,"lesson_id"=>1])->take("teacher_id")->first();
                $schedule->teacher ="{$scheduleinfo->teachers->infos->lastName} {$scheduleinfo->teachers->infos->firstName} {$scheduleinfo->teachers->infos->middleName}" ;
            }
        }
        return $schedules;
    }

    public static function getQuizzes(){
        $user = User::find(Auth::id());
        $active = Semester::where("current",1)->first();
        $exams = ExamSchedule::where(["semester_id"=>$active->id,"group_id"=>$user->group_id,"type_id"=>3,"active"=>1])->get();
        $newExams = [];
        foreach ($exams as $exam){
            $assignment = Assignment::where(["semester_id"=>$active->id,"subject_id"=>$exam->subject_id,"group_id"=>$user->group_id,"student_id"=>Auth::id()])->first();
            if($assignment){
                if($assignment->first_rating && $assignment->second_rating && ($assignment->exam_rating == null||$assignment->exam_rating == 0)){
                    $newExams[] = $exam;
                }
            }

        }
        return $newExams;
    }

    public static function checkStatus($schedule_id,$user_id){
        $schedule = ExamSchedule::find($schedule_id);
        if($schedule){
            $assignment = Assignment::where(["semester_id"=>$schedule->semester_id,"subject_id"=>$schedule->subject_id,"group_id"=>$schedule->group_id,"student_id"=>Auth::id()])->first();
            if($assignment){
                if ($assignment->first_rating && $assignment->second_rating && ($assignment->exam_rating == null || $assignment->exam_rating == 0)){
                    return true;
                }
            }
            else{
                return false;
            }
        }
    }
}
