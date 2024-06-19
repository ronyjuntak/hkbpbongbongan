@include('layouts.formSearch.navbar')
@include('layouts.formSearch.header')
@include('layouts.formSearch.sidebar')
@include('layouts.formSearch.footer')

<!-- Main content -->
<div class="content-wrapper"><br><br>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header" style="height:6rem;">
                <h3 class="card-title" id="textHeader">Daftar Nama Keluarga</h3>
              </div><br>
              <div class="card-tools">
                  <a type="submit" href="{{ route('daftarKeluarga') }}" class="btn btn-success float-right" id="buttonHeader">Tambah Nama Keluarga</a>
                  {{--  <a type="submit" href="{{ route('cetak-keluarga') }}" class="btn btn-primary float-right" id="buttonHeader" target="_blank">Cetak Data <i class="fas fa-print"></i></a>  --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th><center>Nama Keluarga</center></th>
                    <th><center>Sektor</center></th>
                    <th width="120px"><center>Aksi</center></th>
                  </tr>
                  </thead>
                  @if($keluarga != null)
                      @foreach ($keluarga as $d)
                  <tbody>
                  <tr>
                        <td>{{ $d->nama_keluarga }}</td>
                        <td><center>{{ $d->id_wijk }}</center></td>
                    <td>
                      <a class="btn btn-primary" href="{{ route('detailKeluarga',$d->id_registrasi) }}" data-toggle="tooltip" data-placement="top" title="detail"><i><img src="/icon/search2.png" alt="" class="iconbutton"></i></a>
                      <a class="btn btn-warning" href="{{ route('editKeluarga',$d->id_registrasi) }}" data-toggle="tooltip" data-placement="top" title="edit"><i class="bi bi-pencil-square"></i></a>
                      <a class="btn btn-danger" href="{{ route('deleteKeluarga', $d->id_registrasi) }}" data-toggle="tooltip" data-placement="top" title="hapus"><i class="bi bi-trash3-fill"></i></a>
                    </td>
                  </tr>
                  @endforeach
                  @endif
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
