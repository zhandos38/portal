<?php

namespace App\Http\Controllers;

use App\ExpelledStudent;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Group;
use App\Models\Roles;
use App\Models\User;
use App\Models\UserInfo;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        if (Auth::user()->role_id == 1){
//            $roles = Roles::pluck('title', 'id')->all();
        $users = User::where('id', '!=', Auth::user()->id)->paginate(30);
    }
        if (Auth::user()->role_id == 2) {
//            $roles = Roles::whereNotIn('id', [1,2,6])->pluck('title', 'id')->all();
            $users = User::whereNotIn('id',[1,2,6,5])->where('faculty_id', Auth::user()->faculty_id)->paginate(30);
        }
        return view('users.index')
            ->with(compact('users'));
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        if (Auth::user()->role_id == 1){
            $roles = Roles::pluck('title', 'id')->all();
            $faculties = Faculty::pluck("title","id")->all();
            $departments = Department::pluck("title","id")->all();
            $groups = Group::pluck("title","id")->all();
        }
        if (Auth::user()->role_id == 2) {
            $roles = Roles::whereNotIn('id', [1,2,6,5])->pluck('title', 'id')->all();
            $faculties = Faculty::where("id",Auth::user()->faculty_id)->pluck("title","id")->all();
            $key = array_keys($faculties);
            $departments = Department::where("faculty_id",$key[0])->pluck("title","id")->all();
            $department_keys = array_keys($departments);
            $groups = Group::whereIn("department_id",$department_keys)->pluck("title","id")->all();
        }
        $userInfo = null;
        $hidden = true;
        return view('users.create', compact('roles', 'faculties', 'departments', 'groups', 'hidden', 'userInfo'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request,["login"=>"required|unique:users","password"=>"required","firstName"=>"required","middleName"=>"required","lastName"=>"required",
            "address"=>"required","birthDay"=>"required","nationality"=>"required","citizen"=>"required","cardNumber"=>"required|same:password","iin"=>"sometimes|unique:user_infos","idCard"=>"sometimes|unique:user_infos",],
            ["required"=>"Поле :attribute обязательно для заполнения","unique"=>"Поле :attribute уже существует","same"=>"Поле зачетная книжка должна совпадать с паролем"],
            ["login"=>"логин","password"=>"пароль","firstName"=>"имя","middleName"=>"отчество","lastName"=>"фамилия",
                "address"=>"адрес","birthDay"=>"дата рождения","nationality"=>"национальность","citizen"=>"гражданство","cardNumber"=>"номер зачетной книжки/пароль","iin"=>"ИИН","idCard"=>"номер уд.личности(паспорта)",]
        );
        $input = User::makeData($request->all());
        $user = User::create($input);
        if($user){
            UserInfo::makeData($request,$user->id);
        }
        if (Auth::user()->role_id == 1){
//            $roles = Roles::pluck('title', 'id')->all();
            $users = User::where('id', '!=', Auth::user()->id)->paginate(30);
        }
        if (Auth::user()->role_id == 2) {
//            $roles = Roles::whereNotIn('id', [1,2,6])->pluck('title', 'id')->all();
            $users = User::whereNotIn('id',[1,2,6,5])->where('faculty_id', Auth::user()->faculty_id)->paginate(30);
        }
        Flash::success('Пользователь успешно сохранен!');

        return view('users.index', compact('users'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);
        if (empty($user)) {
            Flash::error('Пользователь не найден!');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('Пользователь не найден!');

            return redirect(route('users.index'));
        }
        if (Auth::user()->role_id == 1){
            $roles = Roles::pluck('title', 'id')->all();
            $faculties = Faculty::pluck("title","id")->prepend("Не выбранно",0)->all();
            $departments = Department::pluck("title","id")->prepend("Не выбранно",0)->all();
            $groups = Group::pluck("title","id")->prepend("Не выбранно",0)->all();
        }
        if (Auth::user()->role_id == 2) {
            $roles = Roles::whereNotIn('id', [1,2,6])->pluck('title', 'id')->all();
            $faculties = Faculty::where("id",Auth::user()->faculty_id)->pluck("title","id")->all();
            $key = array_keys($faculties);
            $departments = Department::where("faculty_id",$key[0])->pluck("title","id")->prepend("Не выбранно",0)->all();
            $department_keys = array_keys($departments);
            $groups = Group::whereIn("department_id",$department_keys)->pluck("title","id")->prepend("Не выбранно",0)->all();
        }
        $userInfo = UserInfo::where("user_id",$id)->first();
        $hidden = false;

        return view('users.edit')->with(compact("user","roles","faculties","departments","groups","hidden","userInfo"));
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request,["login"=>"required|unique:users,id,$id","password"=>"required","firstName"=>"required","middleName"=>"required","lastName"=>"required",
            "address"=>"required","birthDay"=>"required","nationality"=>"required","citizen"=>"required","cardNumber"=>"required|same:password","iin"=>"sometimes|unique:user_infos,user_id,$id","idCard"=>"sometimes|unique:user_infos,user_id,$id",],
            ["required"=>"Поле :attribute обязательно для заполнения","unique"=>"Поле :attribute уже существует","same"=>"Поле зачетная книжка должна совпадать с паролем"],
            ["login"=>"логин","password"=>"пароль","firstName"=>"имя","middleName"=>"отчество","lastName"=>"фамилия",
                "address"=>"адрес","birthDay"=>"дата рождения","nationality"=>"национальность","citizen"=>"гражданство","cardNumber"=>"номер зачетной книжки/пароль","iin"=>"ИИН","idCard"=>"номер уд.личности(паспорта)",]
        );
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('Пользователь не найден!');

            return redirect(route('users.index'));
        }
        $input = User::makeData($request->all());
        $user->update($input);
        UserInfo::makeData($request,$id);

        Flash::success('Пользователь успешно обновлен!.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('Пользователь не найден!');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('Пользователь успешно удален!');

        return redirect(route('users.index'));
    }


    //different roles
    public function superAdmin(){
        $users = User::where("id","!=",Auth::user()->id)->where("role_id",1)->paginate(30);
        return view('users.index')
            ->with('users', $users);
    }
    public function administrator(){
        $users = User::where("role_id",2)->paginate(30);
        return view('users.index')
            ->with('users', $users);
    }

    public function moderator(){
        if(Auth::user()->role_id == 1) {
            $users = User::where("role_id", 3)->paginate(30);
        }
        if(Auth::user()->role_id == 2){
            $users = User::where(["role_id"=>3,"faculty_id"=>Auth::user()->faculty_id])->paginate(30);
        }
        return view('users.index')
            ->with('users', $users);
    }
    public function teacher(){
        if(Auth::user()->role_id == 1) {
            $users = User::where("role_id", 4)->paginate(30);
        }
        if(Auth::user()->role_id == 2){
            $users = User::where(["role_id"=>4,"faculty_id"=>Auth::user()->faculty_id])->paginate(30);
        }
        return view('users.index')
            ->with('users', $users);
    }
    public function student(){
        if(Auth::user()->role_id == 1) {
            $users = User::where("role_id", 5)->paginate(30);
        }
        if(Auth::user()->role_id == 2){
            $users = User::where(["role_id"=>5,"faculty_id"=>Auth::user()->faculty_id])->paginate(30);
        }
        return view('users.index')
            ->with('users', $users);
    }

    //expel Student

    public function expel($id){
        $user = User::find($id);
        if($user){
            if($user->role_id == 5){
                if(Auth::user()->role_id == 1 || (Auth::user()->role_id == 2 && Auth::user()->faculty_id == $user->faculty_id)){
                    ExpelledStudent::expelStudent($id);
                }

                Flash::success("Успешно выполнено");
            }
        }
        else{
            Flash::error('Пользователь не найден!');
        }
        return redirect(route('users.expelled'));


    }

    public function expelled(){
       $userIds = ExpelledStudent::getExpelledStudent();
        if(Auth::user()->role_id == 1){
          $users = User::whereIn("id",$userIds)->paginate(30);
        }
        if(Auth::user()->role_id == 2){
            $users = User::whereIn("id",$userIds)->where("faculty_id",Auth::user()->faculty_id)->paginate(30);
        }
        return view("users.index",compact("users"));
    }
    public function active(){
        $userIds = ExpelledStudent::getExpelledStudent();
        if(Auth::user()->role_id == 1){
            $users = User::whereNotIn("id",$userIds)->where("role_id",5)->paginate(30);
        }
        if(Auth::user()->role_id == 2){
            $users = User::whereNotIn("id",$userIds)->where(["faculty_id"=>Auth::user()->faculty_id,"role_id"=>5])->paginate(30);
        }
        return view("users.index",compact("users"));
    }



}
