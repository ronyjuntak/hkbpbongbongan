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
                  <h3 class="card-title" id="textHeader">Detail Data Keluarga</h3>
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
                            <td>ID Registrasi</td>
                            <td>{{ $keluarga->id_registrasi }}</td>
                          </tr>
                      <tr>
                        <td>No. Registrasi</td>
                        <td>{{ $keluarga->no_registrasi }}</td>
                      </tr>
                      <tr>
                        <td>Tanggal Registrasi</td>
                        <td>{{ $keluarga->tgl_registrasi }}</td>
                      </tr>
                      <tr>
                        <td>Nama Keluarga</td>
                        <td>{{ $keluarga->nama_keluarga }}</td>
                      </tr>
                      <tr>
                        <td>Sektor</td>
                        <td>{{ $keluarga->nama_wijk }}</td>
                      </tr>
                      <tr>
                        <td>Jenis Register</td>
                        <td>{{ $keluarga->nama_jenis_registrasi }}</td>
                      </tr>
                      <tr>
                        <td>Surat Nikah</td>
                        <td>
                            @if(!empty($keluarga->skp))
                            <a href="{{ asset('storage/skps/'. $keluarga->skp) }}" target="_blank" class="img-thumbnail" style="width:50%"><value="{{ $keluarga->skp }}">Lihat File</value>
                            </a>
                            @endif
                        </td>
                    </tr>
                      <tr>
                        <td>Status</td>
                        <td>{{ $keluarga->keterangan }}</td>
                      </tr>

                    </tbody>
                  </table>
                </div><br>
                <!-- /.card-body -->
                <div>
                  <a href="{{ route('keluarga') }}" class="btn btn-default" id="buttonKembali">Kembali</a>
                  {{--  <a href="{{ route('editBaptis',$baptis->id_registrasi_baptis) }}" class="btn btn-warning" id="buttonEdit">Edit</a>  --}}
                </div><br><br>

              </div>
              <!-- /.card -->
            </div>
          </div>
