<?php

namespace App;

use App\Models\Assignment;
use App\Models\Department;
use App\Models\ExamSchedule;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Semester;
use App\Models\Shedule;
use App\Models\SubjectList;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Transcript extends Model
{
    public static function filterData($request)
    {
        if (isset($request['faculty'])) {

            $departments = Department::where('faculty_id', $request['faculty'])->pluck('title', 'id')->all();

            if ($departments) {
                $return = "<option value=".null.">Выберите кафедру</option>";
                foreach ($departments as $k => $v) {
                        $return .= "<option value='{$k}'>{$v}</option>";
                }
                return $return;
            } else {
                $return = "<option value=".null.">Нет кафедры</option>";
                return $return;
            }
        }
        if (isset($request['department'])) {

            $groups = Group::where('department_id', $request['department'])->pluck('title', 'id')->all();
            if ($groups) {
                $return = "<option value=".null.">Выберите группу</option>";
                    foreach ($groups as $k => $v) {
                        $return .= "<option value='{$k}'>{$v}</option>";
                    }
                return $return;
            } else {
                $return = "<option value=".null.">Нет группы</option>";
                return $return;
            }
        }
        if (isset($request['student'])) {
            $students = User::where('group_id', $request['student'])->get();
            $data = [];
            $i = 0;
            foreach ($students as $student) {
                $data[$i][$student->id] = $student->infos->firstName.' '.$student->infos->lastName.' '.$student->infos->middleName;
                $i++;
            }
            if ($data) {
                $return = "<option value=".null.">Выберите студента</option>";
                foreach ($data as $item) {
                    foreach ($item as $k => $v) {
                        $return .= "<option value='{$k}'>{$v}</option>";
                    }
                }
                return $return;
            } else {
                $return = "<option value=".null.">Нет студентов</option>";
                return $return;
            }
        }

        if (isset($request['transcript'])) {

            $student = User::find($request['transcript']);
            $strRandom = rand(100000, 999999);
            Pns::add($student->id, $strRandom);
            $str = (string)$strRandom;
            $pns = substr($str, 0,-3);
            $return = "
                    $pns***
                    <table border='0' style='width: 100%'>
                        <tr>
                           <th>Аты-жөні/ФИО/Name</th>
                           <th class='text-right'>".$student->infos->firstName.' '.$student->infos->lastName.' '.$student->infos->middleName."</th>
                        </tr>
                        <tr>
                           <th>Факультеті/Факультет/Faculty</th>
                           <th class='text-right'>".$student->faculties->title."</th>
                        </tr>
                        <tr>
                           <th>Мамандығы/Специальность/Speciality</th>
                           <th class='text-right'>".$student->departments->code. '-' .$student->departments->speciality."</th>
                        </tr>
                        <tr>
                           <th>Түскен-жылы/Год поступления/Year</th>
                           <th class='text-right'>".$student->infos->date."</th>
                        </tr>
                        <tr>
                           <th>Оқу тілі/Язык/Language</th>
                           <th class='text-right'>".$student->groups->languages->title."</th>
                        </tr>
                    </table>
                    <table class='text-center' border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style='font-size: 12px;'>
                       <tr>
                        <th rowspan='2'>№</th>
                        <th rowspan='2'>Пәндердің аталуы/Наименование дисциплины/Courses</th>
                        <th rowspan='2'>Академиалық<br> кредиттердің<br> саны ECTS/<br>Количество<br> академических<br> кредитов<br> ECTS/Number<br> of academik ECTS</th>
                        <th colspan=\"4\">Баға / Оценка / Grade</th>
                       </tr>
                       <tr>
                        <th>Пайызбен/<br>В процентах/<br>In percent</th>
                        <th>Әріптік/<br>Буквенная/<br>Alphabetic</th>
                        <th>Баллмен/<br>В баллах/<br>In points</th>
                        <th>Дәстүрлі жүйе/<br>Традиционная/<br>Traditional</th>
                       </tr>";
            $subjectLists = SubjectList::where(['group_id' => $student->group_id, 'student_id' => $student->id])->get();
            if (count($subjectLists) > 0){
                $i = 1;
                foreach ($subjectLists as $subjectList){
                    $item = Assignment::where(['group_id' => $subjectList->group_id, 'semester_id' => $subjectList->semester_id, 'student_id' => $subjectList->student_id, 'subject_id' => $subjectList->subject_id])->first();
                    if ($item){
                        $credit = SubjectList::where(['group_id' => $item->group_id, 'semester_id' => $item->semester_id, 'student_id' => $item->student_id, 'subject_id' => $item->subject_id])->first();
                        $return .="<tr align=\"center\">";
                        $return .= "<td>".$i."</td>";
                        $return .= "<td>".$item->subject->title."</td>";
                        $return .= $credit ? "<td>".$credit->credits." / ".$credit->ECTS."</td>" : "<td>Нет</td>";
                        $return .= "<td>".$item->total_rating."</td>";
                        $return .= "<td>";
                        if ($item->total_rating >= 95){$return .= 'A';}
                        if ($item->total_rating >= 90 and $item->total_rating <= 94){$return .= 'A-';}
                        if ($item->total_rating >= 85 and $item->total_rating <= 89){$return .= 'B+';}
                        if ($item->total_rating >= 80 and $item->total_rating <= 84){$return .= 'B';}
                        if ($item->total_rating >= 75 and $item->total_rating <= 79){$return .= 'B-';}
                        if ($item->total_rating >= 70 and $item->total_rating <= 74){$return .= 'C+';}
                        if ($item->total_rating >= 65 and $item->total_rating <= 69){$return .= 'C';}
                        if ($item->total_rating >= 60 and $item->total_rating <= 64){$return .= 'C-';}
                        if ($item->total_rating >= 55 and $item->total_rating <= 59){$return .= 'Д+';}
                        if ($item->total_rating >= 50 and $item->total_rating <= 54){$return .= 'Д';}
                        if ($item->total_rating >= 25 and $item->total_rating <= 49){$return .= 'FX';}
                        if ($item->total_rating >= 0 and $item->total_rating <= 24){$return .= 'F';}
                        $return .= "</td>";
                        $return .= "<td>";
                        if ($item->total_rating >= 95){$return .= '4.0';}
                        if ($item->total_rating >= 90 and $item->total_rating <= 94){$return .= '3.67';}
                        if ($item->total_rating >= 85 and $item->total_rating <= 89){$return .= '3.33';}
                        if ($item->total_rating >= 80 and $item->total_rating <= 84){$return .= '3.0';}
                        if ($item->total_rating >= 75 and $item->total_rating <= 79){$return .= '2.67';}
                        if ($item->total_rating >= 70 and $item->total_rating <= 74){$return .= '2.33';}
                        if ($item->total_rating >= 65 and $item->total_rating <= 69){$return .= '2.0';}
                        if ($item->total_rating >= 60 and $item->total_rating <= 64){$return .= '1.67';}
                        if ($item->total_rating >= 55 and $item->total_rating <= 59){$return .= '1.33';}
                        if ($item->total_rating >= 50 and $item->total_rating <= 54){$return .= '1.0';}
                        if ($item->total_rating >= 25 and $item->total_rating <= 49){$return .= '0.5';}
                        if ($item->total_rating >= 0 and $item->total_rating <= 24){$return .= '0';}
                        $return .= "</td>";
                        $return .= "<td>";
                        if ($item->total_rating >= 95){$return .= '5(отл)';}
                        if ($item->total_rating >= 90 and $item->total_rating <= 94){$return .= '5(отл)';}
                        if ($item->total_rating >= 85 and $item->total_rating <= 89){$return .= '4(хорошо)';}
                        if ($item->total_rating >= 80 and $item->total_rating <= 84){$return .= '4(хорошо)';}
                        if ($item->total_rating >= 75 and $item->total_rating <= 79){$return .= '4(хорошо)';}
                        if ($item->total_rating >= 70 and $item->total_rating <= 74){$return .= '4(хорошо)';}
                        if ($item->total_rating >= 65 and $item->total_rating <= 69){$return .= '3(удв)';}
                        if ($item->total_rating >= 60 and $item->total_rating <= 64){$return .= '3(удв)';}
                        if ($item->total_rating >= 55 and $item->total_rating <= 59){$return .= '3(удв)';}
                        if ($item->total_rating >= 50 and $item->total_rating <= 54){$return .= '3(удв)';}
                        if ($item->total_rating >= 25 and $item->total_rating <= 49){$return .= '2(не удв)';}
                        if ($item->total_rating >= 0 and $item->total_rating <= 24){$return .= '2(не удв)';}
                        $return .= "</td>";
                        $return.="</tr>";

                    } else {
                        $return .="<tr align=\"center\">";
                        $return .= "<td>".$i."</td>";
                        $return .= "<td>".$subjectList->subject->title."</td>";
                        $return .= "<td>".$subjectList->credits." / ".$subjectList->ECTS."</td>";
                        $return .= "<td>0</td>";
                        $return .= "<td>I</td>";
                        $return .= "<td>0</td>";
                        $return .= "<td>Дисциплина не завершена</td>";
                        $return.="</tr>";
                    }
                    $i++;
                }

                $return .= "</table>";
                $return .= "<hr>";
                $TIMA = [];
                foreach ($student->assignments as $assignment) {
                    $credit = SubjectList::where(['semester_id' => $assignment->semester_id, 'student_id' => $assignment->student_id])->get()->toArray();
                    $ball = [];
                    $i = 0;
                    if ($assignment['total_rating'] >= 95){$ball = 4.0;}
                    if ($assignment['total_rating'] >= 90 and $assignment['total_rating'] <= 94){$ball = 3.67;}
                    if ($assignment['total_rating'] >= 85 and $assignment['total_rating'] <= 89){$ball = 3.33;}
                    if ($assignment['total_rating'] >= 80 and $assignment['total_rating'] <= 84){$ball = 3.0;}
                    if ($assignment['total_rating'] >= 75 and $assignment['total_rating'] <= 79){$ball = 2.67;}
                    if ($assignment['total_rating'] >= 70 and $assignment['total_rating'] <= 74){$ball = 2.33;}
                    if ($assignment['total_rating'] >= 65 and $assignment['total_rating'] <= 69){$ball = 2.0;}
                    if ($assignment['total_rating'] >= 60 and $assignment['total_rating'] <= 64){$ball = 1.67;}
                    if ($assignment['total_rating'] >= 55 and $assignment['total_rating'] <= 59){$ball = 1.33;}
                    if ($assignment['total_rating'] >= 50 and $assignment['total_rating'] <= 54){$ball = 1.0;}
                    if ($assignment['total_rating'] >= 25 and $assignment['total_rating'] <= 49){$ball = 0.5;}
                    if ($assignment['total_rating'] >= 0 and $assignment['total_rating'] <= 24){$ball = 0;}
                    foreach ($credit as $item) {
                        $TIMA[$assignment->semester_id]['credits'][$i] = $item['credits'];
                        $TIMA[$assignment->semester_id]['ECTS'][$i] = $item['ECTS'];
                        $i++;
                    }
                    $TIMA[$assignment->semester_id]['GPA'][] = $ball;
                }
                $data = [];
                foreach ($TIMA as $k => $item){
                    $data[$k]['credits'] = array_sum($item['credits']);
                    $data[$k]['ECTS'] = array_sum($item['ECTS']);
                    $data[$k]['GPA'] = round(array_sum($item['GPA'])/count($item['GPA']), 2);
                }
                $return .= "<table border=\"1\" cellpadding=\"5\" width=\"70%\" style='margin: 0 auto;'>
                                <tr>
                                 <td colspan=\"3\" align='center'><b>Баллы GPA за промежуточные время</b></td>
                                </tr>
                                <tr align='center'>
                                 <td><b>Семестер</b></td>
                                 <td><b>GPA</b></td>
                                 <td><b>Академиалық кредиттердің саны<br> ECTS/<br>Количество академических кредитов<br> ECTS/<br>Number of academik ECTS</b></td>
                                </tr>";
                $totalCount = 0;
                $totalGPA = 0;
                $totalCredits = 0;
                $totalECTS = 0;
                foreach ($data as $k => $v) {
                    $k = Semester::find($k);
                    $totalGPA += $v['GPA'];
                    $totalCredits += $v['credits'];
                    $totalECTS += $v['ECTS'];
                    $totalCount++;
                    $return .= "<tr align='center'>";
                    $return .= "<td>".$k->title."</td>";
                    $return .= "<td>".$v['GPA']."</td>";
                    $return .= "<td>".$v['credits']. " / ". $v['ECTS']."</td>";
                    $return .= "</tr>";
                }
                $return .= "</table><hr>";
                $return .= "<p>Жалпы академиялық кредит саны ECTS/Общее число академических кредитов ECTS/Total Hours Passed ECTS: ".$totalCredits. " / ". $totalECTS."  GPA: ".$totalGPA/$totalCount."</p>";

                $return .= "<table border='0' style='width: 100%;border-spacing: 7px 11px;border-collapse: separate;'>";
                $return .= "
                                <tr>
                                    <td class='text-left'>Ректоры/Ректор/Rector</td>
                                    <td class='text-right'>__________________Қожамжарова Д.П.</td>
                                </tr>
                                <tr>
                                    <td class='text-left'>ТК Директоры/Директор ОР/Head of registration office</td>
                                    <td class='text-right'>__________________Сатымбекова К.Б.</td>
                                </tr>
                                <tr>
                                    <td class='text-left'>М.Ө.М.П</td>
                                    <td class='text-right'>Тіркеу №/Регистрационный №/Registration № _____</td>
                                </tr>
                                <tr>
                                    <td class='text-left'>___  __________ 20__</td>
                                    <td class='text-right'>Исполнитель ______________</td>
                                </tr>
                                </table><hr>
                            ";
                $return .= "
                                <p><b>Ескерту:</b> С+(2,33 жақсы) ҚР БжҒМ 12.10.2018ж . №563 бұйрығымен енгізілген</p>
                                <p><b>Примечание:</b> С+(2,33 хорошо) введено в действие согласно приказу МОН РК №563 от 12.10.2018г</p>
                                <p><b>Note:</b> С+(2,33 good) was signed into law to the order of MES of RK №563 from 12.10.2018</p>
                            ";
            }else {
                $return .="<tr align=\"center\">";
                $return .= "<td>1</td>";
                $return .= "<td>Не завершено</td>";
                $return .= "<td></td>";
                $return .= "<td></td>";
                $return .= "<td></td>";
                $return .= "<td></td>";
                $return .= "<td></td>";
                $return.="</tr>";
            }

        }

                  $return .= "</table>";

            return $return;
        }

    public static function filterData2($request)
    {
        if (isset($request['faculty'])) {

            $departments = Department::where('faculty_id', $request['faculty'])->pluck('title', 'id')->all();

            if ($departments) {
                $return = "<option value=".null.">Выберите кафедру</option>";
                foreach ($departments as $k => $v) {
                    $return .= "<option value='{$k}'>{$v}</option>";
                }
                return $return;
            } else {
                $return = "<option value=".null.">Нет кафедры</option>";
                return $return;
            }
        }
        if (isset($request['department'])) {

            $groups = Group::where('department_id', $request['department'])->pluck('title', 'id')->all();
            if ($groups) {
                $return = "<option value=".null.">Выберите группу</option>";
                foreach ($groups as $k => $v) {
                    $return .= "<option value='{$k}'>{$v}</option>";
                }
                return $return;
            } else {
                $return = "<option value=".null.">Нет группы</option>";
                return $return;
            }
        }
        if (isset($request['group'])) {
            $group = Group::find($request['group']);
            $return = "
                    <table border='0' style='width: 100%'>
                        <tr>
                           <th>Факультеті/Факультет/Faculty</th>
                           <th class='text-right'>".$group->departments->faculties->title."</th>
                        </tr>
                        <tr>
                           <th>Мамандығы/Специальность/Speciality</th>
                           <th class='text-right'>".$group->departments->code. '-' .$group->departments->speciality."</th>
                        </tr>
                        <tr>
                           <th>Оқу тілі/Язык/Language</th>
                           <th class='text-right'>".$group->languages->title."</th>
                        </tr>
                    </table>";
                    if (count($group->users) > 0){
                    $return .= "<table class='table text-center' border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style='font-size: 14px; width: 100%;'>";
                    $return .= "<thead>
                                    <tr>
                                      <th scope=\"col\">№</th>
                                      <th scope=\"col\">СРН/ПНС</th>
                                      <th scope=\"col\">ФИО</th>
                                      
                                    </tr>
                                  </thead>
                                  <tbody>";

                        $i = 1;
                        foreach ($group->users as $user) {
                            $return .= "<tr>
                                                    <th scope=\"row\">".$i."</th>
                                                    <td>".$user->infos->cardNumber."</td>
                                                    <td>".$user->infos->lastName. " " .$user->infos->firstName." ".$user->infos->middleName."</td>
                                                    
                                                    
                                                </tr>";
                            $i++;
                        }
                        $return .= "</table>";
                    } else {
                        $return .= "Нет студентов";
                    }
        }

        return $return;
    }





    public static function filterData3($request){
        $faculty_id = $request->get("faculty_id");
        $department_id = $request->get("department_id");
        $group_id = $request->get("group_id");
        $subject_id = $request->get("subject_id");
        $str = "<option>Не выбранно</option>";


        if($faculty_id && !$department_id && !$group_id && !$subject_id){
            $departments = Department::where("faculty_id",$faculty_id)->get();
            if(count($departments)>0){
                foreach ($departments as $department){
                    $str .= "<option value= '{$department->id}'>$department->title</option>";
                }
            }
            else{
                $str = "<option>Кафедры не найдены</option>";
            }
            return $str;
        }
        if($faculty_id && $department_id && !$group_id && !$subject_id){
            $groups = Group::where("department_id",$department_id)->get();
            if(count($groups)>0){
                foreach ($groups as $group){
                    $str .= "<option value= '{$group->id}'>$group->title</option>";
                }
            }
            else{
                $str = "<option>Группы не найдены</option>";
            }
            return $str;
        }
        if($faculty_id && $department_id && $group_id && !$subject_id){
            $subjects = ExamSchedule::where("group_id",$group_id)->get();
            if(count($subjects)>0){
                foreach ($subjects as $subject){
                    $str .= "<option value= '{$subject->id}'>".$subject->subject->title ."</option>";
                }
            }
            else{
                $str = "<option>Предметы не найдены</option>";
            }
            return $str;
        }
        if($faculty_id && $department_id && $group_id && $subject_id){
            $students = User::where("group_id",$group_id)->get();
            if(count($students)>0){
                $faculty = Faculty::find($faculty_id);
                $group = Group::find($group_id);
                $examShedule = ExamSchedule::where(["group_id"=>$group_id,"subject_id"=>$subject_id])->first();
                $schedule = Shedule::where(["group_id"=>$group_id,"subject_id"=>$subject_id,"lesson_id"=>1])->first();
                    $str = "
                    <table border='0' style='width: 100%'>
                        <tr>
                           <th>Факультеті/Факультет/Faculty</th>
                           <th class='text-right'>".$faculty->title."</th>
                        </tr>
                        <tr>
                           <th>Мамандығы/Специальность/Speciality</th>
                           <th class='text-right'>".$group->departments->code. '-' .$group->departments->speciality."</th>
                        </tr>
                        <tr>
                           <th>Оқу тілі/Язык/Language</th>
                           <th class='text-right'>".$group->languages->title."</th>
                        </tr>
                        <tr>
                           <th>Тобы/Группа/Group</th>
                           <th class='text-right'>".$group->title."</th>
                        </tr>
                        <tr>
                           <th>Пән Аты/Дисциплина/Discipline</th>
                           <th class='text-right'>".$examShedule->subject->title."</th>
                        </tr>
                        <tr>
                           <th>Оқытушы/Преподаватель/Teacher</th>
                           <th class='text-right'>".$schedule->teachers->login."</th>
                        </tr>
                        <tr>
                           <th>Аудитория/Аудитория/Audience</th>
                           <th class='text-right'>".$examShedule->cabinet."</th>
                        </tr>
                         <tr>
                           <th>Емтихан түрі/Тип Экзамена/Exam type</th>
                           <th class='text-right'>".$examShedule->type->title."</th>
                        </tr>
                        <tr>
                           <th>Семестер/Семестер/Semester</th>
                           <th class='text-right'>".$examShedule->semester->title."</th>
                        </tr>
                        <tr>
                           <th>Күні/День/Date</th>
                           <th class='text-right'>".$examShedule->start."</th>
                        </tr>
                        <tr>
                           <th>Уақыт/Время/Time</th>
                           <th class='text-right'>".$examShedule->time."(минут)</th>
                        </tr>
                    </table>";

                    $str .= "<table class='table text-center' border=\"1\" cellpadding=\"2\" cellspacing=\"0\" style='font-size: 14px; width: 100%;'>";
                    $str .= "<thead>
                                    <tr>
                                      <th rowspan='2' scope=\"col\">№</th>
                                      <th rowspan='2' scope=\"col\">ФИО</th>
                                      <th rowspan='2' scope=\"col\">Сынақ кітап. №/№ зачетной книжки</th>
                                      <th  colspan=\"3\">Рейтинг көрсеткіш / Показатели рейтинга</th>
                                      <th rowspan='2'  colspan=\"2\">Буквенное выражение / Цифровые эквиваленты</th>
                                      <th rowspan='2'>Экземен/Оценка</th>
                                    </tr>
                                    <tr>
                                    <th>Күнделікті бақылау/<br>Текущий контроль</th>
                                    <th>Қорытынды бакылау/<br>Итог контр.</th>
                                    <th>Жалпы балл/<br>Общий балл</th>
                                    </tr>
                                  </thead>
                                  <tbody>";
                                $i=1;
                                $denied = 0;
                                $abcent = 0;
                                $excellent = 0;
                                $good = 0;
                                $ok = 0;
                                $bad = 0;
                                foreach ($students as $student){
                                    $str .="<tr>
                                                    <th scope=\"row\">".$i."</th>
                                                    <td>".$student->infos->lastName. " " .$student->infos->firstName." ".$student->infos->middleName."</td>
                                                    <td>".$student->infos->cardNumber."</td>";
                                                   $assignment = Assignment::where(["group_id"=>$group_id,"subject_id"=>$subject_id,"student_id"=>$student->id])->first();

                                                    if($assignment){
                                                       $rating = $assignment->first_rating + $assignment->second_rating;
                                                       $str.= "<td>".$rating."</td>";
                                                       if($assignment->exam_rating == 0){$abcent++;}
                                                       $str.= "<td>".$assignment->exam_rating."</td>";
                                                       $str.= "<td>".$assignment->total_rating."</td>";
                                                       $str .= "<td>";
                                                       if ($assignment->total_rating >= 95){$str .= 'A';}
                                                       if ($assignment->total_rating >= 90 and $assignment->total_rating <= 94){$str .= 'A-';}
                                                       if ($assignment->total_rating >= 85 and $assignment->total_rating <= 89){$str .= 'B+';}
                                                       if ($assignment->total_rating >= 80 and $assignment->total_rating <= 84){$str .= 'B';}
                                                       if ($assignment->total_rating >= 75 and $assignment->total_rating <= 79){$str .= 'B-';}
                                                       if ($assignment->total_rating >= 70 and $assignment->total_rating <= 74){$str .= 'C+';}
                                                       if ($assignment->total_rating >= 65 and $assignment->total_rating <= 69){$str .= 'C';}
                                                       if ($assignment->total_rating >= 60 and $assignment->total_rating <= 64){$str .= 'C-';}
                                                       if ($assignment->total_rating >= 55 and $assignment->total_rating <= 59){$str .= 'Д+';}
                                                       if ($assignment->total_rating >= 50 and $assignment->total_rating <= 54){$str .= 'Д';}
                                                       if ($assignment->total_rating >= 25 and $assignment->total_rating <= 49){$str .= 'FX';}
                                                       if ($assignment->total_rating >= 0 and $assignment->total_rating <= 24){$str .= 'F';}
                                                       $str .= "</td>";
                                                       $str .= "<td>";
                                                       if ($assignment->total_rating >= 95){$str .= '4.0';}
                                                       if ($assignment->total_rating >= 90 and $assignment->total_rating <= 94){$str .= '3.67';}
                                                       if ($assignment->total_rating >= 85 and $assignment->total_rating <= 89){$str .= '3.33';}
                                                       if ($assignment->total_rating >= 80 and $assignment->total_rating <= 84){$str .= '3.0';}
                                                       if ($assignment->total_rating >= 75 and $assignment->total_rating <= 79){$str .= '2.67';}
                                                       if ($assignment->total_rating >= 70 and $assignment->total_rating <= 74){$str .= '2.33';}
                                                       if ($assignment->total_rating >= 65 and $assignment->total_rating <= 69){$str .= '2.0';}
                                                       if ($assignment->total_rating >= 60 and $assignment->total_rating <= 64){$str .= '1.67';}
                                                       if ($assignment->total_rating >= 55 and $assignment->total_rating <= 59){$str .= '1.33';}
                                                       if ($assignment->total_rating >= 50 and $assignment->total_rating <= 54){$str .= '1.0';}
                                                       if ($assignment->total_rating >= 25 and $assignment->total_rating <= 49){$str .= '0.5';}
                                                       if ($assignment->total_rating >= 0 and $assignment->total_rating <= 24){$str .= '0';}
                                                       $str .= "</td>";
                                                       $str .= "<td>";
                                                       if ($assignment->total_rating >= 95){$str .= '5(отл)';}
                                                       if ($assignment->total_rating >= 90 and $assignment->total_rating <= 94){$str .= '5(отл)'; ++$excellent;}
                                                       if ($assignment->total_rating >= 85 and $assignment->total_rating <= 89){$str .= '4(хорошо)';++$good;}
                                                       if ($assignment->total_rating >= 80 and $assignment->total_rating <= 84){$str .= '4(хорошо)';++$good;}
                                                       if ($assignment->total_rating >= 75 and $assignment->total_rating <= 79){$str .= '4(хорошо)';++$good;}
                                                       if ($assignment->total_rating >= 70 and $assignment->total_rating <= 74){$str .= '4(хорошо)';++$good;}
                                                       if ($assignment->total_rating >= 65 and $assignment->total_rating <= 69){$str .= '3(удв)';++$good;}
                                                       if ($assignment->total_rating >= 60 and $assignment->total_rating <= 64){$str .= '3(удв)';++$ok;}
                                                       if ($assignment->total_rating >= 55 and $assignment->total_rating <= 59){$str .= '3(удв)';++$ok;}
                                                       if ($assignment->total_rating >= 50 and $assignment->total_rating <= 54){$str .= '3(удв)';++$ok;}
                                                       if ($assignment->total_rating >= 25 and $assignment->total_rating <= 49){$str .= '2(не удв)';++$bad;}
                                                       if ($assignment->total_rating >= 0 and $assignment->total_rating <= 24){$str .= '2(не удв)';++$bad;}
                                                       $str .= "</td>";
                                                       $str.="</tr>";
                                                   }
                                                   else{
                                                       $str.= "<td>-</td>";
                                                       $str.= "<td>-</td>";
                                                       $str.= "<td>-</td>";
                                                       $str.= "<td>-</td>";
                                                       $str.= "<td>-</td>";
                                                       $str.= "<td>-</td>";
                                                        $denied++;
                                                   }


                                                "</tr>";
                                    $i++;
                                }
                $str .= "</table>";
                                $str.="<p>Емтиханға қатысқан студент саны/Число студентов на экзамене:<b>".count($students)."</b></p>";
                                $str.="<p>Оның ішінде 'өте жаксы алгандар'/Из них получили 'отлично':<b>".$excellent."</b></p>";
                                $str.="<p>'жақсы' алғандар/получили хорошо :<b>$good</b></p>";
                                $str.="<p>'қанағаттарлық' алғандар/получившие 'удовлетворительно':<b>".$ok."</b></p>";
                                $str.="<p>'қанағаттанарлықсыз' алғандар/получившие 'не удовлетворительно':<b>".$bad."</b></p>";
                                $str.="<p>Емтиханға келмеген студент саны/Число студентов не пришедших экзамен:<b>".$abcent."</b></p>";
                                $str.="<p>Емтиханға жіберілмеген студент саны/Число студентов не допущенных на экзамен:<b>".$denied."</b></p>";
                                $str.="<p>Электрондық тізбені шығарған тіркеуші/Выдал(а) электронную ведомость регистратор(ФИО и подпись):<b>____________________________________</b></p>";
                                $str.="<p>Оқытушы/Преподаватель:<b>____________________________________</b></p>";
                                $str.="<p>Комиссия мүшесі/Члены контрольной комиссии:<b>____________________________________</b></p>";
            }
            else{
                $str = "<option>Студенты не найдены</option>";
            }
            return $str;
        }
        else{
            return "<option>Ничего не найдено<option>";
        }








    }
}
