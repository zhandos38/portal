<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\UserInfo;
use App\Pns;
use App\Transcript;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrintController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 1){
            $faculties = Faculty::pluck('title', 'id')->prepend('Выберите факультет', '')->all();
        }
        if (Auth::user()->role_id == 2){
            $faculties = Faculty::where('id', Auth::user()->faculty_id)->pluck('title', 'id')->prepend('Выберите факультет', '')->all();
        }
        $pns = Pns::all();
        return view('print.index', compact('faculties', 'pns'));
    }

    public function search(Request $request)
    {
        return Transcript::filterData($request);
    }

    public function lists(Request $request)
    {
        return Transcript::filterData2($request);
    }

    public function assign(Request $request){
        return Transcript::filterData3($request);
    }

}
