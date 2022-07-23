<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgencyStoreRequest;
use App\Models\Agency;
use App\Repositories\Agency\AgencyRepository;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    private $agencyRepository;

    public function __construct(AgencyRepository $agencyRepository) {
        $this->agencyRepository = $agencyRepository;
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

        $agencies = $this->agencyRepository->getAgencies(json_decode(json_encode($params)));

        return response()->json($agencies, 200);
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
    public function store(AgencyStoreRequest $request)
    {
        $agency = $this->agencyRepository->storeAgency($request);

        return response()->json($agency, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agency = $this->agencyRepository->getAgencyById($id);

        return response()->json($agency, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit(Agency $agency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(AgencyStoreRequest $request, $id)
    {
        $agency = $this->agencyRepository->updateAgency($request, $id);

        return response()->json($agency, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
