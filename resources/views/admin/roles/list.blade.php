@extends('admin.layout.master')

@section('content')
<link rel="stylesheet" href="{{ asset('admin/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
<link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet"/>


<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Table</a></li>
                    <li class="active">Data table</li>
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
                    <strong class="card-title">Data Table</strong>
                    <a href="{{ route('roles.create') }}" class="btn btn-success pull-right" class="card-title">Create</a>
                </div>
                <div class="card-body">
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                 <th>#</th>
                <th>Name</th>
                <th>Display Name</th>
                <th>Description</th>
                <th>Permissions</th>
                <th>Option</th>

              </tr>
            </thead>
            <tbody>
                @foreach ($roles as $i => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->display_name }}</td>
                    <td>{{ $role->description }}</td>
                    <td>
                        @if ($role->perms())
                            <ul class="list-group">
                                @foreach ($role->perms()->get() as $r)
                                    <li class="list-group-item">{{ $r->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('roles.edit', ['id' => $role->id]) }}" class="btn btn-success btn-sm">Edit</a>

                        <a href="{{ route('roles.delete', ['id'=> $role->id]) }}" class="btn btn-danger btn-sm">Delete</a>
                </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
                </div>
            </div>
        </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->








    <script src="{{ asset('admin/assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/lib/data-table/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/lib/data-table/datatables-init.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>

@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script src="{{ asset('js/toastr.min.js') }}"></script>
<script>
        @if(Session::has('success'))
             toastr.success("{{ Session::get('success') }}")
        @endif
        @if(Session::has('info'))
             toastr.info("{{ Session::get('info') }}")
        @endif
   </script>
