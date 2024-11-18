<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
    {
        return response()->json(Vehiculo::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_de_vehiculo' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
        ]);

        $vehiculo = Vehiculo::create($request->all());

        return response()->json($vehiculo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehiculo = Vehiculo::find($id);
       if (!$vehiculo) {
        return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }

        return response()->json($vehiculo, 200);
    }


    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::find($id);

        if (!$vehiculo) {
            return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }

        $request->validate([
            'tipo_de_vehiculo' => 'sometimes|required|string|max:255',
            'categoria' => 'sometimes|required|string|max:255',
        ]);

        $vehiculo->update($request->all());

        return response()->json($vehiculo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehiculo = Vehiculo::find($id);

        if (!$vehiculo) {
            return response()->json(['message' => 'Vehículo no encontrado'], 404);
        }

        $vehiculo->delete();

        return response()->json(['message' => 'Vehículo eliminado'], 200);
    }
}
