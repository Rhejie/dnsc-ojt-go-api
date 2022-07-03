<?php

namespace App\Repositories;


use \Auth;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{

    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function query()
    {
        return $this->model();
    }

    public function model()
    {
        return $this->model;
    }

    // Get all instances of model
    public function all()
    {
        $result = $this->model()->get();

        return $result;
    }

    public function paginate(int $count, int $page = 1)
    {
        return $this->model()->paginate($count, ['*'], 'page', $page);
    }

    // create a new record in the database
    public function create(array $data)
    {
        $data = $this->model()->create($data);

        return $this->model()->findOrFail($data->id);
    }

    public function updateOrCreate(array $criteria, array $data)
    {
        return $this->model()->updateOrCreate($criteria, $data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record  = $this->model()->findOrFail($id);

        $record->update($data);

        return $this->model()->findOrFail($record->id);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model()->find($id)->delete();
    }

    public function deleteWhere($params)
    {
        return $this->model()->where($params)->delete();
    }

    // show the record with the given id
    public function get($id)
    {
        return $this->model()->find($id);
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model()->with($relations);
    }

    // get record with condition
    public function where($params)
    {
        return $this->model()->where($params);
    }
}
