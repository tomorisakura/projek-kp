@extends('layouts.master')

@section('data_user_aywa')
<link href="{{ url('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<!-- Custom styles for this template-->
<link href="{{ url('assets/css/sb-admin-2.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link href="{{ url('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

<div class="container-fluid">
  <div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data User Aywa Petcare</h1>
    <p class="mb-4">Selamat Bekerja dan Semangat !</p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          Tambah Pegawai
        </button>
      </div>

      <!-- table -->
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Validasi</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Handphone</th>
                <th>Hak Akses</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Validasi</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No. Handphone</th>
                <th>Hak Akses</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
            <tbody>

              <?php $no=1; ?>

              @foreach ($user as $users)
              <tr>
                <td><?php echo $no++; ?></td>
                <td data-target="image"><img src="{{ URL::to('/') }}/images/{{ $users->image }}" class="rounded mx-auto d-block img-thumbnail" width="80" alt=""></td>
                <td data-target="name">{{$users -> name}}</td>
                <td data-target="email">{{$users -> email}}</td>
                <td data-target="no_hp">{{$users -> no_hp}}</td>
                <td data-target="status">{{$users -> status}}</td>
                <td>

                <div class="btn-group mr-2" role="group" aria-label="Basic example">
                  <button type="button" name="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $users -> id }}" id="editData{{ $users-> id}}" data-role="update"><i class="fas fa-user-edit"></i> Edit</button>
                </div>
                  <div class="btn-group mr-2" role="group">
                     <form class="" action="{{ route('delete', [$users-> id]) }}" method="get">
                       {{ csrf_field() }}
                       {{ method_field('DELETE') }}
                       <button type="submit" name="button" class="btn btn-danger btn-sm" onclick="return confirm('Hapus Pengguna Ini ?')"><i class="fas fa-trash"></i> Hapus</button>
                     </form>
                  </div></td>
              </tr>
                      <!-- modal edit -->
                  <div class="modal fade bd-example-modal-lg" id="editModal{{ $users -> id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Edit Data Pengguna</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="card shadow mb-4">
                            <div class="card-header py-3">
                              <h6 class="m-0 font-weight-bold text-primary">Isikan Data Dengan Valid</h6>
                            </div>
                            <div class="card-body">
                              <form class="" action="{{ route('update', [$users -> id]) }}" method="post" enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                <input type="hidden" name="id" value="{{ $users -> id }}">

                                <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Profile</label>
                                  <div class="col-sm-10">
                                    <img src="{{ URL::to('/') }}/images/{{ $users->image }}" width="60" alt="">
                                    <input type="file" name="image" class="" id="image">
                                  </div>
                                </div>

                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="namaUp" value="{{ $users->name }}" required autocomplete="name" autofocus>

                                      @error('name')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror

                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">E-Mail</label>
                                    <div class="col-sm-10">
                                      <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="emailUp" value="{{ $users->email }}" required autocomplete="email">

                                      @error('email')
                                      <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror

                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nomor Handphone</label>
                                    <div class="col-sm-10">
                                      <input type="tel" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" id="no_telpUp" value="{{ $users->no_hp }}" required autocomplete="no_telp">

                                      @error('no_telp')
                                      <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror

                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                      <select class="form-control @error('status') is-invalid @enderror" name="status" id="statusUp">
                                        <option value="Admin" @if($users->status == 'Admin') selected @endif>Admin</option>
                                        <option value="Dokter Hewan" @if($users->status == 'Dokter Hewan') selected @endif>Dokter Hewan</option>
                                        <option value="Helper" @if($users->status == 'Helper') selected @endif>Helper</option>
                                      </select>

                                      @error('status')
                                      <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror

                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="" required>

                                      @error('password')
                                      <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror

                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Konfirmasi Password</label>
                                    <div class="col-sm-10">
                                      <input type="password" name="con_password" class="form-control @error('con_password') is-invalid @enderror" id="no_telpUp" value="" required>

                                      @error('con_password')
                                      <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror

                                    </div>
                                  </div>

                                  <!-- <div class="form-group row">
                                    <div class="col-sm-3 col-form-label"><a href="#">Ganti Password</a></div>
                                  </div> -->
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" name="update" class="btn btn-primary">Update</button>
                            </div>
                          </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
                  <!-- end modal edit -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- modal add pegawai -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span id="#form_result"></span>
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Isikan Data Dengan Valid</h6>
          </div>
          <div class="card-body">

            <form class="" action="{{ route('regis') }}" method="POST"  enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="hidden_id" id="id" value="">


              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Profile</label>
                <div class="col-sm-10">
                  <input type="file" name="image" class="" id="image">
                </div>
              </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror

                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">E-Mail</label>
                  <div class="col-sm-10">
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" required autocomplete="off">

                    @error('username')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Nomor Handphone</label>
                  <div class="col-sm-10">
                    <input type="tel" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" value="{{ old('no_telp') }}" required autocomplete="no_telp">

                    @error('no_telp')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Level</label>
                  <div class="col-sm-10">
                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                      <option value="1">Super Admin</option>
                      <option value="2">Admin</option>
                      <option value="3">Dokter Hewan</option>
                      <option value="4">Helper</option>
                    </select>

                    @error('status')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{ old('password') }}" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Konfirmasi Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="password-confirm" class="form-control" id="password-confirm" value="{{ old('password') }}" required autocomplete="new-password">
                  </div>
                </div>
            </div>
            <!-- end of content -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" id="simpan" value="Tambah Pengguna"></input>
          </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">

// $(document).on('click', 'a[data-role=update]', function(){
//   // alert($(this).data('id'));
//   var id = $(this).data('id');
//   var image = $('#'+id).children('td[data-target=image]').text();
//   var nama = $('#'+id).children('td[data-target=name]').text();
//   var email = $('#'+id).children('td[data-target=email]').text();
//   var no_hp = $('#'+id).children('td[data-target=no_hp]').text();
//   var status = $('#'+id).children('td[data-target=status]').text();
//
//   $('#image').val(image);
//   $('#name').val(nama);
//   $('#email').val(email);
//   $('#no_telp').val(no_hp);
//   $('#status').val(status);
//   $('#editModal').modal('toggle');
// });
</script>
@endsection
