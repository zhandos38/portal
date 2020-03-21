<?php

namespace App\Http\Controllers;

use App\Models\Days;
use App\Models\Department;
use App\Models\ExamSchedule;
use App\Models\Group;
use App\Models\LessonType;
use App\Models\Semester;
use App\Models\Shedule;
use App\Models\User;
use App\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(){
        if (Auth::user()->role_id == 1){
            $searchable = ["1"=>"Факультеты","2"=>"Кафедры","3"=>"Группы","4"=>"СуперАдмины","5"=>"Администраторы","6"=>"Модераторы","7"=>"Преподаватели","8"=>"Студенты"];
        }
        if (Auth::user()->role_id == 2){
            $searchable = ["2"=>"Кафедры","3"=>"Группы","6"=>"Модераторы","7"=>"Преподаватели","8"=>"Студенты"];
        }
        return view("search.index",compact("searchable"));
    }

    public function result(Request $request){
        $category = $request->get("category");
        //Faculty
        if($category == 1){
            $faculties = Search::search($request);
            return view('search.faculty',compact('faculties'));
        }
        //Department
        if($category == 2){
           $departments = Search::search($request);
            return view('search.department',compact('departments'));
        }
        //Group
        if($category == 3){
            $groups = Search::search($request);
            return view('search.group',compact('groups'));
        }
        //SuperAdmin
        if($category == 4){
            $users = Search::search($request);
            return view("search.user",compact("users"));
        }
        //Administrator
        if($category == 5){
            $users = Search::search($request);
            return view("search.user",compact("users"));
        }
        //Moderator
        if($category == 6){
            $users = Search::search($request);
            return view("search.user",compact("users"));
        }
        //Teacher
        if($category == 7){
            $users = Search::search($request);
            return view("search.user",compact("users"));
        }
        //Student
        if($category == 8){
            $users = Search::search($request);
            return view("search.user",compact("users"));
        }
    }

    public function schedule(){
        $semesters = Semester::pluck("title","id")->all();
        if(Auth::user()->role_id == 1){
            $groups = Group::pluck("title","id")->all();
        }
        if(Auth::user()->role_id == 2){
            $keys = array_keys(Department::where("faculty_id",Auth::user()->faculty_id)->pluck("title","id")->all());
            $groups = Group::whereIn("department_id",$keys)->pluck("title","id")->all();
        }
        return view("search.schedule",compact("semesters","groups"));
    }

    public function scheduleResult(Request $request){
        $this->validate($request,["semester_id"=>"required","group_id"=>"required","type_id"=>"required"]);
        if($request["type_id"] == 1){
            $shedules = Shedule::where(["semester_id"=>$request->get("semester_id"),"group_id"=>$request->get("group_id")])->paginate(30);
            return view('shedules.index',compact('shedules'));
        }
        if($request["type_id"] == 2){
            $examSchedules = ExamSchedule::where(["semester_id"=>$request->get("semester_id"),"group_id"=>$request->get("group_id")])->paginate(30);
            return view('exam_schedules.index',compact('examSchedules'));
        }

    }
}
