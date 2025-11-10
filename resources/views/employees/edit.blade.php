@extends('layout')

@section('content')
    <h4 class="mb-3">Edit Employee #{{ $emp->id }}</h4>

    <form method="POST" action="/employees/{{ $emp->id }}/update">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <input name="first_name" value="{{ $emp->first_name }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <input name="last_name" value="{{ $emp->last_name }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <input name="email" value="{{ $emp->email }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <input name="joining_date" type="date" value="{{ $emp->joining_date }}" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="department_id" class="form-label">Select Department</label>
                <select name="department_id" id="department_id" class="form-control" required>
                    <option value="">-- Select Department --</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept->id }}" {{ $emp->department_id == $dept->id ? 'selected' : '' }}>
                            {{ $dept->dept_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <input name="salary" value="{{ $emp->salary }}" class="form-control">
            </div>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>

    {{-- dd("editing employee id => " . $emp->id) --}}
@endsection
