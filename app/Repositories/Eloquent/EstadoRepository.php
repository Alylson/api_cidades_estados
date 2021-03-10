<?php


namespace App\Repositories\Eloquent;

use App\Models\Estado;
use App\Repositories\Contracts\EstadoRepositoryInterface;

class EstadoRepository extends AbstractRepository implements EstadoRepositoryInterface
{
    protected $model = Estado::class;
}
