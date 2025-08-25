<?php

namespace App\Services;

use App\Models\SearchLog;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class SearchLogger
{
   public static function log(Request $request): void
   {

      SearchLog::create([
         'user_id'      => Auth()->user->id(),
         'search_route' => $request->route()->getName(),
         'input_fields' => json_encode($request->except(['_token'])),
         'ip_address'   => $request->ip(),
         'user_agent'   => $request->header('User-Agent'),
      ]);
   }
}
