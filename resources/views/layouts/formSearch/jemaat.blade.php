@include('layouts.formSearch.navbar')
@include('layouts.formSearch.header')
@include('layouts.formSearch.sidebar')
@include('layouts.formSearch.footer')
@include('sweetalert::alert')


<!-- Main content -->
<div class="content-wrapper"><br><br>
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header" style="height:6rem;">
                <h3 class="card-title" id="textHeader">Daftar Jemaat Gereja</h3>
              </div><br>
              <div>
                <a href="{{ route('daftarJemaat') }}" class="btn btn-success float-right" id="buttonHeader">Tambah Jemaat</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Keluarga</th>
                    <th width="120px"><center>Aksi</center></th>
                  </tr>
                  </thead>
                  <tbody>
                    @if($jemaat != null)

                    @foreach ($jemaat as $d)
                  <tr>
                    <td>{{ $d->nama_depan }} {{ $d->nama_belakang }}</td>
                    <td>{{ $d->nama_keluarga }}</td>
                    <td>
                      <a class="btn btn-primary" href="{{ route('detailJemaat',$d->id_jemaat) }}" data-toggle="tooltip" data-placement="top" title="detail"><i><img src="/icon/search2.png" alt="" class="iconbutton"></i></a>
                      <a class="btn btn-warning" href="{{ route('editJemaat',$d->id_jemaat) }}" data-toggle="tooltip" data-placement="top" title="edit"><i class="bi bi-pencil-square"></i></a>
                      <a class="btn btn-danger" href="{{ route('deleteJemaat',$d->id_jemaat) }}" data-toggle="tooltip" data-placement="top" id="delete" title="hapus"><i class="bi bi-trash3-fill"></i></a>
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

@push('myscript')
<script>
    $(".delete").click(function(e){
        var form = $(this).closest('form');
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda Yakin Ingin Menghapus Data ini?',
            text: "Data Anda akan terhapus Permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire(
                    'Deleted!',
                    'Data Berhasil Dihapus',
                    'success'
                )
            }
        })
    });
</script>
@endpush
