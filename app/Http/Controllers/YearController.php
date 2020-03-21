<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateYearRequest;
use App\Http\Requests\UpdateYearRequest;
use App\Repositories\YearRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class YearController extends AppBaseController
{
    /** @var  YearRepository */
    private $yearRepository;

    public function __construct(YearRepository $yearRepo)
    {
        $this->yearRepository = $yearRepo;
    }

    /**
     * Display a listing of the Year.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $years = $this->yearRepository->paginate(30);

        return view('years.index')
            ->with('years', $years);
    }

    /**
     * Show the form for creating a new Year.
     *
     * @return Response
     */
    public function create()
    {
        return view('years.create');
    }

    /**
     * Store a newly created Year in storage.
     *
     * @param CreateYearRequest $request
     *
     * @return Response
     */
    public function store(CreateYearRequest $request)
    {
        $input = $request->all();

        $year = $this->yearRepository->create($input);

        Flash::success('Учебный год успешно создан!');

        return redirect(route('years.index'));
    }

    /**
     * Display the specified Year.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $year = $this->yearRepository->find($id);

        if (empty($year)) {
            Flash::error('Учебный год не найден!');

            return redirect(route('years.index'));
        }

        return view('years.show')->with('year', $year);
    }

    /**
     * Show the form for editing the specified Year.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $year = $this->yearRepository->find($id);

        if (empty($year)) {
            Flash::error('Учебный год не найден!');

            return redirect(route('years.index'));
        }

        return view('years.edit')->with('year', $year);
    }

    /**
     * Update the specified Year in storage.
     *
     * @param int $id
     * @param UpdateYearRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateYearRequest $request)
    {
        $year = $this->yearRepository->find($id);

        if (empty($year)) {
            Flash::error('Учебный год не найден!');

            return redirect(route('years.index'));
        }

        $year = $this->yearRepository->update($request->all(), $id);

        Flash::success('Учебный год успешно обновлен!');

        return redirect(route('years.index'));
    }

    /**
     * Remove the specified Year from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $year = $this->yearRepository->find($id);

        if (empty($year)) {
            Flash::error('Учебный год не найден!');

            return redirect(route('years.index'));
        }

        $this->yearRepository->delete($id);

        Flash::success('Учебный год успешно удален!');

        return redirect(route('years.index'));
    }
}
