<?php

namespace App\Helpers;
use Request;
use App\Models\Logger as LoggerModel;

class Logger
{
  public static function add($subject)
  {
    LoggerModel::create([
      'activity' => $subject,
      'url' => Request::fullUrl(),
      'method' => Request::method(),
      'ip' => Request::ip(),
      'agent' => Request::header('user-agent'),
      'user_id' => auth()->user()->id,
      'role' => auth()->user()->roles->first()->id,
    ]);
  }

  public static function history()
  {
    return LoggerModel::latest()->get();
  }

  public static function historyByUser(User $user)
  {
    return LoggerModel::where('user_id', $user->id)->latest()->get();
  }
}