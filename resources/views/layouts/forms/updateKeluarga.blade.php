@include('layouts.forms.header')
@include('layouts.forms.navbar')
@include('layouts.forms.sidebar')
@include('layouts.forms.footer')

<!-- general form elements disabled -->
        <div class="content-wrapper"><br><br>
        <section class="content">
            <div class="card card-primary">
              <div class="card-header" style="height:6rem;">
                <h3 class="card-title" id="textHeader">Update Data Keluarga</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('updateKeluarga') }}" method="post" enctype="multipart/form-data">
                    @csrf
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <input type="hidden" class="form-control" name="id_registrasi" required value="{{ $bkeluarga->id_registrasi }}">
                      <div class="form-group">
                        <label>No. Registrasi<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" autocomplete="off" readonly name="no_registrasi" value="{{ $bkeluarga->no_registrasi }}" placeholder="Nomor Registrasi">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nama Keluarga<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" autocomplete="off" required name="nama_keluarga" value="{{ $bkeluarga->nama_keluarga }}" placeholder="Nama Keluarga">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Sektor<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" autocomplete="off" readonly name="sektor" value="{{ $bkeluarga->id_wijk }}" placeholder="Sektor">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Tanggal Registrasi<span style="color: red;">*</span></label>
                        <input type="date" class="form-control" autocomplete="off" required name="tgl_registrasi" value="{{ $bkeluarga->tgl_registrasi }}" placeholder="Tanggal Registrasi">
                      </div>
                    </div>
                  {{--  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" class="form-control" placeholder="Tempat Lahir">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Golongan Darah</label>
                        <input type="text" class="form-control" placeholder="Golongan Darah">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" class="form-control" placeholder="Jenis Kelamin">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>No Telepon</label>
                        <input type="text" class="form-control" placeholder="No Telepon">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" rows="3" placeholder="keterangan"></textarea>
                      </div>
                    </div>
                  </div>  --}}
                  <div class="card-footer mt-3">
                    <a href="{{ route('keluarga') }}" class="btn btn-outline-dark btn-lg ml-3 float-right">Cancel</a>
                    <button type="submit" class="btn btn-success btn-lg float-right">Update</button>
                    </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
        </section>
    </div>
            <!-- /.card -->
