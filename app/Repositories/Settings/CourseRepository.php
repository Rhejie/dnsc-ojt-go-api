<?php

namespace App\Repositories\Settings;

use App\Models\Course;
use App\Repositories\Repository;

class CourseRepository extends Repository {

    public function __construct(Course $model) {
        $this->model = $model;
    }

    public function getCourses($params) {

        $courses = $this->model();

        if($params->search) {

            $courses = $courses->where(function($query) use ($params) {
                $query->orWhere('name', 'LIKE', "%$params->search%");
                $query->orWhere('abbreviation', 'LIKE', "%$params->search%");
            })->orderBy('id', 'desc')->paginate($params->count, ['*'], 'page', $params->page);

            return $courses;
        }

        $courses = $courses->orderBy('id', 'desc')->paginate($params->count, ['*'], 'page', $params->page);

        return $courses;
    }

    public function storeCourse($request) {
        $course = new $this->model();
        $course->name = $request->name;
        $course->institute_id = $request->institute_id;
        $course->abbreviation = $request->abbreviation;
        if($course->save()) {
            return $course;
        }
    }

    public function updateCourse($request, $id) {
        $course = $this->model()->find($id);
        $course->name = $request->name;
        $course->institute_id = $request->institute_id;
        $course->abbreviation = $request->abbreviation;
        if($course->save()) {
            return $course;
        }
    }

    public function deleteCourse($id) {
        $course = $this->model()->find($id);
        if($course) {
            $course->delete();
        }
    }

    public function getCourseById($id) {

        $course = $this->model()->with('institute')->find($id);

        return $course;

    }

}
