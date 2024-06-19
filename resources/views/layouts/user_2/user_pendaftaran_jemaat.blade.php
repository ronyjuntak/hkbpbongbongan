@include('layouts.user_2.style')
@include('layouts.user_2.navbar')
@include('sweetalert::alert')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Jemaat HKBP Bongbongan</title>

    <link rel="stylesheet" href="{{asset('Style')}}/style2.css">
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->




</head>
<body>
  <div id="loading-indicator">
    <img src="{{asset('Style')}}/image/loading2.gif" alt="Loading..." />
  </div>
    <header class="hero">
       <H1><span>Bongbongan</span></H1>
        <p>Pendaftaran Jemaat</p>

        <div class="mouse">
          <ion-icon name="arrow-down-circle-outline" id="scrollButton"></ion-icon>
        </div>
    </header>
    <main>

    <h1>Pendaftaran Jemaat</h1>

        <div class="card">
            <div class="image-container">
              <img class="foto_sidi" src="{{asset('Style')}}/image/jemaat.jpg" alt="gambar">
            </div>
            <div class="text-container">
              <h3>Jemaat</h3><br>
              <p>Untuk dapat menjadi bagian atau jemaat dari HKBP Bongbongan wajib mendaftarkan
                dirinya sehingga dapat diakui sebagai jemaat sah dari HKBP Bongbongan</p>
            </div>
          </div>

          <div class="card_1" id="targetElement">
            <h1 style="align-items: center; text-align: center; padding-right: 200px;"> <span style="display:inline-block; border-bottom: 1px solid black; width: 100px; margin-right: 10px; margin-bottom: 9px;">
                </span>Pendaftaran Jemaat HKBP Bongbongan<strong><span style="display:inline-block; border-bottom: 1px solid black; width: 100px; margin-left: 10px; margin-bottom: 9px;"></span></strong>
            </h1>
            <form  method="post" action="{{route('registrasiJemaat')}}" enctype="multipart/form-data">
              @csrf
              @method('post')
              <div class="form-group">
                <label for="name">Nama Depan<span style="color: red">*</span></label>
                <input type="text" id="name" name="nama_depan" value="{{ old('nama_depan') }}" placeholder="Masukkan nama depan anda" required/>
              </div>
              <div class="form-group">
                <label for="name">Nama Belakang</label>
                <input type="text" id="name" name="nama_belakang" value="{{ old('nama_belakang') }}" placeholder="Masukkan nama belakang anda" />
              </div>
              <div class="form-group">
                <label for="name">Gelar Depan</label>
                <input type="text" id="name" name="gelar_depan" value="{{ old('gelar_depan') }}" placeholder="Masukkan gelar depan anda" />
              </div>
              <div class="form-group">
                <label for="name">Gelar Belakang</label>
                <input type="text" id="name" name="gelar_belakang" value="{{ old('gelar_belakang') }}" placeholder="Masukkan gelar belakang anda" />
              </div>
              <div class="form-group">
                <label for="name">Tempat Lahir<span style="color: red">*</span></label>
                <input type="text" id="name" name="tempat_lahir" value="{{ old('tempat_lahir') }}" placeholder="Masukkan tempat lahir anda" required/>
              </div>
              <div class="form-group">
                <label for="name">Tanggal Lahir<span style="color: red">*</span></label>
                <input type="date" id="name" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" placeholder="Masukkan tanggal lahir anda" required/>
              </div>
              <div class="form-group">
                <label for="name">Golongan Darah</label>
                <!-- <input type="text" id="name" name="id_gol_darah" placeholder="Masukkan Golongan Darah Anda" /> -->
                <select class="pilihan" name="id_gol_darah">
                  <option  value="{{ old('id_gol_darah') }}">Pilih Golongan Darah Anda</option>
                  @foreach($gol_darahs as $data)
                    <option value="{{$data->id_gol_darah}}">{{$data->gol_darah}}</option>
                  @endforeach
                </select>
              </div>
              {{--  <div class="form-group">
                <label for="name">Golongan Darah</label>
                <input type="text" id="name" name="gol_darah" value="{{ old('gol_darah') }}" placeholder="Masukkan Golongan Darah anda" />
              </div>  --}}
              <div class="form-group">
                <label for="name">Jenis Kelamin<span style="color: red">*</span></label>
                <!-- <input type="text" id="name" name="id_jenis_kelamin" placeholder="Pilih Jenis Kelamin Anda" /> -->
                <select class="pilihan" name="id_jenis_kelamin">
                  <option  value="{{ old('id_jenis_kelamin') }}">Pilih Jenis Kelamin Anda</option>
                  @foreach($jenis_kelamins as $data)
                    <option value="{{$data->id_jenis_kelamin}}">{{$data->jenis_kelamin}}</option>
                  @endforeach
                </select>
              </div>
              {{--  <div class="form-group">
                <label for="name">Jenis Kelamin</label>
                <input type="text" id="name" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}" placeholder="Masukkan jenis kelamin" required/>
              </div>  --}}
              <div class="form-group">
                <label for="name">No Telepon</label>
                <input type="text" id="name" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="Masukkan nomor telepon anda" />
              </div>
              <div class="form-group">
                <label for="name">Alamat<span style="color: red">*</span></label>
                <input type="text" id="name" name="alamats" value="{{ old('alamats') }}" placeholder="Masukkan alamat anda" required/>
              </div>
              <div class="form-group">
                <label for="name">Nama Keluarga<span style="color: red">*</span></label>
                <!-- <input type="text" id="name" name="nama_keluarga" placeholder="Masukkan Gelar Anda" /> -->
                <select class="pilihan" name="nama_keluarga">
                  <option  value="{{ old('nama_keluarga') }}">Pilih Nama Keluarga Anda</option>
                  @foreach($margas as $data)
                    @if ($data->status == 1)
                    <option value="{{$data->no_registrasi}}">{{$data->nama_keluarga}}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="name">Sektor<span style="color: red">*</span></label>
                <!-- <input type="text" id="name" name="id_wijk" placeholder="Masukkan Sektor Anda" /> -->
                <select class="pilihan" name="id_wijk">
                  <option  value="{{ old('id_wijk') }}">Pilih Sektor Anda</option>
                  @foreach($sektors as $data)
                  <option value="{{$data->id_wijk}}">{{$data->nama_wijk}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="name">Status Keluarga<span style="color: red">*</span></label>
                <!-- <input type="text" id="name" name="id_hub_keluarga" placeholder="Masukkan Gelar Anda" /> -->
                <select class="pilihan" name="id_hub_keluarga">
                  <option  value="{{ old('id_hub_keluarga') }}">Pilih Status Hubungan Keluarga Anda</option>
                  @foreach($keluargas as $data)
                    <option value="{{$data->id_hub_keluarga}}">{{$data->nama_hub_keluarga}}</option>
                  @endforeach
                </select>
              </div>
              <!-- <div class="form-group">
                <label for="name">Status</label>
                <input type="text" id="name" name="id_status_pernikahan" placeholder="Masukkan Gelar Anda" />
              </div> -->
              <div class="form-group">
                <label for="name">Pendidikan Terakhir</label>
                <!-- <input type="text" id="name" name="id_pendidikan" placeholder="Masukkan Gelar Anda" /> -->
                <select class="pilihan" name="id_pendidikan">
                  <option  value="{{ old('id_pendidikan') }}">Pilih Pendidikan Terakhir Anda</option>
                  @foreach($pendidikans as $data)
                    <option value="{{$data->id_pendidikan}}">{{$data->pendidikan}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="name">Bidang Pendidikan</label>
                <!-- <input type="text" id="name" name="id_bidang_pendidikan" placeholder="Masukkan Gelar Anda" /> -->
                <select  class="pilihan"name="id_bidang_pendidikan">
                  <option value="{{ old('id_bidang_pendidikan') }}">Pilih Bidang Pendidikan Anda</option>
                  @foreach($bidangPendidikans as $data)
                    <option value="{{$data->id_bidang_pendidikan}}">{{$data->nama_bidang_pendidikan}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="name">Pekerjaan</label>
                <!-- <input type="text" id="name" name="id_pekerjaan" placeholder="Masukkan Gelar Anda" /> -->
                <select class="pilihan"name="id_pekerjaan">
                  <option  value="{{ old('id_pekerjaan') }}">Pilih Pekerjaan Anda</option>
                  @foreach($pekerjaans as $data)
                    <option value="{{$data->id_pekerjaan}}">{{$data->pekerjaan}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="name">Pekerjaan Lainnya</label>
                <input type="text" id="name" name="nama_pekerjaan_lain" value="{{ old('nama_pekerjaan_lain') }}" placeholder="Masukkan pekerjaan lain jika tidak ada terdaftar pada aplikasi" />
              </div>
              <div class="form-group">
                <label for="image" class="form-label">Foto<span style="color: red">*</span></label>
                <input class="form-control @error('foto') is-invalid @enderror" type="file" id="image" name="foto" required>
                @error('foto')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="image" class="form-label">Surat Tardidi<span style="color: red">*</span></label>
                <input class="form-control @error('sbk') is-invalid @enderror" type="file" id="image" name="sbk" required>
                @error('sbk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="image" class="form-label">Surat Naik Sidi (jika ada)</label>
                <input class="form-control @error('sns') is-invalid @enderror" type="file" id="image" name="sns">
                @error('sns')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              {{--  <div class="form-group">
                <label for="image" class="form-label">Surat Pernikahan (jika ada)</label>
                <input class="form-control @error('sbp') is-invalid @enderror" type="file" id="image" name="sbp">
                @error('sbp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>  --}}
              {{--  <div class="form-group">
                <label for="name">Keterangan</label>
                <input type="text" id="name" name="keterangan" value="{{ old('keterangan') }}" placeholder="Masukkan Gelar Anda" />
              </div>  --}}
              {{--  <input type="hidden" name="id_keluarga" value="{{ $margas->no_registrasi }}">  --}}
              <input type="hidden" name="id_user" value="{{ Auth::id() }}">
              <!-- upload foto -->
              <div style="text-align: right; margin-top: 40px;">
                 <input type="submit" value="DAFTAR"/>
              </div>
            </form>
          </div>



    </main>
    <footer>
       <div class="footer_1">
        <img src="{{ asset('Style') }}/image/logo_putih.png" alt="Foto">
            <div class="teks">
            <h1>
                BONGBONGAN
            </h1>
            <P>Jl. Medan Km 6,        <br>
                Pondok Sayur,          <br>
                Kec. Siantar Martoba,          <br>
                Kota Pematangsiantar      <br>
                , Sumatera Utara   <br>
                21154</P>
            </div>

       </div>

	</footer>
  <script src="{{asset('Style')}}/style.js"></script>
  <script>
    var scrollButton = document.getElementById('scrollButton');

    scrollButton.addEventListener('click', function() {
      var targetElement = document.getElementById('targetElement');

      if (targetElement) {
        var targetPosition = targetElement.offsetTop;

        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
      }
    });
  </script>
  <script>
    document.getElementById('loading-indicator').style.display = 'block';

    // Kirim permintaan asinkron menggunakan JavaScript atau teknik AJAX
    // Setelah respons diterima, sembunyikan GIF loading
    // Contoh penggunaan dengan teknik Fetch API
    fetch('/example')
        .then(response => {
            // Proses respons atau tindakan lain yang sesuai
        })
        .finally(() => {
            document.getElementById('loading-indicator').style.display = 'none';
        });
  </script>
</body>
</html>
