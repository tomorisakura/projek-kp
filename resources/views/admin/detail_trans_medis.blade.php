
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
      <h1 class="h3 mb-2 text-gray-800">Details Rekam Medis</h1>
      <p class="mb-4"></p>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <!-- table -->
        <div class="card-body">
          <div class="table-responsive">
            <table>
                <tr>
                  <td>ID Medis</td>
                  <td id="_idMedis">{{ $data_trans->id_medis }}</td>
                </tr>
                <tr>
                  <td>Nama Pemilik</td> 
                  <td>{{ $data_trans->nama_pemilik }}</td>
                </tr>
                <tr>
                  <td>Tanggal Periksa</td>
                  <td>{{ $data_trans->tgl_periksa }}</td>
                </tr>
                <tr>
                  <td>Status Pembayaran</td>
                  <td id="_stBayar">{{ $data_trans->status_pembayaran }}</td>
                </tr>
                <tr>
                  <td>Dokter</td>
                  <td>{{ $data_trans->name }}</td>
                </tr>
                <tr>
                  <td>Total Harga</td>
                  <td><p id="t_harga" class="text-success font-weight-bold">{{ number_format($data_trans->total_harga) }}</p></td>
                </tr>
                <tr>
                  <td>----------------------------</td>
                </tr>
            </table>

            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama Hewan</th>
                  <th>Jenis Hewan</th>
                  <th>Penyakit</th>
                  <th>Gejala</th>
                  <th>Harga</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data_det as $item)
                  <tr>
                    <td>{{ $item->nama_hewan }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nama_penyakit }}</td>
                    <td>{{ $item->gejala }}</td>
                    <td>{{ number_format($item->harga_detail) }}</td>
                </tr>
                @endforeach
                </tbody>
              </table>
              <div class="modal-footer">
                <a href="" class="btn btn-success btnModalTelegram">Kirim Pesan Telegram</a>
                <a href="" class="btn btn-primary btnEdit">Edit Status</a>
              </div>
            </div>
          </div>
          {{-- end of table --}}
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

            <input type="hidden" id="id_pelanggan" name="id_pelanggan" value="{{ $data_trans->id_pel }}">

            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Username Telegram</label>
              <div class="col-sm-12">
                <div class="input-group">
                  <input type="text" name="username_telegram" class="form-control" id="username_telegram" value="{{ $data_trans->telegram }}" required autocomplete="off" readonly>
                  <div class="input-group-append">
                    <button class="btn btn-primary btnValidate" type="button">
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

<!-- modal edit tgl ambil Hewan -->
<div class="modal fade modalUpdate" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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

            <form class="formUpdate" action="{{ route('get.update_medis') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id_transaksi" id="_id_transaksi" value="">
  
            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Status Pembayaran</label>
              <div class="col-sm-12">
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

    $(document).on('click', '.btnModalTelegram', function(event) {
      event.preventDefault();
      $('.modalTelegram').modal('show');
    });

    $(document).on('click', '.btnDetails', function(event) {
        event.preventDefault();
        var id = $(this).attr('id');
        var url = "{{ url('/adm/pemilik-hewan') }}/"+id;
        // alert(id);
        $.ajax({
            url : url,
            method : 'GET',
            dataType : 'json',
            cache : false,
            success:function(data) {
              console.log(data);
                $('.btnSee').modal('show');
                $('.btnSimpan').val("Cetak");
                $('.namaPemilik').text(data.nama_pemilik);
                $('.alamatPemilik').text(data.alamat);
                $('.noHpPemilik').text(data.no_hp);
                $('.emailPemilik').text(data.email);
            }
        });
      });

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
          console.log(datas.response);
          
        }
      });
    });

    $(document).on('click', '.btnSimpan', function(event){
      event.preventDefault();
      var id = $('#id_pelanggan').val();
      var url = "{{ url('/adm/send-message-medis-telebot') }}/"+id;

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

    $(document).on('click', '.btnEdit', function(event) {
      event.preventDefault();
      var id_medis = $('#_idMedis').text();
      var stts = $('#_stBayar').text();
      console.log(id_medis);
      $('.modalUpdate').modal('show');
      $('#_id_transaksi').val(id_medis);
      $('#stat_bayar').val(stts);
    });


    // end of ajax
  });

</script>

@include('layouts.footer')
@endsection
