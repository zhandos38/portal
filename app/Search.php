<?php

namespace App;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Group;
use DevDojo\Chatter\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class Search extends Model
{
    public static function search($request){
        $searchable = ["1"=>"Факультеты","2"=>"Кафедры","3"=>"Группы","4"=>"СуперАдмины","5"=>"Администраторы","6"=>"Модераторы","7"=>"Преподаватели","8"=>"Студенты"];
        $category = $request->get("category");
        $keyword = $request->get("title");
        if(Auth::user()->role_id == 1){
            if($category == 1){
                $result = Faculty::where("title","like","%{$keyword}%")->get();
                return $result;
            }
            if($category == 2){
                $result = Department::where("title","like","%{$keyword}%")->orWhere("code","like","%{$keyword}%")->orWhere("speciality","like","%{$keyword}%")->get();
                return $result;
            }
            if($category == 3){
                $result = Group::where("title","like","%{$keyword}%")->get();
                return $result;
            }
            if($category == 4){
                $result = User::where("login","like","%{$keyword}%")->where('role_id',1)->get();
                return $result;
            }
            if($category == 5){
                $result = User::where("login","like","%{$keyword}%")->where('role_id',2)->get();
                return $result;
            }
            if($category == 6){
                $result = User::where("login","like","%{$keyword}%")->where('role_id',3)->get();
                return $result;
            }
            if($category == 7){
                $result = User::where("login","like","%{$keyword}%")->where('role_id',4)->get();
                return $result;
            }
            if($category == 8){
                $result = User::where("login","like","%{$keyword}%")->where('role_id',5)->get();
                return $result;
            }
        }
        if(Auth::user()->role_id == 2){

            if($category == 2){
                $result = Department::where('faculty_id',Auth::user()->faculty_id)->where("title","like","%{$keyword}%")->orWhere("code","like","%{$keyword}%")->orWhere("speciality","like","%{$keyword}%")->get();
                return $result;
            }
            if($category == 3){
                $departmentKeys = array_values(Department::where('faculty_id',Auth::user()->faculty_id)->pluck("id","id")->all());
                $result = Group::where("title","like","%{$keyword}%")->whereIn("department_id",$departmentKeys)->get();
                return $result;
            }
            if($category == 6){
                $result = User::where('faculty_id',Auth::user()->faculty_id)->where("login","like","%{$keyword}%")->where('role_id',3)->get();
                return $result;
            }
            if($category == 7){
                $result = User::where('faculty_id',Auth::user()->faculty_id)->where("login","like","%{$keyword}%")->where('role_id',4)->get();
                return $result;
            }
            if($category == 8){
                $result = User::where('faculty_id',Auth::user()->faculty_id)->where("login","like","%{$keyword}%")->where('role_id',5)->get();
                return $result;
            }
        }




    }
}
