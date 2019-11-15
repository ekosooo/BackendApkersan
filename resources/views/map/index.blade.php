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

    <title>Apkersan | Peta</title>

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
                                <h3 class="card-title">Peta Pengaduan</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Kabupaten / Kota</label>

                                    <select class="form-control" id="kabupaten_kota">
                                        <option>Kalimantan Barat</option>
                                        <option lat="-0.026426" lng="109.342190">Kota Pontianak</option>
                                        <option lat="0.904792" lng="108.982981">Kota Singkawang</option>
                                        <option lat="0.821847" lng="109.477884">Kabupaten Bengkayang</option>
                                        <option lat="0.845401" lng="112.930674">Kabupaten Kapuas Hulu</option>
                                        <option lat="-1.027914" lng="110.061215">Kabupaten Kayong Utara</option>
                                        <option lat="-1.857485" lng="109.972067">Kabupaten Ketapang</option>
                                        <option lat="-0.234348" lng="109.5126244">Kabupaten Kubu Raya</option>
                                        <option lat="0.5184408" lng="109.726436">Kabupaten Landak</option>
                                        <option lat="-0.499929" lng="111.728822">Kabupaten Melawi</option>
                                        <option lat="0.370032" lng="108.954388">Kabupaten Mempawah</option>
                                        <option lat="1.362226" lng="109.301216">Kabupaten Sambas</option>
                                        <option lat="0.164193" lng="110.641101">Kabupaten Sanggau</option>
                                        <option lat="0.020774" lng="110.878296">Kabupaten Sekadau</option>
                                        <option lat="0.115008" lng="111.506662">Kabupaten Sintang</option>
                                    </select>
                                </div>
                                <div id="map-canvas" style="width:100%; height:380px;"></div>
                            </div>
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

        $(document).ready(function() {

            var lat = -0.026426;
            var lng = 109.342190;

            var posisi = {lat,  lng};
            var map = new google.maps.Map(
                document.getElementById('map-canvas'), {
                    zoom: 7,
                    center: posisi
                });


            var locations = [
                    @foreach($peta as $value)
                [{{ $value->lat }}, {{ $value->lng }} ],
                @endforeach
            ];

            var info = [
                    @foreach($peta as $value)
                ['No Tiket : {{$value->ticket_number}}<br> Nama : {{$value->korban_nama}}<br> Jenis Kasus : {{$value->kasus_nama}}<br> Status : {{$value->status_pengaduan}}'],
                @endforeach
            ];

            console.log(info);
            console.log(locations);

            var infowindow = new google.maps.InfoWindow();
            var marker, i;
            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][0], locations[i][1]),
                    map: map
                });


                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(info[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        });


        $("#kabupaten_kota").on("change", function(){

            var lat = $("#kabupaten_kota option:selected").attr("lat");
            var lng = $("#kabupaten_kota option:selected").attr("lng");

            lat=parseFloat(lat);
            lng=parseFloat(lng);


            var posisi = {lat,  lng};
            var map = new google.maps.Map(
                document.getElementById('map-canvas'), {
                    zoom: 12,
                    center: posisi
                });


            var locations = [
                    @foreach($peta as $value)
                [{{ $value->lat }}, {{ $value->lng }} ],
                @endforeach
            ];

            var info = [
                    @foreach($peta as $value)
                ['No Tiket : {{$value->ticket_number}}<br> Nama : {{$value->korban_nama}}<br> Jenis Kasus : {{$value->kasus_nama}}<br> Status : {{$value->status_pengaduan}}'],
                @endforeach
            ];

            console.log(info);
            console.log(locations);

            var infowindow = new google.maps.InfoWindow();
            var marker, i;
            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][0], locations[i][1]),
                    map: map
                });


                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(info[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }

        });


    }

</script>

</body>
</html>




