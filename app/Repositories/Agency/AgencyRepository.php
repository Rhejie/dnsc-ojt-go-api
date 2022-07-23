<?php

namespace App\Repositories\Agency;

use App\Models\Agency;
use App\Repositories\Repository;

class AgencyRepository extends Repository {

    public function __construct(Agency $model) {
        $this->model = $model;
    }

    public function getAgencies($params) {

        $agencies = $this->model();

        if($params->search) {

            $agencies = $agencies->where(function($query) use ($params) {
                $query->orWhere('name', 'LIKE', "%$params->search%");
            })->orderBy('id', 'desc')->paginate($params->count, ['*'], 'page', $params->page);

            return $agencies;
        }

        $agencies = $agencies->orderBy('id', 'desc')->paginate($params->count, ['*'], 'page', $params->page);

        return $agencies;
    }

    public function storeAgency($request) {
        $agency = new $this->model();
        $agency->name = $request->name;
        $agency->address = $request->address;
        $agency->latitude = $request->latitude;
        $agency->longitude = $request->longitude;
        if($agency->save()) {
            return $agency;
        }
    }

    public function updateAgency($request, $id) {
        $agency = $this->model()->find($id);
        $agency->name = $request->name;
        $agency->address = $request->address;
        $agency->latitude = $request->latitude;
        $agency->longitude = $request->longitude;
        if($agency->save()) {
            return $agency;
        }
    }

    public function deleteAgency($id) {
        $agency = $this->model()->find($id);
        if($agency) {
            $agency->delete();
        }
    }

    public function getAgencyById($id) {

        $agency = $this->model()->with('institute')->find($id);

        return $agency;

    }

}
