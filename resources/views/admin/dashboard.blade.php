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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- content --}}
        <form action="" method="post" id="form_change">
        <div class="form-group row">
          <label class="col-sm-5 col-form-label">Bulan</label>
          <div class="col-sm-12">
            <select name="bulan" class="form-control" id="">
              <option value="01">Januari</option>
              <option value="02">Februari</option>
              <option value="03">Maret</option>
              <option value="04">April</option>
              <option value="05">Mei</option>
              <option value="06">Juni</option>
              <option value="07">Juli</option>
              <option value="08">Agustus</option>
              <option value="09">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>
          </div>
        </div>

        {{-- end of content --}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary btn_reload" value="Simpan"></input>
      </form>
      </div>
    </div>
  </div>
</div>

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
        categories: ['grafik akan berubah sesuai bulan'],
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
