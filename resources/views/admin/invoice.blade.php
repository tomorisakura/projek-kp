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
            font-size:16px;
            margin: 0;
        }
        .container{
            height:auto;
            background-color:#fff;
        }
        caption{
            font-size:16px;
            margin-bottom:15px;
        }
        table{
            border-collapse:collapse;
            margin:0 auto;
            width:740px;
        }
        td, tr, th{
            width:155px;
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
                <p>Aywa Petcare<br>
                    Jl. Palagan Tentara Pelajar No.120, Daerah Istimewa Yogyakarta<br>
                      034737383<br>
                  </p>
            </caption>
            <thead>
                <tr>
                  @foreach ($data_trans as $item)
                      
                  <th colspan="5">No Medis <strong>{{ $item->id }}</strong></th>
                  {{-- <th>{{ $invoice->created_at->format('D, d M Y') }}</th> --}}
                  @endforeach
                </tr>
                <tr>
                    @foreach ($data_trans as $item)
                    <td colspan="2">
                        <p>Pemilik Hewan: {{ $item->nama_pemilik }}</p><br>
                        <p>Tanggal Periksa : {{ $item->tgl_periksa }}</p><br>
                        <p>Status Pembayaran : {{ $item->status_pembayaran }}</p><br>
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
                    <th>Antigenik</th>
                    <th>Keterangan</th>
                    <th>Sub Biaya</th>
                </tr>
                @foreach ($data_det as $item)
                <tr>
                  <td>{{ $item->nama_hewan }}</td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->nama_penyakit }}</td>
                  <td>{{ $item->gejala }}</td>
                  <td>{{ $item->harga_detail }}</td>
                </tr>
                @endforeach
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
