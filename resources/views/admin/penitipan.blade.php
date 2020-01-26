
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
        <h6 class="m-0 font-weight-bold text-primary">Pemilik Hewan</h6>
      </div>

      <div class="card-body">

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">No. Penitipan</label>
          <div class="col-sm-10">
            <input type="text" name="no_penitipan" readonly class="form-control" id="_noPenitipan" required autocomplete="off">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Nama Pemilik</label>
          <div class="col-sm-10">
            <div class="input-group">
              <select name="pemilik" class="form-control" id="opt_pemilik">
                <option>-- PILIH --</option>
                @foreach ($pelanggan as $customer)
                  <option class="p_option" value="{{ $customer->id }}" id="{{ $customer->id }}">PET00-0{{ $customer->id }} - {{ $customer->nama_pemilik }}</option>
                @endforeach
              </select>
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-user-check"></i>
                </button>
              </div>
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
        <form class="" action="" method="post">
          @csrf
          @method('post')

          <input type="hidden" name="id_pemilik" readonly id="id_pemilik" value="">
          <input type="hidden" name="id_petugas" value="{{ Auth::user()->id }}">
          <input type="hidden" name="id_hewan">
          <input type="hidden" name="id_medis">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Hewan</label>
            <div class="col-sm-10">
              <input type="text" name="nama_hewan" class="form-control" id="nama_hewan" required autocomplete="off">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Jenis Hewan</label>
            <div class="col-sm-10">
              <select class="form-control" name="jenis_hewan" required>
                <option>--Pilih--</option>
                <option value="Kucing">Kucing</option>
                <option value="Anjing">Anjing</option>
                <option value="Kelinci">Kelinci</option>
                <option value="lain_lain">Lain - Lain</option>
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
            <label class="col-sm-2 col-form-label">Harga</label>
            <div class="col-sm-10">
              <input type="text" readonly name="total_harga" id="totalHarga" class="form-control">
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



  <script src="{{ url('assets/vendor/jquery/jquery.js') }}"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- </script> -->
  <script type="text/javascript">

    console.log('ok');
    $("#tgl_masuk").datepicker({dateFormat : 'dd, MM, yy'});
    $('#tgl_keluar').datepicker({dateFormat : 'dd, MM, yy'});

    function calculate() {
      var date1 = new Date($('#tgl_masuk').val());
      var date2 = new Date($('#tgl_keluar').val());
      var harga = $('#harga').val();

      var time = date2.getTime() - date1.getTime();
      var miliSecondtoOneSecond = 1000;
      var secondtoOneHour = 3600;
      var hourstoDay = 24;

      var equals = time / (miliSecondtoOneSecond * secondtoOneHour * hourstoDay);
      var price = equals * harga;
      $('#totalHarga').val(price);
    }

    $('#harga').keyup(function() {
      calculate();
    });

    $(document).ready(function() {
      $.ajaxSetup({
        headers : {
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
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
            // console.log(response);
            $('#_noPenitipan').val("HTL-0"+response.id);
            $('#_noHp').val(response.no_hp);
          }
        });
      });

      //end
    });

  </script>

@include('layouts.footer')
@endsection
