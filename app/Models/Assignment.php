<?php

namespace App\Models;

use App\Models\User;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * Class Assignment
 * @package App\Models
 * @version February 29, 2020, 7:16 am UTC
 *
 * @property string semester_id
 * @property string group_id
 * @property string subject_id
 * @property string teacher_id
 * @property string student_id
 * @property string first_rating
 * @property string second_rating
 * @property string exam_rating
 * @property string total_rating
 */
class Assignment extends Model
{
    use SoftDeletes;

    public $table = 'assignments';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public function semester(){
        return $this->belongsTo(Semester::class,"semester_id");
    }
    public function group(){
        return $this->belongsTo(Group::class,"group_id");
    }
    public function subject(){
        return $this->belongsTo(Subject::class,"subject_id");
    }
    public function teacher(){
        return $this->belongsTo(User::class,"teacher_id");
    }
    public function student(){
        return $this->belongsTo(User::class,"student_id");
    }


    public $fillable = [
        'semester_id',
        'group_id',
        'subject_id',
        'teacher_id',
        'student_id',
        'first_lection',
        'first_practice',
        'first_rating',
        'second_lection',
        'second_practice',
        'second_rating',
        'exam_rating',
        'total_rating'
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
        'subject_id' => 'string',
        'teacher_id' => 'string',
        'student_id' => 'string',
        'first_rating' => 'string',
        'second_rating' => 'string',
        'exam_rating' => 'string',
        'total_rating' => 'string'
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
        'teacher_id' => 'required',
        'student_id' => 'required',
        'first_rating' => 'required',
        'second_rating' => 'required',
        'exam_rating' => 'required',
        'total_rating' => 'required'
    ];

    public static function filterData($request)
    {
        if (isset($request['semester'])) {
            if(Auth::user()->role_id == 1){
                $shedules = Shedule::where('semester_id', $request['semester'])->pluck("id", 'group_id')->all();
            }
            if(Auth::user()->role_id == 4){
                $shedules = Shedule::where(["semester_id" => $request['semester'],"teacher_id" => Auth::id()])->pluck("id", 'group_id')->all();
            }
//            $shedules = Shedule::where('semester_id', $request['semester'])->pluck("id", 'group_id')->all();
            $groups = [];
            $i = 0;
            foreach ($shedules as $k => $v) {
                $groups[$i] = $k;
                $i++;
            }
            $data = [];
            $i = 0;
            foreach ($groups as $group) {
                $data[$i] = Group::where('id', $group)->pluck('title', 'id')->all();
                $i++;
            }
            if ($data) {
                $return = "<option value=".null.">Выберите группу</option>";
                foreach ($data as $item) {
                    foreach ($item as $k => $v) {
                        $return .= "<option value='{$k}'>{$v}</option>";
                    }
                }
                return $return;
            } else {
                $return = "<option value=".null.">Нет группы</option>";
                return $return;
            }
        }
        if (isset($request['group'])) {
            if(Auth::user()->role_id == 1){
                $shedules = Shedule::where(['group_id' => $request['group'], 'semester_id' => $request['semesterId']])->pluck('id', 'subject_id')->all();
            }
            if(Auth::user()->role_id == 4){
                $shedules = Shedule::where(["semester_id" => $request['semesterId'], "group_id" => $request['group'],"teacher_id"=>Auth::id()])->pluck('id', 'subject_id')->all();
            }
//            $shedules = Shedule::where(['group_id' => $request['group'], 'semester_id' => $request['semesterId']])->pluck('id', 'subject_id')->all();
            $subjects = [];
            $i = 0;
            foreach ($shedules as $k => $v) {
                $subjects[$i] = $k;
                $i++;
            }
            $data = [];
            $i = 0;
            foreach ($subjects as $subject) {
                $data[$i] = Subject::where('id', $subject)->pluck('title', 'id')->all();
                $i++;
            }
            if ($data) {
                $return = "<option value=".null.">Выберите дисциплину</option>";
                foreach ($data as $item) {
                    foreach ($item as $k => $v) {
                        $return .= "<option value='{$k}'>{$v}</option>";
                    }
                }
                return $return;
            } else {
                $return = "<option value=".null.">Отсутсвует дисциплина</option>";
                return $return;
            }
        }
        if (isset($request['subject'])) {
            if (Auth::user()->role_id == 1){
                $shedules = Shedule::where(['group_id' => $request['groupId'], 'semester_id' => $request['semesterId'], 'subject_id' => $request['subject']])->pluck('id', 'teacher_id')->all();
            }
            if (Auth::user()->role_id == 4){
                $shedules = Shedule::where(['group_id' => $request['groupId'], 'semester_id' => $request['semesterId'], 'subject_id' => $request['subject'], 'teacher_id' => Auth::id()])->pluck('id', 'teacher_id')->all();
            }
            $teachers = [];
            $i = 0;
            foreach ($shedules as $k => $v) {
                $teachers[$i] = $k;
                $i++;
            }
            $data = [];
            $i = 0;
            foreach ($teachers as $teacher) {
                $data[$i] = User::where('id', $teacher)->pluck('login', 'id')->all();
                $i++;
            }
            if ($data) {
                $return = "<option value=".null.">Выберите препода</option>";
                foreach ($data as $item) {
                    foreach ($item as $k => $v) {
                        $return .= "<option value='{$k}'>{$v}</option>";
                    }
                }
                return $return;
            } else {
                $return = "<option value=".null.">Нет препода</option>";
                return $return;
            }
        }
        if (isset($request['teacher'])) {
            if(Auth::user()->role_id == 1){
                $shedules = Shedule::where(["semester_id" => $request['semesterId'], "group_id" => $request['groupId'], "subject_id" => $request['subjectId']])->first();
            }
            if(Auth::user()->role_id == 4){
                $shedules = Shedule::where(["semester_id" => $request['semesterId'], "group_id" => $request['groupId'], "subject_id" => $request['subjectId']])->first();
                $lesson_types = array_keys(Shedule::where(["semester_id" => $request['semesterId'], "group_id" => $request['groupId'], "subject_id" => $request['subjectId'],"teacher_id"=>Auth::id()])->pluck("id","lesson_id")->all());
                $semester = Semester::find($request['semesterId']);
            }
//            $shedules = Shedule::where(['group_id' => $request['groupId'], 'semester_id' => $request['semesterId'], 'subject_id' => $request['subjectId']])->pluck('id', 'group_id')->all();
            $students = User::where("group_id", $request['groupId'])->get();

            if(count($students) > 0){
                if(Auth::user()->role_id == 1){
                    $str = "";
                    $str .= "<thead>
                    <tr>
                    <th>ФИО</th>
                    <th>1 рубежка</th>
                    <th>2 рубежка</th>
                    <th>Экзамен</th>
                    <th>Общий рейтинг</th>
                    </tr>
                    </thead>
                    <tbody>";
                    foreach ($students as $key => $student){
                        $str .="<tr>";
                        $student_assignment = Assignment::where(["semester_id" => $request['semesterId'], "group_id" => $request['groupId'], "subject_id" => $request['subjectId'], "student_id"=>$student->id])->first();
                        if($student_assignment){
                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][student]\"  value=\"$student->login\" disabled placeholder=\"$student->login\"></td>";
                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_rating]\"  value=\"$student_assignment->first_rating\"></td>";
                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_rating]\" value=\"$student_assignment->second_rating\"></td>";
                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][exam_rating]\"  value=\"$student_assignment->exam_rating\"></td>";
                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][total_rating]\"  value=\"$student_assignment->total_rating\"disabled></td>";
                            $str.="</tr>";
                        }
                        else{
                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][student]\"  value=\"$student->login\" disabled placeholder=\"$student->login\"></td>";
                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_rating]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_rating]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][exam_rating]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][total_rating]\"  value=0 disabled></td>";
                            $str.="</tr>";
                        }


                    }
                    $str .="</tbody>";
                    return $str;

                }
                if(Auth::user()->role_id == 4){
                    $str = "";
                    $str .= "<thead>
                    <tr>
                    <th>ФИО</th>
                    <th>Лекционные занятия 18 из 30(60%)</th>
                    <th>Практические занятия 12 из 30(40%)</th>
                    <th>Общий рейтинг</th>
                    </tr>
                    </thead>
                    <tbody>";
                    foreach ($students as $key => $student){
                        $str .="<tr>";
                        $student_assignment = Assignment::where(["semester_id" => $request['semesterId'], "group_id" => $request['groupId'], "subject_id" => $request['subjectId'], "student_id"=>$student->id])->first();
                        // if student assignment exists
                        if($student_assignment){
                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][student]\"  value=\"$student->login\" disabled placeholder=\"$student->login\"></td>";
                            //first step
                            if($semester->step == 1){
                                if($student_assignment->first_lection == null || $student_assignment->first_practice == null) {
                                    //if teacher has lesson and practice
                                    if(in_array(1,$lesson_types) && in_array(2,$lesson_types)){
                                        if($student_assignment->first_lection == null){
                                            $str .= "<td><input type='number' class='form-control' name=\"rating[$student->id][first_lection]\"  value=\"$student_assignment->first_lection\"  max='18' min='0'></td>";
                                        }
                                        else{
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_lection]\"  value=\"$student_assignment->first_lection\" disabled></td>";
                                        }
                                        if($student_assignment->first_practice == null){
                                            $str .= "<td><input type='number' class='form-control' name=\"rating[$student->id][first_practice]\"  value=\"$student_assignment->first_practice\"  max='12' min='0'></td>";
                                        }
                                        else{
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_practice]\"  value=\"$student_assignment->first_practice\" disabled></td>";
                                        }
                                    }
                                    //if teacher has only lesson
                                    if(in_array(1,$lesson_types) && !in_array(2,$lesson_types)){
                                        if($student_assignment->first_lection == null){
                                            $str .= "<td><input type='number' class='form-control' name=\"rating[$student->id][first_lection]\"  value=\"$student_assignment->first_lection\"  max='18' min='0'></td>";
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_practice]\"  value=\"$student_assignment->first_practice\" disabled></td>";

                                        }
                                        else{
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_lection]\"  value=\"$student_assignment->first_lection\" disabled></td>";
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_practice]\"  value=\"$student_assignment->first_practice\" disabled></td>";

                                        }
                                    }
                                    //if teacher has only practice
                                    if(!in_array(1,$lesson_types) && in_array(2,$lesson_types)){
                                        if($student_assignment->first_practice == null){
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_lection]\"  value=\"$student_assignment->first_lection\" disabled></td>";
                                            $str .= "<td><input type='number' class='form-control' name=\"rating[$student->id][first_practice]\"  value=\"$student_assignment->first_practice\"  max='12' min='0'></td>";
                                        }
                                        else{
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_lection]\"  value=\"$student_assignment->first_lection\" disabled></td>";
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_practice]\"  value=\"$student_assignment->first_practice\" disabled></td>";
                                        }
                                    }
                                }
                                //if student has and practice and lection rating!
                                else{
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_lection]\"  value=\"$student_assignment->first_lection\" disabled></td>";
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_practice]\"  value=\"$student_assignment->first_practice\" disabled></td>";
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_rating]\"  value=\"$student_assignment->first_rating\" disabled></td>";
                                }
                            }
                            //second step
                            if($semester->step == 2){
                                if($student_assignment->second_lection == null || $student_assignment->second_practice == null){
                                    //if teacher has lesson and practice
                                    if(in_array(1,$lesson_types) && in_array(2,$lesson_types)){
                                        if($student_assignment->second_lection == null){
                                            $str .= "<td><input type='number' class='form-control' name=\"rating[$student->id][second_lection]\"  value=\"$student_assignment->second_lection\"  max='18' min='0'></td>";
                                        }
                                        else{
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_lection]\"  value=\"$student_assignment->second_lection\" disabled></td>";
                                        }
                                        if($student_assignment->second_practice == null){
                                            $str .= "<td><input type='number' class='form-control' name=\"rating[$student->id][second_practice]\"  value=\"$student_assignment->second_practice\"  max='12' min='0'></td>";
                                        }
                                        else{
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_practice]\"  value=\"$student_assignment->second_practice\" disabled></td>";
                                        }
                                    }
                                    //if teacher has only lesson
                                    if(in_array(1,$lesson_types) && !in_array(2,$lesson_types)){
                                        if($student_assignment->second_lection == null){
                                            $str .= "<td><input type='number' class='form-control' name=\"rating[$student->id][second_lection]\"  value=\"$student_assignment->second_lection\"  max='18' min='0'></td>";
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_practice]\"  value=\"$student_assignment->second_practice\" disabled></td>";
                                        }
                                        else{
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_lection]\"  value=\"$student_assignment->second_lection\" disabled></td>";
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_practice]\"  value=\"$student_assignment->second_practice\" disabled></td>";

                                        }
                                    }
                                    //if teacher has only practice
                                    if(!in_array(1,$lesson_types) && in_array(2,$lesson_types)){
                                        if($student_assignment->second_practice == null){
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_lection]\"  value=\"$student_assignment->second_lection\" disabled></td>";
                                            $str .= "<td><input type='number' class='form-control' name=\"rating[$student->id][second_practice]\"  value=\"$student_assignment->second_practice\"  max='12' min='0'></td>";
                                        }
                                        else{
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_lection]\"  value=\"$student_assignment->second_lection\" disabled></td>";
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_practice]\"  value=\"$student_assignment->second_practice\" disabled></td>";
                                        }
                                    }

                                }
                                //if student has assignment for second rating
                                //if student has and practice and lection rating!
                                else{
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_lection]\"  value=\"$student_assignment->second_lection\" disabled></td>";
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_practice]\"  value=\"$student_assignment->second_practice\" disabled></td>";
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_rating]\"  value=\"$student_assignment->second_rating\" disabled></td>";
                                }

                            }
                            $str.="</tr>";
                        }
                        //if student assignment doesnt exist
                        else{
                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][student]\"  value=\"$student->login\" disabled placeholder=\"$student->login\"></td>";
                            if($semester->step == 1){
                                if(in_array(1,$lesson_types) && in_array(2,$lesson_types)){
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_lection]\"  value=0 max='18' min='0'></td>";
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_practice]\"  value=0 max='12' min='0'></td>";
                                }
                                //if teacher has only lesson
                                if(in_array(1,$lesson_types) && !in_array(2,$lesson_types)){
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_lection]\"  value= 0  max='18' min='0'></td>";
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_practice]\"  disabled ></td>";
                                }
                                //if teacher has only practice
                                if(!in_array(1,$lesson_types) && in_array(2,$lesson_types)){
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_lection]\"  disabled></td>";
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_practice]\"  value=0  max='12' min='0'></td>";
                                }


                            }
                            if($semester->step == 2){
                                if(in_array(1,$lesson_types) && in_array(2,$lesson_types)){
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_lection]\"  value=0  max='18' min='0'></td>";
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_practice]\"  value=0  max='12' min='0'></td>";
                                }
                                //if teacher has only lesson
                                if(in_array(1,$lesson_types) && !in_array(2,$lesson_types)){
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_lection]\"  value= 0  max='18' min='0'></td>";
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_practice]\"  value=0 disabled  max='12' min='0'></td>";
                                }
                                //if teacher has only practice
                                if(!in_array(1,$lesson_types) && in_array(2,$lesson_types)){
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_lection]\"  disabled  max='18' min='0'></td>";
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][second_practice]\"  value=0  max='12' min='0'></td>";
                                }

                            }

                            $str.="</tr>";
                        }


                    }
                    $str .="</tbody>";
                    return $str;
                }
            }else {
                $str = "<p>Студенты не найдены</p>";
                return $str;
            }
        }
    }

    public static function makeData($request){
        $semester_id = $request->get("semester_id");
        $group_id = $request->get("group_id");
        $subject_id = $request->get("subject_id");
        $teacher_id = $request->get("teacher_id");
        $ratings = $request->get("rating");
        if(isset($ratings)){
            foreach ($ratings as $key =>$value){
                $student = Assignment::where(["semester_id" => $semester_id, "group_id" => $group_id, "subject_id" => $subject_id, "student_id"=>$key])->first();

                if($value["first_rating"]<0 || !is_numeric($value["first_rating"]) || $value["first_rating"] === null){
                    $value["first_rating"] = 0;
                    $value["first_lection"] = 0;
                    $value["first_practice"] = 0;
                }
                if($value["first_rating"]>30){
                    $value["first_rating"] = 30;
                    $value["first_lection"] = 18;
                    $value["first_practice"] = 12;
                }
                else{
                    $value["first_lection"] = round($value["first_rating"]/100 * 60) ;
                    $value["first_practice"] =  $value["first_rating"] -  $value["first_lection"];

                }


                if($value["second_rating"] < 0 || !is_numeric($value["second_rating"]) || $value["second_rating"] === null){
                    $value["second_rating"] = 0;
                    $value["second_lection"] = 0;
                    $value["second_practice"] = 0;
                }
                if($value["second_rating"]>30){
                    $value["second_rating"] = 30;
                    $value["second_lection"] = 18;
                    $value["second_practice"] = 12;
                }
                else{
                    $value["second_lection"] = round($value["second_rating"]/100 * 60) ;
                    $value["second_practice"] =  $value["second_rating"] -  $value["second_lection"];
                }


                if($value["exam_rating"] < 0 || !is_numeric($value["exam_rating"]) || $value["exam_rating"] === null){
                    $value["exam_rating"] = 0;
                }
                if($value["exam_rating"]>40){
                    $value["exam_rating"] = 40;
                }

                if(isset($value["first_rating"]) && isset($value["second_rating"]) && isset($value["exam_rating"])){
                    $value["total_rating"] = $value["first_rating"] + $value["second_rating"] + $value["exam_rating"];
                }
                if(Auth::user()->role_id == 1){
                    if($student){
                        $student->first_lection = $value["first_lection"];
                        $student->first_practice = $value["first_practice"];
                        $student->first_rating = $value["first_rating"];
                        $student->second_lection = $value["second_lection"];
                        $student->second_practice = $value["second_practice"];
                        $student->second_rating = $value["second_rating"];
                        $student->exam_rating = $value["exam_rating"];
                        $student->total_rating = $value["total_rating"];
                        $student->teacher_id = $teacher_id;
                        $student->save();
                    }
                    else{
                        $assignment = new static();
                        $studentIndex=[];
                        $studentIndex["semester_id"] = $semester_id;
                        $studentIndex["group_id"] = $group_id;
                        $studentIndex["subject_id"] = $subject_id;
                        $studentIndex["teacher_id"] = $teacher_id;
                        $studentIndex["student_id"] = $key;
                        $studentIndex["first_lection"] = $value["first_lection"];
                        $studentIndex["first_practice"] = $value["first_practice"];
                        $studentIndex["first_rating"] = $value["first_rating"];
                        $studentIndex["second_lection"] = $value["second_lection"];
                        $studentIndex["second_practice"] = $value["second_practice"];
                        $studentIndex["second_rating"] = $value["second_rating"];
                        $studentIndex["exam_rating"] = $value["exam_rating"];
                        $studentIndex["total_rating"] = $value["total_rating"];
                        $assignment->fill($studentIndex);
                        $assignment->save();
                    }
                }
            }
        }

    }


    public static function makeTeacherData($request){
        $semester_id = $request->get("semester_id");
        $group_id = $request->get("group_id");
        $subject_id = $request->get("subject_id");
        $teacher_id = $request->get("teacher_id");
        $ratings = $request->get("rating");
        $lessonTypes = array_values(Shedule::where(["semester_id"=>$semester_id,"subject_id"=>$subject_id,"group_id"=>$group_id,"teacher_id"=>$teacher_id])->pluck("lesson_id","lesson_id")->all());
        $semester = Semester::where(["id"=>$semester_id,"current"=>1])->first();
        if($ratings && $semester){
            if(count($ratings)>0){
                foreach ($ratings as $key => $value){
                    $student = Assignment::where(["semester_id" => $semester_id, "group_id" => $group_id, "subject_id" => $subject_id, "student_id"=>$key])->first();
                    //first step
                    if($semester->step == 1){
                        if($student){
                            if(in_array(1,$lessonTypes) && in_array(2,$lessonTypes)){
                                if($student->first_lection == null && $student->first_practice == null) {
                                    $student->first_lection = $value["first_lection"];
                                    $student->first_practice = $value["first_practice"];
                                    $student->first_rating = $value["first_lection"] + $value["first_practice"];
                                    $student->total_rating += $student->first_rating;
                                    $student->save();
                                }
                            }
                            if(in_array(1,$lessonTypes) && !in_array(2,$lessonTypes)){
                                if($student->first_lection == null) {
                                    $student->first_lection = $value["first_lection"];
                                    $student->first_rating = $value["first_lection"] + $student->first_practice;
                                    $student->total_rating += $value["first_lection"];
                                    $student->save();
                                }
                            }
                            if(!in_array(1,$lessonTypes) && in_array(2,$lessonTypes)){
                                if($student->first_practice == null) {
                                    $student->first_practice = $value["first_practice"];
                                    $student->first_rating = $value["first_practice"] + $student->first_lection;
                                    $student->total_rating += $value["first_practice"];
                                    $student->save();
                                }
                            }
                        }
                        else{
                            if(in_array(1,$lessonTypes) && in_array(2,$lessonTypes)){
                                $assignment = new static();
                                $studentIndex=[];
                                $studentIndex["semester_id"] = $semester_id;
                                $studentIndex["group_id"] = $group_id;
                                $studentIndex["subject_id"] = $subject_id;
                                $studentIndex["teacher_id"] = $teacher_id;
                                $studentIndex["student_id"] = $key;
                                $studentIndex["first_lection"] = $value["first_lection"];
                                $studentIndex["first_practice"] = $value["first_practice"];
                                $studentIndex["first_rating"] = $value["first_lection"] +  $value["first_practice"];
                                $studentIndex["total_rating"] = $studentIndex["first_rating"];
                                $assignment->fill($studentIndex);
                                $assignment->save();

                            }
                            //if teacher has only lection
                            if(in_array(1,$lessonTypes) && !in_array(2,$lessonTypes)){
                                $assignment = new static();
                                $studentIndex=[];
                                $studentIndex["semester_id"] = $semester_id;
                                $studentIndex["group_id"] = $group_id;
                                $studentIndex["subject_id"] = $subject_id;
                                $studentIndex["teacher_id"] = $teacher_id;
                                $studentIndex["student_id"] = $key;
                                $studentIndex["first_lection"] = $value["first_lection"];
                                $studentIndex["first_rating"] = $value["first_lection"];
                                $studentIndex["total_rating"] = $studentIndex["first_rating"];
                                $assignment->fill($studentIndex);
                                $assignment->save();
                            }
                            //if teacher has only practice
                            if(!in_array(1,$lessonTypes) && in_array(2,$lessonTypes)){
                                $assignment = new static();
                                $studentIndex=[];
                                $studentIndex["semester_id"] = $semester_id;
                                $studentIndex["group_id"] = $group_id;
                                $studentIndex["subject_id"] = $subject_id;
                                $studentIndex["teacher_id"] = $teacher_id;
                                $studentIndex["student_id"] = $key;
                                $studentIndex["first_practice"] = $value["first_practice"];
                                $studentIndex["first_rating"] = $value["first_practice"];
                                $studentIndex["total_rating"] = $studentIndex["first_rating"];
                                $assignment->fill($studentIndex);
                                $assignment->save();
                            }
                        }

                    }
                    //second step
                    if($semester->step == 2){
                        if($student){
                            if(in_array(1,$lessonTypes) && in_array(2,$lessonTypes)){
                                if($student->second_lection == null && $student->second_practice == null){
                                    $student->second_lection = $value["second_lection"];
                                    $student->second_practice = $value["second_practice"];
                                    $student->second_rating = $value["second_lection"] + $value["second_practice"];
                                    $student->total_rating += $student->second_rating;
                                    $student->save();
                                }
                            }
                            if(in_array(1,$lessonTypes) && !in_array(2,$lessonTypes)){
                                if($student->second_lection == null) {
                                    $student->second_lection = $value["second_lection"];
                                    $student->second_rating = $value["second_lection"] + $student->second_practice;
                                    $student->total_rating += $value["second_lection"];
                                    $student->save();
                                }
                            }
                            if(!in_array(1,$lessonTypes) && in_array(2,$lessonTypes)){
                                if($student->second_practice == null) {
                                    $student->second_practice = $value["second_practice"];
                                    $student->second_rating = $value["second_practice"] + $student->second_lection;
                                    $student->total_rating += $value["second_practice"];
                                    $student->save();
                                }
                            }


                        }
                        else{
                            if(in_array(1,$lessonTypes) && in_array(2,$lessonTypes)){
                                $assignment = new static();
                                $studentIndex=[];
                                $studentIndex["semester_id"] = $semester_id;
                                $studentIndex["group_id"] = $group_id;
                                $studentIndex["subject_id"] = $subject_id;
                                $studentIndex["teacher_id"] = $teacher_id;
                                $studentIndex["student_id"] = $key;
                                $studentIndex["second_lection"] = $value["second_lection"];
                                $studentIndex["second_practice"] = $value["second_practice"];
                                $studentIndex["second_rating"] = $value["second_lection"] +  $value["second_practice"];
                                $studentIndex["total_rating"] = $studentIndex["second_rating"];
                                $assignment->fill($studentIndex);
                                $assignment->save();

                            }
                            //if teacher has only lection
                            if(in_array(1,$lessonTypes) && !in_array(2,$lessonTypes)){
                                $assignment = new static();
                                $studentIndex=[];
                                $studentIndex["semester_id"] = $semester_id;
                                $studentIndex["group_id"] = $group_id;
                                $studentIndex["subject_id"] = $subject_id;
                                $studentIndex["teacher_id"] = $teacher_id;
                                $studentIndex["student_id"] = $key;
                                $studentIndex["second_lection"] = $value["second_lection"];
                                $studentIndex["second_rating"] = $value["second_lection"];
                                $studentIndex["total_rating"] = $studentIndex["second_rating"];
                                $assignment->fill($studentIndex);
                                $assignment->save();
                            }
                            //if teacher has only practice
                            if(!in_array(1,$lessonTypes) && in_array(2,$lessonTypes)){
                                $assignment = new static();
                                $studentIndex=[];
                                $studentIndex["semester_id"] = $semester_id;
                                $studentIndex["group_id"] = $group_id;
                                $studentIndex["subject_id"] = $subject_id;
                                $studentIndex["teacher_id"] = $teacher_id;
                                $studentIndex["student_id"] = $key;
                                $studentIndex["second_practice"] = $value["second_practice"];
                                $studentIndex["second_rating"] = $value["second_practice"];
                                $studentIndex["total_rating"] = $studentIndex["second_rating"];
                                $assignment->fill($studentIndex);
                                $assignment->save();
                            }
                        }

                    }



                }
            }
        }

    }


    public static function getMark($schedule_id,$user_id,$total){
        $schedule = ExamSchedule::find($schedule_id);
        if($total>40){$total = 40;};
        if($total<0){$total = 0;};
        if($schedule){
            $assignment = Assignment::where(["semester_id"=>$schedule->semester_id,"subject_id"=>$schedule->subject_id,"group_id"=>$schedule->group_id,"student_id"=>$user_id])->first();

            if($assignment){
                if ($assignment->first_rating && $assignment->second_rating && ($assignment->exam_rating == null || $assignment->exam_rating == 0)){
                    $assignment->exam_rating = $total;
                    $assignment->total_rating += $total;
                    $assignment->save();
                }
            }
            else{
                return false;
            }
        }



    }

}
