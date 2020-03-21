<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserInfoRequest;
use App\Http\Requests\UpdateUserInfoRequest;
use App\Models\User;
use App\Repositories\UserInfoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class UserInfoController extends AppBaseController
{
    /** @var  UserInfoRepository */
    private $userInfoRepository;

    public function __construct(UserInfoRepository $userInfoRepo)
    {
        $this->userInfoRepository = $userInfoRepo;
    }

    /**
     * Display a listing of the UserInfo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $userInfos = $this->userInfoRepository->all();

        return view('user_infos.index')
            ->with('userInfos', $userInfos);
    }

    /**
     * Show the form for creating a new UserInfo.
     *
     * @return Response
     */
    public function create($id)
    {
        $user = User::where('id', $id)->first();
        return view('user_infos.create', compact('user'));
    }

    /**
     * Store a newly created UserInfo in storage.
     *
     * @param CreateUserInfoRequest $request
     *
     * @return Response
     */
    public function store(CreateUserInfoRequest $request)
    {
        $input = $request->all();

        $userInfo = $this->userInfoRepository->create($input);

        Flash::success('User Info saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified UserInfo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userInfo = $this->userInfoRepository->find($id);

        if (empty($userInfo)) {
            Flash::error('User Info not found');

            return redirect(route('userInfos.index'));
        }

        return view('user_infos.show')->with('userInfo', $userInfo);
    }

    /**
     * Show the form for editing the specified UserInfo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userInfo = $this->userInfoRepository->find($id);
        $user = $userInfo->users;
        if (empty($userInfo)) {
            Flash::error('User Info not found');

            return redirect(route('users.index'));
        }

        return view('user_infos.edit')->with(compact('userInfo', 'user'));
    }

    /**
     * Update the specified UserInfo in storage.
     *
     * @param int $id
     * @param UpdateUserInfoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserInfoRequest $request)
    {
        $userInfo = $this->userInfoRepository->find($id);

        if (empty($userInfo)) {
            Flash::error('User Info not found');

            return redirect(route('users.index'));
        }

        $userInfo = $this->userInfoRepository->update($request->all(), $id);

        Flash::success('User Info updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified UserInfo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userInfo = $this->userInfoRepository->find($id);

        if (empty($userInfo)) {
            Flash::error('User Info not found');

            return redirect(route('users.index'));
        }

        $this->userInfoRepository->delete($id);

        Flash::success('User Info deleted successfully.');

        return redirect(route('users.index'));
    }
}
