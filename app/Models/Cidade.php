<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    protected $table = 'tb_cidade';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'estado_id'
    ];

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    function estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
