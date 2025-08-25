<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PersonSearchExport;

class PersonSearchController extends Controller
{
    public function showSearchForm()
    {
        return view('search.form');
    }

    public function search(Request $request)
    {
        $request->validate([
            'person_name' => 'nullable|string',
            'fathers_name' => 'nullable|string',
            'national_id' => 'nullable|string',
            'company_name' => 'nullable|string',
        ]);

        dd($request);

        $query = DB::table(DB::raw('dhk.person_search_dudok@rjscdb..roc.gov.bd a'))
            ->select(
                'a.REGISTRATION_NO',
                'a.COMPANY_NAME',
                'a.CLIENT_ID',
                'a.PERSON_NAME',
                'a.FATHERS_NAME',
                'a.NATIONAL_ID',
                'a.BIRTH_DATE',
                'a.PRESENT_ADDRESS',
                'a.PERMANENT_ADDRESS'
            )
            ->distinct();

        // Apply filters based on search inputs
        if ($request->input('person_name')) {
            $query->whereRaw("LOWER(a.person_name) LIKE ?", ["%" . strtolower($request->input('person_name')) . "%"]);
        }

        if ($request->input('fathers_name')) {
            $query->whereRaw("LOWER(a.fathers_name) LIKE ?", ["%" . strtolower($request->input('fathers_name')) . "%"]);
        }

        if ($request->input('national_id')) {
            $query->whereRaw("REPLACE(REPLACE(LOWER(a.national_id), ' ', ''), '-', '') = ?", [str_replace([' ', '-'], '', strtolower($request->input('national_id')))]);
        }

        if ($request->input('company_name')) {
            $query->whereRaw("LOWER(a.company_name) LIKE ?", ["%" . strtolower($request->input('company_name')) . "%"]);
        }

        // Fetch search results
        try {
            $results = $query->orderBy('a.COMPANY_NAME', 'asc')->get()->paginate(10);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => 'An error occurred while searching: ' . $e->getMessage()]);
        }
        return view('search.results', compact('results'));
    }

    public function exportSelected(Request $request)
    {
        $selectedRows = $request->input('selectedRows', []);

        if (empty($selectedRows)) {
            return redirect()->back()->withErrors(['message' => 'No rows selected for export.']);
        }

        $rows = DB::table(DB::raw('dhk.person_search_dudok@rjscdb..roc.gov.bd a'))
            ->whereIn('a.CLIENT_ID', $selectedRows)
            ->select(
                'a.REGISTRATION_NO',
                'a.COMPANY_NAME',
                'a.CLIENT_ID',
                'a.PERSON_NAME',
                'a.FATHERS_NAME',
                'a.NATIONAL_ID',
                'a.BIRTH_DATE',
                'a.PRESENT_ADDRESS',
                'a.PERMANENT_ADDRESS'
            )
            ->get()
            ->toArray();

        return Excel::download(new PersonSearchExport($rows), 'selected_persons.xlsx');
    }
}
