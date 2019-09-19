<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

abstract class CustomRepository extends BaseRepository {

    /**
     * Retrieve all data of repository, paginated
     *
     * @param null $limit
     * @param int $page
     * @param array $columns
     * @param string $method
     * @return mixed
     */
    public function paginate($limit = null, $page = null, $columns = ['*'], $method = "paginate")
    {
        $this->applyCriteria();
        $this->applyScope();
        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;
        $results = $this->model->{$method}($limit, $columns, 'page', $page);
        $results->appends(app('request')->query());
        $this->resetModel();

        return $this->parserResult($results);
    }
}
