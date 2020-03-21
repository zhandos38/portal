<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSemesterRequest;
use App\Http\Requests\UpdateSemesterRequest;
use App\Models\Semester;
use App\Repositories\SemesterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SemesterController extends AppBaseController
{
    /** @var  SemesterRepository */
    private $semesterRepository;

    public function __construct(SemesterRepository $semesterRepo)
    {
        $this->semesterRepository = $semesterRepo;
    }

    /**
     * Display a listing of the Semester.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $semesters = $this->semesterRepository->paginate(30);

        return view('semesters.index')
            ->with('semesters', $semesters);
    }

    /**
     * Show the form for creating a new Semester.
     *
     * @return Response
     */
    public function create()
    {
        return view('semesters.create');
    }

    /**
     * Store a newly created Semester in storage.
     *
     * @param CreateSemesterRequest $request
     *
     * @return Response
     */
    public function store(CreateSemesterRequest $request)
    {
        $input = $request->all();
        $semester = $this->semesterRepository->create($input);

        Flash::success('Семестр успешно создан!');

        return redirect(route('semesters.index'));
    }

    /**
     * Display the specified Semester.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $semester = $this->semesterRepository->find($id);

        if (empty($semester)) {
            Flash::error('Семестр не найден!');

            return redirect(route('semesters.index'));
        }

        return view('semesters.show')->with('semester', $semester);
    }

    /**
     * Show the form for editing the specified Semester.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $semester = $this->semesterRepository->find($id);

        if (empty($semester)) {
            Flash::error('Семестр не найден!');

            return redirect(route('semesters.index'));
        }

        return view('semesters.edit')->with('semester', $semester);
    }

    /**
     * Update the specified Semester in storage.
     *
     * @param int $id
     * @param UpdateSemesterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSemesterRequest $request)
    {
        $semester = $this->semesterRepository->find($id);

        if (empty($semester)) {
            Flash::error('Семестр не найден!');

            return redirect(route('semesters.index'));
        }

        $semester = $this->semesterRepository->update($request->all(), $id);

        Flash::success('Семестр успешно обновлен!');

        return redirect(route('semesters.index'));
    }

    /**
     * Remove the specified Semester from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $semester = $this->semesterRepository->find($id);

        if (empty($semester)) {
            Flash::error('Семестр не найден!');

            return redirect(route('semesters.index'));
        }

        $this->semesterRepository->delete($id);

        Flash::success('Семестр успешно удален!');

        return redirect(route('semesters.index'));
    }

    public function change(Request $request){
        $id = $request->get("id");
        $checked = $request->get("checked");
        $semestr = Semester::where("id",$id)->first();
        $currentsemestrs = Semester::where("current",1)->get();
        if($checked){
            foreach ($currentsemestrs as $item){
                $item->current = 0;
                $item->save();
            }
            $semestr->current =1;
            $semestr->save();
        }
        else{
            $semestr->current = 0;
        }
    }

    public function step(Request $request)
    {
        $id = $request->get('id');
        $val = $request->get('value');
        $semester = Semester::where('id', $id)->first();
        $semester->step = $val;
        $semester->save();
    }
}
