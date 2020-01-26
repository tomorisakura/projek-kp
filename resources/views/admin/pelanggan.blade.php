
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
        <h1 class="h3 mb-2 text-gray-800">Pendaftaran Pemilik Hewan</h1>
        <p class="mb-4"></p>
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <a href="" class="btn btn-success float-right" id="btnTambah" data-target=".tambah-pelanggan" data-toggle="modal">Tambah Pemilik Hewan</a>
          </div>

          <!-- table -->
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama Pemilik</th>
                    <th>Alamat</th>
                    <th>No Handphone</th>
                    <th>Email</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="loadTable">
                <?php $no=1; ?>
                @foreach ($pelanggan as $customer)
                <tr>
                <td><?php echo $no++; ?></td>
                <td>PET00-0{{ $customer->id }}</td>
                <td id="td_nama">{{$customer -> nama_pemilik}}</td>
                <td>{{$customer -> alamat}}</td>
                <td>{{$customer -> no_hp}}</td>
                <td>{{$customer -> email}}</td>

                <td>
                    <a href="" class="btn bg-info btn-sm text-light btnEdit" id="{{ $customer->id }}" data-toggle="modal" data-target=""><i class="fas fa-user-edit"></i></a>
                    <a href="" class="btn bg-danger btn-sm text-light btnHapus" id="{{ $customer->id }}"><i class="fas fa-trash"></i></a>
                </td>
                </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
      </div>

<!-- modal tambah Pemilik Hewan -->
<div class="modal fade tambah-pelanggan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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

            <form class="" id="tambahPemilik" action="{{ route('register.pelanggan') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="">

              <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Pemilik</label>
              <div class="col-sm-10">
                <input type="text" name="nama_pemilik" class="form-control" id="_pemilik" autocomplete="off">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="alamat" id="_alamat" aria-label="With textarea" required placeholder="Alamat"></textarea>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nomor Handphone</label>
              <div class="col-sm-10">
                <input type="tel" name="no_hp" id="_noHp" class="form-control">
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" name="email" class="form-control" id="_email" autocomplete="off">
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
<div class="modal fade edit-pelanggan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
              <h6 class="m-0 font-weight-bold text-primary">Pemilik</h6>
            </div>
            <div class="card-body">
  
              <form class="" id="formEdit" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="id" id="_idPemilik" value="">
  
                <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Pemilik</label>
                <div class="col-sm-10">
                  <input type="text" name="nama_pemilik" class="form-control" id="_pemilik_edit" autocomplete="off">
                </div>
              </div>
  
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamat" id="_alamat_edit" aria-label="With textarea" required placeholder="Alamat"></textarea>
                </div>
              </div>
  
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nomor Handphone</label>
                <div class="col-sm-10">
                  <input type="tel" name="no_hp" id="_noHp_edit" class="form-control">
                </div>
              </div>
  
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" name="email" class="form-control" id="_email_edit" autocomplete="off">
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
      console.log('js valid');
    //   function loadDataTable() {
    //       var url ="{{ url('/adm/pemilik-hewan/getData') }}";
    //       $.ajax({
    //           url : url,
    //           success:function(data) {
    //               $('#loadTable').html(data);
    //           }
    //       });
    //   }
    //   loadDataTable();

      $(document).on('click', '.btnEdit', function(event) {
          event.preventDefault();
          var id = $(this).attr('id');
          var url = "{{ url('/adm/pemilik-hewan') }}/"+id;
        //   alert(id);
          $.ajax({
              url : url,
              method : 'GET',
              dataType : 'json',
              cache : false,
              success:function(data) {
                console.log(data);
                  $('.edit-pelanggan').modal('show');
                  $('.btnUpdate').val("Update");
                  $('#_idPemilik').val(data.id);
                  $('#_pemilik_edit').val(data.nama_pemilik);
                  $('#_alamat_edit').val(data.alamat);
                  $('#_noHp_edit').val(data.no_hp);
                  $('#_email_edit').val(data.email);
              }

          });
      });

      $('#formEdit').submit(function(event){
          event.preventDefault();
          var request = new FormData(this);
          var id = $(this).attr('id');
          var url = "{{ url('/adm/pemilik-hewan/update') }}/"+id;
          $.ajax({
              url : url,
              method : 'POST',
              data : request,
              contentType : false,
              cache : false,
              processData : false,
              success:function(response) {
                  alert(response);
                  $('#closeModalEdit').modal('hide');
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

      $(document).on('click', '.btnHapus', function(event) {
          event.preventDefault();
          var id = $(this).attr('id');
          var url = "{{ url('/adm/pemilik-hewan/hapus') }}/"+id;
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
