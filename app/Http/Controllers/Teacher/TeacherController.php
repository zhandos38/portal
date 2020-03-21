<?php

namespace App\Http\Controllers\Teacher;

use App\Envelope;
use App\EnvelopeStudent;
use App\Models\Group;
use App\Models\Semester;
use App\Models\Shedule;
use App\Models\UserInfo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class TeacherController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        return view('users.show', compact('user'));
    }

    public function envelope()
    {
        $semesterID = Semester::where('current', 1)->first();
        $groupsID = Shedule::where(['teacher_id' => Auth::id(), 'semester_id' => $semesterID->id])->pluck('id', 'group_id')->all();
        $groups = Group::whereIn('id', array_keys($groupsID))->get();
        return view('teachers.envelope', compact('groups'));
    }

    public function envelopeGetStudents($id)
    {
        $semesterID = Semester::where('current', 1)->first();
        $groupsID = Shedule::where(['teacher_id' => Auth::id(), 'semester_id' => $semesterID->id])->pluck('id', 'group_id')->all();
        $groups = Group::whereIn('id', array_keys($groupsID))->get();
        $students = User::where('group_id', $id)->get();

        return view('teachers.getStudents', compact('students', 'groups'));
    }

    public function envelopeSendStudents(Request $request)
    {
        $this->validate($request, ['students' => 'required', 'title' => 'required', 'description' => 'required']);
        Envelope::makeData($request);
        Flash::success('Успешно отправлено!');
        return redirect()->route('teacherEnvelope');
    }

    public function envelopeRed($id)
    {
        $semesterID = Semester::where('current', 1)->first();
        $groupsID = Shedule::where(['teacher_id' => Auth::id(), 'semester_id' => $semesterID->id])->pluck('id', 'group_id')->all();
        $groups = Group::whereIn('id', array_keys($groupsID))->get();
        $message = EnvelopeStudent::find($id);
        $message->status = 1;
        $message->save();

        return view('teachers.red', compact('groups', 'message'));
    }

    public function envelopeSend($id)
    {
        $semesterID = Semester::where('current', 1)->first();
        $groupsID = Shedule::where(['teacher_id' => Auth::id(), 'semester_id' => $semesterID->id])->pluck('id', 'group_id')->all();
        $groups = Group::whereIn('id', array_keys($groupsID))->get();
        $message = Envelope::find($id);
        return view('teachers.send', compact('message', 'groups'));
    }

    public function schedule(){
        $schedules = Shedule::getTeacherSchedule(Auth::id(),true);
        return view("teachers.schedule",compact("schedules"));
    }

    public function examschedule(){
        $examSchedules = Shedule::getTeacherSchedule(Auth::id(),false);
        return view("teachers.examschedule",compact("examSchedules"));

    }
}
