@extends('admin.layout.master')

@section('content')


<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Edit</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Post</a></li>
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
                    <strong class="card-title">Edit post</strong>
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
                          <form action="{{ route('posts.update', ['id'=>$post->id]) }}" method="post" enctype="multipart/form-data">
                                   {{ csrf_field() }}
                                   <div class="form-group">
                                        <label for="name" class="control-label mb-1">Title</label>
                                        <input id="name" name="title" type="text" value="{{ $post->title }}" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                          <label for="short_description" class="control-label mb-1">Short Description</label>
                                        <textarea name="short_description" id="short_description" cols="5" rows="5" class="form-control">{{ $post->short_description }}</textarea>
                                      </div>
                                      <div class="form-group">
                                          <label for="description" class="control-label mb-1">Description</label>
                                          <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{ $post->description }}</textarea>
                                      </div>

                                    <div class="form-group">
                                          <label for="category_id" class="control-label mb-1">Category</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                          @foreach ($category as $cat)

                                          <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                          @endforeach
                                        </select>
                                      </div>

                                    <div class="form-group">
                                          <label for="img" class="control-label mb-1">Image</label>
                                          <input type="file" name="img" id="img" class="form-control">
                                      </div>

                              </div>
                                    <div>
                                        <button  type="submit" class="btn btn-lg btn-info btn-block">
                                           Edit Post
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
