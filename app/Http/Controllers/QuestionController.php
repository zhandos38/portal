<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Imports\QuestionImport;
use App\Models\Question;
use App\Models\Quiz;
use App\Repositories\QuestionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class QuestionController extends AppBaseController
{
    /** @var  QuestionRepository */
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepo)
    {
        $this->questionRepository = $questionRepo;
    }

    /**
     * Display a listing of the Question.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $questions = $this->questionRepository->paginate(30);
        $quizzes = Quiz::paginate(30);

        return view('questions.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new Question.
     *
     * @return Response
     */
    public function create()
    {
        $str1 = parse_url(url()->full(), PHP_URL_QUERY);
        $quiz = preg_replace('/[^0-9]/', '', $str1);
        $questions = Question::where('quiz_id', $quiz)->paginate(30);

        return view('questions.create', compact('questions', 'quiz'));
    }
    public function addQuestion($id)
    {
        $questions = Question::where('quiz_id', $id)->paginate(30);
        $quiz = $id;

        return view('questions.create', compact('questions', 'quiz'));
    }

    /**
     * Store a newly created Question in storage.
     *
     * @param CreateQuestionRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionRequest $request)
    {
        $input = $request->all();

        $question = $this->questionRepository->create($input);

        Flash::success('Вопрос успешно создан!');

        return redirect()->back();
    }

    /**
     * Display the specified Question.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Вопрос не найден!');

            return redirect(route('questions.index'));
        }

        return view('questions.show')->with('question', $question);
    }

    /**
     * Show the form for editing the specified Question.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Вопрос не найден!');

            return redirect(route('questions.index'));
        }
        $quiz = $question->quizzes->id;
        return view('questions.edit')->with(compact('question', 'quiz'));
    }

    /**
     * Update the specified Question in storage.
     *
     * @param int $id
     * @param UpdateQuestionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionRequest $request)
    {
        $question = $this->questionRepository->find($id);
        if (empty($question)) {
            Flash::error('Вопрос не найден!');

            return redirect(route('questions.index'));
        }

        $question = $this->questionRepository->update($request->all(), $id);

        Flash::success('Вопрос успешно обновлен!');

        $url = route('questions.create'). "?".$question->quizzes->id;

        return redirect("$url");
    }

    /**
     * Remove the specified Question from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $question = $this->questionRepository->find($id);

        if (empty($question)) {
            Flash::error('Вопрос не найден!');

            return redirect(route('questions.index'));
        }

        $this->questionRepository->delete($id);

        Flash::success('Вопрос успешно удален!');

        return redirect(route('questions.index'));
    }

    public function importExcelToDB(Request $request){
        $this->validate($request,["quiz_id"=>"required","questions"=>"required|mimes:xlsx,xls"],
            ["required"=>"Поля обязательны для заполнения",]);
        $file = $request->file("questions")->getRealPath();
        $quiz_id = $request->get("quiz_id");
        Excel::import(new QuestionImport($quiz_id),$request->file("questions"));
        return redirect(route('quizzes.index'));
    }
}
