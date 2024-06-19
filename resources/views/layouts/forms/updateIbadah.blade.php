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
            <h1>Update Jadwal Ibadah</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Jadwal Ibadah</li>
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
                <h3 class="card-title" id="textHeader">Ubah Jadwal Ibadah</h3>
              </div><br>
              <!-- /.card-header -->
              <!-- form start -->
<form action="{{ route('updateIbadah') }}" method="POST">
    @csrf
<div class="card-body">
        <input type="hidden" value="{{ $jadwal_ibadah->id_jadwal_ibadah }}" id="idjadwalibadah" class="form-control" placeholder="id Jadwal Ibadah" name="id_jadwal_ibadah">
            <div class="form-group">
                <label>Nama Minggu <span style="color: red">*</span></label>
                    <select name="id_jenis_minggu" id="id_jenis_minggu" class="form-select">
                        <option value="">Nama Minggu</option>
                            @foreach ($minggu as $d)
                                <option {{ $jadwal_ibadah->id_jenis_minggu == $d->id_jenis_minggu ? 'selected' : '' }} value="{{ $d->id_jenis_minggu }}">{{ $d->nama_jenis_minggu }}</option>
                            @endforeach
                    </select>
            </div>
            <div class="form-group">
                <label>Tanggal Ibadah <span style="color: red">*</span></label>
                <input type="date" value="{{ $jadwal_ibadah->tgl_ibadah }}" id="tgl_ibadah" class="form-control" name="tgl_ibadah" placeholder="Tgl Ibadah">
            </div>
            <div class="form-group">
                <label>Waktu Ibadah <span style="color: red">*</span></label>
                <input type="time" value="{{ $jadwal_ibadah->waktu_mulai }}" id="waktu_mulai" class="form-control" name="waktu_mulai" placeholder="Waktu Ibadah">
            </div>
            <div class="form-group">
                <label>Pengkhotbah <span style="color: red">*</span></label>
                <select name="id_melayani" id="id_melayani" class="form-select">
                <option value="">Pengkhotbah</option>
                    @foreach ($pendeta as $d)
                        <option {{ $jadwal_ibadah->id_melayani == $d->id_pelayan ? 'selected' : '' }} value="{{ $d->id_pelayan }}">{{ $d->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Jumlah Pelayan <span style="color: red">*</span></label>
                <input type="text" value="{{ $jadwal_ibadah->jumlah_pelayan }}" id="jumlah_pelayan" class="form-control" name="jumlah_pelayan" placeholder="Jumlah Pelayan">
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <input type="text" value="{{ $jadwal_ibadah->keterangan }}" id="keterangan" class="form-control" name="keterangan" placeholder="Keterangan">
            </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nyanyian 1 <span style="color: red">*</span></label>
                <input type="text" value="{{ $jadwal_ibadah->nyanyian_1 }}" id="nyanyian_1" class="form-control" name="nyanyian_1" placeholder="Nyanyian ke-1">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Votum <span style="color: red">*</span></label>
                <input type="text" value="{{ $jadwal_ibadah->votum }}" id="votum" class="form-control" name="votum" placeholder="Votum">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nyanyian 2 <span style="color: red">*</span></label>
                <input type="text" value="{{ $jadwal_ibadah->nyanyian_2 }}" id="nyanyian_2" class="form-control" name="nyanyian_2" placeholder="Nyanyian ke-2">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Hukum Taurat <span style="color: red">*</span></label>
                <input type="text" value="{{ $jadwal_ibadah->hukum_taurat }}" id="hukum_taurat" class="form-control" name="hukum_taurat" placeholder="Hukum Taurat">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nyanyian 3 <span style="color: red">*</span></label>
                <input type="text" value="{{ $jadwal_ibadah->nyanyian_3 }}" id="nyanyian_3" class="form-control" name="nyanyian_3" placeholder="Nyanyian ke-3">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Pengakuan Dosa <span style="color: red">*</span></label>
                <input type="text" value="{{ $jadwal_ibadah->pengakuan_dosa }}" id="pengakuan_dosa" class="form-control" name="pengakuan_dosa" placeholder="Pengakuan Dosa">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nyanyian 4 <span style="color: red">*</span></label>
                <input type="text" value="{{ $jadwal_ibadah->nyanyian_4 }}" id="nyanyian_4" class="form-control" name="nyanyian_4" placeholder="Nyanyian ke-4">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Epistel <span style="color: red">*</span></label>
                <input type="text" value="{{ $jadwal_ibadah->epistel }}" id="epistel" class="form-control" name="epistel" placeholder="Epistel">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nyanyian 5 <span style="color: red">*</span></label>
                <input type="text" value="{{ $jadwal_ibadah->nyanyian_5 }}" id="nyanyian_5" class="form-control" name="nyanyian_5" placeholder="Nyanyian ke-5">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Pengakuan Iman <span style="color: red">*</span></label>
                <input type="text" value="{{ $jadwal_ibadah->pengakuan_iman }}" id="pengakuan_iman" class="form-control" name="pengakuan_iman" placeholder="Pengakuan Iman">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nyanyian 6 <span style="color: red">*</span></label>
                <input type="text" value="{{ $jadwal_ibadah->nyanyian_6 }}" id="nyanyian_6" class="form-control" name="nyanyian_6" placeholder="Nyanyian ke-6">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Khotbah <span style="color: red">*</span></label>
                <input type="text" value="{{ $jadwal_ibadah->khotbah }}" id="khotbah" class="form-control" name="khotbah" placeholder="Khotbah">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nyanyian 7 <span style="color: red">*</span></label>
                <input type="text" value="{{ $jadwal_ibadah->nyanyian_7 }}" id="nyanyian_7" class="form-control" name="nyanyian_7" placeholder="Nyanyian ke-7">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Doa Penutup <span style="color: red">*</span></label>
                <input type="text" value="{{ $jadwal_ibadah->doa_penutup }}" id="doa_penutup" class="form-control" name="doa_penutup" placeholder="Doa Penutup">
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <a href="{{ route('ibadah') }}" class="btn btn-outline-dark btn-lg ml-3 float-right">Cancel</a>
    <button type="submit" class="btn btn-warning btn-lg float-right">Update</button>
  </div>
</form>
