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
            margin:0;
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
        }
        td, tr, th{
            width:150px;
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
                  @foreach ($data_transaksi as $item)
                      
                  <th colspan="5">No. Penitipan <strong>{{ $item->id }}</strong></th>
                  {{-- <th>{{ $invoice->created_at->format('D, d M Y') }}</th> --}}
                  @endforeach
                </tr>
                <tr>
                    @foreach ($data_transaksi as $item)
                    <td colspan="2"><br>
                        <p>Pemilik Hewan: {{ $item->nama_pemilik }}</p><br>
                          <p>Tanggal Masuk : {{ $item->tgl_masuk }}</p><br>
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
                    <th>Tanggal Keluar</th>
                    <th>Ras Hewan</th>
                    <th>Biaya Hewan</th>
                </tr>
                @foreach ($data_penitipan as $item)
                <tr>
                  <td>{{ $item->nama_hewan }}</td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ $item->tgl_keluar }}</td>
                  <td>{{ $item->ras_hewan }}</td>
                  <td>{{ $item->harga_hewan }}</td>
                </tr>
                @endforeach
                {{-- <tr>
                    <th colspan="3">Subtotal</th>
                    <td>Rp {{ number_format($data_trans->total_harga) }}</td>
                </tr> --}}
            </tbody>
            <tfoot>
              @foreach ($data_transaksi as $item)
                <tr>
                  <th colspan="4">Total Biaya Penitipan</th>
                    <td>Rp {{ number_format($item->total_biaya) }}</td>
                  </tr>
              @endforeach
            </tfoot>
        </table>
    </div>
</body>
</html>
