<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Logger;
use App\Models\Payment;
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArrendadorPaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:payments.index')->only('index');
        $this->middleware('can:payments.store')->only('store');
    }

    public function index(Contract $contract)
    {
        if(! auth()->user()->contracts->contains($contract->id)) {
            return response()->json([
                'message' => 'Acción no autorizada, este contrato no pertenece a este usuario',
            ]);
        }

        Logger::add('Obteniendo el listado de pagos de un contrato');

        return response()->json([
            'message' => 'Listado de pagos',
            'contract' => $contract->load('payments'),
        ]);
    }

    public function store(Request $request, Contract $contract)
    {
        $request->validate([
            'amount' => 'required',
            'payment_type_id' => 'required|integer'
        ]);

        if(! auth()->user()->contracts->contains($contract->id)) {
            return response()->json([
                'message' => 'Acción no autorizada, este contrato no pertenece a este usuario',
            ]);
        }

        $payment = new Payment();
        $payment->amount = $request->amount;
        $payment->payment_type_id = $request->payment_type_id;
        $payment->user_id = auth()->user()->id;
        $payment->contract_id = $contract->id;

        if($payment->save()) {

            Logger::add('Pago vinculado a un contrato');

            return response()->json([
                'message' => 'Pago registrado correctamente',
                'contract' => $contract->load('payments'),
            ]);
        }

        return response()->json([
            'message' => 'El pago no pudo ser registrado',
        ], 500);
    }
}
