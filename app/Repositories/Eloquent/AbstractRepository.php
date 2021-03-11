<?php


namespace App\Repositories\Eloquent;


abstract class AbstractRepository
{
    protected $model;
    protected $id;
    protected $request;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }

    public function estadoWithCidade()
    {
        return $this->model->with('cidade')->get();
    }

    public function estadoWithCidadeId($id)
    {
        return $this->model->with('cidade')->where('id', $id)->get();
    }

    public function findEstado($id)
    {
        return $this->model->find($id);
    }

    public function all()
    {
        return $this->model->with('cidade')->toArray();
    }

    public function whereEstadoId($request, $id)
    {
        return $this->model->where('id',$id)
            ->update([
                    'uf' => $request->get('uf'),
                    'nome' => $request->get('nome')]
            );
    }
}
