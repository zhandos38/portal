<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class Shedule
 * @package App\Models
 * @version February 28, 2020, 8:36 am UTC
 *
 * @property string semester_id
 * @property string group_id
 * @property string teacher_id
 * @property string subject_id
 * @property string lesson_id
 * @property string day_id
 * @property string start
 * @property string end
 * @property string cabinet
 */
class Shedule extends Model
{
    use SoftDeletes;

    public $table = 'shedules';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public function semesters()
    {
        return $this->hasOne(Semester::class, 'id', 'semester_id');
    }
    public function groups()
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }
    public function teachers()
    {
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }
    public function subjects()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }
    public function lessons()
    {
        return $this->hasOne(LessonType::class, 'id', 'lesson_id');
    }
    public function days()
    {
        return $this->hasOne(Days::class, 'id', 'day_id');
    }

    public $fillable = [
        'semester_id',
        'group_id',
        'teacher_id',
        'subject_id',
        'lesson_id',
        'day_id',
        'start',
        'end',
        'cabinet'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'semester_id' => 'string',
        'group_id' => 'string',
        'teacher_id' => 'string',
        'subject_id' => 'string',
        'lesson_id' => 'string',
        'day_id' => 'string',
        'start' => 'string',
        'end' => 'string',
        'cabinet' => 'string'
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
        'subject_id' => 'required',
        'lesson_id' => 'required',
        'day_id' => 'required',
        'start' => 'required',
        'end' => 'required',
        'cabinet' => 'required'
    ];

    public static function getTeacherSchedule($id,$schedule){
        $active = Semester::where("current",1)->first();
        if($active){
            $schedules = Shedule::where(["teacher_id"=>$id,"semester_id"=>$active->id])->orderBy("start","ASC")->get();
            if(count($schedules)>0){
                if($schedule){
                    $timetable = [];
                    foreach ($schedules as $schedule){
                        $timetable[$schedule->day_id][] = "<b>{$schedule->start}-{$schedule->end} </b>" ."<br>{$schedule->subjects->title}"   .  "<br>{$schedule->groups->title} <br>{$schedule->lessons->title}" . "(". $schedule->cabinet .")";
                    }
                    return $timetable;
                }
                else{
                    $subjectIds = array_keys(Shedule::where(["teacher_id"=>$id,"semester_id"=>$active->id])->pluck("id","subject_id")->all());
                    $groupIds = array_keys(Shedule::where(["teacher_id"=>$id,"semester_id"=>$active->id])->pluck("id","group_id")->all());
                    $examschedules = ExamSchedule::where("semester_id",$active->id)->where("type_id","!=",3)->whereIn("subject_id",$subjectIds)->whereIn("group_id",$groupIds)->orderBy("start")->get();
                    if(count($examschedules)>0){
                        return $examschedules;
                    }
                    else{
                        return [];
                    }

                }
            }
            else{
                return [];
            }

        }
        else{return [];}
    }

    public static  function getStudentSchedule($id,$schedule){
        $active = Semester::where("current",1)->first();
        if($active){
            $schedules = Shedule::where(["group_id"=>$id,"semester_id"=>$active->id])->orderBy("start","ASC")->get();
            if(count($schedules)>0){
                if($schedule){
                    $timetable = [];
                    foreach ($schedules as $schedule){
                        $timetable[$schedule->day_id][] = "<b>{$schedule->start}-{$schedule->end} </b>" ."<br>{$schedule->subjects->title}" ."<br>{$schedule->teachers->infos->lastName}  {$schedule->teachers->infos->firstName}  {$schedule->teachers->infos->middleName}"  .  "<br>{$schedule->groups->title} <br>{$schedule->lessons->title}" . "(". $schedule->cabinet .")";
                    }
                    return $timetable;
                }
                else{
                    $subjectIds = array_keys(Shedule::where(["group_id"=>$id,"semester_id"=>$active->id])->pluck("id","subject_id")->all());
                    $groupIds = array_keys(Shedule::where(["group_id"=>$id,"semester_id"=>$active->id])->pluck("id","group_id")->all());
                    $examschedules = ExamSchedule::where("semester_id",$active->id)->whereIn("subject_id",$subjectIds)->whereIn("group_id",$groupIds)->orderBy("start")->get();
                    if(count($examschedules)>0){
                        return $examschedules;
                    }
                    else{
                        return [];
                    }

                }
            }
            else{
                return [];
            }

        }
        else{return [];}
    }
}
