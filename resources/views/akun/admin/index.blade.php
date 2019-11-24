<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Apkersan | Pengguna</title>

    @include('master/style')

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
@include('master/header')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('master/sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')

                <div class="row">
                    <div class="col-sm-1"></div>

                    <div class="col-sm-10">
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Admin</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{route('admin.pindah')}}" class="btn btn-primary btn-sm" style="float: right; margin-top: 10px">Tambah Data</a>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tindakan</th>
                                    </tr>
                                    @foreach($admin as $value)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$value->user_nama}}</td>
                                            <td>{{$value->user_email}}</td>
                                            <td>{{$value->user_phone}}</td>
                                            <td>{{$value->user_jk}}</td>
                                            <td>
                                                <a href="{{route('show.admin', $value->user_id)}}" class="btn btn-success btn-sm">Edit</a>
                                                @if($value->user_id != Auth()->user()->user_id)
                                                    <a href="" class="btn btn-danger btn-sm" data-user_id="{{$value->user_id}}" data-toggle="modal" data-target="#Modal-hapus">Delete</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{ $admin->links() }}
                                </ul>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-sm-1"></div>
                </div><!-- /.row -->

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Modal static-->
    <div class="modal fade" id="Modal-hapus" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.destroy')}}" method="post">
                        {{method_field('delete')}}
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="hidden" name="user_id" id="user_id" value="">
                                <p>Apakah anda yakin menghapus data ini ?</p>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    @include('master/footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('master/script')
<script>
    $('#Modal-hapus').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var user_id = button.data('user_id');

        var modal = $(this)
        modal.find('.modal-body #user_id').val(user_id);
    })
</script>
</body>
</html>




