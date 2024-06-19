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
                <h3 class="card-title" id="textHeader">Detail Data Baptis</h3>
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
                      <td>ID Baptis</td>
                      <td>{{ $baptis->id_registrasi_baptis }}</td>
                    </tr>
                    <tr>
                      <td>Nama Lengkap</td>
                      <td>{{ $baptis->nama_lengkap }}</td>
                    </tr>
                    <tr>
                      <td>Nama Ayah</td>
                      <td>{{ $baptis->nama_ayah }}</td>
                    </tr>
                    <tr>
                      <td>Nama Ibu</td>
                      <td>{{ $baptis->nama_ibu }}</td>
                    </tr>
                    <tr>
                      <td>Jenis Kelamin</td>
                      <td>{{ $baptis->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                      <td>Tempat/Tanggal Lahir</td>
                      <td>{{ $baptis->tempat_lahir }}  /  {{ $baptis->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td>{{ $baptis->alamat }}</td>
                    </tr>
                    <tr>
                      <td>Tanggal Baptis</td>
                      <td>{{ $baptis->tanggal_baptis }}</td>
                    </tr>
                    <tr>
                      <td>Nama Pendeta</td>
                      <td>
                        @foreach ($pendeta as $d)
                        {{ $d->nama_lengkap }}
                        @endforeach
                       </td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>{{ $baptis->keterangan }}</td>
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
                <a href="{{ route('baptis') }}" class="btn btn-default" id="buttonKembali">Kembali</a>
                {{--  <a href="{{ route('editBaptis',$baptis->id_registrasi_baptis) }}" class="btn btn-warning" id="buttonEdit">Edit</a>  --}}
              </div><br><br>

            </div>
            <!-- /.card -->
          </div>
        </div>
