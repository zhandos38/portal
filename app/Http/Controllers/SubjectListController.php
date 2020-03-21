<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubjectListRequest;
use App\Http\Requests\UpdateSubjectListRequest;
use App\Models\Department;
use App\Models\Group;
use App\Models\Semester;
use App\Models\Semestr;
use App\Models\SubjectList;
use App\Repositories\SubjectListRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class SubjectListController extends AppBaseController
{
    /** @var  SubjectListRepository */
    private $subjectListRepository;

    public function __construct(SubjectListRepository $subjectListRepo)
    {
        $this->subjectListRepository = $subjectListRepo;
    }

    /**
     * Display a listing of the SubjectList.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->role_id == 1){
            $subjectLists = $this->subjectListRepository->paginate(30);
        }
        if(Auth::user()->role_id == 2){
            $departmentKeys = array_keys(Department::where("faculty_id",Auth::user()->faculty_id)->pluck("id","id")->all());
            $groups = array_values(Group::whereIn("department_id",$departmentKeys)->pluck("id","id")->all());
            $subjectLists = SubjectList::whereIn("group_id",$groups)->paginate(30);
        }


        return view('subject_lists.index')
            ->with('subjectLists', $subjectLists);
    }

    /**
     * Show the form for creating a new SubjectList.
     *
     * @return Response
     */
    public function create()
    {

        if(Auth::user()->role_id == 1){
            $semesters = Semester::pluck("title","id")->all();
            $groups = Group::pluck("title","id")->all();
        }

        if(Auth::user()->role_id == 2){
            $semesters = Semester::where("current",1)->pluck("title","id")->all();
            $departmentKeys = array_keys(Department::where("faculty_id",Auth::user()->faculty_id)->pluck("id","id")->all());
            $groups = Group::whereIn("department_id",$departmentKeys)->pluck("title","id")->all();


        }
        return view('subject_lists.create',compact("semesters","groups"));
    }

    /**
     * Store a newly created SubjectList in storage.
     *
     * @param CreateSubjectListRequest $request
     *
     * @return Response
     */
    public function store(CreateSubjectListRequest $request)
    {
        $input = SubjectList::makeData($request);
            Flash::success('Список занятия успешно создан!');


        return redirect(route('subjectLists.index'));
    }

    /**
     * Display the specified SubjectList.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subjectList = $this->subjectListRepository->find($id);

        if (empty($subjectList)) {
            Flash::error('Список занятия не найден!');

            return redirect(route('subjectLists.index'));
        }

        return view('subject_lists.show')->with('subjectList', $subjectList);
    }

    /**
     * Show the form for editing the specified SubjectList.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $subjectList = $this->subjectListRepository->find($id);

        if (empty($subjectList)) {
            Flash::error('Список занятия не найден!');

            return redirect(route('subjectLists.index'));
        }
        if(Auth::user()->role_id == 1){
            $semesters = Semester::pluck("title","id")->prepend("Не выбранно","0")->all();
            $groups = Group::where("id",$subjectList->group_id)->pluck("title","id")->all();
        }
        if(Auth::user()->role_id == 2){
            $semesters = Semester::where("current",1)->pluck("title","id")->prepend("Не выбранно","0")->all();
            $groups = Group::where("id",$subjectList->group_id)->pluck("title","id")->all();

        }

        return view('subject_lists.edit',compact('subjectList',"semesters","groups"));
    }

    /**
     * Update the specified SubjectList in storage.
     *
     * @param int $id
     * @param UpdateSubjectListRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubjectListRequest $request)
    {
        $subjectList = $this->subjectListRepository->find($id);

        if (empty($subjectList)) {
            Flash::error('Список занятия не найден!');

            return redirect(route('subjectLists.index'));
        }
        SubjectList::updateData($request,$id);

        Flash::success('Список занятия успешно обновлен!');

        return redirect(route('subjectLists.index'));
    }

    /**
     * Remove the specified SubjectList from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subjectList = $this->subjectListRepository->find($id);

        if (empty($subjectList)) {
            Flash::error('Список занятия не найден!');

            return redirect(route('subjectLists.index'));
        }

//        $this->subjectListRepository->delete($id);
        SubjectList::deleteData($id);
        Flash::success('Список занятия успешно удален!');

        return redirect(route('subjectLists.index'));
    }
}
