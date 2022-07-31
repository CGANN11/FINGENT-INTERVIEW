<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository.
 *
 * @package namespace App\Repositories;
 */
class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @author Nishal <nishal@webandcrafts.com>
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     *
     * @author Nishal <nishal@webandcrafts.com>
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Find by Id
     *
     * @author Nishal <nishal@webandcrafts.com>
     *
     * @param $id - Id of data to return
     * @return Model - return respective model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }
}
