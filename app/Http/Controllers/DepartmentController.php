<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\User;
use App\Repositories\DepartmentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class DepartmentController extends AppBaseController
{
    /** @var  DepartmentRepository */
    private $departmentRepository;

    public function __construct(DepartmentRepository $departmentRepo)
    {
        $this->departmentRepository = $departmentRepo;
    }

    /**
     * Display a listing of the Department.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->role_id == 1){
           $departments = $this->departmentRepository->paginate(30);
        }
        if (Auth::user()->role_id == 2) {
            $departments = Department::where('faculty_id', Auth::user()->faculty_id)->paginate(30);
        }

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new Department.
     *
     * @return Response
     */
    public function create()
    {
        if (Auth::user()->role_id == 1){
            $faculties = Faculty::pluck('title', 'id')->all();
        }
        if (Auth::user()->role_id == 2) {
            $faculties = Faculty::where('id', Auth::user()->faculty_id)->pluck('title', 'id')->all();
        }
        return view('departments.create', compact('faculties'));
    }

    /**
     * Store a newly created Department in storage.
     *
     * @param CreateDepartmentRequest $request
     *
     * @return Response
     */
    public function store(CreateDepartmentRequest $request)
    {
        $input = $request->all();

        $department = $this->departmentRepository->create($input);

        Flash::success('Кафедра успешно создана!');

        return redirect(route('departments.index'));
    }

    /**
     * Display the specified Department.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error('Кафедра не найдена!');

            return redirect(route('departments.index'));
        }

        return view('departments.show')->with('department', $department);
    }

    /**
     * Show the form for editing the specified Department.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $department = $this->departmentRepository->find($id);
        if (empty($department)) {
            Flash::error('Кафедра не найдена!');

            return redirect(route('departments.index'));
        }
        if (Auth::user()->role_id == 1){
            $faculties = Faculty::pluck('title', 'id')->all();
        }
        if (Auth::user()->role_id == 2) {
            $faculties = Faculty::where('id', Auth::user()->faculty_id)->pluck('title', 'id')->all();
        }

        return view('departments.edit', compact('department', 'faculties'));
    }

    /**
     * Update the specified Department in storage.
     *
     * @param int $id
     * @param UpdateDepartmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDepartmentRequest $request)
    {
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error('Кафедра не найдена!');

            return redirect(route('departments.index'));
        }
        Department::changeFaculty($request->get("faculty_id"),$id);
        $department = $this->departmentRepository->update($request->all(), $id);

        Flash::success('Кафедра успешно обновлена!');

        return redirect(route('departments.index'));
    }

    /**
     * Remove the specified Department from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $department = $this->departmentRepository->find($id);

        if (empty($department)) {
            Flash::error('Кафедра не найдена!');

            return redirect(route('departments.index'));
        }

        $department->users()->delete();
        $department->groups()->delete();
        $this->departmentRepository->delete($id);

        Flash::success('Кафедра успешно удалена!');

        return redirect(route('departments.index'));
    }
}
