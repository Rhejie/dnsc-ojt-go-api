<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function all();

    public function paginate(int $count, int $page);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function get($id);

    public function where($params);

}
