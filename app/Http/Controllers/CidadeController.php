<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CidadeResource;

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listarCidades()
    {
        $cidades = Cidade::all();
        return response([ 'cidades' => CidadeResource::collection($cidades), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cadastrarCidade(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'nome' => 'required|max:255|unique:tb_cidade'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $cidade = Cidade::create($data);

        return response(['cidade' => new CidadeResource($cidade), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function buscarCidadePorId(Cidade $cidade)
    {
        return response(['cidade' => new CidadeResource($cidade), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function atualizarCidade(Request $request, $id)
    {
        $cidade = $request->all();
        $data = Cidade::find($id);

        $validator = Validator::make($cidade, [
            'nome' => 'required|max:255',
            'estado_id' => 'required|integer'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        Cidade::where('id', $data->id)
            ->update([
                    'nome' => $request->get('nome'),
                    'estado_id' => $request->get('estado_id')]
            );

        return response(['cidade' => new CidadeResource($cidade),
            'message' => 'Update successfully'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function excluirCidade($id)
    {
        $data = Cidade::find($id);

        if(!$data) {
            return response(['message' => 'City cannot found'],404);
        }
        $data->delete();

        return response(['message' => 'Deleted']);
    }
}
