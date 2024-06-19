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
            <h1>Pendaftaran Keluarga</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Pendaftaran Keluarga</li>
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
                <h3 class="card-title" id="textHeader">Tambah Nama Keluarga</h3>
              </div><br>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('createKeluarga') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  {{--  <div class="form-group">
                    <label for="exampleInputEmail1">No. Registrasi</label>  --}}
                    {{--  <select class="form-control" name="id_jemaat" required autocomplete="off">
                      <option class="form-control" value="">Pilih Jemaat</option>
                      @if($jemaat != null)
                      @foreach($jemaat as $item)
                          <option  class="form-control" value="{{ $item->id_jemaat }}">{{ $item->nama_lengkap }}</option>
                      @endforeach
                      @endif
                    </select>  --}}
                    {{--  <input type="text" class="form-control" name="no_registrasi" id="exampleInputEmail1" placeholder="No. Registrasi" required>
                  </div>  --}}
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal Registrasi</label>
                    {{--  <select class="form-control" name="id_jenis_rpp" required autocomplete="off">
                      <option class="form-control" value="">Pilih Jenis RPP</option>
                      @if($rpp != null)
                      @foreach($rpp as $item)
                          <option  class="form-control" value="{{ $item->id_jenis_rpp }}">{{ $item->jenis_rpp }}</option>
                      @endforeach
                      @endif
                    </select>  --}}
                    <input type="date" class="form-control" name="tgl_registrasi" id="exampleInputPassword1" placeholder="Tanggal Registrasi" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Keluarga</label>
                    <input type="text" required autocomplete="off" class="form-control" name="nama_keluarga" id="exampleInputEmail1" placeholder="Nama Keluarga" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sektor</label>
                    <select class="form-control" name="id_wijk" required autocomplete="off">
                        <option class="form-control" value="">Pilih Sektor</option>
                        @if($id_wijk != null)
                        @foreach($id_wijk as $item)
                            <option  class="form-control" value="{{ $item->id_wijk }}">{{ $item->nama_wijk }}</option>
                        @endforeach
                        @endif
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Register</label>
                    <select class="form-control" name="id_jenis_register" required autocomplete="off">
                      <option class="form-control" value="">Pilih Jenis Register</option>
                      @if($jenis_registrasi != null)
                      @foreach($jenis_registrasi as $item)
                          <option  class="form-control" value="{{ $item->id_jenis_registrasi }}">{{ $item->nama_jenis_registrasi }}</option>
                      @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Gereja</label>
                    <select class="form-control" name="id_gereja" required autocomplete="off">
                      <option class="form-control" value="">Pilih Gereja</option>
                      @if($gereja != null)
                      @foreach($gereja as $item)
                          <option  class="form-control" value="{{ $item->id_gereja }}">{{ $item->nama_gereja }}</option>
                      @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">No. HP</label>
                    <input type="text" required autocomplete="off" class="form-control" name="no_hp" id="exampleInputEmail1" placeholder="No. HP">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <input type="text" required autocomplete="off" class="form-control" name="alamat" id="exampleInputEmail1" placeholder="Alamat" required>
                  </div>
                  <div class="custom-file-upload">
                    <label for="fileUploadInput" class="form-label">Surat Pernikahan dari Gereja</label>
                    <input class="form-control @error('skp') is-invalid @enderror" type="file" id="fileUpload1" name="skp" accept=".png, .jpg, .jpeg" required>
                    @error('skp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                  </div>
                  {{--  <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <select class="form-control" name="id_status_registrasi" required autocomplete="off">
                      <option class="form-control" value="">Pilih Status</option>
                      @if($status != null)
                      @foreach($status as $item)
                          <option  class="form-control" value="{{ $item->id_status }}">{{ $item->id_jenis_status }} {{ $item->keterangan }}</option>
                      @endforeach
                      @endif
                    </select>
                  </div>  --}}
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a class="btn btn-outline-dark btn-lg ml-3 float-right" href="{{ route('keluarga') }}">Cancel</a>
                  <button type="submit" class="btn btn-success btn-lg float-right">Create</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
