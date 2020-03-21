<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLessonTypeRequest;
use App\Http\Requests\UpdateLessonTypeRequest;
use App\Repositories\LessonTypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class LessonTypeController extends AppBaseController
{
    /** @var  LessonTypeRepository */
    private $lessonTypeRepository;

    public function __construct(LessonTypeRepository $lessonTypeRepo)
    {
        $this->lessonTypeRepository = $lessonTypeRepo;
    }

    /**
     * Display a listing of the LessonType.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $lessonTypes = $this->lessonTypeRepository->all();

        return view('lesson_types.index')
            ->with('lessonTypes', $lessonTypes);
    }

    /**
     * Show the form for creating a new LessonType.
     *
     * @return Response
     */
    public function create()
    {
        return view('lesson_types.create');
    }

    /**
     * Store a newly created LessonType in storage.
     *
     * @param CreateLessonTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateLessonTypeRequest $request)
    {
        $input = $request->all();

        $lessonType = $this->lessonTypeRepository->create($input);

        Flash::success('Тип занятия успешно создана!');

        return redirect(route('lessonTypes.index'));
    }

    /**
     * Display the specified LessonType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $lessonType = $this->lessonTypeRepository->find($id);

        if (empty($lessonType)) {
            Flash::error('Тип занятия не найдена!');

            return redirect(route('lessonTypes.index'));
        }

        return view('lesson_types.show')->with('lessonType', $lessonType);
    }

    /**
     * Show the form for editing the specified LessonType.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $lessonType = $this->lessonTypeRepository->find($id);

        if (empty($lessonType)) {
            Flash::error('Тип занятия не найдена!');

            return redirect(route('lessonTypes.index'));
        }

        return view('lesson_types.edit')->with('lessonType', $lessonType);
    }

    /**
     * Update the specified LessonType in storage.
     *
     * @param int $id
     * @param UpdateLessonTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLessonTypeRequest $request)
    {
        $lessonType = $this->lessonTypeRepository->find($id);

        if (empty($lessonType)) {
            Flash::error('Тип занятия не найдена!');

            return redirect(route('lessonTypes.index'));
        }

        $lessonType = $this->lessonTypeRepository->update($request->all(), $id);

        Flash::success('Тип занятия успешно обновлена!');

        return redirect(route('lessonTypes.index'));
    }

    /**
     * Remove the specified LessonType from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $arr = [1,2,3];
        if(!in_array($id,$arr)){
            $lessonType = $this->lessonTypeRepository->find($id);

            if (empty($lessonType)) {
                Flash::error('Тип занятия не найдена!');

                return redirect(route('lessonTypes.index'));
            }

            $this->lessonTypeRepository->delete($id);

            Flash::success('Тип занятия успешно удалена!');
        }
        else{
            Flash::error('Запрещено удалять системные данные.');
        }


        return redirect(route('lessonTypes.index'));
    }
}
