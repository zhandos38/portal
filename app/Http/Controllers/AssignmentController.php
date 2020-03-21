<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Models\Assignment;
use App\Models\Group;
use App\Models\Semester;
use App\Models\Shedule;
use App\Models\Subject;
use App\Repositories\AssignmentRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use function Psy\sh;
use Response;

class AssignmentController extends AppBaseController
{
    /** @var  AssignmentRepository */
    private $assignmentRepository;

    public function __construct(AssignmentRepository $assignmentRepo)
    {
        $this->assignmentRepository = $assignmentRepo;
    }

    /**
     * Display a listing of the Assignment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $assignments = $this->assignmentRepository->all();

        return view('assignments.index')
            ->with('assignments', $assignments);
    }

    /**
     * Show the form for creating a new Assignment.
     *
     * @return Response
     */
    public function create()
    {
        return view('assignments.create');
    }

    /**
     * Store a newly created Assignment in storage.
     *
     * @param CreateAssignmentRequest $request
     *
     * @return Response
     */
//    public function store(CreateAssignmentRequest $request)
//    {
//        $input = $request->all();
//
//        $assignment = $this->assignmentRepository->create($input);
//
//        Flash::success('Assignment saved successfully.');
//
//        return redirect(route('assignments.index'));
//    }

    public function store(Request $request){
        $this->validate($request,["semester_id"=>"required","group_id"=>"required","subject_id"=>"required","teacher_id"=>"required","rating"=>"required"],
            ["required"=>"Поле :attribute обязательно!"],["semester_id"=>"семестр","group_id"=>"группа","subject_id"=>"дисциплина","teacher_id"=>"преподаватель","rating"=>"рейтинг"]
        );
        if(Auth::user()->role_id == 1){
            Assignment::makeData($request);
        }
        if(Auth::user()->role_id == 4){
            $this->validate($request,["rating.*.first_lection"=>"sometimes|numeric|min:0|max:18","rating.*.first_practice"=>"sometimes|numeric|min:0|max:12","rating.*.second_lection"=>"sometimes|numeric|min:0|max:18","rating.*.second_practice"=>"sometimes|numeric|min:0|max:12"],
                ["numeric"=>"Поле :attribute должен быть валидным числом","min"=>"Значения поля :attribute не должно быть ниже 0", "max"=>"Значения поля :attribute не должно быть выше :max"],
                ["rating.*.first_lection"=>"лекционные занятия","rating.*.first_practice"=>"Практические занятия","rating.*.second_lection"=>"лекционные занятия","rating.*.second_practice"=>"практические занятия"]
            );


            Assignment::makeTeacherData($request);
        }
        Flash::success('Рейтинг успешно создан!');
        return redirect(route('assignments.index'));
    }

    /**
     * Display the specified Assignment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $assignment = $this->assignmentRepository->find($id);

        if (empty($assignment)) {
            Flash::error('Рейтинг не найден!');

            return redirect(route('assignments.index'));
        }

        return view('assignments.show')->with('assignment', $assignment);
    }

    /**
     * Show the form for editing the specified Assignment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $assignment = $this->assignmentRepository->find($id);

        if (empty($assignment)) {
            Flash::error('Рейтинг не найден!');

            return redirect(route('assignments.index'));
        }

        return view('assignments.edit')->with('assignment', $assignment);
    }

    /**
     * Update the specified Assignment in storage.
     *
     * @param int $id
     * @param UpdateAssignmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAssignmentRequest $request)
    {
        $assignment = $this->assignmentRepository->find($id);

        if (empty($assignment)) {
            Flash::error('Рейтинг не найден!');

            return redirect(route('assignments.index'));
        }

        $assignment = $this->assignmentRepository->update($request->all(), $id);

        Flash::success('Рейтинг успешно обновлен!');

        return redirect(route('assignments.index'));
    }

    /**
     * Remove the specified Assignment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $assignment = $this->assignmentRepository->find($id);

        if (empty($assignment)) {
            Flash::error('Рейтинг не найден!');

            return redirect(route('assignments.index'));
        }

        $this->assignmentRepository->delete($id);

        Flash::success('Рейтинг успешно удален!');

        return redirect(route('assignments.index'));
    }

    public function getData(Request $request)
    {
       return Assignment::filterData($request->all());
    }
}
