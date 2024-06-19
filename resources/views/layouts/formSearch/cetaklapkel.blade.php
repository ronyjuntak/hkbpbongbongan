<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Laporan Keluarga</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: F4 }

    #title {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 18px;
        font-weight: bold;
    }

    .tabeldatakeluarga {
        margin-top: 40px
    }

    .tabeldatakeluarga td {
        padding: 5px;
    }

    .tabelkeluarga {
        width: 100%;
        margin-top: 10px;
        border-collapse: collapse;
    }

    .tabelkeluarga tr th {
        border: 1px solid #171616;
        padding: 8px;
        background: #b8b5b5;
    }

    .tabelkeluarga tr td {
        border: 1px solid #171616;
        padding: 5px;
        font-size: 12px;
    }

    .foto {
        width: 40px;
        height: 30px;
    }
    </style>

</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="F4">
    <?php
    ?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

        <table style="width: 100%">
            <tr>
                <td style="width: 30px">
                    <img src="{{ asset('assets/img/logohkbp.png') }}" width="70" height="70" alt="">
                </td>
                <td>
                    <span id="title">
                        LAPORAN KELUARGA<br>
                        {{--  PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>  --}}
                        HKBP BONGBONGAN<br>
                    </span>
                    <span><i>Jl. Medan km. 6 Kel. Pondok Sayur Kec. Siantar Martoba Kota Pematangsiantar</i></span>
                </td>
            </tr>
        </table>
        <table class="tabeldatakeluarga" style="margin-top: 1%">
            <tr>
                <td>Sektor</td>
                <td>:</td>
                <td>{{ $cetaklapkel->id_wijk }}</td>
            </tr>
        </table>
        <table class="tabelkeluarga" style="100%">
            <tr>
                <th>No</th>
                <th>No. Registrasi</th>
                <th>Nama Keluarga</th>
                <th>No. HP</th>
                <th>Alamat</th>
            </tr>
            @foreach ($cetaklapkels as $d)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td style="text-align: center">{{ $d->no_registrasi }}</td>
                <td>{{ $d->nama_keluarga }}</td>
                <td style="text-align: center">{{ $d->no_hp }}</td>
                <td>{{ $d->alamat }}</td>
            </tr>
            @endforeach
        </table>
  </section>
</body>
</html>
