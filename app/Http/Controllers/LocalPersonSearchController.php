<?php

// app/Http/Controllers/LocalPersonSearchController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonSearchDudok;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PersonSearchExport;
use App\Models\SearchLog;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LocalPersonSearchController extends Controller
{
    public function showSearchForm()
    {
        return view('search.form');
    }

    public function search(Request $request)
    {
        $request->validate([
            'person_name' => 'nullable|string|max:255',
            'fathers_name' => 'nullable|string|max:255',
            'national_id' => 'nullable|string|min:1|max:17',
            'company_name' => 'nullable|string|max:255',
        ]);
        SearchLog::create([
            'user_id'      => auth()->id(),
            'search_route' => $request->route()->getName(), // or 'search' if unnamed
            'input_fields' => $request->except(['_token']),
            'ip_address'   => $request->ip(),
            'user_agent'   => $request->header('User-Agent'),
        ]);

        $query = PersonSearchDudok::query();

        // Apply filters based on search inputs
        if ($request->filled('person_name')) {
            $query->where('PERSON_NAME', 'LIKE', '%' . $request->input('person_name') . '%');
        }

        if ($request->filled('fathers_name')) {
            $query->where('FATHERS_NAME', 'LIKE', '%' . $request->input('fathers_name') . '%');
        }

        if ($request->filled('national_id')) {
            $query->where('NATIONAL_ID', 'LIKE', '%' . $request->input('national_id') . '%');
        }

        if ($request->filled('company_name')) {
            $query->where('COMPANY_NAME', 'LIKE', '%' . $request->input('company_name') . '%');
        }

        // dd($query->orderBy('COMPANY_NAME', 'asc')->paginate(20));
        // Fetch search results
        try {
            $perPage = $request->per_page ?? 10;
            $results = $query->orderBy('COMPANY_NAME', 'asc')->paginate($perPage);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'An error occurred while searching: ' . $e->getMessage()]);
        }

        return view('search.results', compact('results'));
    }

    public function exportSelected(Request $request)
    {
        $request->validate([

            'selectedRows' => 'required|array',
            'selectedRows.*' => 'exists:person_search_dudok, CLIENT_ID',
        ]);
        $rows = PersonSearchDudok::whereIn('CLIENT_ID', $request->selectedRows)
            ->get()
            ->toArray();
        return Excel::download(new PersonSearchExport($rows), 'selected_persons.xlsx');
    }
}


 //public function exportSelected(Request $request)
    //     {
    //         $selectedRows = $request->input('selectedRows', []);

    //         if (empty($selectedRows)) {
    //             return redirect()->back()->withErrors(['message' => 'No rows selected for export.']);
    //         }

    //         $rows = DB::table(DB::raw('dhk.person_search_dudok@rjscdb..roc.gov.bd a'))
    //             ->whereIn('a.CLIENT_ID', $selectedRows)
    //             ->select(
    //                 'a.REGISTRATION_NO',
    //                 'a.COMPANY_NAME',
    //                 'a.CLIENT_ID',
    //                 'a.PERSON_NAME',
    //                 'a.FATHERS_NAME',
    //                 'a.NATIONAL_ID',
    //                 'a.BIRTH_DATE',
    //                 'a.PRESENT_ADDRESS',
    //                 'a.PERMANENT_ADDRESS'
    //             )
    //             ->get()
    //             ->toArray();

    //         return Excel::download(new PersonSearchExport($rows), 'selected_persons.xlsx');
    //     }