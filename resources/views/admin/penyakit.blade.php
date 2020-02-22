
@extends('layouts.master')

@section('pemilik-hewan')
<link href="{{ url('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<!-- Custom styles for this template-->
<link rel="stylesheet" href="{{ url('assets/vendor/jquery/jquery-ui.css') }}">
<link href="{{ url('assets/css/sb-admin-2.css') }}" rel="stylesheet">
<link href="{{ url('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <!-- Page Heading -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Master Data Antigenik</h1>
        <p class="mb-4"></p>
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <a href="" class="btn btn-success float-right" id="btnTambah" data-target=".tambah-jenis" data-toggle="modal">Tambah Jenis Antigenik</a>
          </div>

          <!-- table -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="loadTable">
                <?php $no=1; ?>
                @foreach ($data as $datas)
                <tr>
                <td><?php echo $no++; ?></td>
                <td>{{$datas -> nama_penyakit}}</td>
                <td>{{number_format($datas -> harga)}}</td>

                <td>
                    <a href="" class="btn bg-info btn-sm text-light btnEdit" id="{{ $datas->id }}" data-toggle="modal" data-target=""><i class="fas fa-user-edit"></i></a>
                    <a href="" class="btn bg-danger btn-sm text-light btnHapus" id="{{ $datas->id }}"><i class="fas fa-trash"></i></a>
                </td>
                </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
      </div>

<!-- modal tambah Pemilik Hewan -->
<div class="modal fade tambah-jenis" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
            <h6 class="m-0 font-weight-bold text-primary">Jenis Antigenik Hewan</h6>
          </div>
          <div class="card-body">

            <form class="" id="tambahJenis" action="{{ route('create.penyakit') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="">

              <div class="form-group row">
              <label class="col-sm-5 col-form-label">Nama Antigenik</label>
              <div class="col-sm-12">
                <input type="text" name="nama_penyakit" class="form-control" id="_nama" autocomplete="off">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-5 col-form-label">Harga</label>
              <div class="col-sm-12">
                <input type="number" name="harga" id="_harga" class="form-control">
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-success btnSimpan" value="Tambah"></input>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal Edit Pemilik Hewan -->
<div class="modal fade edit-jenis" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" id="closeModalEdit" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{-- <h1 class="h3 mb-4 text-gray-800" id="labelModal">Form Pendaftaran Pemilik Hewan</h1> --}}
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Antigenik</h6>
            </div>
            <div class="card-body">
  
              <form class="" id="formEdit" action="{{ route('update.penyakit') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="idPenyakit_edit" id="idPenyakit" value="">
  
                <div class="form-group row">
                <label class="col-sm-2 col-form-label">Antigenik</label>
                <div class="col-sm-10">
                  <input type="text" name="nama_edit" class="form-control" id="_namaPenyakit" autocomplete="off">
                </div>
              </div>
  
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                  <input type="number" name="harga_edit" id="_hargaPenyakit" class="form-control">
                </div>
              </div>
  
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success btnUpdate" value="Tambah"></input>
          </form>
        </div>
      </div>
    </div>
  </div>


  </div>
</div>
  <script src="{{ url('assets/vendor/jquery/jquery.js') }}"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <script>

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

      $(document).ready(function(){
        $.ajaxSetup({
        headers : {
          'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
      });
      console.log('AYWA PETCARE HEHEHE :V');

      $(document).on('click', '.btnEdit', function(event) {
          event.preventDefault();
          var id = $(this).attr('id');
          var url = "{{ url('/adm/penyakit/get') }}/"+id;
        //   alert(id);
          $.ajax({
              url : url,
              method : 'GET',
              dataType : 'json',
              cache : false,
              success:function(data) {
                // console.log(data);
                  $('.edit-jenis').modal('show');
                  $('.btnUpdate').val("Update");
                  $('#idPenyakit').val(data.id);
                  $('#_namaPenyakit').val(data.nama_penyakit);
                  $('#_hargaPenyakit').val(data.harga);
              }

          });
      });

      $(document).on('click', '.btnHapus', function(event) {
          event.preventDefault();
          var id = $(this).attr('id');
          var url = "{{ url('/adm/penyakit/delete') }}/"+id;
          var token = "{{ csrf_token() }}";
        //   alert(id);

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Data Pelanggan Telah Terhapus',
            showConfirmButton: false,
            timer: 1500
            });

          $.ajax({
              url : url,
              method : 'DELETE',
              dataType : 'json',
              data : {
                  "_token" : token,
                  "id" : id
              },
              cache : false,
              success:function(response) {
                setInterval(function() {
                    location.reload();
                }, 1000);
              }
          });

          setInterval(function() {
                location.reload();
            }, 1000);
      });

      //end jQuerry
      });
  </script>

@include('layouts.footer')
@endsection
