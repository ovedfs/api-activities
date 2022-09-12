<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Helpers\Logger;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    public function history()
    {
        return response()->json([
            'message' => 'Historial de logs',
            'history' => Logger::history(),
        ]);
    }

    public function historyByUser(User $user)
    {
        return response()->json([
            'message' => 'Historial de logs',
            'history' => Logger::historyByUser($user),
        ]);
    }
}
