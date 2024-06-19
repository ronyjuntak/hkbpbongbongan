@include('layouts.forms.header')
@include('layouts.forms.navbar')
@include('layouts.forms.sidebar')
@include('layouts.forms.footer')

        <div class="content-wrapper"><br><br>
        <section class="content">
            <div class="card card-primary">
              <div class="card-header" style="height:6rem;">
                <h3 class="card-title" id="textHeader">Tambah Naik Sidih</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('createSidi') }}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        {{--  <label for="exampleInputEmail1">Nama Jemaat<span style="color: red;">*</span></label>
                        <select class="form-control" name="id_jemaat" required autocomplete="off">
                            <option class="form-control" value="">Pilih Jemaat</option>
                            @if($jemaat != null)
                            @foreach($jemaat as $item)
                                <option  class="form-control" value="{{ $item->id_jemaat }}">{{ $item->nama_singkat }}</option>
                            @endforeach
                            @endif
                          </select>  --}}
                        <label>Nama Lengkap<span style="color: red;">*</span></label>
                        <input type="text" required class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Tanggal Baptis<span style="color: red;">*</span></label>
                        <input type="date" required class="form-control" name="tgl_baptis" placeholder="Tanggal Baptis">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nama Ayah<span style="color: red;">*</span></label>
                        <input type="text" required class="form-control" name="nama_ayah" placeholder="Nama Ayah">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Sektor<span style="color: red;">*</span></label>
                        <select class="form-control" name="sektor" required autocomplete="off">
                            <option class="form-control" value="">Pilih Sektor</option>
                            @if($sektor != null)
                            @foreach($sektor as $item)
                                <option  class="form-control" value="{{ $item->id_wijk }}">{{ $item->nama_wijk }}</option>
                            @endforeach
                            @endif
                          </select>
                        {{--  <label>Sektor<span style="color: red;">*</span></label>
                        <input type="text" required class="form-control" name="sektor" placeholder="Sektor">  --}}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Nama Ibu<span style="color: red;">*</span></label>
                        <input type="text" required class="form-control" name="nama_ibu" placeholder="Nama Ibu">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Nama Pendeta<span style="color: red;">*</span></label>
                        <input type="text" required class="form-control" name="nama_pendeta_sidi" placeholder="Nama Pendeta">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Tanggal Lahir<span style="color: red;">*</span></label>
                        <input type="date" required class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Tanggal Sidi</label>
                        <input type="date" class="form-control" name="tanggal_sidi" placeholder="Tanggal Sidi">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Tempat Lahir<span style="color: red;">*</span></label>
                        <input type="text" required class="form-control" name="tempat_lahir" placeholder="Tempat Lahir">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" placeholder="Keterangan">
                      </div>
                    </div>
                  </div>

                  <div class="card-footer">
                    <a href="{{ route('sidi') }}" class="btn btn-outline-dark btn-lg ml-3 float-right">Cancel</a>
                    <button type="submit" class="btn btn-success btn-lg float-right">Create</button>
                    </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
        </section>
    </div>
            <!-- /.card -->
