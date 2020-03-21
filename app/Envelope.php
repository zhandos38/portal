<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Envelope extends Model
{
    protected $fillable = ['teacher_id', 'group_id', 'student_id', 'title', 'description', 'status'];

    public static function makeData($request)
    {
        $i = 0;
        foreach ($request->get('students') as $item) {
            $data[$i]['teacher_id'] = Auth::id();
            $data[$i]['group_id'] = $request->get('group_id');
            $data[$i]['student_id'] = $item;
            $data[$i]['title'] = $request->get('title');
            $data[$i]['description'] = $request->get('description');
            $i++;
        }
        foreach ($data as $item) {
            $str[$i] = Envelope::create($item);
            $i++;
        }
    }

    public static function makeData2($request)
    {
        $data['teacher_id'] = $request->get('teacher_id');
        $data['student_id'] = Auth::id();
        $data['title'] = $request->get('title');
        $data['description'] = $request->get('description');

        EnvelopeStudent::create($data);
    }

    public function students()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'student_id');
    }

    public function teachers()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'teacher_id');
    }
}
