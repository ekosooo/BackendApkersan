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

    <title>Apkersan | Berita</title>

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
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Berita</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @foreach($berita as $value)
                                <form action="{{route('berita.update', $value->berita_id)}}" method="POST" enctype="multipart/form-data">
                                    {{method_field('patch')}}
                                    {{csrf_field()}}
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Judul Berita</label>
                                            <input type="text" class="form-control" name="judul_berita" value="{{$value->judul_berita}}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Konten Berita</label>
                                            <textarea class="form-control" name="konten_berita" rows="8" required>{{$value->konten_berita}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Gambar</label>
                                            <img src="{{asset('berita/'. $value->gambar)}}" alt="" style="width: 440px; height: 250px;" class="form-control-file">
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>
                                    </div>
                                </form>
                            @endforeach
                        </div>
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






