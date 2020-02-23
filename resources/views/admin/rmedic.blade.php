
@extends('layouts.master')

@section('medis')
<link href="{{ url('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ url('assets/vendor/jquery/jquery-ui.css') }}">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="{{ url('assets/vendor/jquery/jquery-ui.css') }}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ url('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{ url('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
<div class="container-fluid">
  <div class="container-fluid">
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Pembukuan Medis</h1>
      <p class="mb-4"></p>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">

        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Pemilik Hewan</h6>
        </div>

        <div class="card-body">

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Pemilik</label>
            <div class="col-sm-10">
              <div class="input-group">
                <select name="pemilik" class="form-control select2" id="opt_pemilik" data-live-search="true">
                  <option selected hidden class="btnClear">-- PILIH --</option>
                  @foreach ($pelanggan as $customer)
                    <option class="p_option" value="{{ $customer->id }}" data-tokens="{{ $customer->id }}" id="{{ $customer->id }}">{{ $customer->no_hp }} - {{ $customer->nama_pemilik }}</option>
                  @endforeach
                </select>
                {{-- <div class="input-group-append">
                  <button class="btnClear" type="button">
                    <i class="fas fa-user-check"></i>
                  </button>
                </div> --}}
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">No. Handphone</label>
            <div class="col-sm-10">
              <input type="tel" name="no_hp" readonly class="form-control" id="_noHp" required autocomplete="off">
            </div>
          </div>

        </div>

        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Hewan Peliharaan</h6>
        </div>

        <div class="card-header py-3">
          <a href="" class="btn btn-success btn-sm float-right btnAddhewan" data-toggle="modal" data-target=".tambah-hewan"><i class="far fa-angry"></i></a>
        </div>

        {{-- content --}}
        <div class="card-body">
          <form class="" action="{{ route('store.medis') }}" method="post">
            @csrf
            @method('post')

            <input type="hidden" name="id_pemilik" readonly id="id_pemilik" value="">
            <input type="hidden" name="id_petugas" value="{{ Auth::user()->id }}">
            <input type="hidden" name="id_jenis" id="idJenis">
            <input type="hidden" name="id_penyakit" id="idPenyakit">
            <input type="hidden" name="id_trans_medis" id="id_medis">
            <input type="hidden" name="harga_hewan" id="_harga_hewan">
            <input type="hidden" name="harga_penyakit" id="_harga_penyakit">
            <input type="hidden" name="total_harga_baru" id="_total_trans">

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">ID. Medis</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <input type="text" name="no_medis" class="form-control" id="_noMedis" required autocomplete="off">
                  <div class="input-group-append">
                    <button class="btn btn-primary btn_search" type="button">
                      <i class="fas fa-user-check"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Hewan</label>
              <div class="col-sm-10">
                <input type="text" name="nama_hewan" class="form-control" id="_hewan" autocomplete="off" required>
              </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <input type="radio" name="jk_hewan" value="Jantan"> Jantan
                    <input type="radio" name="jk_hewan" value="Betina"> Betina
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ras</label>
                <div class="col-sm-10">
                  <select class="form-control" name="ras_hewan" required>
                    <option>--Pilih--</option>
                    <option value="Domestic">Domestic</option>
                    <option value="Persia">Persia</option>
                    <option value="Anggora">Anggora</option>
                    <option value="Munchkin">Munchkin</option>
                    <option value="Mainecoon">Mainecoon</option>
                    <option value="Rusian Blue">Rusian Blue</option>
                    <option value="lain_lain">Lain - Lain</option>
                  </select>
                </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Jenis Hewan</label>
              <div class="col-sm-10">
                <select name="jenis_hewan" class="form-control select2" id="_jenisHewan" required>
                  <option selected hidden class="jHewan">--Pilih--</option>
                  @foreach ($jenis as $jeniss)
                  <option value="{{ $jeniss->id }}">{{ $jeniss->nama }}</option>                      
                  @endforeach
                </select>
              </div>
            </div>

            <div class="content-hewan"></div>

          </div>

              <input type="hidden" name="id_medis">

            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Diagnosa Penyakit</h6>
            </div>
            <div class="card-body">
              {{-- <input type="hidden" name="id_medis" value=""> --}}

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Antigenetik</label>
                <div class="col-sm-10">
                  <select name="nama_penyakit" class="form-control select2" id="_namaPenyakit" required>
                    <option selected hidden class="jPenyakit">--PIlih--</option>
                    @foreach ($penyakit as $sakit)
                        <option value="{{ $sakit->id }}">{{ $sakit->nama_penyakit }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="gejala" aria-label="With textarea" required placeholder="contoh : kekebalan"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tgl Pemeriksaan</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="tgl_periksa" id="tgl_periksa" autocomplete="off" required readonly>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Biaya</label>
                <div class="col-sm-10">
                  <input type="number" readonly class="form-control" name="total_biaya" id="_subBiaya" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status Pembayaran</label>
                <div class="col-sm-10">
                  <select name="status_pembayaran" class="form-control" id="status_pembayaran" required>
                    <option>--PILIH--</option>
                    <option value="Belum Lunas"> Belum Lunas</option>
                    <option value="Lunas">Lunas</option>
                  </select>
                </div>
              </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-success" id="simpan" value="Tambah"></input>
            </div>

          </div>
        </form>
      </div>
    </div>
    
<!-- Page Heading -->
<script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">

// $('#tgl_periksa').datepicker({
//   dateFormat : 'dd, MM, yy',
//   changeYear : true,
//   changeMonth : true,
//   yearRange : '-100:+20',
//   minDate : 0
// });
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function() {
  console.log("Block Ajax Rekam Medis");
  $.ajaxSetup({
        headers : {
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
  });

  $(document).on('click', '.addHewan', function(){

  });

  var url = "{{ url('/adm/get/transaksi') }}";
  var url1 = "{{ url('/adm/detail-transaksi/get/') }}";
  var tm_id = 0;
  var date = new Date();
  var month = date.getMonth()+1;
  var day = date.getDate();
  var full = ((''+day).length<2 ? '0' : '') + day + "." + ((''+month).length<2 ? '0' : '') + month + '-' + date.getFullYear();
  var today = ((''+day).length<2 ? '0' : '') + day + "." + ((''+month).length<2 ? '0' : '') + month + '-' + date.getFullYear();
  var u = 0;

  $.ajax({
    url : url1,
    method : 'GET',
    dataType : 'json',
    cache : false,
    data : {id : tm_id},
    success:function(data) {
      u = 1 + data.length;
      $('#id_medis').val(full+"-"+u);
      $('#_noMedis').val(full+"-"+u);
    }
  });

  $('#tgl_periksa').val($.datepicker.formatDate('dd, MM, yy', new Date()));

  // $('.select2').chosen();
  $('.select2').selectpicker();

  $(document).on('click', '.btnClear', function() {
    $('#_noMedis').val("");
    $('#_noHp').val("");
    $('#id_pemilik').val("");
  });

  $(document).on('click', '.nHewan', function(){
    $('#_rasHewan').val("");
  });

  $(document).on('click', '.jPenyakit', function(event){
    $('#_subBiaya').val("");
    $('#idPenyakit').val("");
    $('#_harga_penyakit').val("");
  });

  $(document).on('click', '.jHewan', function(event){
    $('#_subBiaya').val("");
    $('#idJenis').val("");
    $('#_harga_hewan').val("");
  });

  $(document).on('click', '.btnAddhewan', function(event){
    event.preventDefault();

    Swal.fire({
      title: 'Sisihhkan Waktu Untuk Istirahat',
      text: 'Pengen Liburan :(',
      imageUrl: 'https://unsplash.it/500/300',
      imageWidth: 400,
      imageHeight: 200,
      imageAlt: 'Custom image',
    })

  });


  var h_hewan = 0;
  var h_penyakit = 0;
  var h_detail = 0;

  $(document).on('click', '.btn_search', function(event){
    event.preventDefault();

    var id = $('#_noMedis').val();
    var url = "{{ url('/adm/rekam-medis/get/detail') }}/"+id;

    $.ajax({
      url : url,
      method : 'GET',
      dataType : 'json',
      cache : false,
      success:function(datas) {
        if(datas != null) {

        $('#opt_pemilik').val(datas.nama_pemilik);
        $('#_noHp').val(datas.no_hp);
        $('#status_pembayaran').attr('disabled', true).val(datas.status_pembayaran);
        $('#tgl_periksa').attr('disabled', true).val(datas.tgl_periksa);
        $('#harga').val(datas.harga);
        $('.nama_pemilik').text("Data Dari "+datas.nama_pemilik);
        $('#id_pemilik').val(datas.id_pemilik);
        h_detail = datas.total_biaya;

        Swal.fire(
          'Data Ditemukan ! ',
          'Data ID ' +id + ' adalah data dari ' +datas.nama_pemilik,
          'question'
        )

        } else {

          Swal.fire('Data ID Belum Digunakan 🤩');
          $('#status_bayar').attr('disabled', false);
          $('.nama_pemilik').text("Pemilik Hewan");
          $('#tgl_masuk').val("");
          $('#tgl_keluar').val("");

        }

      }
    });

  })

  $(document).on('change', '#_jenisHewan', function (event) {
    var id = $(this).find(':selected')[0].value;
    var url = "{{ url('/adm/jenis-hewan/get') }}/"+id;
    // alert(id);
    $.ajax({
      url : url,
      method : 'GET',
      dataType : 'json',
      cache : false,
      success:function(data) {
        h_hewan = data.harga;
        $('#idJenis').val(data.id);
        $('#_harga_hewan').val(data.harga);
        // console.log("Hewan " + h_hewan);
      }
    });
  });

  $(document).on('change', '#_namaPenyakit', function(event){
    var id = $(this).find(':selected')[0].value;
    var url = "{{ url('/adm/penyakit/get') }}/"+id;
    var t_biaya = 0;
    var t_harga = 0;
    $.ajax({
      url : url,
      method : 'GET',
      dataType : 'json',
      cache : false,
      success:function(data) {
        h_penyakit = data.harga;
        $('#idPenyakit').val(data.id);
        // console.log(h_hewan);
        // console.log(h_penyakit);
        // console.log(h_detail);
        t_biaya = h_penyakit + h_hewan;
        $('#_subBiaya').val(t_biaya);
        $('#_harga_penyakit').val(data.harga);
        t_harga = t_biaya +h_detail;
        $('#_total_trans').val(t_harga);
      }
    });
  });

  $(document).on('change', '#_namaHewan', function(event){
    event.preventDefault();
    var id = $(this).find(':selected')[0].value;
    var url = "{{ url('/adm/rekam-medis/get/hewan') }}/"+id;
    // alert(id);
    $.ajax({
      url : url,
      method : 'GET',
      dataType : 'json',
      cache : false,
      success:function(data) {
        console.log(data);
        $('#_rasHewan').val(data.ras_hewan);
      }
    });
  });

  var id_x = 0;

  $(document).on('change','#opt_pemilik', function(event){
    var condition = (event.keyCode ? event.keyCode : event.which);
      event.preventDefault();
      var idx = $(this).find(':selected')[0].id;
      var url = "{{ url('/adm/rekam-medis/get') }}/"+idx;
      // alert(idx);

      $.ajax({
        url: url,
        method : 'GET',
        dataType : 'json',
        cache : false,
        success:function(response) {
          // console.log(response);
          id_x = response.id + 1;
          // $('#_noMedis').val(full+"-"+id_x);
          $('#_noHp').val(response.no_hp);
          $('#id_pemilik').val(response.id);
        }
      });
  });

});

</script> 

@include('layouts.footer')
@endsection
