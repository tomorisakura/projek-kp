@extends('layouts.master')

@section('dashboard')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container-fluid">
  

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">
  @if (Auth::user()->level == 3 || Auth::user()->level == 1 || Auth::user()->level == 2)
  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Penitipan</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800" id="_text_penitipan"></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Customer</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800" id="_text_customer"></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Users</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="_text_user"></div>
              </div>
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-id-card fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endif
{{-- end of user  --}}

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-warning shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Penitipan</div>
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="_text_belum_lunas_penitipan"></div>
            </div>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-id-card fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-primary shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Penitipan</div>
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="_text_lunas_penitipan"></div>
            </div>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-id-card fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

@if (Auth::user()->level == 3 || Auth::user()->level == 1 || Auth::user()->level == 2)
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-warning shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Medical Checkup</div>
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="_text_belum_lunas_medic"></div>
            </div>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-id-card fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card border-left-info shadow h-100 py-2">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Medical Checkup</div>
          <div class="row no-gutters align-items-center">
            <div class="col-auto">
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="_text_lunas_medic"></div>
            </div>
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-id-card fa-2x text-gray-300"></i>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

    {{-- end of content --}}
</div>

@if (Auth::user()->level == 1 || Auth::user()->level == 2)
<div class="row">
  <div class="col-xl-8 col-lg-7">

    <!-- Area Chart -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Chart Bulanan</h6>
      </div>
      <div class="card-body">
        <div id="grafik"></div>
      </div>
    </div>

  </div>
    <!-- Donut Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Pendapatan Bulan Sekarang</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">

          <div class="btn btn-primary mb-3">
            Penitipan Rp. {{ number_format($sum_penitipan) }}
          </div>
          <br>
          <div class="btn btn-info mb-3">
            Medical Checkup Rp. {{ number_format($sum_medis) }}
          </div>
          
        </div>
      </div>
    </div>

</div>
@endif

<script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>

  $(document).ready(function() {
    console.log('status ok men');

    $.ajaxSetup({
        headers : {
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var id = 0;

    $.ajax({
      url : "{{ url('/adm/dashboard/get/users') }}",
      method : 'GET',
      dataType : 'json',
      cache : false,
      data : {id : id},
      success:function(data) {
        $('#_text_user').text(data.length);
      }
    });

    $.ajax({
      url : "{{ url('/adm/dashboard/get/pelanggan') }}",
      method : 'GET',
      dataType : 'json',
      cache : false,
      success:function(datas) {
        $('#_text_customer').text(datas.length);
      }
    });

    $.ajax({
      url : "{{ url('/adm/dashboard/get/penitipan') }}",
      method : 'GET',
      dataType : 'json',
      cache : false,
      success:function(datas) {
        $('#_text_penitipan').text(datas.length);
      }
    });

    var titip = {!!json_encode($total)!!};
    var medis = {!!json_encode($total_medis)!!}
    var penitipan_belum = {!!json_encode($penitipan_belum)!!}
    var penitipan_lunas = {!!json_encode($penitipan_lunas)!!}
    var medis_belum = {!!json_encode($medis_belum)!!}
    var medis_lunas = {!!json_encode($medis_lunas)!!}

    $('#_text_belum_lunas_penitipan').text(penitipan_belum.length + " Belum Lunas");
    $('#_text_belum_lunas_medic').text(medis_belum.length + " Belum Lunas")
    $('#_text_lunas_medic').text(medis_lunas.length + " Lunas")
    $('#_text_lunas_penitipan').text(penitipan_lunas.length + " Lunas")
    // console.log(penitipan_belum);

    $(document).on('submit', '#form_change', function(event) {
      event.preventDefault();
      var url = "{{ url('/adm/dashboard/post') }}";
      var request = new FormData(this);
      $.ajax({
        url : url,
        method : 'POST',
        data : request,
        contentType : false,
        cache : false,
        processData : false,
        success:function(datas) {
          $('#grafik').load("{{ url('/adm/dashboard/post') }}");
        }
      });
    })

    Highcharts.chart('grafik', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Grafik Pendapatan Bulanan Aywa Petcare'
    },
    subtitle: {
        text: 'Grafik'
    },
    xAxis: {
        categories: ['grafik akan berubah sesuai pergantian bulan'],
        crosshair: false
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Profit'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.0,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Pet Hotel',
        data: titip

    },{
      name: 'Medical Checkup',
      data: medis
    }]
});

    // end of script
  });

</script>



@endsection
