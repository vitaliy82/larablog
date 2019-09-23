<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StopWordRepository;
use App\Entities\StopWord;
use App\Validators\StopWordValidator;

/**
 * Class StopWordRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class StopWordRepositoryEloquent extends BaseRepository implements StopWordRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StopWord::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return StopWordValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
