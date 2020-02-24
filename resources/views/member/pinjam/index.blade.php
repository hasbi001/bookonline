@extends('layouts.default')

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
                      <th>No</th>
                      <th>Action</th>
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

  </div>
  <!-- Card -->
@endsection

@section('js')
  <script type="text/javascript">

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

      var table = $('#pinjam').DataTable( {
            'processing': true,
            'serverSide': true,
            'ajax': {
                url: '{{ url("/member/pinjam/list") }}',
                type: 'GET',
                data: { userid:{{ Auth::guard('member')->user()->id }} }
            },
            columns: [
                {data: 'id', name: 'id', 'visible': false},
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'judul', name: 'judul'},
                {data: 'startdate', name: 'startdate'},
                {data: 'enddate', name: 'enddate'},
                {data: 'status', name: 'status'},
            ],
            order: [[0, 'asc']],
            searchDelay: 3000
        } );
    });
    function comeback(id) {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
      });
      $.ajax({

      type:'POST',

      url:'{{ url("/member/pinjam/update") }} ',
      dataType:'JSON',
      data:{id:id},

      success:function(data){
        var btn = "btnpinjam_"+id;
        document.getElementById(btn).disabled = true;
        $('#pinjam').DataTable().draw();
        alert(data.message);

      }

    });
  }
</script>
@endsection
