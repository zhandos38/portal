<?php

namespace App\Http\Controllers\Student;

use App\Envelope;
use App\EnvelopeStudent;
use App\Models\Assignment;
use App\Models\ExamSchedule;
use App\Models\Group;
use App\Models\Material;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Semester;
use App\Models\Shedule;
use App\Models\SubjectList;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class StudentController extends Controller
{
    public function info()
    {
        $user = User::find(Auth::id());
        return view('users.show', compact('user'));
    }

    public function envelope()
    {
        $semesterID = Semester::where('current', 1)->first();
        $teachersID = Shedule::where(['group_id' => Auth::user()->group_id, 'semester_id' => $semesterID->id])->pluck('id', 'teacher_id')->all();
        $teachers = User::whereIn('id', array_keys($teachersID))->get();

        return view('students.envelope', compact('teachers'));
    }

    public function envelopeGetTeachers($id)
    {
        $semesterID = Semester::where('current', 1)->first();
        $teachersID = Shedule::where(['group_id' => Auth::user()->group_id, 'semester_id' => $semesterID->id])->pluck('id', 'teacher_id')->all();
        $teachers = User::whereIn('id', array_keys($teachersID))->get();
        $teacher = User::find($id);

        return view('students.getTeachers', compact( 'teacher', 'teachers'));
    }

    public function envelopeSendTeacher(Request $request)
    {
        $this->validate($request, ['title' => 'required', 'description' => 'required']);
        Envelope::makeData2($request);
        Flash::success('Успешно отправлено!');
        return redirect()->route('studentEnvelope');
    }

    public function envelopeRed($id)
    {
        $semesterID = Semester::where('current', 1)->first();
        $teachersID = Shedule::where(['group_id' => Auth::user()->group_id, 'semester_id' => $semesterID->id])->pluck('id', 'teacher_id')->all();
        $teachers = User::whereIn('id', array_keys($teachersID))->get();
        $message = Envelope::find($id);
        $message->status = 1;
        $message->save();

        return view('students.red', compact('teachers', 'message'));
    }

    public function envelopeSend($id)
    {
        $semesterID = Semester::where('current', 1)->first();
        $teachersID = Shedule::where(['group_id' => Auth::user()->group_id, 'semester_id' => $semesterID->id])->pluck('id', 'teacher_id')->all();
        $teachers = User::whereIn('id', array_keys($teachersID))->get();
        $message = EnvelopeStudent::find($id);
        return view('students.send', compact('message', 'teachers'));
    }

    public function schedule(){
        $user = User::find(Auth::id());
        $schedules = Shedule::getStudentSchedule($user->group_id,true);
        return view("students.schedule",compact("schedules"));
    }

    public function examschedule(){
        $user = User::find(Auth::id());
        $examSchedules = Shedule::getStudentSchedule($user->group_id,false);
        return view("students.examschedule",compact("examSchedules"));
    }

    public function material(){
        $user = User::find(Auth::id());
        $active = Semester::where("current",1)->first();
        $materials = Material::where(["semester_id"=>$active->id,"group_id"=>$user->group_id])->get();
        return view("students.material",compact("materials"));
    }
    public function subject(){
        $subjects = SubjectList::where("student_id",Auth::id())->get();
        return view("students.subject",compact("subjects"));
    }

    public function assignment(){
        $user = User::find(Auth::id());
        $assignments = Assignment::where(["group_id"=>$user->group_id,"student_id"=>$user->id])->get();

        return view('students.assignments',compact("assignments"));
    }

    public function currentassignment(){
        $user = User::find(Auth::id());
        $semester = Semester::where("current",1)->first();
        $assignments = Assignment::where(["semester_id"=>$semester->id,"group_id"=>$user->group_id,"student_id"=>$user->id])->get();
        return view('students.assignments',compact("assignments"));
    }

    //exam
    public function exam(){
        $exams = ExamSchedule::getQuizzes();
        return view("students.exam",compact("exams"));
    }

    public function passexam($id,$examId){
        $status = ExamSchedule::checkStatus($examId,Auth::id());
        $tests = Quiz::getQuestions($id);
        $schedule  = ExamSchedule::find($examId);
        if($tests && $schedule && $status){
            return view("students.quiz",compact("tests","schedule"));
        }
        else{
            abort(404);
        }
    }

    public function check(Request $request){

        if($request->get("answers")){
            $results = Question::checkAnswer($request->except("_token"));
        }
        else{
            $results["total"] = 0;
        }
        Assignment::getMark($request->get("schedule"),Auth::id(),$results["total"]);
        return view("students.exam_result",compact("results"));
    }
    //end of exam

}
