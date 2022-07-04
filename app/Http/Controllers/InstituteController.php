<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstituteRequest;
use App\Http\Requests\UpdateInstituteRequest;
use App\Models\Institute;
use App\Repositories\Settings\InstituteRepository;
use Illuminate\Http\Request;

class InstituteController extends Controller
{
    private $instituteRepository;

    public function __construct(InstituteRepository $instituteRepository)
    {
        $this->instituteRepository = $instituteRepository;    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->page ? $request->page : 1;
        $count = $request->count ? $request->count : 10;
        $search = $request->search && $request->search != '' && $request->search !== 'null' ? $request->search : null;

        $params = [
            'page' => $page,
            'count' => $count,
            'search' => $search
        ];

        $institutes = $this->instituteRepository->getInstitutes(json_decode(json_encode($params)));

        return response()->json($institutes, 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInstituteRequest $request)
    {
        $institute = $this->instituteRepository->storeInstitute($request);

        return response()->json($institute, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $institute = $this->instituteRepository->getInstituteById($id);

        return response()->json($institute, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    public function edit(Institute $institute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInstituteRequest $request, $id)
    {
        $institute = $this->instituteRepository->updateInstitute($request, $id);
        
        return response()->json($institute,200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        $institute = $this->instituteRepository->deleteInstitute($id);

        return response()->json($institute, 200);

    }
}
