<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{

    public function index(Request $request)
{
    if (!DB::getSchemaBuilder()->hasTable('departments')) {
        dd("⚠️ Table 'departments' missing — import SQL file or check DB connection.");
    }

    $query = DB::table('departments');

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where('dept_name', 'like', "%$search%");
        // dd("search filter applied => " . $search);
    }

    if ($request->filled('sort') && in_array($request->sort, ['asc', 'desc'])) {
        $sortOrder = $request->sort;
    } else {
        $sortOrder = 'desc';
    }
    $departments = $query->orderBy('id', $sortOrder)->get();

    // dd("departments fetched => " . $departments->count());

    return view('departments.list', compact('departments'));
}


    // public function showAll()
    // {
    //     $departments = DB::table('departments')->get();
    //     // dd("departments loaded => " . $departments->count());
    //     return view('departments.list', compact('departments'));
    // }

    public function create()
    {
        return view('departments.add');
    }

    public function store(Request $request)
    {
        $insertId = DB::table('departments')->insertGetId([
            'dept_name' => $request->dept_name ?? null,
            'created_at' => now(),
        ]);

        // dd("new dept id => $insertId");

        return redirect('/departments')->with('msg', 'Department added');
    }

    public function edit($id)
    {
        $dept = DB::table('departments')->where('id', $id)->first();

        if (!$dept) {
            abort(404);
        }

        return view('departments.edit', compact('dept'));
    }

    public function update(Request $request, $id)
    {
        DB::table('departments')->where('id', $id)->update([
            'dept_name' => $request->dept_name ?? null,
            'updated_at' => now(),
        ]);

        // dd("dept updated id => $id");

        return redirect('/departments')->with('msg', 'Department updated');
    }

    public function destroy($id)
    {
        $deleted = DB::table('departments')->where('id', $id)->delete();
        return redirect('/departments')->with('msg', 'Deleted');
    }
}
