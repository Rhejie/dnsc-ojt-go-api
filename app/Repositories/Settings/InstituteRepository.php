<?php

namespace App\Repositories\Settings;

use App\Models\Institute;
use App\Repositories\Repository;

class InstituteRepository extends Repository {
    public function __construct(Institute $model) {
        $this->model = $model;
    }

    public function getInstitutes($params) {

        $institutes = $this->model();

        if($params->search) {

            $institutes = $institutes->where(function($query) use ($params) {
                $query->orWhere('name', 'LIKE', "%$params->search%");
                $query->orWhere('abbreviation', 'LIKE', "%$params->search%");
            })->orderBy('id', 'desc')->paginate($params->count, ['*'], 'page', $params->page);

            return $institutes;
        }

        $institutes = $institutes->orderBy('id', 'desc')->paginate($params->count, ['*'], 'page', $params->page);

        return $institutes;
    }

    public function storeInstitute($request) {
        $institute = new $this->model();
        $institute->name = $request->name;
        $institute->abbreviation = $request->abbreviation;
        if($institute->save()) {
            return $institute;
        }
    }

    public function updateInstitute($request, $id) {
        $institute = $this->model()->find($id);
        $institute->name = $request->name;
        $institute->abbreviation = $request->abbreviation;
        if($institute->save()) {
            return $institute;
        }
    }

    public function getInstituteById($id) {
        $institute = $this->model()->find($id);
        return $institute;
    }

    public function deleteInstitute($id) {
        $institute = $this->model()->find($id);
        if($institute) {
            $institute->delete();
        } 
    }
    
}