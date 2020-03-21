<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFacultyRequest;
use App\Http\Requests\UpdateFacultyRequest;
use App\Models\Department;
use App\Repositories\FacultyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FacultyController extends AppBaseController
{
    /** @var  FacultyRepository */
    private $facultyRepository;

    public function __construct(FacultyRepository $facultyRepo)
    {
        $this->facultyRepository = $facultyRepo;
    }

    /**
     * Display a listing of the Faculty.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $faculties = $this->facultyRepository->paginate(30);

        return view('faculties.index')
            ->with('faculties', $faculties);
    }

    /**
     * Show the form for creating a new Faculty.
     *
     * @return Response
     */
    public function create()
    {
        return view('faculties.create');
    }

    /**
     * Store a newly created Faculty in storage.
     *
     * @param CreateFacultyRequest $request
     *
     * @return Response
     */
    public function store(CreateFacultyRequest $request)
    {
        $input = $request->all();

        $faculty = $this->facultyRepository->create($input);

        Flash::success('Факультет успешно создан!');

        return redirect(route('faculties.index'));
    }

    /**
     * Display the specified Faculty.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $faculty = $this->facultyRepository->find($id);

        if (empty($faculty)) {
            Flash::error('Факультет не найден!');

            return redirect(route('faculties.index'));
        }

        return view('faculties.show')->with('faculty', $faculty);
    }

    /**
     * Show the form for editing the specified Faculty.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $faculty = $this->facultyRepository->find($id);

        if (empty($faculty)) {
            Flash::error('Факультет не найден!');

            return redirect(route('faculties.index'));
        }

        return view('faculties.edit')->with('faculty', $faculty);
    }

    /**
     * Update the specified Faculty in storage.
     *
     * @param int $id
     * @param UpdateFacultyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFacultyRequest $request)
    {
        $faculty = $this->facultyRepository->find($id);

        if (empty($faculty)) {
            Flash::error('Факультет не найден!');

            return redirect(route('faculties.index'));
        }

        $faculty = $this->facultyRepository->update($request->all(), $id);

        Flash::success('Факультет успешно обновлен!');

        return redirect(route('faculties.index'));
    }

    /**
     * Remove the specified Faculty from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $faculty = $this->facultyRepository->find($id);

        if (empty($faculty)) {
            Flash::error('Факультет не найден!');

            return redirect(route('faculties.index'));
        }

        $faculty->users()->delete();
        $department = Department::where('faculty_id', $id)->get();
        foreach ($department as $item) {
            $item->groups()->delete();
        }
        $faculty->departments()->delete();
        $this->facultyRepository->delete($id);

        Flash::success('Факультет успешно удален!');

        return redirect(route('faculties.index'));
    }
}
