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
                    <li><a href="#">Role</a></li>
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
                    <strong class="card-title">Edit Role</strong>
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
                          <form action="{{ route('roles.update', ['id'=>$role->id]) }}" method="post" >
                                   {{ csrf_field() }}

                              <div class="form-group">
                                  <label for="name" class="control-label mb-1">Name</label>
                                  <input id="name" name="name" value="{{ $role->name }}" type="text" class="form-control" >
                              </div>
                              <div class="form-group">
                                <label for="display_name" class="control-label mb-1">Display Name</label>
                                <input id="display_name" value="{{ $role->display_name }}" name="display_name" type="text" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="description" class="control-label mb-1">Description</label>

                                <textarea name="description"  id="description" cols="5" rows="5" class="form-control">{{ $role->description }}</textarea>
                            </div>
                            <div class="form-group">

                                <label for="permission[]" class="control-label mb-1">Permission</label>
                                <select name="permission[]" id="permission[]" class="form-control" multiple="multiple"  id="permission">
                                        @foreach ($permission as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                </select>
                            </div>

                              </div>
                              <div>
                                  <button  type="submit" class="btn btn-lg btn-info btn-block">
                                     Create Roles
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
