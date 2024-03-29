<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use App\Imports\QuestionImport;
use App\Repositories\QuizRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class QuizController extends AppBaseController
{
    /** @var  QuizRepository */
    private $quizRepository;

    public function __construct(QuizRepository $quizRepo)
    {
        $this->quizRepository = $quizRepo;
    }

    /**
     * Display a listing of the Quiz.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $quizzes = $this->quizRepository->paginate(30);

        return view('quizzes.index')
            ->with('quizzes', $quizzes);
    }

    /**
     * Show the form for creating a new Quiz.
     *
     * @return Response
     */
    public function create()
    {
        return view('quizzes.create');
    }

    /**
     * Store a newly created Quiz in storage.
     *
     * @param CreateQuizRequest $request
     *
     * @return Response
     */
    public function store(CreateQuizRequest $request)
    {
        $input = $request->all();

        $quiz = $this->quizRepository->create($input);

        Flash::success('Тест успешно создан!');

        return redirect(route('quizzes.index'));
    }

    /**
     * Display the specified Quiz.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $quiz = $this->quizRepository->find($id);

        if (empty($quiz)) {
            Flash::error('Тест не найден!');

            return redirect(route('quizzes.index'));
        }

        return view('quizzes.show')->with('quiz', $quiz);
    }

    /**
     * Show the form for editing the specified Quiz.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $quiz = $this->quizRepository->find($id);

        if (empty($quiz)) {
            Flash::error('Тест не найден!');

            return redirect(route('quizzes.index'));
        }

        return view('quizzes.edit')->with('quiz', $quiz);
    }

    /**
     * Update the specified Quiz in storage.
     *
     * @param int $id
     * @param UpdateQuizRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuizRequest $request)
    {
        $quiz = $this->quizRepository->find($id);

        if (empty($quiz)) {
            Flash::error('Тест не найден!');

            return redirect(route('quizzes.index'));
        }

        $quiz = $this->quizRepository->update($request->all(), $id);

        Flash::success('Тест успешно обновлен!');

        return redirect(route('quizzes.index'));
    }

    /**
     * Remove the specified Quiz from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $quiz = $this->quizRepository->find($id);

        if (empty($quiz)) {
            Flash::error('Тест не найден!');

            return redirect(route('quizzes.index'));
        }
        $quiz->questions()->delete();
        $this->quizRepository->delete($id);


        Flash::success('Тест успешно удален!');

        return redirect(route('quizzes.index'));
    }

}
