@include('layouts.forms.header')
@include('layouts.forms.navbar')
@include('layouts.forms.sidebar')
@include('layouts.forms.footer')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Data Kegiatan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Data Kegiatan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header" style="height:6rem">
                <h3 class="card-title" id="textHeader">Ubah Data Kegiatan</h3>
              </div><br>
              <!-- /.card-header -->
              <!-- form start -->

              <form action="{{ route('updateKegiatan') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                  <input type="hidden" name="id_jenis_kegiatan" value="{{ $bkegiatan->id_jenis_kegiatan }}">
                </div>
                  <div class="form-group">
                    <label>Nama Kegiatan<span style="color: red;">*</span></label>
                    <input type="text" autocomplete="off" required class="form-control" name="nama_jenis_kegiatan" value="{{ $bkegiatan->nama_jenis_kegiatan }}" placeholder="Nama Kegiatan">
                  </div>
                  <div class="form-group">
                    <label>Tanggal Kegiatan<span style="color: red;">*</span></label>
                    <input type="date" required autocomplete="off" class="form-control" name="tanggal_kegiatan" value="{{ $bkegiatan->tanggal_kegiatan }}" placeholder="Jenis Kegiatan">
                  </div>
                  <div class="form-group">
                    <label>Waktu Kegiatan<span style="color: red;">*</span></label>
                    <input type="time" required autocomplete="off" class="form-control" name="waktu_kegiatan" value="{{ $bkegiatan->waktu_kegiatan }}" placeholder="Jadwal Kegiatan">
                  </div>
                  <div class="form-group">
                    <label>Lokasi Kegiatan<span style="color: red;">*</span></label>
                    <input type="text" required autocomplete="off" class="form-control" name="lokasi_kegiatan" value="{{ $bkegiatan->lokasi_kegiatan }}" placeholder="Lokasi Kegiatan">
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" required autocomplete="off" class="form-control" name="keterangan" value="{{ $bkegiatan->keterangan }}" placeholder="Keterangan">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="{{ route('kegiatan') }}" class="btn btn-outline-dark btn-lg ml-3 float-right">Cancel</a>
                  <button type="submit" class="btn btn-warning btn-lg float-right">Update</button>
                </div>
              </form>

            </div>
            <!-- /.card -->
