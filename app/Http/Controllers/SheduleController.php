<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSheduleRequest;
use App\Http\Requests\UpdateSheduleRequest;
use App\Models\Department;
use App\Models\Group;
use App\Models\Shedule;
use App\Models\SubjectList;
use App\Models\User;
use App\Models\UserInfo;
use App\Repositories\SheduleRepository;
use App\Http\Controllers\AppBaseController;
use const http\Client\Curl\AUTH_ANY;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class SheduleController extends AppBaseController
{
    /** @var  SheduleRepository */
    private $sheduleRepository;

    public function __construct(SheduleRepository $sheduleRepo)
    {
        $this->sheduleRepository = $sheduleRepo;
    }

    /**
     * Display a listing of the Shedule.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->role_id ==1) {
            $shedules = $this->sheduleRepository->paginate(30);
        }
        if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3) {
            $departmentKeys = array_keys(Department::where("faculty_id",Auth::user()->faculty_id)->pluck("id","id")->all());
            $groups = array_values(Group::whereIn("department_id",$departmentKeys)->pluck("id","id")->all());
            $shedules = Shedule::whereIn('group_id', $groups)->paginate(30);
        }

        return view('shedules.index')
            ->with(compact('shedules'));
    }

    /**
     * Show the form for creating a new Shedule.
     *
     * @return Response
     */
    public function create()
    {
        return view('shedules.create');
    }

    /**
     * Store a newly created Shedule in storage.
     *
     * @param CreateSheduleRequest $request
     *
     * @return Response
     */
    public function store(CreateSheduleRequest $request)
    {
        $input = $request->all();
        $shedule = $this->sheduleRepository->create($input);

        Flash::success('Расписание успешно создан!');

        return redirect(route('shedules.index'));
    }

    /**
     * Display the specified Shedule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $shedule = $this->sheduleRepository->find($id);

        if (empty($shedule)) {
            Flash::error('Расписание не найден!');

            return redirect(route('shedules.index'));
        }

        return view('shedules.show')->with('shedule', $shedule);
    }

    /**
     * Show the form for editing the specified Shedule.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $shedule = $this->sheduleRepository->find($id);

        if (empty($shedule)) {
            Flash::error('Расписание не найден!');

            return redirect(route('shedules.index'));
        }

        return view('shedules.edit')->with('shedule', $shedule);
    }

    /**
     * Update the specified Shedule in storage.
     *
     * @param int $id
     * @param UpdateSheduleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSheduleRequest $request)
    {
        $shedule = $this->sheduleRepository->find($id);

        if (empty($shedule)) {
            Flash::error('Расписание не найден!');

            return redirect(route('shedules.index'));
        }

        $shedule = $this->sheduleRepository->update($request->all(), $id);

        Flash::success('Расписание успешно обновлен!');

        return redirect(route('shedules.index'));
    }

    /**
     * Remove the specified Shedule from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $shedule = $this->sheduleRepository->find($id);

        if (empty($shedule)) {
            Flash::error('Расписание не найден!');

            return redirect(route('shedules.index'));
        }

        $this->sheduleRepository->delete($id);

        Flash::success('Расписание успешно удален!');

        return redirect(route('shedules.index'));
    }
}
