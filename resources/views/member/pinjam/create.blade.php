@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
              <div class="card-header">Form Peminjaman</div>

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
                 <form action="{{ route('pinjam.save') }}" method="POST">
                   @csrf
                   <input type="hidden" name="user_id" value="{{ Auth::guard('member')->user()->id }}">
                    <div class="form-group"> 
                        <label>Book</label>
                        <select class="form-control" name="book_id">
                          {!! $optbook !!}
                        </select>
                    </div>
                    <div class="form-group"> 
                        <label>Start Date</label>
                        <input type="date" class="form-control" name="startdate"/>
                    </div>
                    <div class="form-group"> 
                        <label>End Date</label>
                        <input type="date" class="form-control" name="enddate"/>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                 </form>
              </div>
          </div>
        </div>
    </div>
</div>
@endsection