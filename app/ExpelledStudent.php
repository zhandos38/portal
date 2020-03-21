<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ExpelledStudent extends Model
{
    protected $table = "expelled_students";
    protected $fillable = ["student_id","created_at","updated_at"];

    public function student()
    {
        return $this->belongsTo(\App\Models\User::class, 'student_id');
    }


    public static function expelStudent($id){
        $student = ExpelledStudent::where("student_id",$id)->first();
        if($student){
            $student->delete();
        }
        else{
            ExpelledStudent::create(["student_id"=>$id]);
        }

    }


    public static function getExpelledStudent(){
        $userIds = ExpelledStudent::all();
        $users = [];
        if(count($userIds)>0){
            foreach ($userIds as $userId){
                $users[] = $userId->student_id;
            }
        }
        return $users;
        }


}
