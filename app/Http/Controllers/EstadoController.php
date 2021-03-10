<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\EstadoRepositoryInterface;
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
    public function index(EstadoRepositoryInterface $model)
    {
        $estados = $model->withCidade();

        return response([
            'estados' => EstadoResource::collection($estados),
            'message' => 'Retrieved successfully'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Estado::with('cidade')->where('id', $id)->get();
        if (!$data) {
            return response(['message' => 'State not found'], 404);
        }

        return response([
            'estado' => new EstadoResource($data),
            'message' => 'Retrieved successfully'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Estado::find($id);
        if (!$data) {
            return response(['message' => 'State not found'], 404);
        }

        $estado = $request->all();
        $validator = Validator::make($estado, [
            'uf' => 'required',
            'nome' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        Estado::where('id', $data->id)
            ->update([
                'uf' => $request->get('uf'),
                'nome' => $request->get('nome')]
            );

        return response(['estado' => new EstadoResource($estado),
            'message' => 'Update successfully'
           ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Estado::find($id);

        if(!$data) {
            return response(['message' => 'State cannot found'],404);
        }
        $data->delete();

        return response(['message' => 'Deleted']);
    }
}
