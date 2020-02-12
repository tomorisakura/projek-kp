<script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>

  $(document).ready(function() {
    console.log('status ok men');
    var id = 0;

    var titip = {!!json_encode($total)!!};
    var medis = {!!json_encode($total_medis)!!}

    Highcharts.chart('grafik', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Pendapatan Bulanan Aywa Petcare'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [],
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