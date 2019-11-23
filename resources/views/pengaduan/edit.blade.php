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
                                <h3 class="card-title">Pengaduan</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            @foreach($pengaduan as $value)
                                <form action="{{route('pengaduan.verifikasi', $value->pengaduan_id)}}" method="POST">
                                    {{method_field('put')}}
                                    {{csrf_field()}}
                                    <div class="card-body">

                                        {{--Data Umum--}}
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="exampleInputEmail1">Data umum</label>
                                            </div>

                                            <div class="col-sm-8">

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">No Tiket</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" name="ticket_number" value="{{$value->ticket_number}}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Status Pelapor</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1"  value="{{$value->status_pelapor}}">
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="exampleInputEmail1">Jenis Kasus</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1" name="kasus_nama" value="{{$value->kasus_nama}}">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="exampleInputEmail1">Bentuk Kekerasan</label>
                                                        <input type="text" class="form-control" id="exampleInputEmail1"  value="{{$value->kekerasan_nama}}">
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <hr>
                                        {{-- Data Korban--}}
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="exampleInputEmail1">Data Korban</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1"  value="{{$value->korban_nama}}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1"  value="{{$value->korban_jk}}">
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Disibalitas</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" value="{{$value->disabilitas}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Bekerja</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1"  value="{{$value->korban_bekerja}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Pendidikan</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1"  value="{{$value->korban_pendidikan}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Status Kawin</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1"  value="{{$value->korban_statuskawin}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Usia</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" value="{{$value->korban_usia}}">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                        {{--Data Pelengkap--}}
                                        <div class="row">

                                            <div class="col-sm-4">
                                                <label for="exampleInputEmail1">Data Pelengkap</label>
                                            </div>
                                            <div class="col-sm-8">

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Waktu Kejadian</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" value="{{$value->waktu_kejadian}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Tempat Kejadian</label>
                                                            <input type="text" class="form-control" id="exampleInputEmail1" value="{{$value->tempat_kejadian}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Alamat</label>
                                                    <textarea name="" id="" cols="30" rows="5" class="form-control">{{$value->alamat_kejadian}}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Kronologi</label>
                                                    <textarea name="" id="" cols="30" rows="5" class="form-control">{{$value->kronologi}}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Bukti</label>
                                                    <br>
                                                    <br>
                                                    @if($value->bukti != null)
                                                        <img src="{{ asset('/bukti/' . $value->bukti) }}"  height="260px" width="400px"/>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="exampleInputEmail1">Tindakan</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">Status</label>
                                                    <select class="form-control" name="status_pengaduan">
                                                        <option value="Menunggu" {{ ( $value->status_pengaduan == 'Menunggu') ? 'selected' : '' }}>Menunggu</option>
                                                        <option value="Diterima" {{ ( $value->status_pengaduan == 'Diterima') ? 'selected' : '' }}>Diterima</option>
                                                        <option value="Ditolak"  {{ ( $value->status_pengaduan == 'Ditolak') ? 'selected' : '' }}>Ditolak</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tindak Lanjut</label>
                                                    <textarea name="tindak_lanjut" cols="30" rows="5" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Peta Lokasi Kejadian</label>
                                            <div id="map-canvas" style="width:100%; height:380px;"></div>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="fcm_token" value="{{$value->fcm_token}}">
                                            <button type="submit" class="btn btn-primary" style="float: right;">Verifikasi Pengaduan</button>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->

                                </form>
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

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLVUltI28Rc8tpWWBc0P3qdTWciWRmNn8&callback=initMap">
</script>

<script>
    function initMap() {

        var posisi = {lat: {{$value->lat}}, lng: {{$value->lng}}};

        var map = new google.maps.Map(
            document.getElementById('map-canvas'), {zoom: 18, center: posisi});
        var marker = new google.maps.Marker({position: posisi, map: map});


        var contentString = 'No Tiket : {{$value->ticket_number}}<br> Nama : {{$value->korban_nama}}<br> Jenis Kasus : {{$value->kasus_nama}}<br> Status : {{$value->status_pengaduan}}';
        // membuat objek info window
        var infowindow = new google.maps.InfoWindow({
            content: contentString,
            position: posisi
        });

        // event saat marker diklik
        marker.addListener('click', function () {
            // tampilkan info window di atas marker
            infowindow.open(map, marker);
        });

    }
</script>
@endforeach
</body>
</html>



