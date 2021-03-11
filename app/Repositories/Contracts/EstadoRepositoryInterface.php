<?php


namespace App\Repositories\Contracts;


interface EstadoRepositoryInterface
{
    public function estadoWithCidade();
    public function estadoWithCidadeId($id);
    public function findEstado($id);
    public function all();
    public function whereEstadoId($request, $id);
}
