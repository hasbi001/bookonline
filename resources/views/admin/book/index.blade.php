@extends('adminlte::page')
@section('title', 'Admin Book Online | book')
@section('content_header')
    <h1>Dashboard | Book <a href="{{ url('/admin/book/create') }}" class="btn btn-primary pull-right">Add</a></h1>
@stop
@section('content')
  <!-- Card -->
  <div class="card">
    <!-- Card content -->
    <div class="card-body">
      <!-- Text -->
      <div class="table-responsive">
          <table class="customerstable table" id="books" style="width:100%;">
              <thead class="text-primary">
                  <tr>
                      <th></th>
                      <th>NO</th>
                      <th>ACTION</th>
                      <th>code</th>
                      <th>Title</th>
                      <th>Year of Release</th>
                      <th>Writer</th>
                      <th>Stock</th>
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
      alert('ada');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

      var table = $('#books').DataTable( {
            'processing': true,
            'serverSide': true,
            'ajax': {
                url: '{{ url("/admin/book/data") }}',
                type: 'GET',
            },
            columns: [
                {data: 'id', name: 'id', 'visible': false},
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'code', name: 'code'},
                {data: 'title', name: 'title'},
                {data: 'year_release', name: 'year_release'},
                {data: 'writer', name: 'writer'},
                {data: 'stock', name: 'stock'},
            ],
            order: [[0, 'asc']],
            searchDelay: 3000
        } );
    });
  </script>
@stop