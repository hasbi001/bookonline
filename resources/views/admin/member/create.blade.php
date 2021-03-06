@extends('adminlte::page')
@section('title', 'Admin Member Online | member')
@section('content_header')
    <h1>Dashboard | Member | Create Data</h1>
@stop
@section('content')
  <!-- Card -->
  <div class="card">
    <!-- Card content -->
    <div class="card-body">
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div><br />
      @endif
     <form action="{{ url('/admin/member/save') }}" method="POST">
       @csrf

        <div class="form-group"> 
            <label>Name</label>
            <input type="text" class="form-control" name="name"/>
        </div>
        <div class="form-group"> 
            <label>Email</label>
            <input type="email" class="form-control" name="email"/>
        </div>
        <div class="form-group"> 
            <label>Password</label>
            <input type="password" class="form-control" name="password"/>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
     </form>

    </div>

  </div>
  <!-- Card -->
@stop
