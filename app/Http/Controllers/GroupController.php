<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Group;
use App\Repositories\GroupRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class GroupController extends AppBaseController
{
    /** @var  GroupRepository */
    private $groupRepository;

    public function __construct(GroupRepository $groupRepo)
    {
        $this->groupRepository = $groupRepo;
    }

    /**
     * Display a listing of the Group.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->role_id ==1){
            $groups = $this->groupRepository->paginate(30);
        }
        if(Auth::user()->role_id == 2){
            $keys = array_keys(Department::where("faculty_id",Auth::user()->faculty_id)->pluck("title","id")->all());
            $groups = Group::whereIn("department_id",$keys)->paginate(30);
        }
        return view('groups.index',compact('groups'));
    }

    /**
     * Show the form for creating a new Group.
     *
     * @return Response
     */
    public function create()
    {
        if (Auth::user()->role_id ==1){
            $departments = Department::pluck("title","id")->all();
        }
        if(Auth::user()->role_id == 2){
            $departments = Department::where("faculty_id",Auth::user()->faculty_id)->pluck("title","id")->all();
        }
        return view('groups.create', compact('departments'));
    }

    /**
     * Store a newly created Group in storage.
     *
     * @param CreateGroupRequest $request
     *
     * @return Response
     */
    public function store(CreateGroupRequest $request)
    {
        $input = $request->all();

        $group = $this->groupRepository->create($input);

        Flash::success('Группа успешно создана!');

        return redirect(route('groups.index'));
    }

    /**
     * Display the specified Group.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            Flash::error('Группа не найдена!');

            return redirect(route('groups.index'));
        }

        return view('groups.show')->with('group', $group);
    }

    /**
     * Show the form for editing the specified Group.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            Flash::error('Группа не найдена!');

            return redirect(route('groups.index'));
        }
        if (Auth::user()->role_id == 1){
            $departments = Department::pluck('title', 'id')->all();
        }
        if (Auth::user()->role_id == 2 ) {
            $departments = Department::where("id",array_keys(Faculty::where("id",Auth::user()->faculty_id)->pluck("title","id")->all()))->pluck('title', 'id')->all();
        }

        return view('groups.edit', compact('group', 'departments'));
    }

    /**
     * Update the specified Group in storage.
     *
     * @param int $id
     * @param UpdateGroupRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGroupRequest $request)
    {
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            Flash::error('Группа не найдена!');

            return redirect(route('groups.index'));
        }
        Group::changeGroup($request->get("department_id"),$id);
        $group = $this->groupRepository->update($request->all(), $id);

        Flash::success('Группа успешно обновлена!');

        return redirect(route('groups.index'));
    }

    /**
     * Remove the specified Group from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $group = $this->groupRepository->find($id);

        if (empty($group)) {
            Flash::error('Группа не найдена!');

            return redirect(route('groups.index'));
        }
        $group->users->delete();
        $this->groupRepository->delete($id);

        Flash::success('Группа успешно удалена!');

        return redirect(route('groups.index'));
    }
}
