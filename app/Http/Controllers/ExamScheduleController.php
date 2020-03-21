<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExamScheduleRequest;
use App\Http\Requests\UpdateExamScheduleRequest;
use App\Models\Department;
use App\Models\ExamSchedule;
use App\Models\ExamType;
use App\Models\Group;
use App\Models\Quiz;
use App\Models\Shedule;
use App\Repositories\ExamScheduleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class ExamScheduleController extends AppBaseController
{
    /** @var  ExamScheduleRepository */
    private $examScheduleRepository;

    public function __construct(ExamScheduleRepository $examScheduleRepo)
    {
        $this->examScheduleRepository = $examScheduleRepo;
    }

    /**
     * Display a listing of the ExamSchedule.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->role_id ==1) {
            $examSchedules = $this->examScheduleRepository->paginate(30);
        }
        if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3) {
            $departmentKeys = array_keys(Department::where("faculty_id",Auth::user()->faculty_id)->pluck("id","id")->all());
            $groups = array_values(Group::whereIn("department_id",$departmentKeys)->pluck("id","id")->all());
            $examSchedules = ExamSchedule::whereIn('group_id', $groups)->paginate(30);
        }
        return view('exam_schedules.index')
            ->with('examSchedules', $examSchedules);
    }

    /**
     * Show the form for creating a new ExamSchedule.
     *
     * @return Response
     */
    public function create()
    {
        return view('exam_schedules.create');
    }

    /**
     * Store a newly created ExamSchedule in storage.
     *
     * @param CreateExamScheduleRequest $request
     *
     * @return Response
     */

    public function store(Request $request){
        $this->validate($request,
            ["semester_id"=>"required","subject_id"=>'required',"group_id"=>"required","type_id"=>"required","quiz_id"=>"required_if:type_id,3","start"=>"required","end"=>"required","time"=>"required|numeric|min:1|max:300","cabinet"=>"required"],
            ["required"=>"Поле :attribute обязательно","required_if"=>"Поле :attribute обязательно для теста","numeric"=>"Поле :attribute должно быть числом от(1 до 300 минут)"],
            ["semester_id"=>"семестр","subject_id"=>'дисциплина',"group_id"=>"группа","type_id"=>"тип экзамена","quiz_id"=>"тест","start"=>"начало","end"=>"конец","time"=>"время сдачи(минутах)","cabinet"=>"кабинет"]
        );
        if(ExamSchedule::makeData($request)){
            Flash::success('Успешно добавлено расписание!');
            return redirect(route('examSchedules.index'));
        }
        else{
            Flash::error('Произошла ошибка');
        }


    }

//    public function store(CreateExamScheduleRequest $request)
//    {
//        $input = $request->all();
//
//        $examSchedule = $this->examScheduleRepository->create($input);
//
//        Flash::success('Exam Schedule saved successfully.');
//
//        return redirect(route('examSchedules.index'));
//    }

    /**
     * Display the specified ExamSchedule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $examSchedule = $this->examScheduleRepository->find($id);

        if (empty($examSchedule)) {
            Flash::error('Расписание не найден!');

            return redirect(route('examSchedules.index'));
        }

        return view('exam_schedules.show')->with('examSchedule', $examSchedule);
    }

    /**
     * Show the form for editing the specified ExamSchedule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $examSchedule = $this->examScheduleRepository->find($id);

        if (empty($examSchedule)) {
            Flash::error('Расписание не найден!');

            return redirect(route('examSchedules.index'));
        }

        return view('exam_schedules.edit')->with('examSchedule', $examSchedule);
    }

    /**
     * Update the specified ExamSchedule in storage.
     *
     * @param int $id
     * @param UpdateExamScheduleRequest $request
     *
     * @return Response
     */

    public function update($id,Request $request){
        $this->validate($request,
            ["semester_id"=>"required","subject_id"=>'required',"group_id"=>"required","type_id"=>"required","quiz_id"=>"required_if:type_id,3","start"=>"required","end"=>"required","time"=>"required|numeric|min:1|max:300","cabinet"=>"required"],
            ["required"=>"Поле :attribute обязательно","required_if"=>"Поле :attribute обязательно для теста","numeric"=>"Поле :attribute должно быть числом от(1 до 300 минут)"],
            ["semester_id"=>"семестр","subject_id"=>'дисциплина',"group_id"=>"группа","type_id"=>"тип экзамена","quiz_id"=>"тест","start"=>"начало","end"=>"конец","time"=>"время сдачи(минутах)","cabinet"=>"кабинет"]
        );
        if(ExamSchedule::makeData($request)){
            Flash::success('Успешно обновлено расписание!');
            return redirect(route('examSchedules.index'));
        }
        else{
            Flash::error('Произошла ошибка');
        }
    }
//    public function update($id, UpdateExamScheduleRequest $request)
//    {
//        $examSchedule = $this->examScheduleRepository->find($id);
//
//        if (empty($examSchedule)) {
//            Flash::error('Расписание не найден!');
//
//            return redirect(route('examSchedules.index'));
//        }
//
//        $examSchedule = $this->examScheduleRepository->update($request->all(), $id);
//
//        Flash::success('Exam Schedule updated successfully.');
//
//        return redirect(route('examSchedules.index'));
//    }

    /**
     * Remove the specified ExamSchedule from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $examSchedule = $this->examScheduleRepository->find($id);

        if (empty($examSchedule)) {
            Flash::error('Расписание не найден!');

            return redirect(route('examSchedules.index'));
        }

        $this->examScheduleRepository->delete($id);

        Flash::success('Расписание успешно удалено!');

        return redirect(route('examSchedules.index'));
    }

    public function getData(Request $request){
        $str = ExamSchedule::filterData($request);
        return $str;

    }

    public function switch(Request $request){
        if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2){
            $id = $request->get("id");
            if($id){
                $exam = ExamSchedule::find($id);
                if($exam){
                    if($exam->type_id == 3  && $exam->quiz_id != 0){
                        $exam->active == 0 ? $exam->active = 1 : $exam->active = 0;
                        $exam->save();
                    }
                }
            }

        }
    }
    public function active(){
        if(Auth::user()->role_id == 1){
            $examSchedules = ExamSchedule::where(["type_id"=>3,"active"=>1])->paginate(30);
        }
        if(Auth::user()->role_id == 2){
            $departmentKeys = array_keys(Department::where("faculty_id",Auth::user()->faculty_id)->pluck("id","id")->all());
            $groups = array_values(Group::whereIn("department_id",$departmentKeys)->pluck("id","id")->all());
            $examSchedules = ExamSchedule::whereIn('group_id', $groups)->where(["type_id"=>3,"active"=>1])->paginate(30);
        }
        return view('exam_schedules.index')
            ->with('examSchedules', $examSchedules);
    }

    public function disactive(){
        if(Auth::user()->role_id == 1){
            $examSchedules = ExamSchedule::where(["type_id"=>3,"active"=>0])->paginate(30);
        }
        if(Auth::user()->role_id == 2){
            $departmentKeys = array_keys(Department::where("faculty_id",Auth::user()->faculty_id)->pluck("id","id")->all());
            $groups = array_values(Group::whereIn("department_id",$departmentKeys)->pluck("id","id")->all());
            $examSchedules = ExamSchedule::whereIn('group_id', $groups)->where(["type_id"=>3,"active"=>0])->paginate(30);
        }
        return view('exam_schedules.index')
            ->with('examSchedules', $examSchedules);
    }
}
