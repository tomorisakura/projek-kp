
@extends('layouts.master')

@section('penitipan')
<link href="{{ url('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<!-- Custom styles for this template-->
<link rel="stylesheet" href="{{ url('assets/vendor/jquery/jquery-ui.css') }}">
<link href="{{ url('assets/css/sb-admin-2.css') }}" rel="stylesheet">
<link href="{{ url('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<div class="container-fluid">
  <!-- Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pembukuan Penitipan</h1>
    <p class="mb-4"></p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary nama_pemilik">Pemilik Hewan</h6>
      </div>

      <div class="card-body">

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Nama Pemilik</label>
          <div class="col-sm-10">
            <div class="input-group">
              <select name="pemilik" class="form-control select2" id="opt_pemilik">
                <option>-- PILIH --</option>
                @foreach ($pelanggan as $customer)
                  <option class="p_option" value="{{ $customer->id }}" id="{{ $customer->id }}">PET00-0{{ $customer->id }} - {{ $customer->nama_pemilik }}</option>
                @endforeach
              </select>
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

      {{-- content --}}
      <div class="card-body">
        <form class="" action="{{ route('store.penitipan') }}" method="post">
          @csrf
          @method('post')

          <input type="hidden" name="id_pemilik" readonly id="id_pemilik">
          <input type="hidden" name="id_petugas" value="{{ Auth::user()->id }}" readonly>
          <input type="hidden" name="id_hewan" id="idJenis" readonly>
          <input type="hidden" name="id_trans_penitipan" id="id_penitipan">

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">ID. Penitipan</label>
            <div class="col-sm-10">
              <div class="input-group">
                <input type="text" name="no_penitipan" class="form-control" id="_noPenitipan" required autocomplete="off">
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
              <input type="text" name="nama_hewan" class="form-control" id="nama_hewan" required autocomplete="off">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Jenis Hewan</label>
            <div class="col-sm-10">
              <select name="jenis_hewan" class="form-control select2" id="_jenisHewan">
                <option hidden class="jHewan">--Pilih--</option>
                @foreach ($jenis as $jeniss)
                <option value="{{ $jeniss->id }}">{{ $jeniss->nama }}</option>                      
                @endforeach
              </select>
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
                <option hidden>--Pilih--</option>
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
        </div>

        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Penitipan</h6>
        </div>
        <div class="card-body">
    
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tanggal Masuk</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="tgl_masuk" id="tgl_masuk" autocomplete="off" placeholder="Tanggal Masuk" required>
            </div>
          </div>
    
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tanggal Keluar</label>
            <div class="col-sm-10">
              <input type="text" name="tgl_keluar" class="form-control" id="tgl_keluar" autocomplete="off" placeholder="Tanggal Keluar" required>
            </div>
          </div>
    
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Biaya Penitipan</label>
            <div class="col-sm-10">
              <input type="number" name="harga" class="form-control" id="harga" required>
            </div>
          </div>
    
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nomor Kandang</label>
            <div class="col-sm-10">
              <input type="text" name="no_kandang" class="form-control" autocomplete="off">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Jenis Kandang</label>
            <div class="col-sm-10">
              <select class="form-control" name="jenis_kandang" required>
                <option selected disabled>--Pilih--</option>
                <option value="Vaksin">V-01 Vaksin</option>
                <option value="Biasa">NV-02 Tidak Vaksin</option>
              </select>
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
            <select name="status_pembayaran" class="form-control" id="status_bayar">
              <option>--PILIH--</option>
              <option value="Belum Lunas"> Belum Lunas</option>
              <option value="Lunas">Lunas</option>
            </select>
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



  <script src="{{ url('assets/vendor/jquery/jquery.js') }}"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- </script> -->
  <script type="text/javascript">

    $(document).ready(function() {
      $.ajaxSetup({
        headers : {
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
      });

    $("#tgl_masuk").datepicker({dateFormat : 'dd, MM, yy'});
    $('#tgl_keluar').datepicker({dateFormat : 'dd, MM, yy'});

      $('.select2').chosen();

      var url = "{{ url('/adm/detail-penitipan/get') }}";
      var tm_id = 0;
      var date = new Date();
      var month = date.getMonth()+1;
      var day = date.getDate();
      var full = ((''+day).length<2 ? '0' : '') + day + "." + ((''+month).length<2 ? '0' : '') + month + '-' + date.getFullYear();
      var u = 0;

      $.ajax({
        url : url,
        method : 'GET',
        dataType : 'json',
        cache : false,
        data : {id : tm_id},
        success:function(data) {
          u = 1 + data.length;
          $('#id_penitipan').val(full+"-"+u);
          $('#_noPenitipan').val(full+"-"+u);
        }
      });

      $(document).on('click', '.btn_search', function(event) {
        event.preventDefault();
        var id = $('#_noPenitipan').val();
        var url = "{{ url('/adm/detail-penitipan/get/detail') }}/"+id;
        // alert(url);
        $.ajax({
          url : url,
          method : 'GET',
          dataType : 'json',
          cache : false,
          success:function(datas) {
            // alert(datas);
            console.log(datas);
            if(datas != null) {

            $('#opt_pemilik').val(datas.nama_pemilik);
            $('#_noHp').val(datas.no_hp);
            $('#status_bayar').attr('disabled', true).val(datas.status_pembayaran);
            $('#tgl_masuk').val(datas.tgl_masuk);
            $('#tgl_keluar').val(datas.tgl_keluar);
            $('#harga').val(datas.harga);
            $('.nama_pemilik').text("Data Dari "+datas.nama_pemilik);

            Swal.fire(
              'Apakah Benar ?',
              'Data ID ' +id + ' adalah data dari ' +datas.nama_pemilik + ' Benar ?',
              'question'
            )

            } else {

              Swal.fire('Data ID Belum Digunakan :D');
              $('#status_bayar').attr('disabled', false);
              $('.nama_pemilik').text("Pemilik Hewan");
              $('#tgl_masuk').val("");
              $('#tgl_keluar').val("");

            }

          }
        });

      });

      $(document).on('change', '#opt_pemilik',function (event) {
        event.preventDefault();
        var id = $(this).find(':selected')[0].id;
        $.ajax({
          url : "{{ url('/adm/penitipan/get') }}/"+id,
          method : 'GET',
          dataType : 'json',
          cache : false,
          success:function(response) {
            $('#id_pemilik').val(response.id);
            $('#_noHp').val(response.no_hp);
          }
        });
      });

      var sub_harga = 0;

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
            sub_harga = data.harga;
            $('#idJenis').val(data.id);
            $('#harga').val(sub_harga);
          }
        });
      });

      $(document).on('change','#tgl_keluar',function() {
        calculate();
      });

      $(document).on('change','#tgl_masuk', function() {
        calculate();
      });

      function calculate() {
        var date1 = new Date($('#tgl_masuk').val());
        var date2 = new Date($('#tgl_keluar').val());
        var harga = sub_harga;

        var time = date2.getTime() - date1.getTime();
        var miliSecondtoOneSecond = 1000;
        var secondtoOneHour = 3600;
        var hourstoDay = 24;

        var equals = time / (miliSecondtoOneSecond * secondtoOneHour * hourstoDay);
        var price = equals * harga;
        $('#totalHarga').val(price);
        console.log(price);
      }

      //end
    });

  </script>

@include('layouts.footer')
@endsection
