
@extends('layouts.master')

@section('data_medis')
<link href="{{ url('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ url('assets/vendor/jquery/jquery-ui.css') }}">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="{{ url('assets/vendor/jquery/jquery-ui.css') }}">
<link href="{{ url('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="{{ url('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
<div class="container-fluid">
  <div class="container-fluid">
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Details Rekam Medis</h1>
      <p class="mb-4"></p>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <!-- table -->
        <div class="card-body">
          <div class="table-responsive">
            <table>
                @foreach ($det_transaksi as $trans)
                <tr>
                  <td>Nama Pemilik</td> 
                  <td>{{ $trans->nama_pemilik }}</td>
                </tr>
                <tr>
                  <td>Tanggal Transaksi</td>
                  <td>{{ $trans->tgl_masuk }}</td>
                </tr>
                <tr>
                  <td>Status Pembayaran</td>
                  <td>{{ $trans->status_pembayaran }}</td>
                </tr>
                <tr>
                  <td>Total Harga</td>
                  <td><p id="t_harga" class="text-success font-weight-bold">{{ $trans->total_harga }}</p></td>
                </tr>
                <tr>
                  <td>----------------------------</td>
                </tr>
                @php
                    break;
                @endphp
                @endforeach
            </table>

            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama Hewan</th>
                  <th>Jenis Hewan</th>
                  <th>Tanggal Masuk</th>
                  <th>Tanggal Keluar</th>
                  <th>Harga</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($det_penitipan as $item)
                  <tr>
                    <td>{{ $item->nama_hewan }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->tgl_masuk }}</td>
                    <td>{{ $item->tgl_keluar }}</td>
                    <td>{{ $item->total_biaya }}</td>
                </tr>
                @endforeach
                </tbody>
              </table>
              <div class="modal-footer">
                <a href="" class="btn btn-success btnSimpan">Kirim Pesan Telegram</a>
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
        {{-- <h1 class="h3 mb-4 text-gray-800" id="labelModal">Form Pendaftaran Pemilik Hewan</h1> --}}
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pemilik</h6>
          </div>
          <div class="card-body">

            <input type="hidden" name="id" value="">

              <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Pemilik</label>
              <div class="col-sm-10">
                <label class="col-sm-2 col-form-label namaPemilik"></label>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <label class="col-sm-2 col-form-label alamatPemilik"></label>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nomor Handphone</label>
              <div class="col-sm-10">
                <label class="col-sm-5 col-form-label noHpPemilik"></label>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <label class="col-sm-5 col-form-label emailPemilik"></label>
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
        <input type="submit" class="btn btn-success btnSimpan" value="Cetak"></input>
      </div>
    </div>
  </div>
</div>


<!-- Page Heading -->
<script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script>

  $(document).ready(function() {

    $.ajaxSetup({
      headers : {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
      }
    });

    var url = ""

    $.ajax({
      
    });
  });

</script>

@include('layouts.footer')
@endsection
