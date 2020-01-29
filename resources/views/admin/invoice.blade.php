<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:18px;
            margin:0;
        }
        .container{
            height:auto;
            background-color:#fff;
        }
        caption{
            font-size:28px;
            margin-bottom:15px;
        }
        table{
            border:1px solid #333;
            border-collapse:collapse;
            margin:0 auto;
            width:740px;
        }
        td, tr, th{
            border:1px solid #333;
            width:185px;
        }
        th{
            background-color: #f0f0f0;
        }
        h4, p{
            margin:0px;
        }
    </style>
</head>
<body>
    <div class="container">
        <table>
            <caption>
                Aywa Petcare
            </caption>
            <thead>
                <tr>
                  @foreach ($data_trans as $item)
                      
                  <th colspan="5">ID Medis <strong>{{ $item->id }}</strong></th>
                  {{-- <th>{{ $invoice->created_at->format('D, d M Y') }}</th> --}}
                  @endforeach
                </tr>
                <tr>
                    <td colspan="3">
                        <h4>Klinik : </h4>
                        <p>Aywa Petcare<br>
                          Jl. Palagan Tentara Pelajar No.120, Daerah Istimewa Yogyakarta<br>
                            034737383<br>
                        </p>
                    </td>
                    @foreach ($data_trans as $item)
                    <td colspan="2">
                        <h4>Pemilik Hewan: </h4>
                            
                        <p>{{ $item->nama_pemilik }}<br>
                          <h5>Tanggal Periksa</h5>{{ $item->tgl_periksa }}<br>
                          <h5>Status Pembayaran</h5>
                          {{ $item->status_pembayaran }} <br>
                        </p>
                      </td>
                      @php
                          break;
                      @endphp
                      @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Nama Hewan</th>
                    <th>Jenis Hewan</th>
                    <th>Diagnosa</th>
                    <th>Gejala</th>
                    <th>Sub Biaya</th>
                </tr>
                @foreach ($data_det as $item)
                <tr>
                  <td>{{ $item->nama_hewan }}</td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->nama_penyakit }}</td>
                  <td>{{ $item->gejala }}</td>
                  <td>{{ $item->total_biaya }}</td>
                </tr>
                @endforeach
                {{-- <tr>
                    <th colspan="3">Subtotal</th>
                    <td>Rp {{ number_format($data_trans->total_harga) }}</td>
                </tr> --}}
            </tbody>
            <tfoot>
              @foreach ($data_trans as $item)
                <tr>
                  <th colspan="4">Total</th>
                    <td>Rp {{ number_format($item->total_harga) }}</td>
                  </tr>
              @endforeach
            </tfoot>
        </table>
    </div>
</body>
</html>
