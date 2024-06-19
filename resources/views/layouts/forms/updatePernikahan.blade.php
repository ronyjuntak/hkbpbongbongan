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
            <h1>Update Data Pernikahan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Data Pernikahan</li>
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
                <h3 class="card-title" id="textHeader">Ubah Data Pernikahan</h3>
              </div><br>
              <!-- /.card-header -->
              <!-- form start -->

              <form action="{{ route('updatePernikahan') }}" method="POST">
                @csrf
                @method('POST')
                <div class="card-body">
                  <input type="hidden" name="id_pernikahan" value="{{ $bnikah->id_pernikahan }}">
                  <div class="form-group">
                    <label for="exampleInputEmail1">ID Registrasi Nikah<span style="color: red;">*</span></label>
                    <select class="form-control" name="id_registrasi_pernikahan" required autocomplete="off">
                      <option class="form-control" value="">Pasangan</option>
                      @if($nikah != null)
                      @foreach($nikah as $barang)
                          <option  class="form-control" value="{{ $barang->id_registrasi_nikah }}">Pasangan {{ $barang->nama_lengkap_laki }} & {{ $barang->nama_lengkap_perempuan }}</option>
                      @endforeach
                      @endif
                    </select>
                    {{-- <input type="option" class="form-control" id="exampleInputEmail1" name="id_registrasi_pernikahan" value="{{ $item['id_registrasi_pernikahan'] }}" placeholder="Nama Pelayan"> --}}
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Pernikahan<span style="color: red;">*</span></label>
                    <input type="date" required autocomplete="off" class="form-control" id="exampleInputEmail1" name="tgl_pernikahan" value="{{ $bnikah->tgl_pernikahan }}" placeholder="ID Jemaat">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nats Pernikahan<span style="color: red;">*</span></label>
                    <input type="text" required autocomplete="off" class="form-control" id="exampleInputPassword1" name="nats_pernikahan" value="{{ $bnikah->nats_pernikahan }}" placeholder="Nats Pernikahan">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">ID Gereja Pernikahan</label>
                    <select class="form-control" name="id_gereja_nikah" autocomplete="off">
                      <option class="form-control" value="">Pilih Gereja</option>
                      @if($gereja != null)
                      @foreach($gereja as $barang)
                          <option  class="form-control" value="{{ $barang->id_gereja }}">{{ $barang->nama_gereja }}</option>
                      @endforeach
                      @endif
                    </select>
                    {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="id_gereja_nikah" value="{{ $item['id_gereja_nikah'] }}" placeholder="ID Gereja Pernikahan"> --}}
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Gereja</label>
                    <input type="text" autocomplete="off" class="form-control" id="exampleInputEmail1" name="nama_gereja_non_HKBP" value="{{ $bnikah->nama_gereja_non_HKBP }}" placeholder="Diluar Gereja HKBP Bongbongan">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Pendeta Memberkati<span style="color: red;">*</span></label>
                    <input type="text" required autocomplete="off" class="form-control" id="exampleInputEmail1" name="nama_pendeta" value="{{ $bnikah->nama_pendeta }}" placeholder="Nama Pendeta Memberkati">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Keterangan</label>
                    <textarea type="text" autocomplete="off" class="form-control" id="exampleInputEmail1" name="keterangan" value="" placeholder="Keterangan">{{ $bnikah->keterangan }}</textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="{{ route('pernikahan') }}" class="btn btn-out9line-dark btn-lg ml-3 float-right">Cancel</a>
                  <button type="submit" class="btn btn-warning btn-lg float-right">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
