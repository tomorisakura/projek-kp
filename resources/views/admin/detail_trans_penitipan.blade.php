
@extends('layouts.master')

@section('data_medis')
<link href="{{ url('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ url('assets/vendor/jquery/jquery-ui.css') }}">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="{{ url('assets/vendor/jquery/jquery-ui.css') }}">
<link href="{{ url('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<!-- Custom styles for this template-->
<link href="{{ url('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
<div class="container-fluid">
  <div class="container-fluid">
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Details Penitipan</h1>
      <p class="mb-4"></p>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <!-- table -->
        <div class="card-body">
          <div class="table-responsive">
            <table>
              <tr>
                <td>ID Penitipan</td> 
                <td id="id_det_penitipan" class="font-weight-bold">{{ $det_transaksi->id_penitipan }}</td>
              </tr>
              <tr>
                <td>Nama Pemilik</td> 
                <td>{{ $det_transaksi->nama_pemilik }}</td>
              </tr>
              <tr>
                <td>Tanggal Transaksi</td>
                <td id="det_tgl_masuk">{{ $det_transaksi->tgl_masuk }}</td>
              </tr>
              <tr>
                <td>Status Pembayaran</td>
                <td id="stt_byr">{{ $det_transaksi->status_pembayaran }}</td>
              </tr>
              <tr>
                <td>Helper</td>
                <td>{{ $det_transaksi->name }}</td>
              </tr>
              <tr>
                <td>Total Harga</td>
                <td><p id="t_harga" class="text-success font-weight-bold">{{ number_format($det_transaksi->tot_biaya) }}</p></td>
              </tr>
              {{-- <tr>
                <td>Total Harga</td>
                <td id="ttl_sum" class="text-success font-weight-bold"></td>
              </tr> --}}
              <tr>
                <td>----------------------------</td>
              </tr>
              <input type="hidden" name="total_biaya" readonly id="_total_biaya" value="{{ $det_transaksi->total_biaya }}">
            </table>

            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama Hewan</th>
                  <th>Jenis Hewan</th>
                  <th>Tanggal Keluar</th>
                  <th>Nomor Kandang</th>
                  <th>Jenis Kandang</th>
                  {{-- <th>Harga</th> --}}
                </tr>
              </thead>
              <tbody>
                @foreach ($det_penitipan as $item)
                  <tr>
                    <td>{{ $item->nama_hewan }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->tgl_keluar }}</td>
                    <td>{{ $item->no_kandang }}</td>
                    <td>{{ $item->jenis_kandang }}</td>
                    {{-- <td>{{ number_format($item->harga_detail) }}</td> --}}
                    <input type="hidden" class="harga_total" value="{{ $item->total_biaya }}">
                    <input type="hidden" name="" class="harga_satuan" value="{{ $item->harga_hewan }}">
                </tr>
                @endforeach
                </tbody>
              </table>
              <div class="modal-footer">
                <a href="" class="btn btn-success btnTelegram">Kirim Pesan Telegram</a>
                <a href="#" class="btn btn-primary btnEdit">Edit Tanggal Ambil</a>
              </div>
            </div>
          </div>
          {{-- end of table --}}
    </div>
  </div>
</div>

<!-- modal tambah Pemilik Hewan -->
<div class="modal fade btnSee" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id="closeModalTambah" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary id-transaksi">Pemilik</h6>
          </div>
          <div class="card-body">

            <form class="formUpdate" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id" id="_id_transaksi" value="">

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tanggal Masuk</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="tgl_masuk" id="tgl_masuk" autocomplete="off" placeholder="Tanggal Masuk" required readonly>
              </div>
            </div>
      
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tanggal Keluar</label>
              <div class="col-sm-10">
                <input type="text" name="tgl_keluar" class="form-control" id="tgl_keluar" autocomplete="off" placeholder="Tanggal Keluar" required>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Harga</label>
              <div class="col-sm-10">
                <input type="number" readonly name="total_harga" id="totalHarga" class="form-control">
              </div>
            </div>
  
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Status Pembayaran</label>
            <div class="col-sm-10">
              <select name="status_pembayaran" class="form-control" id="stat_bayar">
                <option>--PILIH--</option>
                <option value="Belum Lunas"> Belum Lunas</option>
                <option value="Lunas">Lunas</option>
              </select>
            </div>
          </div>

          </div>
        </div>

        <div class="card shadow mb-4">
          {{-- data pake foreach --}}
        </div>
      </div>
      {{-- end of details --}}
      <div class="modal-footer">
        <input type="submit" class="btn btn-success btnSimpanDetail" value="Simpan"></input>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- modal Telegram Pemilik Hewan -->
<div class="modal fade modalTelegram" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id="closeModalTambah" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- <h1 class="h3 mb-4 text-gray-800" id="labelModal">Form Pendaftaran Pemilik Hewan</h1> --}}
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary id-transaksi">Pemilik</h6>
          </div>
          <div class="card-body">

            <form class="update_id" method="post">
            {{-- {{ csrf_field() }} --}}

            <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="{{ $det_transaksi->id_pel }}">

            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Username Telegram</label>
              <div class="col-sm-12">
                <div class="input-group">
                  <input type="text" name="username_telegram" class="form-control" id="username_telegram" value="{{ $det_transaksi->telegram }}" required autocomplete="off" readonly>
                  <div class="input-group-append">
                    <button class="btn btn-primary btnValidate" id="btnValidate" type="button">
                      <i class="fas fa-user-check"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="card shadow mb-4">
          {{-- data pake foreach --}}
        </div>
      </div>
      {{-- end of details --}}
      <div class="modal-footer">
        <a href="" class="btn btn-success btnSimpan">Kirim</a>
      </div>
    </form>
    </div>
  </div>
</div>


<!-- Page Heading -->
<script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="{{ url('assets/js/jquery.number.min.js') }}"></script>

<script>

  $(document).ready(function() {

    $.ajaxSetup({
      headers : {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("#tgl_masuk").datepicker({
      dateFormat : 'dd, MM, yy',
      changeYear : true,
      changeMonth : true,
      yearRange : '-100:+20',
      minDate : 0
    });
    $('#tgl_keluar').datepicker({
      dateFormat : 'dd, MM, yy',
      changeYear : true,
      changeMonth : true,
      yearRange : '-100:+20',
      minDate : 0
    });

    var sub_harga = $('#_total_biaya').val();
    // var sub_biaya = $('.harga_satuan').val();
    var id_trans = $('#id_det_penitipan').text();
    var status_bayar = $('#stt_byr').text();

    var sum = $('.harga_satuan').val();
    var sum_total = 0;

    $('.harga_satuan').each(function() {
      sum_total += Number($(this).val());
    });

    // $('.harga_total').each(function() {
    //   sum_total += Number($(this).val());
    // });

    // $('#ttl_sum').text(sum_total);

    // $.fn.digits = function() {
    //   return this.each(function() {
    //     $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );
    //   });
    // }

    // $('#ttl_sum').digits();

    $(document).on('click', '.btnValidate', function(event) {
      event.preventDefault();
      var id = $('#id_pelanggan').val();
      var url = "{{ url('/adm/update-activity') }}/"+id;
      // alert(id);
      $.ajax({
        url : url,
        method : 'POST',
        contentType : false,
        cache : false,
        processData : false,
        success:function(datas) {
          console.log("Finding ID");
        }
      });
    });

    $(document).on('click', '.btnSimpan', function(event){
      event.preventDefault();
      var id = $('#id_pelanggan').val();
      var url = "{{ url('/adm/send-message-telebot') }}/"+id;

      $.ajax({
        url : url,
        method : 'POST',
        contentType : false,
        cache : false,
        processData : false,
        success:function(datas) {
          console.log('Sukses Kirim Pesan');

          Swal.fire(
            'Berhasil!',
            'Bot telah berhasil mengirimkan pesan !',
            'success'
          )
        }
      });
    });

    $(document).on('click', '.btnTelegram', function(event){
      event.preventDefault();

      $('.modalTelegram').modal('show');
    });

    $(document).on('click', '.btnEdit', function(event){
      event.preventDefault();
      var tgl_masuk = $('#det_tgl_masuk').text();

      $('.btnSee').modal('show');
      $('.id-transaksi').text("ID Penitipan " + id_trans);
      $('#tgl_masuk').val(tgl_masuk);

      $('#_id_transaksi').val(id_trans);
      $('#stat_bayar').val(status_bayar);

    });

    $(document).on('change','#tgl_keluar',function() {
        calculate();
    });

    function calculate() {
      var date1 = new Date($('#tgl_masuk').val());
      var date2 = new Date($('#tgl_keluar').val());
      var harga = sum_total;

      var time = date2.getTime() - date1.getTime();
      var miliSecondtoOneSecond = 1000;
      var secondtoOneHour = 3600;
      var hourstoDay = 24;

      var equals = time / (miliSecondtoOneSecond * secondtoOneHour * hourstoDay);
      var price = equals * harga;
      $('#totalHarga').val(price);
    }

    $('.formUpdate').submit(function(event){
      event.preventDefault();
      var request = new FormData(this);
      var id = $('#_id_transaksi').val();
      var url = "{{ url('/adm/detail-penitipan/update') }}/"+id;
      $.ajax({
        url : url,
        method : 'POST',
        data : request,
        contentType : false,
        cache : false,
        processData : false,
        success:function(response) {
          console.log(Response);
          $('.btnSee').modal('hide');
          setInterval(function() {
            location.reload(true);
          }, 1000);
        }
      });

      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Data Berhasil Diubah',
        showConfirmButton: false,
        timer: 1500
        });

      setInterval(function() {
        location.reload(true);
      }, 500);
    });

    // end of document
  });

</script>

@include('layouts.footer')
@endsection
