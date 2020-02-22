@extends('adminlte::page')
@section('title', 'Admin Book Online | book')
@section('content_header')
    <h1>Dashboard | Book | View Data <a href="{{ url('/admin/book') }}" class="btn btn-primary pull-right">Back</a></h1>
@stop
@section('content')
  <div class="card">
    <!-- Card content -->
    <div class="card-body">
     <table>
       <tr>
         <td><label>Code</label></td>
         <td>{{ $model->code }}</td>
       </tr>
       <tr>
         <td><label>Title</label></td>
         <td>{{ $model->title }}</td>
       </tr>
       <tr>
         <td><label>Year of Release</label></td>
         <td>{{ $model->year_release }}</td>
       </tr>
       <tr>
         <td><label>Writer</label></td>
         <td>{{ $model->writer }}</td>
       </tr>
       <tr>
         <td><label>Stock</label></td>
         <td>{{ $model->stock }}</td>
       </tr>
     </table>

    </div>

  </div>
@stop