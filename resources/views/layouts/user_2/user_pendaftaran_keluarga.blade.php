@include('layouts.user_2.style')
@include('layouts.user_2.navbar')
@include('sweetalert::alert')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Keluarga</title>

    <link rel="stylesheet" href="{{asset('Style')}}/style2.css">
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->


</head>
<body>
  <div id="loading-indicator">
    <img src="{{asset('Style')}}/image/loading2.gif" alt="Loading..." />
  </div>
    <header class="hero">
       <H1><span>Bongbongan</span></H1>
        <p>Daftar Keluarga HKBP Bongbongan</p>

        <div class="mouse">
          <ion-icon name="arrow-down-circle-outline" id="scrollButton"></ion-icon>
        </div>
    </header>
    <main>

      <h1>Pendaftaran Keluarga</h1>

        <div class="card">
            <div class="image-container">
              <img class="foto_keluarga" src="{{ asset('Style')}}/image/keluarga.jpg" alt="gambar">
            </div>
            <div class="text-container">
              <h3>Keluarga</h3><br>
              <p>Keluarga adalah bagian terkecil dari persekutuan kepada Tuhan</p>
            </div>

          </div>

          <div class="card_1" id="targetElement">
            <h1 style="align-items: center; text-align: center; padding-right: 200px;"> <span style="display:inline-block; border-bottom: 1px solid black; width: 50px; margin-right: 10px; margin-bottom: 9px;">
                </span>Keluarga HKBP Bongbongan<strong><span style="display:inline-block; border-bottom: 1px solid black; width: 50px; margin-left: 10px; margin-bottom: 9px;"></span></strong>
            </h1>
            <form method="post" action="{{route('registrasiKeluarga')}}" enctype="multipart/form-data">
              @csrf
              @method('post')
              <div class="card-body">
                {{--  <div class="form-group">
                  <label for="exampleInputEmail1">No. Registrasi</label>
                  <input type="text" class="form-control" name="no_registrasi" id="exampleInputEmail1" placeholder="No. Registrasi" required>
                </div>  --}}
                <div class="form-group">
                  <label for="exampleInputPassword1">Tanggal Registrasi<span style="color: red">*</span></label>
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
                  <label for="exampleInputEmail1">Nama Keluarga<span style="color: red">*</span></label>
                  <input type="text" required autocomplete="off" class="form-control" name="nama_keluarga" id="exampleInputEmail1" placeholder="Nama Keluarga" required>
                </div>
                <div class="form-group">
                  <label for="name">Sektor<span style="color: red">*</span></label>
                  <!-- <input type="date" id="name" name="id_wijk" placeholder="Masukkan Sektor Anda" /> -->
                  <select class="pilihan" name="id_wijk" required autocomplete="off">
                      <option value="{{ old('id_wijk') }}">Pilih Sektor</option>
                      @foreach($sektors as $item)
                          <option value="{{ $item->id_wijk }}">{{ $item->nama_wijk }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Jenis Register<span style="color: red">*</span></label>
                  <!-- <input type="date" id="name" name="id_jenis_register" placeholder="Masukkan Sektor Anda" /> -->
                  <select class="pilihan" name="id_jenis_register" required autocomplete="off">
                    <option value="{{ old('id_jenis_register') }}">Pilih Jenis Register</option>
                    @foreach($jenisregisters as $item)
                        <option value="{{ $item->id_jenis_registrasi }}">{{ $item->nama_jenis_registrasi }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="name">Nama Gereja<span style="color: red">*</span></label>
                  <!-- <input type="date" id="name" name="id_gereja" placeholder="Masukkan Sektor Anda" /> -->
                  <select class="pilihan" name="id_gereja" required autocomplete="off">
                    <option value="{{ old('id_gereja') }}">Pilih Gereja</option>
                    @foreach($gerejas as $item)
                        <option value="{{ $item->id_gereja }}">{{ $item->nama_gereja }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">No_HP<span style="color: red">*</span></label>
                    <input type="text" required autocomplete="off" class="form-control" name="no_hp" id="exampleInputEmail1" placeholder="No HP/WA aktif" required>
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Alamat<span style="color: red">*</span></label>
                    <input type="text" required autocomplete="off" class="form-control" name="alamat" id="exampleInputEmail1" placeholder="Alamat" required>
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
              <div class="custom-file-upload">
                <label for="fileUploadInput" class="form-label">Surat Pernikahan dari Gereja<span style="color: red">*</span></label>
                <input class="form-control @error('skp') is-invalid @enderror" type="file" id="fileUpload1" name="skp" accept=".png, .jpg, .jpeg" required>
                @error('skp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <div style="text-align: right; margin-top: 40px;">
                 <input type="submit" onclick="contoh()" value="DAFTAR"/>
              </div>
              <input type="hidden" name="id_user" value="{{ Auth::id() }}">
              <script type="text/javascript">

                    function contoh() {

                      swal({

                            title: "Berhasil!",

                            text: "Pop-up berhasil ditampilkan",

                            icon: "success",

                            button: true

                        });

                    }

                </script>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"

                  integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"

                    crossorigin="anonymous"></script>
            </form>
          </div>



    </main>
    <footer>
       <div class="footer_1">
        <img src="{{ asset('Style') }}/image/logo_putih.png" alt="Foto">
            <div class="teks">
            <h1>
                Bongbongan
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
