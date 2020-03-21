<?php

namespace App\Http\Controllers\API;

use App\Models\UserInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrintController extends Controller
{
    public function getStudents(Request $request)
    {
        $TIMA = UserInfo::all();
        $data = [];

        foreach ($TIMA as $item) {
            $data[]['name'] = $item->firstName. ' ' .$item->lastName. ' ' .$item->middleName;
        }
        return response()->json($data);
    }
}
