@extends('adminlte::page')
@section('title', 'Admin Book Online | book')
@section('content_header')
    <h1>Dashboard | Book <a href="{{ url('/admin/member/create') }}" class="btn btn-primary pull-right">Add</a></h1>
@stop
@section('content')
  <!-- Card -->
  <div class="card">
    <!-- Card content -->
    <div class="card-body">
      <!-- Text -->
      <div class="table-responsive">
          <table class="customerstable table" id="member" style="width:100%;">
              <thead class="text-primary">
                  <tr>
                      <th></th>
                      <th>NO</th>
                      <th>ACTION</th>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Email</th>
                  </tr>
              </thead>
          </table>
      </div>

    </div>

  </div>
  <!-- Card -->
@stop

@section('js')
  <script type="text/javascript">

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

      var table = $('#member').DataTable( {
            'processing': true,
            'serverSide': true,
            'ajax': {
                url: '{{ url("/admin/member/data") }}',
                type: 'GET',
            },
            columns: [
                {data: 'id', name: 'id', 'visible': false},
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
            ],
            order: [[0, 'asc']],
            searchDelay: 3000
        } );
    });
  </script>
@stop
