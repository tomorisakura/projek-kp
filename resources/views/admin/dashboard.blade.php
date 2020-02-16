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

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Penitipan</div>
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
</div>

@if (Auth::user()->level == 3 || Auth::user()->level == 1 || Auth::user()->level == 2)
<div class="btn btn-primary mb-3">
  Pendapatan Penitipan Rp. {{ number_format($sum_penitipan) }}
</div>
<br>
<div class="btn btn-primary mb-3">
  Pendapatan Medical Checkup Rp. {{ number_format($sum_medis) }}
</div>

<div>
  <div id="grafik"></div>
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
