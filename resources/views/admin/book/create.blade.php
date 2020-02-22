@extends('adminlte::page')
@section('title', 'Admin Book Online | book')
@section('content_header')
    <h1>Dashboard | Book | Create Data</h1>
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
     <form action="{{ url('/admin/book/save') }}" method="POST">
       @csrf

        <div class="form-group"> 
            <label>Code</label>
            <input type="text" class="form-control" name="code"/>
        </div>
        <div class="form-group"> 
            <label>Title</label>
            <input type="text" class="form-control" name="title"/>
        </div>
        <div class="form-group"> 
            <label>Year of Release</label>
            <input type="number" class="form-control" name="year_release"/>
        </div>
        <div class="form-group"> 
            <label>Writer</label>
            <input type="text" class="form-control" name="writer"/>
        </div>
        <div class="form-group"> 
            <label>Stock</label>
            <input type="number" class="form-control" name="stock"/>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
     </form>

    </div>

  </div>
  <!-- Card -->
@stop