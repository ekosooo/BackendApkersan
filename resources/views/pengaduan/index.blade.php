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

    <title>Apkersan | Pengaduan</title>

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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Pengaduan Masuk</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <tr>
                                        <th>No</th>
                                        <th>No Tiket</th>
                                        <th>Nama</th>
                                        <th>Jenis Kasus</th>
                                        <th>Bentuk Kekerasan</th>
                                        <th>Status</th>
                                        <th>Tindakan</th>
                                    </tr>
                                    @foreach($pengaduan as $value)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$value->ticket_number}}</td>
                                            <td>{{$value->user_nama}}</td>
                                            <td>{{$value->kasus_nama}}</td>
                                            <td>{{$value->kekerasan_nama}}</td>
                                            <td>{{$value->status_pengaduan}}</td>
                                            <td>
                                                <a href="{{route('pengaduan.detail', $value->pengaduan_id)}}" class="btn btn-primary btn-sm">Lihat</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{ $pengaduan->links() }}
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



    <!-- Main Footer -->
    @include('master/footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('master/script')

</body>
</html>



