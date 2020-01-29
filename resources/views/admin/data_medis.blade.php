
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
      <h1 class="h3 mb-2 text-gray-800">Details Pendataan Medis</h1>
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
                  <th>ID Pemilik</th>
                  <th>Nama Pemilik</th>
                  <th>Alamat</th>
                  <th>No Handphone</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php $no=1; ?>
              @foreach ($pelanggan as $customer)
              <tr>
              <td><?php echo $no++; ?></td>
              <td>PLGN-0{{$customer-> pe_id}}</td>
              <td>{{$customer -> nama_pemilik}}</td>
              <td>{{$customer -> alamat}}</td>
              <td>{{$customer -> no_hp}}</td>
              <td>
                  <a href="{{ route('detail.medis', $customer->m_id) }}" class="btn bg-primary btn-sm text-light btnDetails" id="{{ $customer->id }}"><i class="fas fa-receipt"></i> Details</a>
                  <a href="{{ route('get.pdf_medis', $customer->m_id) }}" class="btn bg-success btn-sm text-light" id="{{ $customer->id }}"><i class="fas fa-receipt"></i> Cetak</a>
              </td>
              </tr>
              @endforeach
                </tbody>
              </table>
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

    // $(document).on('click', '.btnDetails', function(event) {
    //     event.preventDefault();
    //     var id = $(this).attr('id');
    //     var url = "{{ url('/adm/pemilik-hewan') }}/"+id;
    //     // alert(id);
    //     $.ajax({
    //         url : url,
    //         method : 'GET',
    //         dataType : 'json',
    //         cache : false,
    //         success:function(data) {
    //           console.log(data);
    //             $('.btnSee').modal('show');
    //             $('.btnSimpan').val("Cetak");
    //             $('.namaPemilik').text(data.nama_pemilik);
    //             $('.alamatPemilik').text(data.alamat);
    //             $('.noHpPemilik').text(data.no_hp);
    //             $('.emailPemilik').text(data.email);
    //         }

    //     });
    //   });

  });

</script>

@include('layouts.footer')
@endsection
