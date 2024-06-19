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
                <h3 class="card-title" id="textHeader">Detail Data Jemaat Pindah</h3>
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
                      <td>ID Registrasi Pindah</td>
                      <td>{{ $pindah->id_head_reg_pindah }}</td>
                    </tr>
                    <tr>
                      <td>No Surat Pindah</td>
                      <td>{{ $pindah->no_surat_pindah }}</td>
                    </tr>
                    <tr>
                      <td>ID Registrasi Jemaat</td>
                      <td>{{ $pindah->is_registrasi }}</td>
                    </tr>
                    <tr>
                      <td>ID Jemaat</td>
                      <td>{{ $pindah->id_jemaat }}</td>
                    </tr>
                    <tr>
                      <td>Nama Jemaat</td>
                      <td>{{ $pindah->nama_depan }} {{ $pindah->nama_belakang }}</td>
                    </tr>
                    <tr>
                      <td>Nama Gereja HKBP Tujuan</td>
                      <td>{{ $pindah->id_gereja_tujuan }}</td>
                    </tr>
                    <tr>
                    <tr>
                      <td>Nama Gereja selain HKBP</td>
                      <td>{{ $pindah->nama_gereja }}</td>
                    </tr>
                    <tr>
                      <td>Tanggal Pindah</td>
                      <td>{{ $pindah->tgl_pindah }}</td>
                    </tr>
                    <tr>
                      <td>Tanggal Warta</td>
                      <td>{{ $pindah->tgl_warta }}</td>
                    </tr>
                    <tr>
                      <td>Keterangan</td>
                      <td>{{ $pindah->keterangan }}</td>
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
                <a class="btn btn-default" href="{{ route('pindah') }}" id="buttonKembali">Kembali</a>
                {{--  <a class="btn btn-warning" href="{{ route('editPindah', $item['id_head_reg_pindah']) }}" id="buttonEdit">Edit</a>  --}}
              </div><br><br>

            </div>
            <!-- /.card -->
          </div>
        </div>
