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
        'first_rating_week',
        'first_rating',
        'second_rating_week',
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
                    <th>1н</th>
                    <th>2н</th>
                    <th>3н</th>
                    <th>4н</th>
                    <th>5н</th>
                    <th>6н</th>
                    <th>7н</th>
                    <th>1н</th>
                    <th>2н</th>
                    <th>3н</th>
                    <th>4н</th>
                    <th>5н</th>
                    <th>6н</th>
                    <th>7н</th>
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
                            foreach (json_decode($student_assignment->first_rating_week,1) as $item) {
                                $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\"  value=\"$item\"></td>";
                            }
                            foreach (json_decode($student_assignment->second_rating_week,1) as $item) {
                                $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\" value=\"$item\"></td>";
                            }
                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][exam_rating]\"  value=\"$student_assignment->exam_rating\"></td>";
                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][total_rating]\"  value=\"$student_assignment->total_rating\"disabled></td>";
                            $str.="</tr>";
                        }
                        else{
                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][student]\"  value=\"$student->login\" disabled placeholder=\"$student->login\"></td>";
                            $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\"  value=0></td>";
                            $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\"  value=0></td>";
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
                    <th>1н</th>
                    <th>2н</th>
                    <th>3н</th>
                    <th>4н</th>
                    <th>5н</th>
                    <th>6н</th>
                    <th>7н</th>
                    <th>Общий рейтинг</th>
                    </tr>
                    </thead>
                    <tbody>";
                    if ($semester->step == 0){
                        $str .= "<td>Доступ закрыт!</td>";
                    } else {
                        if(!in_array(3,$lesson_types)){
                            foreach ($students as $key => $student){
                                $str .="<tr>";
                                $student_assignment = Assignment::where(["semester_id" => $request['semesterId'], "group_id" => $request['groupId'], "subject_id" => $request['subjectId'], "student_id"=>$student->id])->first();
                                // if student assignment exists
                                if($student_assignment){

                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][student]\"  value=\"$student->login\" disabled placeholder=\"$student->login\"></td>";
                                    //first step
                                    if($semester->step == 1){

                                        if($student_assignment->first_rating_week == null) {
                                            //if teacher has lesson and practice
                                            $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\" min='0' max='100'></td>";
                                            $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\" min='0' max='100'></td>";
                                            $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\" min='0' max='100'></td>";
                                            $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\" min='0' max='100'></td>";
                                            $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\" min='0' max='100'></td>";
                                            $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\" min='0' max='100'></td>";
                                            $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\" min='0' max='100'></td>";
                                        }
                                        //if student has and practice and lection rating!
                                        else{
                                            foreach (json_decode($student_assignment->first_rating_week, 1) as $item) {
                                                $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\"  value=\"$item\" disabled></td>";
                                            }
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_rating]\"  value=\"$student_assignment->first_rating\" disabled></td>";
                                        }


                                    }
                                    //second step
                                    if($semester->step == 2){
                                        if($student_assignment->second_rating_week == null) {
                                            //if teacher has lesson and practice
                                            $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\" value='0' min='0' max='100'></td>";
                                            $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\" value='0' min='0' max='100'></td>";
                                            $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\" value='0' min='0' max='100'></td>";
                                            $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\" value='0' min='0' max='100'></td>";
                                            $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\" value='0' min='0' max='100'></td>";
                                            $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\" value='0' min='0' max='100'></td>";
                                            $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\" value='0' min='0' max='100'></td>";
                                        }
                                        //if student has and practice and lection rating!
                                        else{
                                            foreach (json_decode($student_assignment->second_rating_week, 1) as $item) {
                                                $str .= "<td><input type='text' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\"  value=\"$item\" disabled></td>";
                                            }
                                            $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][first_rating]\"  value=\"$student_assignment->second_rating\" disabled></td>";
                                        }

                                    }

                                    $str.="</tr>";


                                }
                                //if student assignment doesnt exist
                                else{
                                    $str .= "<td><input type='text' class='form-control' name=\"rating[$student->id][student]\"  value=\"$student->login\" disabled placeholder=\"$student->login\"></td>";
                                    if($semester->step == 1){
                                        $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\" value='0' min='0' max='100'></td>";
                                        $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\" value='0' min='0' max='100'></td>";
                                        $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\" value='0' min='0' max='100'></td>";
                                        $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\" value='0' min='0' max='100'></td>";
                                        $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\" value='0' min='0' max='100'></td>";
                                        $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\" value='0' min='0' max='100'></td>";
                                        $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][first_rating_week][]\" value='0' min='0' max='100'></td>";
                                    }
                                    if($semester->step == 2){
                                        $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\" value='0' min='0' max='100'></td>";
                                        $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\" value='0' min='0' max='100'></td>";
                                        $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\" value='0' min='0' max='100'></td>";
                                        $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\" value='0' min='0' max='100'></td>";
                                        $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\" value='0' min='0' max='100'></td>";
                                        $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\" value='0' min='0' max='100'></td>";
                                        $str .= "<td><input type='number' class='form-control validation-number' name=\"rating[$student->id][second_rating_week][]\" value='0' min='0' max='100'></td>";
                                    }

                                    $str.="</tr>";
                                }

                            }
                        } else {
                            $str .= "<td>Недостаточно прав!</td>";
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
//        dd($ratings);
        if(isset($ratings)){
            foreach ($ratings as $key =>$value){
                $student = Assignment::where(["semester_id" => $semester_id, "group_id" => $group_id, "subject_id" => $subject_id, "student_id"=>$key])->first();
                $first_rating = [];
                $first_rating_week = [];
                if (!empty($value['first_rating_week'])){
                    $first_rating = round(array_sum($value['first_rating_week'])/7 * 0.3);
                    $first_rating_week = json_encode($value['first_rating_week']);
                }
                else{
                    $first_rating = 0;
                    $first_rating_week = json_encode([0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0]);
                }
                $second_rating = [];
                $second_rating_week = [];
                if (!empty($value['second_rating_week'])){
                    $second_rating = round(array_sum($value['second_rating_week'])/7 * 0.3);
                    $second_rating_week = json_encode($value['second_rating_week']);
                }
                else{
                    $second_rating = 0;
                    $second_rating_week = json_encode([0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0]);
                }

                if($value["exam_rating"] < 0 || !is_numeric($value["exam_rating"]) || $value["exam_rating"] === null){
                    $value["exam_rating"] = 0;
                }
                if($value["exam_rating"]>40){
                    $value["exam_rating"] = 40;
                }

                if(isset($first_rating) && isset($second_rating) && isset($value["exam_rating"])){
                    $value["total_rating"] = $first_rating + $second_rating + $value["exam_rating"];
                }

                if(Auth::user()->role_id == 1){
                    if($student){
                        $student->first_rating = $first_rating;
                        $student->first_rating_week = $first_rating_week;
                        $student->second_rating = $second_rating;
                        $student->second_rating_week = $second_rating_week;
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
                        $studentIndex["first_rating"] = $first_rating;
                        $studentIndex["first_rating_week"] = $first_rating_week;
                        $studentIndex["second_rating"] = $second_rating;
                        $studentIndex["second_rating_week"] = $second_rating_week;
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
                    $first_rating = [];
                    $first_rating_week = [];
                    if (!empty($value['first_rating_week'])){
                        $first_rating = round(array_sum($value['first_rating_week'])/7 * 0.3);
                        $first_rating_week = json_encode($value['first_rating_week']);
                    }
                    else{
                        $first_rating = 0;
                        $first_rating_week = json_encode([0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0]);
                    }
                    $second_rating = [];
                    $second_rating_week = [];
                    if (!empty($value['second_rating_week'])){
                        $second_rating = round(array_sum($value['second_rating_week'])/7 * 0.3);
                        $second_rating_week = json_encode($value['second_rating_week']);
                    }
                    else{
                        $second_rating = 0;
                        $second_rating_week = json_encode([0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0]);
                    }
                    //first step
                    if($semester->step == 1){
                        if($student){
                            if($student->first_rating_week == null) {
                                $student->first_rating = $first_rating;
                                $student->first_rating_week = $first_rating_week;
                                $student->total_rating = $first_rating;
                                $student->save();
                            }
                        }
                        else{
                            $assignment = new static();
                            $studentIndex=[];
                            $studentIndex["semester_id"] = $semester_id;
                            $studentIndex["group_id"] = $group_id;
                            $studentIndex["subject_id"] = $subject_id;
                            $studentIndex["teacher_id"] = $teacher_id;
                            $studentIndex["student_id"] = $key;
                            $studentIndex["first_rating"] = $first_rating;
                            $studentIndex["first_rating_week"] = $first_rating_week;
                            $studentIndex["total_rating"] = $first_rating;
                            $assignment->fill($studentIndex);
                            $assignment->save();

                        }
                    }



                    //second step
                    if($semester->step == 2){
                        if($student){
                            if($student->second_rating_week == null) {
                                $student->second_rating = $second_rating;
                                $student->second_rating_week = $second_rating_week;
                                $student->total_rating = $student->first_rating + $second_rating;
                                $student->save();
                            }
                        }
                        else{
                            $assignment = new static();
                            $studentIndex=[];
                            $studentIndex["semester_id"] = $semester_id;
                            $studentIndex["group_id"] = $group_id;
                            $studentIndex["subject_id"] = $subject_id;
                            $studentIndex["teacher_id"] = $teacher_id;
                            $studentIndex["student_id"] = $key;
                            $studentIndex["second_rating"] = $second_rating;
                            $studentIndex["second_rating_week"] = $second_rating_week;
                            $studentIndex["total_rating"] = $assignment->first_rating + $second_rating;
                            $assignment->fill($studentIndex);
                            $assignment->save();

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
