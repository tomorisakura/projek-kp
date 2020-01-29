
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
                @foreach ($data_trans as $trans)
                <tr>
                  <td>Nama Pemilik</td> 
                  <td>{{ $trans->nama_pemilik }}</td>
                </tr>
                <tr>
                  <td>Tanggal Periksa</td>
                  <td>{{ $trans->tgl_periksa }}</td>
                </tr>
                <tr>
                  <td>Status Pembayaran</td>
                  <td>{{ $trans->status_pembayaran }}</td>
                </tr>
                <tr>
                  <td>Total Harga</td>
                  <td><p id="t_harga" class="text-success font-weight-bold">{{ number_format($trans->total_harga) }}</p></td>
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
                    <td>{{ number_format($item->total_biaya) }}</td>
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
  });

</script>

@include('layouts.footer')
@endsection
