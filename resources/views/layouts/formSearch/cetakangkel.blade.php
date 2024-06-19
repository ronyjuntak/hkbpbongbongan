<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Laporan Jemaat</title>

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

    .tabeldatajemaat {
        margin-top: 40px
    }

    .tabeldatajemaat td {
        padding: 5px;
    }

    .tabeljemaat {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .tabeljemaat tr th {
        border: 1px solid #171616;
        padding: 5px;
        background: #b8b5b5;
    }

    .tabeljemaat tr td {
        border: 1px solid #171616;
        padding: 5px;
        font-size: 10px;
    }

    .foto {
        width: 40px;
        height: 30px;
    }

    body.F4.landscape .sheet {
        width: 297 mm !important;
        height: auto !important;
    }
    </style>

</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="F4 landscape">
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
                        LAPORAN ANGGOTA KELUARGA<br>
                        {{--  PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>  --}}
                        HKBP BONGBONGAN<br>
                    </span>
                    <span><i>Jl. Medan km. 6 Kel. Pondok Sayur Kec. Siantar Martoba Kota Pematangsiantar</i></span>
                </td>
            </tr>
        </table>
        <table class="tabeldatajemaat" style="margin-top: 1%">
            <tr>
                <td>Nama Keluarga</td>
                <td>:</td>
                <td>{{ $cetakangkel->nama_keluarga }}</td>
            </tr>
            <tr>
                <td>ID Keluarga</td>
                <td>:</td>
                <td>{{ $cetakangkel->no_registrasi }}</td>
            </tr>
            <tr>
                <td>Sektor</td>
                <td>:</td>
                <td>{{ $cetakangkel->id_wijk }}</td>
            </tr>
            <tr>
                <td>Alamat Keluarga</td>
                <td>:</td>
                <td>{{ $cetakangkel->alamat }}</td>
            </tr>
        </table>
        <table class="tabeljemaat" style="100%">
            <tr>
                <th>No</th>
                <th>ID. Registrasi</th>
                <th>Nama Lengkap</th>
                <th>TTL</th>
                <th>Jenis Kelamin</th>
                <th>Hub. Keluarga</th>
                <th>Pendidikan</th>
                <th>Pekerjaan</th>
                <th>No. Telepon</th>
                <th>Foto</th>
            </tr>
            @foreach ($cetakangkels as $d)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>{{ $d->id_registrasii }}</td>
                <td>{{ $d->nama_depan }} {{ $d->nama_belakang }}</td>
                <td>{{ $d->tempat_lahir }} , {{ date("d F Y",strtotime($d->tanggal_lahir)) }}</td>
                <td style="text-align: center">{{ $d->jenis_kelamin }}</td>
                <td style="text-align: center">{{ $d->nama_hub_keluarga }}</td>
                <td style="text-align: center">{{ $d->pendidikan }}</td>
                <td style="text-align: center">{{ $d->pekerjaan }}</td>
                <td style="text-align: center">{{ $d->no_telepon }}</td>
                <td>
                    <a href="{{ asset('storage/foto/'. $d->foto) }}" target="_blank">
                        <img src="{{ asset('storage/foto/'.$d->foto) }}" alt="" width="50"/>
                </td>
            </tr>
            @endforeach
        </table>
  </section>
</body>
</html>
