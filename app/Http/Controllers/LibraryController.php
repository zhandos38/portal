<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;
use App\Models\Library;
use App\Repositories\LibraryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Response;

class LibraryController extends AppBaseController
{
    /** @var  LibraryRepository */
    private $libraryRepository;

    public function __construct(LibraryRepository $libraryRepo)
    {
        $this->libraryRepository = $libraryRepo;
    }

    /**
     * Display a listing of the Library.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->role_id == 1){
            $libraries = $this->libraryRepository->paginate(30);
        }
        if(Auth::user()->role_id == 4){
            $libraries = Library::where("user_id",Auth::id())->paginate(30);
        }


        return view('libraries.index')
            ->with('libraries', $libraries);
    }

    /**
     * Show the form for creating a new Library.
     *
     * @return Response
     */
    public function create()
    {
        return view('libraries.create');
    }


    public function store(Request $request)
    {
        $this->validate($request,["title"=>"required|unique:libraries","description"=>"required","src"=>"required|file|max:102400|mimes:doc,docx,xls,xlsx,ppt,pptx,pdf,odt,txt"],
            ["required"=>"Поле :attribute обязательно для заполнения","unique"=>"Файл с таким наименованием уже существует","file"=>"Поле :attribute должен быть файлом","max"=>"Размер исходного файла не должен превышать 100МБ"],
            ["title"=>"наименование","description"=>"описание","src"=>"файл"]
            );
            if(Library::makeDate($request)){
                Flash::success('Файл успешно добавлен в библиотеку!');

            }
            else{
                Flash::error('Произошла ошибка');
            }
            return redirect(route('libraries.index'));

    }

    /**
     * Display the specified Library.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $library = $this->libraryRepository->find($id);

        if (empty($library)) {
            Flash::error('Файл не найден!!');

            return redirect(route('libraries.index'));
        }

        return view('libraries.show')->with('library', $library);
    }

    /**
     * Show the form for editing the specified Library.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $library = $this->libraryRepository->find($id);

        if (empty($library)) {
            Flash::error('Файл не найден!!');

            return redirect(route('libraries.index'));
        }

        return view('libraries.edit')->with('library', $library);
    }

    /**
     * Update the specified Library in storage.
     *
     * @param int $id
     * @param UpdateLibraryRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request,["title"=>"required|unique:libraries,title,$id","description"=>"required","src"=>"sometimes|file|max:102400|mimes:doc,docx,xls,xlsx,ppt,pptx,pdf,odt,txt"],
            ["required"=>"Поле :attribute обязательно для заполнения","unique"=>"Файл с таким наименованием уже существует","file"=>"Поле :attribute должен быть файлом","max"=>"Размер исходного файла не должен превышать 100МБ"],
            ["title"=>"наименование","description"=>"описание","src"=>"файл"]);
        $library = Library::find($id);
        if($library){
            if(Library::updateData($request,$library)){
                Flash::success('Успешно изменено!');
            }
            else{
                Flash::error('Произошла ошибка!');
            }
        }
        else{
            Flash::error('Файл не найден!');
        }

        return redirect(route('libraries.index'));
    }

    /**
     * Remove the specified Library from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $library = $this->libraryRepository->find($id);

        if (empty($library)) {
            Flash::error('Файл не найден!!');

            return redirect(route('libraries.index'));
        }

        Library::deleteFile($library);
        $this->libraryRepository->delete($id);

        Flash::success('Файл успешно удален!');

        return redirect(route('libraries.index'));
    }
    public function download($id){
        $library = $this->libraryRepository->find($id);
        if($library){
            if (Storage::disk("local")->exists($library->src)){
               return response()->download(public_path($library->src));
            }
            else{
                abort(404);
            }
        }
        else{
            Flash::error('Файл не найден!');
            return redirect(route('libraries.index'));

        }

    }
}
