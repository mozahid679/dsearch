<?php

namespace App\Http\Controllers;

use App\Models\SearchLog;
use Illuminate\Http\Request;

class SearchLogController extends Controller
{
   // public function index(Request $request)
   // {
   //    $logs = SearchLog::with('user')
   //       ->latest('searched_at')
   //       ->paginate(20);

   //    return view('searchlogs.index', compact('logs'));
   // }

   public function index(Request $request)
   {
      $logs = SearchLog::with('user')
         ->latest('searched_at')
         ->paginate(20);

      return view('searchlogs.index', compact('logs'));
   }
}
