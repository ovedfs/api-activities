<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Helpers\Logger;
use App\Models\Contract;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArrendadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:properties.index')->only('listProperties');
        $this->middleware('can:properties.store')->only('storeProperty');
        $this->middleware('can:contracts.index')->only('listContracts');
        $this->middleware('can:contracts.store')->only('storeContract');
    }
    
    public function listProperties()
    {
        $properties = auth()->user()->properties;
        // $user = User::find(2);
        // $properties = $user->properties;

        Logger::add('Obteniendo el listado de propiedades');

        return response()->json([
            'message' => 'Listado de propiedades',
            'properties' => $properties,
        ]);
    }

    public function storeProperty(Request $request)
    {
        $request->validate([
            'address' => 'required',
        ]);

        $property = new Property();
        $property->address = $request->address;
        $property->user_id = auth()->user()->id;

        if($property->save()) {

            Logger::add('Creando una nueva propiedad');

            return response()->json([
                'message' => 'propiedad creada correctamente',
                'property' => $property,
            ]);
        }

        return response()->json([
            'message' => 'La propiedad no pudo ser creada',
        ], 500);
    }

    public function listContracts()
    {
        //$user = User::find(2);
        $contracts = auth()->user()->contracts;
        //$contracts = $user->contracts;

        Logger::add('Obteniendo el listado de contratos');

        return response()->json([
            'message' => 'Listado de contratos',
            'contracts' => $contracts,
        ]);
    }

    public function storeContract(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'property_id' => 'required',
        ]);

        $contract = new Contract();
        $contract->content = $request->content;
        $contract->user_id = auth()->user()->id;
        // Validar que la propiedad sea de este arrendador ...
        $contract->property_id = $request->property_id;

        if($contract->save()) {

            Logger::add('Creando un nuevo contrato');

            return response()->json([
                'message' => 'Contrato creado correctamente',
                'contract' => $contract,
            ]);
        }

        return response()->json([
            'message' => 'El contrato no pudo ser creado',
        ], 500);
    }
}
