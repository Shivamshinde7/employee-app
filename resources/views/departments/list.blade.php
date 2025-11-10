@extends('layout')

@section('content')
<h4 class="mb-3 fw-bold">Departments</h4>

<a href="/departments/create" class="btn btn-sm btn-primary mb-3">+ Add Department</a>

<table class="table table-bordered">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Created</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($departments as $d)
    <tr>
      <td>{{ $loop ->iteration}}
      <td>{{ $d->dept_name }}</td>
      <td>{{ $d->created_at }}</td>
      <td>
        <a href="/departments/{{ $d->id }}/edit" class="btn btn-sm btn-info">Edit</a>
        <a href="/departments/{{ $d->id }}/delete" class="btn btn-sm btn-danger">Del</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{-- dd("departments loaded => " . count($departments)) --}}
@endsection
