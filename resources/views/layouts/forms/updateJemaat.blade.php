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
            <h1>Update Data Jemaat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Data Jemaat</li>
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
                <h3 class="card-title" id="textHeader">Ubah Data Jemaat</h3>
              </div><br>
              <!-- /.card-header -->
              <!-- form start -->

<form action="{{ route('updateJemaat') }}" method="post">
    @csrf
<div class="card-body">
        <input type="hidden" value="{{ $bjemaat->id_jemaat }}" id="idjemaat" class="form-control" placeholder="id Jemaat" name="id_jemaat">
        <input type="hidden" value="{{ $bjemaat->id_registrasi }}" id="idregistrasi" class="form-control" placeholder="id Registrasi" name="id_registrasi">
            <div class="form-group">
                <label>Nama Depan<span style="color: red;">*</span></label>
                <input type="text" class="form-control" name="nama_depan"  value="{{ $bjemaat->nama_depan }}" placeholder="Nama Depan">
            </div>
            <div class="form-group">
                <label>Nama Belakang<span style="color: red;">*</span></label>
                <input type="text" class="form-control" name="nama_belakang"  value="{{ $bjemaat->nama_belakang }}" placeholder="Nama Belakang">
            </div>
    <div class="row">
        <div class="col-sm-6">
                      <!-- text input -->
            <div class="form-group">
                <label>Gelar depan</label>
                <input type="text" class="form-control" name="gelar_depan"  value="{{ $bjemaat->gelar_depan }}" placeholder="Gelar Depan">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Gelar Belakang</label>
                <input type="text" class="form-control" name="gelar_belakang"  value="{{ $bjemaat->gelar_belakang }}" placeholder="Gelar Belakang">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
                      <!-- text input -->
            <div class="form-group">
                <label>Tempat Lahir<span style="color: red;">*</span></label>
                <input type="text" class="form-control" name="tempat_lahir"  value="{{ $bjemaat->tempat_lahir }}" placeholder="Tempat Lahir">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Tanggal Lahir<span style="color: red;">*</span></label>
                <input type="date" class="form-control" name="tanggal_lahir"  value="{{ $bjemaat->tanggal_lahir }}" placeholder="Tanggal Lahir">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
                      <!-- textarea -->
            <div class="form-group">
                <label>Nama Keluarga<span style="color: red;">*</span></label>
                <select class="form-control" name="id_registrasi">
                    <option class="form-control" value="">Pilih Keluarga</option>
                    @foreach($registrasi as $d)
                    <option  {{ $bjemaat->id_registrasi == $d->id_registrasi ? 'selected' : '' }} value="{{ $d->id_registrasi }}">{{ $d->nama_keluarga }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Golongan Darah</label>
                <input type="text" class="form-control" name="id_gol_darah"  value="{{ $bjemaat->id_gol_darah }}" placeholder="Golongan Darah">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
                      <!-- textarea -->
            <div class="form-group">
                <label>Jenis Kelamin<span style="color: red;">*</span></label>
                <input type="text" class="form-control" name="id_jenis_kelamin"  value="{{ $bjemaat->id_jenis_kelamin }}" placeholder="Jenis Kelamin">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>No Telepon</label>
                <input type="number" class="form-control" name="no_telepon"  value="{{ $bjemaat->no_telepon }}" placeholder="No Telepon">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
                      <!-- textarea -->
            <div class="form-group">
                <label>Alamat<span style="color: red;">*</span></label>
                <input type="text" class="form-control" name="alamat"  value="{{ $bjemaat->alamat }}" placeholder="Alamat">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Status Keluarga<span style="color: red;">*</span></label>
                <select class="form-control" name="id_hub_keluarga">
                    <option class="form-control" value="">Pilih Status Keluarga</option>
                        @foreach($keluarga as $barang)
                            <option {{ $bjemaat->id_hub_keluarga == $barang->id_hub_keluarga ? 'selected' : '' }} value="{{ $barang->id_hub_keluarga }}">{{ $barang->nama_hub_keluarga }}</option>
                        @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
                      <!-- textarea -->
            <div class="form-group">
                <label>Pekerjaan<span style="color: red;">*</span></label>
                <select class="form-control" name="id_pekerjaan">
                    <option class="form-control" value="">Pilih Pekerjaan</option>
                          @foreach($pekerjaan as $barang)
                              <option {{ $bjemaat->id_pekerjaan == $barang->id_pekerjaan ? 'selected' : '' }} value="{{ $barang->id_pekerjaan }}">{{ $barang->pekerjaan }}</option>
                          @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Pekerjaan Lainnya</label>
                <input type="text" class="form-control" name="nama_pekerjaan_lain"  value="{{ $bjemaat->nama_pekerjaan_lain }}" placeholder="Pekerjaan Lainnya">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
                      <!-- textarea -->
            <div class="form-group">
                <label>Bidang Pendidikan<span style="color: red;">*</span></label>
                <select class="form-control" name="id_bidang_pendidikan">
                    <option class="form-control" value="">Pilih Bidang Pendidikan</option>
                        @foreach($bpendidikan as $barang)
                            <option {{ $bjemaat->id_bidang_pendidikan == $barang->id_bidang_pendidikan ? 'selected' : '' }} value="{{ $barang->id_bidang_pendidikan }}">{{ $barang->nama_bidang_pendidikan }}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Pendidikan Terakhir<span style="color: red;">*</span></label>
                <select class="form-control" name="id_pendidikan">
                    <option class="form-control" value="">Pilih Pendidikan</option>
                        @foreach($pendidikan as $barang)
                            <option {{ $bjemaat->id_pendidikan == $barang->id_pendidikan ? 'selected' : '' }} value="{{ $barang->id_pendidikan }}">{{ $barang->pendidikan }}</option>
                        @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
                      <!-- textarea -->
            <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" name="keterangan"  value="{{ $bjemaat->keterangan }}" placeholder="Keterangan">
            </div>
        </div>
    </div>
</div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="{{ route('jemaat') }}" class="btn btn-outline-dark btn-lg ml-3 float-right">Cancel</a>
                  <button type="submit" class="btn btn-warning btn-lg float-right">Update</button>
                </div>
              </form>
            <!-- /.card -->
