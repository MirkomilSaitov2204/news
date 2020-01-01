@extends('admin.layout.master')

@section('content')


<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Create</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Author</a></li>
                    <li class="active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">


        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Edit Author</strong>
                    @if (count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            <ul class="list-group">
                                <li class="list-group-item">{{ $error }}</li>
                            </ul>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="card-body">
                  <!-- Credit Card -->
                  <div id="pay-invoice">
                      <div class="card-body">
                          <div class="card-title">
                              <h3 class="text-center">Edit Role</h3>
                          </div>
                          <hr>
                          <form action="{{ route('authors.update', ['id'=>$author->id]) }}" method="post" >
                                   {{ csrf_field() }}

                              <div class="form-group">
                                  <label for="name" class="control-label mb-1">Name</label>
                                  <input id="name" name="name" value="{{ $author->name }}" type="text" class="form-control" >
                              </div>
                              <div class="form-group">
                                <label for="email" class="control-label mb-1">Email</label>
                                <input id="email" value="{{ $author->email }}" name="email" type="text" class="form-control" >
                            </div>
                            <div class="form-group">

                                <label for="role[]" class="control-label mb-1">Role</label>
                                <select name="role[]" id="role[]" class="form-control" multiple="multiple">
                                        @foreach ($role as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                </select>
                            </div>

                              </div>
                              <div>
                                  <button  type="submit" class="btn btn-lg btn-info btn-block">
                                     Edit Author
                                  </button>
                              </div>
                          </form>
                      </div>
                  </div>

                </div>
            </div> <!-- .card -->

          </div><!--/.col-->


        </div>


    </div><!-- .animated -->
</div><!-- .content -->





@endsection
