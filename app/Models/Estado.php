<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'tb_estado';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uf',
        'nome'
    ];

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    function cidades()
    {
        return $this->hasMany(Cidade::class);
    }
}
