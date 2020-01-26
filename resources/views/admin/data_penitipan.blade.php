
@extends('layouts.master')

@section('data_hotel')
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
      <h1 class="h3 mb-2 text-gray-800">Data Penitipan</h1>
      <p class="mb-4"></p>
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <!-- table -->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemilik</th>
                    <th>Nomor Handphone</th>
                    <th>Nama Hewan</th>
                    <th>Jenis Hewan</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Helper</th>
                    <th>Total Harga Penitipan</th>
                    <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php $no=1; ?>
                @foreach ($data as $datas)
                <tr>

                  <td><?php echo $no++ ?></td>
                  <td>{{ $datas->nama_pemilik }}</td>
                  <td>{{ $datas->no_hp }}</td>
                  <td>{{ $datas->nama_hewan }}</td>
                  <td>{{ $datas->jenis_hewan }}</td>
                  <td>{{ $datas->tgl_masuk }}</td>
                  <td>{{ $datas->tgl_keluar }}</td>
                  <td>{{ $datas->name }}</td>
                  <td>{{ $datas->total_harga }}</td>

                  <td>
                    <div class="btn-group mr-2" role="group" aria-label="Basic example">
                      <button type="button" name="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#"><i class="fas fa-comment-alt"></i> Kirim Pemberitahuan</button>
                    </div></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
    </div>
  </div>
</div>


<!-- Page Heading -->
<script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

@include('layouts.footer')
@endsection
