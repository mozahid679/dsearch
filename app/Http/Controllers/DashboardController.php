<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchLog;

class DashboardController extends Controller
{
   public function index(Request $request)
   {
      $user = $request->user();

      $totalSearches = SearchLog::where('user_id', $user->id)->count();
      $todaySearches = SearchLog::where('user_id', $user->id)
         ->whereDate('searched_at', today())
         ->count();

      $uptimePercentage = 99.9;

      return view('dashboard', [
         'totalSearches' => $totalSearches,
         'todaySearches' => $todaySearches,
         'uptimePercentage' => $uptimePercentage
      ]);
   }
}
