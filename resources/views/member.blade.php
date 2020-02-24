@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
              <div class="card-header">Book List <a href="{{ route('pinjam.pengajuan') }}" class="btn btn-primary pull-right">Pinjam</a></div>

              <div class="card-body">
                  <div class="table-responsive">
                    <table class="customerstable table" id="listbook" style="width:100%;">
                        <thead class="text-primary">
                            <tr>
                                <th></th>
                                <th>No</th>
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
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

  $(document).ready(function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

    var table = $('#listbook').DataTable( {
          'processing': true,
          'serverSide': true,
          'ajax': {
              url: '{{ url("/member/pinjam/data") }}',
              type: 'GET',
          },
          columns: [
              {data: 'id', name: 'id', 'visible': false},
              {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
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
@endsection