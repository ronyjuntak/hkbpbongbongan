<?php

namespace App\Http\Controllers;
// use Alert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;
// use Alert;


class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jemaat['jemaats'] = DB::table('jemaat')->get();

        $data = array_merge($jemaat);

        return view('layouts.user_2.user_pendaftaran_martumpol', $data);
    }

    public function daftarMartumpol(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8070/api/daftarMartumpol', [
            'nama_gereja_laki' => $request->get('nama_gereja_laki'),
            'id_jemaat_laki' => $request->get('id_jemaat_laki'),
            'nama_ayah_laki' => $request->get('nama_ayah_laki'),
            'nama_ibu_laki' => $request->get('nama_ibu_laki'),
            'nama_gereja_perempuan' => $request->get('nama_gereja_perempuan'),
            'id_jemaat_perempuan' => $request->get('id_jemaat_perempuan'),
            'nama_ayah_perempuan' => $request->get('nama_ayah_perempuan'),
            'nama_ibu_perempuan' => $request->get('nama_ibu_perempuan'),
            'keterangan' => $request->get('keterangan'),
            'id_user' => $request->get('id_user'),
            // 'alamat' => $request->get('alamat'),
        ]);

        Alert::success('Martumpol', 'Registrasi Berhasil');

        if ($response->failed()) {
            Alert::error('Martumpol', 'Registrasi Gagal');
            return back()->withErrors(['message' => 'error when create Baptis data']);
        }

        return redirect()->route('martumpolUser');
    }

    public function index2()
    {
        return view('layouts.user_2.user_pendaftaran_baptis');
    }

    public function daftarBaptis(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8070/api/daftarBaptis', [
            'nama_lengkap' => $request->get('nama_lengkap'),
            'nama_ayah' => $request->get('nama_ayah'),
            'nama_ibu' => $request->get('nama_ibu'),
            'tempat_lahir' => $request->get('tempat_lahir'),
            'tanggal_lahir' => $request->get('tanggal_lahir'),
            'jenis_kelamin' => $request->get('jenis_kelamin'),
            'alamat' => $request->get('alamat'),
            'keterangan' => $request->get('keterangan'),
            'id_user' => $request->get('id_user'),
        ]);

        if ($response->failed()) {
            Alert::error('Baptis', 'Registrasi Gagal');
            return back()->withErrors(['message' => 'error when create Baptis data']);
        }
        Alert::success('Baptis', 'Registrasi Berhasil');
        return redirect()->route('baptisUser');
    }

    public function index3()
    {
        return view('layouts.user_2.user_pendaftaran_jemaat');
    }

    public function daftarJemaat(Request $request)
    {
        // $id_user = Auth::guard('users')->user()->id;
        $id_user = $request->id_user;
        $id_registrasii = $request->id_registrasii;
        $nama_depan = $request->nama_depan;
        $nama_belakang = $request->nama_belakang;
        $gelar_depan = $request->gelar_depan;
        $gelar_belakang = $request->gelar_belakang;
        $tempat_lahir = $request->tempat_lahir;
        $tanggal_lahir = $request->tanggal_lahir;
        $foto = $request->foto;
        $sbk = $request->sbk;
        $sns = $request->sns;
        // $sbp = $request->sbp;
        $id_gol_darah = $request->id_gol_darah;
        $id_jenis_kelamin = $request->id_jenis_kelamin;
        $nama_keluarga = $request->nama_keluarga;
        $id_wijk = $request->id_wijk;
        $id_hub_keluarga = $request->id_hub_keluarga;
        $id_pendidikan = $request->id_pendidikan;
        $id_bidang_pendidikan = $request->id_bidang_pendidikan;
        $id_pekerjaan = $request->id_pekerjaan;
        $nama_pekerjaan_lain = $request->nama_pekerjaan_lain;
        $no_telepon = $request->no_telepon;
        $alamats = $request->alamats;
        $id_kota = $request->id_kota;
        $id_keluarga = $request->id_keluarga;

        $kode_sbk = rand();
        if ($request->hasFile('sbk')) {
            $sbk = $kode_sbk . "." . $request->file('sbk')->getClientOriginalExtension();
        } else {
            $sbk = null;
        }
        $kode_sns = rand();
        if ($request->hasFile('sns')) {
            $sns = $kode_sns . "." . $request->file('sns')->getClientOriginalExtension();
        } else {
            $sns = null;
        }
        $kode_foto = rand();
        if ($request->hasFile('foto')) {
            $foto = $kode_foto . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        $simpan = $request->validate([
            'nama_depan' => 'required|max:255',
            'nama_belakang' => 'required|max:255',
            'tempat_lahir' => 'required|max:100',
            'tanggal_lahir' => 'required',
            'foto' => 'image|file|max:1024',
            'sbk' => 'image|file|max:1024',
            // 'sns' => 'image|file|max:1024',
            // 'sbp' => 'image|file|max:1024',
            'id_jenis_kelamin' => 'required',
            'id_gol_darah' => 'required',
            'nama_keluarga' => 'required',
            'id_hub_keluarga' => 'required',
            'id_bidang_pendidikan' => 'required',
            'id_pekerjaan' => 'required',
            'no_telepon' => 'required',
            'alamats' => 'required'
        ]);

        $lastreg = DB::table('jemaat')
                ->whereRaw('jemaat.nama_keluarga')
                ->orderBy('jemaat.id_registrasii','desc')
                ->first();
        $lastkodereg = $lastreg != null ? $lastreg->id_registrasii : "";
        $format = "".$nama_keluarga;
        $id_registrasii = buatkode($lastkodereg,$format,2);
        // if ($request->file('sbk')){
        //     $validatedData['sbk'] = $request->file('sbk')->store('sbks');
        // }
        // if ($request->file('sns')){
        //     $validatedData['sns'] = $request->file('sns')->store('snss');
        // }
        // if ($request->file('sbp')){
        //     $validatedData['sbp'] = $request->file('sbp')->store('sbps');
        // }
        $data = [
            'nama_depan' => $nama_depan,
            'id_registrasii' => $id_registrasii,
            // 'id_registrasi' => $request->get('id_registrasi'),
            'nama_belakang' => $nama_belakang,
            'gelar_depan' => $gelar_depan,
            'gelar_belakang' => $gelar_belakang,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'foto' => $foto,
            'sbk' => $sbk,
            'sns' => $sns,
            // 'sbp' => $sbp,
            'id_gol_darah' => $id_gol_darah,
            'id_jenis_kelamin' => $id_jenis_kelamin,
            'nama_keluarga' => $nama_keluarga,
            'id_wijk' => $id_wijk,
            'id_hub_keluarga' => $id_hub_keluarga,
            // 'id_status_pernikahan' => $request->get('id_status_pernikahan'),
            'id_pendidikan' => $id_pendidikan,
            'id_bidang_pendidikan' => $id_bidang_pendidikan,
            'id_pekerjaan' => $id_pekerjaan,
            'nama_pekerjaan_lain' => $nama_pekerjaan_lain,
            'no_telepon' => $no_telepon,
            'alamats' => $alamats,
            'id_kota' => $id_kota,
            // 'keterangan' => $request->get('keterangan'),
            'id_user' => $id_user,
            'id_keluarga' => $id_keluarga,
        ];

        $simpan = DB::table('jemaat')->insert( $data);

        if ($simpan) {
            // $kode_sbk = rand();
        if ($request->hasFile('sbk')) {
            $sbk = $kode_sbk . "." . $request->file('sbk')->getClientOriginalExtension();
            $folderPath = "sbks/";
            $request->file('sbk')->storeAs($folderPath, $sbk);
        }
        // $kode_sns = rand();
        if ($request->hasFile('sns')) {
            $sns = $kode_sns . "." . $request->file('sns')->getClientOriginalExtension();
            $folderPath = "snss/";
            $request->file('sns')->storeAs($folderPath, $sns);
        }

        if ($request->hasFile('foto')) {
            $foto = $kode_foto . "." . $request->file('foto')->getClientOriginalExtension();
            $folderPath = "foto/";
            $request->file('foto')->storeAs($folderPath, $foto);
        }
        // $kode_sbp = rand();
        // if ($request->hasFile('sbp')) {
        //     $sbp = $kode_sbp . "." . $request->file('sbp')->getClientOriginalExtension();
        //     $folderPath = "sbps/";
        //     $request->file('sbp')->storeAs($folderPath, $sbp);
        // } else {
        //     $sbp = null;
        // }
            Alert::success('Tambah Jemaat', 'Tambah Jemaat Berhasil');
            return redirect()->route('jemaatUser');
        }
            Alert::error('Tambah Jemaat', 'Tambah Jemaat Gagal');
            return back();
    }

    public function index4()
    {
        $jemaat['jemaats'] = DB::table('jemaat')->get();

        $data = array_merge($jemaat);

        return view('layouts.user_2.user_pendaftaran_pernikahan', $data);
    }

    public function daftarNikah(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8070/api/daftarNikah', [
            'tgl_martumpol' => $request->get('tgl_martumpol'),
            'nama_gereja_martumpol' => $request->get('nama_gereja_martumpol'),
            'tgl_pemberkatan' => $request->get('tgl_pemberkatan'),
            'nama_gereja_pemberkatan' => $request->get('nama_gereja_pemberkatan'),
            'nama_gereja_laki' => $request->get('nama_gereja_laki'),
            'nama_lengkap_laki' => $request->get('nama_lengkap_laki'),
            'nama_lengkap_perempuan' => $request->get('nama_lengkap_perempuan'),
            'nama_ayah_laki' => $request->get('nama_ayah_laki'),
            'nama_ibu_laki' => $request->get('nama_ibu_laki'),
            'nama_gereja_perempuan' => $request->get('nama_gereja_perempuan'),
            'nama_ayah_perempuan' => $request->get('nama_ayah_perempuan'),
            'nama_ibu_perempuan' => $request->get('nama_ibu_perempuan'),
            'keterangan' => $request->get('keterangan'),
            'id_user' => $request->get('id_user'),
        ]);

        Alert::success('Nikah', 'Registrasi Berhasil');

        if ($response->failed()) {
            Alert::error('Nikah', 'Registrasi Gagal');
            return back()->withErrors(['message' => 'error when create Baptis data']);
        }

        return redirect()->route('nikahUser');
    }

    public function index5()
    {
        // $namKeluarga['namKeluargas'] = DB::table('namKeluarga')->get();
        $jemaat['jemaats'] = DB::table('jemaat')->get();

        $data = array_merge( $jemaat);

        return view('layouts.user_2.user_pindah',  $data);
    }

    public function daftarPindah(Request $request)
    {
        $response = Http::post('http://127.0.0.1:8070/api/daftarPindah', [
            'id_registrasi' => $request->get('id_registrasi'),
            'id_jemaat' => $request->get('id_jemaat'),
            'tgl_pindah' => $request->get('tgl_pindah'),
            'nama_gereja' => $request->get('nama_gereja'),
            'keterangan' => $request->get('keterangan'),
            'id_user' => $request->get('id_user'),
        ]);

        Alert::success('Jemaat Pindah', 'Registrasi Berhasil');

        if ($response->failed()) {
            Alert::error('Jemaat Pindah', 'Registrasi Gagal');
            return back()->withErrors(['message' => 'error when create Baptis data']);
        }

        return redirect()->route('pindahUser');
    }

    public function index6()
    {
        $gereja['gerejas'] = DB::table('gereja')->get();
        $sektor['sektors'] = DB::table('wijk')->get();
        $keluarga['keluargas'] = DB::table('hubungan_keluarga')->get();

        $data = array_merge($gereja, $keluarga, $sektor);

        return view('layouts.user_2.user_pendaftaran_naik_sidi', $data);
    }

    public function daftarSidi(Request $request)
    {
        $response = DB::table('registrasi_sidi')->insert( [
            'nama_lengkap' => $request->get('nama_lengkap'),
            'nama_ayah' => $request->get('nama_ayah'),
            'nama_ibu' => $request->get('nama_ibu'),
            'tempat_lahir' => $request->get('tempat_lahir'),
            'tanggal_lahir' => $request->get('tanggal_lahir'),
            'id_gereja_sidi' => $request->get('id_gereja_sidi'),
            'sektor' => $request->get('sektor'),
            'nama_gereja_non_hkbp' => $request->get('nama_gereja_non_hkbp'),
            'id_hub_keluarga' => $request->get('id_hub_keluarga'),
            'keterangan' => $request->get('keterangan'),
            'id_user' => $request->get('id_user'),
            // 'alamat' => $request->get('alamat'),
        ]);

        if (!$response) {
            Alert::error('Tambah Sidi', 'Tambah Sidi Gagal');
            return back();
        }
            Alert::success('Tambah Sidi', 'Tambah Sidi Berhasil');
            return redirect()->route('sidiUser');
    }

    public function index7(Request $request)
    {
        $pelayan['pelayans'] = DB::table('pelayan_gereja')->get();
        $jadwal['jadwals'] = DB::table('jadwal_ibadah')->get();
        $kegiatan['kegiatans'] = DB::table('kegiatan')->get();
        $pemasukan['pemasukans'] = DB::table('pemasukan')->get();
        $pengeluaran['pengeluarans'] = DB::table('pengeluaran')->get();

        $data = array_merge($pelayan, $jadwal, $kegiatan, $pemasukan, $pengeluaran);

        return view('layouts.user_2.userHome', $data);
    }
    /**
     * Show the form for creating a new resource.
     */

     public function jemaat()
     {
        $keluarga['keluargas'] = DB::table('registrasi_jemaat')->get();
        $jk['jenis_kelamins'] = DB::table('jenis_kelamin')->get();
        $gd['gol_darahs'] = DB::table('gol_darah')->get();
        $marga['margas'] = DB::table('registrasi_jemaat')->get();
        $keluarga['keluargas'] = DB::table('hubungan_keluarga')->get();
        $pendidikan['pendidikans'] = DB::table('pendidikan')->get();
        $bidangPendidikan['bidangPendidikans'] = DB::table('bidang_pendidikan')->get();
        $pekerjaan['pekerjaans'] = DB::table('pekerjaan')->get();
        $sektor['sektors'] = DB::table('wijk')->get();

        $data = array_merge($jk, $gd, $marga, $keluarga, $pendidikan, $bidangPendidikan, $pekerjaan, $sektor);

        return view('layouts.user_2.user_pendaftaran_jemaat', $data);
     }

     public function index8()
     {
        $keluarga['keluargas'] = DB::table('registrasi_jemaat')->get();
        $sektor['sektors'] = DB::table('wijk')->get();
        $register['jenisregisters'] = DB::table('jenis_registrasi')->get();
        $gereja['gerejas'] = DB::table('gereja')->get();
        $status['status'] = DB::table('status')->get();

        $data = array_merge($sektor,$register,$gereja, $keluarga, $status);

        return view('layouts.user_2.user_pendaftaran_keluarga', $data);
     }

     public function daftarKeluarga(Request $request)
     {
        // $id_registrasi = $request->id_registrasi;
        $tgl_registrasi = $request->tgl_registrasi;
        $nama_keluarga = $request->nama_keluarga;
        $id_jenis_register = $request->id_jenis_register;
        $id_gereja = $request->id_gereja;
        $nama_gereja_nonHKBP = $request->nama_gereja_nonHKBP;
        $no_hp = $request->no_hp;
        // $id_status_registrasi = $request->id_status_registrasi;
        $alamat = $request->alamat;
        $skp = $request->skp;
        $id_user = $request->id_user;
        $id_wijk = $request -> id_wijk;

        $kode_skp = rand();
        if ($request->hasFile('skp')) {
            $skp = $kode_skp . "." . $request->file('skp')->getClientOriginalExtension();
        } else {
            $skp = null;
        }

        $lastregister = DB::table('registrasi_jemaat')
                    ->whereRaw('id_wijk')
                    ->orderBy('no_registrasi','desc')
                    ->first();
        $lastkoderegister = $lastregister != null ? $lastregister->no_registrasi : "";
        $format = "05150".$id_wijk;
        $no_registrasi = buatkode($lastkoderegister,$format,4);

        // else {
        //     $sbp = null;
        // }
        // $simpan = $request->validate([
        //     'sbp' => 'image|file|max:1024',
        // ]);
        $data = [
            // 'id_registrasi' => $id_registrasi,
            'tgl_registrasi' => $tgl_registrasi,
            'nama_keluarga' => $nama_keluarga,
            'id_jenis_register' => $id_jenis_register,
            'id_gereja' => $id_gereja,
            'nama_gereja_nonHKBP' => $nama_gereja_nonHKBP,
            'no_hp' => $no_hp,
            // 'id_status_registrasi' => $id_status_registrasi,
            'alamat' => $alamat,
            'id_user' => $id_user,
            'no_registrasi' => $no_registrasi,
            'skp' => $skp,
            'id_wijk' => $id_wijk,
        ];
        $simpan = DB::table('registrasi_jemaat')->insert($data);
        if ($simpan) {
        if ($request->hasFile('skp')) {
            $skp = $kode_skp . "." . $request->file('skp')->getClientOriginalExtension();
            $folderPath = "skps/";
            $request->file('skp')->storeAs($folderPath, $skp);
        }
            Alert::success('Tambah Keluarga', 'Tambah Keluarga Berhasil');
            return redirect()->route('keluargaUser');
        }
            Alert::error('Tambah Keluarga', 'Tambah Keluarga Gagal');
            return back();
     }
}
