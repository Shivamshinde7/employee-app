@extends('layout')

@section('content')
<h4 class="mb-3">Add Department</h4>

<form method="POST" action="/departments/store">
  @csrf
  <input name="dept_name" placeholder="Department Name" class="form-control mb-3">
  <button class="btn btn-success">Save</button>
</form>

{{-- dd("add department view rendered") --}}
@endsection
