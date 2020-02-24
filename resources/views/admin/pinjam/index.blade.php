@extends('adminlte::page')
@section('title', 'Admin Pinjam Online | book')
@section('content_header')
    <h1>Dashboard | Pinjam </h1>
@stop
@section('content')
  <!-- Card -->
  <div class="card">
    <!-- Card content -->
    <div class="card-body">
      <!-- Text -->
      <div class="table-responsive">
          <table class="customerstable table" id="pinjam" style="width:100%;">
              <thead class="text-primary">
                  <tr>
                      <th></th>
                      <th>NO</th>
                      <th>ACTION</th>
                      <th>Member</th>
                      <th>Judul Buku</th>
                      <th>Date Start</th>
                      <th>Date Finish</th>
                      <th>Status</th>
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

      var table = $('#pinjam').DataTable( {
            'processing': true,
            'serverSide': true,
            'ajax': {
                url: '{{ url("/admin/pinjam/data") }}',
                type: 'GET',
            },
            columns: [
                {data: 'id', name: 'id', 'visible': false},
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'member', name: 'member'},
                {data: 'judul', name: 'judul'},
                {data: 'startdate', name: 'startdate'},
                {data: 'enddate', name: 'enddate'},
            ],
            order: [[0, 'asc']],
            searchDelay: 3000
        } );
    });
    function approval(id,status)               {
      $.ajax({

      type:'POST',

      url:'{{ url("/admin/pinjam/approval") }} ',

      data:{id:id, status:status},

      success:function(data){
         $('#pinjam').DataTable().draw();
         alert(data.message);

      }

});


    } 
  </script>
@stop
