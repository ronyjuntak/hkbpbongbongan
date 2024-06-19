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
            <h1>Update Pelayan Gereja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Update Pelayan Gereja</li>
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
                <h3 class="card-title" id="textHeader">Ubah Data Pelayan Gereja</h3>
              </div><br>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('updatePelayan') }}" method="POST">
                @csrf
                <input type="hidden" name="id_pelayan" value="{{ $bpelayan->id_pelayan }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pelayan<span style="color: red;">*</span></label>
                    {{--  <select class="form-control" name="id_jemaat" required>
                      <option class="form-control" value="">Pilih Jemaat</option>
                      @if($jemaat != null)
                      @foreach($jemaat as $barang)
                          <option  class="form-control" value="{{ $barang->id_jemaat }}">{{ $barang->nama_lengkap }}</option>
                      @endforeach
                      @endif
                    </select>  --}}
                    <input type="text" class="form-control" name="id_jemaat" id="exampleInputEmail1" value="{{ $bpelayan->gelar_depan }} {{ $bpelayan->nama_depan }} {{ $bpelayan->nama_belakang }} {{ $bpelayan->gelar_belakang }}" placeholder="Jemaat">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal Tahbisan<span style="color: red;">*</span></label>
                    <input type="date" required class="form-control" name="tanggal_tahbisan" id="exampleInputPassword1" value="{{ $bpelayan->tanggal_tahbisan }}" placeholder="Tanggal Tahbisan">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Jabatan<span style="color: red;">*</span></label>
                    <select class="form-control" name="jabatan" required>
                      <option value="">Pilih Jabatan</option>
                      <option value="pendeta">Pendeta</option>
                      <option value="pendatua">Guru Huria</option>
                      <option value="pendatua">Bibelvrow</option>
                      <option value="pendatua">Diakones</option>
                      <option value="pendatua">Sintua</option>
                      </select>
                    {{-- <input type="text" class="form-control" name="jabatan" id="exampleInputPassword1" value="{{ $item['jabatan'] }}" placeholder="Jabatan"> --}}
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Akhir Jabatan<span style="color: red;">*</span></label>
                    <input type="date" required class="form-control" name="tanggal_akhir_jawatan" id="exampleInputEmail1" value="{{ $bpelayan->tanggal_akhir_jawatan }}" placeholder="Tanggal Akhir Jabatan">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan" id="exampleInputEmail1" value="{{ $bpelayan->keterangan }}" placeholder="Keterangan"></input>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="{{ route('pelayan') }}" class="btn btn-outline-dark btn-lg ml-3 float-right">Cancel</a>
                  <button type="submit" class="btn btn-warning btn-lg float-right">Update</button>
                </div>

              </form>
            </div>
            <!-- /.card -->
