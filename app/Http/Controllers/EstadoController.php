<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\EstadoResource;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listarEstados()
    {
        $estados = Estado::all();
        return response([ 'estados' => EstadoResource::collection($estados), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarEstado(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'uf' => 'required|max:2|unique:tb_estado',
            'nome' => 'required|max:255|unique:tb_estado'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $estado = Estado::create($data);

        return response(['estado' => new EstadoResource($estado), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function buscarEstadoPorId(Estado $estado)
    {
        return response(['estado' => new EstadoResource($estado), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function atualizarEstado(Request $request, Estado $estado)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'uf' => 'required|max:2|unique:tb_estado',
            'nome' => 'required|max:255|unique:tb_estado'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $estado->update($data);

        return response(['estado' => new EstadoResource($estado), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function excluirEstado(Estado $estado)
    {
        $estado->delete();

        return response(['message' => 'Deleted']);
    }
}
