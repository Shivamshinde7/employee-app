<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

   public function index(Request $request)
{
    $query = DB::table('employees')
        ->join('departments', 'employees.department_id', '=', 'departments.id')
        ->select('employees.*', 'departments.dept_name as dept_name');

    if ($request->filled('department_id')) {
        $query->where('employees.department_id', $request->department_id);
    }

    if ($request->filled('min_salary')) {
        $query->where('employees.salary', '>=', $request->min_salary);
    }
    if ($request->filled('max_salary')) {
        $query->where('employees.salary', '<=', $request->max_salary);
        // dd("Filtering max_salary => " . $request->max_salary);
    }
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('employees.first_name', 'like', "%$search%")
              ->orWhere('employees.last_name', 'like', "%$search%")
              ->orWhere('employees.email', 'like', "%$search%");
        });
    }

    $employees = $query->orderBy('employees.id', 'DESC')->get();

    $departments = DB::table('departments')->select('id', 'dept_name')->get();

    return view('employees.list', compact('employees', 'departments'));
}



    public function showAll(Request $request)
    {
        $query = DB::table('employees');

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }

        if ($request->filled('min_salary')) {
            $query->where('salary', '>=', $request->min_salary);
        }

        if ($request->filled('max_salary')) {
            $query->where('salary', '<=', $request->max_salary);
        }

        $employees = $query->orderBy('id', 'DESC')->get();

        return view('employees.list', compact('employees'));
    }

    public function create()
    {
        $departments = DB::table('departments')->get();
        return view('employees.add', compact('departments'));
    }

    public function store(Request $request)
    {

        $insertId = DB::table('employees')->insertGetId([
            'user_id' => $request->id, 
            'first_name' => $request->first_name ?? null,
            'last_name' => $request->last_name ?? null,
            'email' => $request->email ?? null,
            'joining_date' => $request->joining_date ?? null,
            'department_id' => $request->department_id ?? null,
            'salary' => $request->salary ?? null,
            'created_at' => now(),
        ]);

        // dd("$request->all());

        return redirect('/employees')->with('msg', 'Employee added successfully');
    }

   public function edit($id)
{
    $emp = DB::table('employees')->where('id', $id)->first();

    if (!$emp) {
        // dd("employee id not found => $id");
        abort(404);
    }

    $departments = DB::table('departments')->get();
    return view('employees.edit', compact('emp', 'departments'));
}


    public function update(Request $request, $id)
    {
        DB::table('employees')->where('id', $id)->update([
            'first_name' => $request->first_name ?? null,
            'last_name' => $request->last_name ?? null,
            'email' => $request->email ?? null,
            'joining_date' => $request->joining_date ?? null,
            'department_id' => $request->department_id ?? null,
            'salary' => $request->salary ?? null,
            'updated_at' => now(),
        ]);


        return redirect('/employees')->with('msg', 'Employee updated');
    }

    public function destroy($id)
    {
        $deleted = DB::table('employees')->where('id', $id)->delete();


        return redirect('/employees')->with('msg', 'Employee deleted');
    }

    public function getEmployeeGraphData()
    {
        $graphData = DB::table('employees')
            ->select(DB::raw('DATE(joining_date) as join_date'), DB::raw('COUNT(*) as total'))
            ->whereNotNull('joining_date')
            ->groupBy('join_date')
            ->orderBy('join_date', 'ASC')
            ->get();

        // dd($graphData);

        return response()->json($graphData);
    }

    public function getEmployeesByDate($date)
    {
        $employees = DB::table('employees')
            ->whereDate('joining_date', '=', $date)
            ->get();


        return view('employees.bydate', compact('employees', 'date'));
    }
}
