@extends('layout')

@section('content')
<h4 class="mb-3">Edit Department #{{ $dept->id }}</h4>

<form method="POST" action="/departments/{{ $dept->id }}/update">
  @csrf
  <input name="dept_name" value="{{ $dept->dept_name }}" class="form-control mb-3">
  <button class="btn btn-primary">Update</button>
</form>

{{-- dd("editing dept id => " . $dept->id) --}}
@endsection
