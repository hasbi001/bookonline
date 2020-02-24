@extends('adminlte::page')
@section('title', 'Admin Book Online | member')
@section('content_header')
    <h1>Dashboard | Member | View Data <a href="{{ url('/admin/member') }}" class="btn btn-primary pull-right">Back</a></h1>
@stop
@section('content')
  <div class="card">
    <!-- Card content -->
    <div class="card-body">
     <table>
       <tr>
         <td><label>Id</label></td>
         <td>{{ $model->id }}</td>
       </tr>
       <tr>
         <td><label>Name</label></td>
         <td>{{ $model->name }}</td>
       </tr>
       <tr>
         <td><label>Email</label></td>
         <td>{{ $model->email }}</td>
       </tr>
       <tr>
         <td><label>Created At</label></td>
         <td>{{ $model->created_at }}</td>
       </tr>
     </table>
    </div>
  </div>
@stop