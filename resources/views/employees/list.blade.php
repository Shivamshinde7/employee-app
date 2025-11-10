@extends('layout')

@section('content')
<h4 class="mb-4 fw-bold">Employees List</h4>

<a href="/employees/create" class="btn btn-sm btn-primary mb-3">+ Add Employee</a>

<form method="GET" action="/employees" class="row g-2 mb-3">
  <div class="col-md-3">
    <select name="department_id" class="form-control">
      <option value="">-- All Departments --</option>
      @foreach($departments as $dept)
        <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>
          {{ $dept->dept_name }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-md-3">
    <input type="number" name="min_salary" placeholder="Min Salary" value="{{ request('min_salary') }}" class="form-control">
  </div>
  <div class="col-md-3">
    <input type="number" name="max_salary" placeholder="Max Salary" value="{{ request('max_salary') }}" class="form-control">
  </div>
  <div class="col-md-3">
    <button class="btn btn-secondary w-100">Filter</button>
  </div>
</form>


<div class="card p-3">
  <canvas id="empChart" height="200"></canvas>
</div>

<table class="table table-bordered mt-4">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Dept</th>
      <th>Salary</th>
      <th>Joining</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($employees as $e)
    <tr>
      {{-- <td>{{ $e->id }}</td> --}}
     <td>{{ $loop->iteration }}</td>
      <td>{{ $e->first_name }} {{ $e->last_name }}</td>
      <td>{{ $e->email }}</td>
     <td>{{ $e->dept_name }}</td>

      <td>{{ $e->salary }}</td>
      <td>{{ $e->joining_date }}</td>
      <td>
        <a href="/employees/{{ $e->id }}/edit" class="btn btn-sm btn-info">Edit</a>
        <a href="/employees/{{ $e->id }}/delete" class="btn btn-sm btn-danger">Del</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<script>
fetch('/employee-graph')
  .then(r => r.json())
  .then(data => {
    const ctx = document.getElementById('empChart');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: data.map(d => d.join_date),
        datasets: [{
          label: 'Employees Joined',
          data: data.map(d => d.total,),
          borderWidth: 2
        }]
      },
      options: {
        onClick: (evt, item) => {
          if (item.length) {
            const date = data[item[0].index].join_date;
            window.location.href = '/employee-graph/' + date;
          }
        }
      }
    });
  })
  .catch(err => console.log("chart load err", err)); // debug check
</script>
@endsection
