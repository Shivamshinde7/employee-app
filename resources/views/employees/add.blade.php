@extends('layout')

@section('content')
<h4 class="mb-3">Add Employee</h4>

<form method="POST" action="/employees/store">
  @csrf
  <div class="row">
    <div class="col-md-6 mb-3">
      <input name="first_name" placeholder="First Name" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
      <input name="last_name" placeholder="Last Name" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
      <input name="email" placeholder="Email" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
      <input name="joining_date" type="date" class="form-control">
    </div>
  <div class="col-md-6 mb-3">
  <label for="department_id" class="form-label">Select Department</label>
  <select name="department_id" id="department_id" class="form-control" required>
    <option value="">-- Select Department --</option>
    @foreach($departments as $department)
      <option value="{{ $department->id }}">{{ $department->dept_name }}</option>
    @endforeach
  </select>
</div>

    <div class="col-md-6 mb-3">
      <input name="salary" placeholder="Salary" class="form-control">
    </div>
  </div>
  <button class="btn btn-success">Save</button>
</form>

{{-- dd("add employee page loaded") --}}
@endsection
