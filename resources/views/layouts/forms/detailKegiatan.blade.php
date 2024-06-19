@include('layouts.forms.header')
@include('layouts.forms.navbar')
@include('layouts.forms.sidebar')
@include('layouts.forms.footer')

<div class="content-wrapper"><br><br>
  <section class="content">
      <div class="container-fluid">
          <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header" style="height:6rem;">
                <h3 class="card-title" id="textHeader">Detail Data Kegiatan</h3>
              </div><br><br>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Bio Data</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Nama Kegiatan</td>
                      <td>{{ $kegiatan->nama_jenis_kegiatan }}</td>
                    </tr>
                    <tr>
                      <td>Tanggal Kegiatan</td>
                      <td>{{ $kegiatan->tanggal_kegiatan }}</td>
                    </tr>
                    <tr>
                      <td>Waktu Kegiatan</td>
                      <td>{{ $kegiatan->waktu_kegiatan }}</td>
                    </tr>
                    <tr>
                      <td>Lokasi Kegiatan</td>
                      <td>{{ $kegiatan->lokasi_kegiatan }}</td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>{{ $kegiatan->keterangan }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>

                  </tbody>
                </table>
              </div><br>
              <!-- /.card-body -->
              <div>
                <a class="btn btn-default" href="{{ route('kegiatan') }}" id="buttonKembali">Kembali</a>
                {{--  <a class="btn btn-warning" href="{{ route('editKegiatan',$item['id_jenis_kegiatan']) }}" id="buttonEdit">Edit</a>  --}}
              </div><br><br>

            </div>
            <!-- /.card -->
          </div>
        </div>
