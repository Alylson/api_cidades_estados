<?php


namespace App\Repositories\Eloquent;


abstract class AbstractRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }

    public function withCidade()
    {
        return $this->model->with('cidade')->get();
    }

    public function all()
    {
        return $this->model->with('cidade')->get();
    }
}
