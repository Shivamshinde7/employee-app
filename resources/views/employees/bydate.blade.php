@extends('layout')

@section('content')
<h4 class="mb-3">Employees Joined on {{ $date }}</h4>

<table class="table table-bordered">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Dept</th>
      <th>Salary</th>
    </tr>
  </thead>
  <tbody>
    @foreach($employees as $e)
    <tr>
      <td>{{ $e->id }}</td>
      <td>{{ $e->first_name }} {{ $e->last_name }}</td>
      <td>{{ $e->email }}</td>
      <td>{{ $e->department_code }}</td>
      <td>{{ $e->salary }}</td>
    </tr>
    @endforeach
  </tbody>
</table>

<a href="/employees" class="btn btn-secondary">Back</a>
@endsection
