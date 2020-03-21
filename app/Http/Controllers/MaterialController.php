<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;
use App\Models\Group;
use App\Models\Library;
use App\Models\Material;
use App\Models\Semester;
use App\Models\Shedule;
use App\Models\Subject;
use App\Repositories\MaterialRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class MaterialController extends AppBaseController
{
    /** @var  MaterialRepository */
    private $materialRepository;

    public function __construct(MaterialRepository $materialRepo)
    {
        $this->materialRepository = $materialRepo;
    }

    /**
     * Display a listing of the Material.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->role_id == 1){
            $materials = $this->materialRepository->paginate(30);
        }
        if(Auth::user()->role_id == 4){
            $materials = Material::where("teacher_id",Auth::id())->paginate(30);
        }

        return view('materials.index',compact('materials'));
    }

    /**
     * Show the form for creating a new Material.
     *
     * @return Response
     */
    public function create()
    {
        $semester = Semester::where("current",1)->first();
        $subjectsIds = array_keys(Shedule::where(["semester_id"=>$semester->id,"teacher_id"=>Auth::id()])->pluck("id","subject_id")->all());
        $subjects = Subject::whereIn("id",$subjectsIds)->pluck("title","id")->prepend("Не выбранно",0)->all();


        return view('materials.create',compact("subjects"));
    }

    /**
     * Store a newly created Material in storage.
     *
     * @param CreateMaterialRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["semester_id"=>"required","subject_id"=>"required","group_id"=>"required","library_id"=>"required","title"=>"required","description"=>"required"],
            ["required"=>"Поле :attribute обязательно для заполнения"],
            ["semester_id"=>"семестр","subject_id"=>"дисциплина","group_id"=>"группа","library_id"=>"файлы","title"=>"наименование","description"=>"описание"]
            );
        $input = $request->all();
        $input["teacher_id"] = Auth::id();
        Material::create($input);


        Flash::success('Материал успешно добавлен.');

        return redirect(route('materials.index'));
    }

    /**
     * Display the specified Material.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            Flash::error('Material not found');

            return redirect(route('materials.index'));
        }

        return view('materials.show')->with('material', $material);
    }

    /**
     * Show the form for editing the specified Material.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            Flash::error('Material not found');

            return redirect(route('materials.index'));
        }
        $semester = Semester::where("current",1)->first();
        $subjectsIds = array_keys(Shedule::where(["semester_id"=>$semester->id,"teacher_id"=>Auth::id()])->pluck("id","subject_id")->all());
        $subjects = Subject::whereIn("id",$subjectsIds)->pluck("title","id")->prepend("Не выбранно",0)->all();

        return view('materials.edit',compact('material', "subjects"));
    }

    /**
     * Update the specified Material in storage.
     *
     * @param int $id
     * @param UpdateMaterialRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request,["semester_id"=>"required","subject_id"=>"required","group_id"=>"required","library_id"=>"required","title"=>"required","description"=>"required"],
            ["required"=>"Поле :attribute обязательно для заполнения"],
            ["semester_id"=>"семестр","subject_id"=>"дисциплина","group_id"=>"группа","library_id"=>"файлы","title"=>"наименование","description"=>"описание"]
        );
        $material = $this->materialRepository->find($id);
        if (empty($material)) {
            Flash::error('Material not found');

            return redirect(route('materials.index'));
        }
        $input = $request->all();
        $input["teacher_id"] = Auth::id();
        $material = $this->materialRepository->update($input, $id);

        Flash::success('Material updated successfully.');

        return redirect(route('materials.index'));
    }


    public function destroy($id)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            Flash::error('Material not found');

            return redirect(route('materials.index'));
        }

        $this->materialRepository->delete($id);

        Flash::success('Material deleted successfully.');

        return redirect(route('materials.index'));
    }

    public function getData(Request $request){
        $str = Material::filterData($request);
        return $str;
    }
}
