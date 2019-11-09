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

    <title>Apkersan | Kekerasan</title>

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

                <br>
                <br>
                <div class="row">
                    <div class="col-md-3"></div>
                    {{-- Form Input Register--}}
                    <div class="col-md-6">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Kekerasan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @foreach($kekerasan as $value)
                                <form action="{{ route('kekerasan.update', $value->kekerasan_id)}}" method="POST">
                                    {{method_field('patch')}}
                                    {{csrf_field()}}
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Bentuk Kekerasan</label>
                                            <input type="text" class="form-control" name="kekerasan_nama"
                                                   value="{{$value->kekerasan_nama}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Deskripsi</label>
                                            <textarea class="form-control" name="kekerasan_deskripsi" rows="3">{{$value->kekerasan_deskripsi}}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary" style="float: right;">Submit</button>

                                    </div>
                                    @endforeach
                                </form>
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-3"></div>
                </div>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')


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





