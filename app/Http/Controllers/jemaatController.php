<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use app\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class jemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jemaat'] = DB::table('jemaat')
                    ->leftJoin('registrasi_jemaat','jemaat.nama_keluarga','=','registrasi_jemaat.no_registrasi')
                    ->get();

        return view('layouts.formSearch.jemaat', $data);
    }

    public function cetakAngkel()
    {
        $data['cetakangkel'] = DB::table('jemaat')
                            ->leftJoin('registrasi_jemaat','jemaat.nama_keluarga','=','registrasi_jemaat.no_registrasi')
                            ->orderBy('jemaat.nama_keluarga')
                            ->get();
        return view('layouts.formSearch.cetak-anggota-keluarga',$data);
    }

    public function cetakJemaat()
    {
        $data['cetakjemaat'] = DB::table('jemaat')
                                ->leftJoin('wijk','jemaat.id_wijk','=','wijk.id_wijk')
                                ->leftJoin('jenis_kelamin','jemaat.id_jenis_kelamin','=','jenis_kelamin.id_jenis_kelamin')
                                ->orderBy('jemaat.id_wijk')
                                ->get();
        return view('layouts.formSearch.cetak-jemaat',$data);
    }

    public function lapjem(Request $request)
    {
        $id_wijk = $request->id_wijk;
        $cetaklapjem = DB::table('jemaat')->where('id_wijk',$id_wijk)->first();
        $cetaklapjems = DB::table('jemaat')
                    ->leftJoin('jenis_kelamin','jemaat.id_jenis_kelamin','=','jenis_kelamin.id_jenis_kelamin')
                    ->leftJoin('registrasi_jemaat','jemaat.nama_keluarga','=','registrasi_jemaat.no_registrasi')
                    ->leftJoin('hubungan_keluarga','jemaat.id_hub_keluarga','=','hubungan_keluarga.id_hub_keluarga')
                    ->leftJoin('pendidikan','jemaat.id_pendidikan','=','pendidikan.id_pendidikan')
                    ->leftJoin('pekerjaan','jemaat.id_pekerjaan','=','pekerjaan.id_pekerjaan')
                    ->where('jemaat.id_wijk',$id_wijk)
                    ->get();

        if (isset($_POST['exportexcel'])){
            $time = date("d-m-Y H:i:s");
            // Fungsi header dengan mengirimkan raw data excel
            header("Content-type: application/vnd-ms-excel");
            // Mendefinisikan nama file ekspor "hasil-export.xls"
            header("Content-Disposition: attachment; filename=Laporan Keluarga $time.xls");
            return view('layouts.formSearch.cetaklapjemexcel',compact('id_wijk','cetaklapkel','cetaklapkels'));
        }
        return view('layouts.formSearch.cetaklapjem',compact('cetaklapjem','cetaklapjems','id_wijk'));
    }

    public function angkel(Request $request)
    {
        $nama_keluarga = $request->nama_keluarga;
        $cetakangkel = DB::table('jemaat')
                    ->leftJoin('registrasi_jemaat','jemaat.nama_keluarga','=','registrasi_jemaat.no_registrasi')
                    ->where('jemaat.nama_keluarga',$nama_keluarga)
                    ->first();
        $cetakangkels = DB::table('jemaat')
                    ->leftJoin('jenis_kelamin','jemaat.id_jenis_kelamin','=','jenis_kelamin.id_jenis_kelamin')
                    ->leftJoin('hubungan_keluarga','jemaat.id_hub_keluarga','=','hubungan_keluarga.id_hub_keluarga')
                    ->leftJoin('pendidikan','jemaat.id_pendidikan','=','pendidikan.id_pendidikan')
                    ->leftJoin('pekerjaan','jemaat.id_pekerjaan','=','pekerjaan.id_pekerjaan')
                    ->leftJoin('registrasi_jemaat','jemaat.nama_keluarga','=','registrasi_jemaat.no_registrasi')
                    ->where('jemaat.nama_keluarga',$nama_keluarga)
                    ->get();

                    if (isset($_POST['exportexcel'])){
                        $time = date("d-m-Y H:i:s");
                        // Fungsi header dengan mengirimkan raw data excel
                        header("Content-type: application/vnd-ms-excel");
                        // Mendefinisikan nama file ekspor "hasil-export.xls"
                        header("Content-Disposition: attachment; filename=Laporan Anggota Keluarga $time.xls");
                        return view('layouts.formSearch.cetakangkelexcel',compact('nama_keluarga','cetakangkel','cetakangkels'));
                    }
                    return view('layouts.formSearch.cetakangkel',compact('cetakangkel','cetakangkels','nama_keluarga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function details(Request $request, $id_jemaat)
    {
        $id_jemaat = $request->id_jemaat;
        $registrasi = DB::select('CALL getRegistrasiJemaat()');
        $pendidikan = DB::select('CALL getPendidikan()');
        $pekerjaan = DB::select('CALL getPekerjaan()');
        $bpendidikan = DB::select('CALL getBidangPendidikan()');
        $keluarga = DB::select('CALL getHubunganKeluarga()');

        $jemaat  = DB::table('jemaat')->where('id_jemaat')->get();
        $bjemaat = DB::table('jemaat')
                    ->leftJoin('gol_darah', 'jemaat.id_gol_darah', '=', 'gol_darah.id_gol_darah')
                    ->leftJoin('jenis_kelamin', 'jemaat.id_jenis_kelamin', '=', 'jenis_kelamin.id_jenis_kelamin')
                    ->leftJoin('registrasi_jemaat','jemaat.nama_keluarga','=','registrasi_jemaat.no_registrasi')
                    ->leftJoin('pekerjaan','jemaat.id_pekerjaan','=','pekerjaan.id_pekerjaan')
                    ->leftJoin('pendidikan','jemaat.id_pendidikan','=','pendidikan.id_pendidikan')
                    ->leftJoin('hubungan_keluarga','jemaat.id_hub_keluarga','=','hubungan_keluarga.id_hub_keluarga')
                    ->where('id_jemaat',$id_jemaat)->first();
        // $jemaat = DB::table('jemaat')->get();

        return view('layouts.forms.detailJemaat',compact('jemaat','registrasi','bjemaat','keluarga','pendidikan','pekerjaan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_jemaat = $request->id_jemaat;
        $tanggal_lahir = $request->tanggal_lahir;
        $registrasi = DB::select('CALL getRegistrasiJemaat()');
        $pendidikan = DB::select('CALL getPendidikan()');
        $pekerjaan = DB::select('CALL getPekerjaan()');
        $bpendidikan = DB::select('CALL getBidangPendidikan()');
        $keluarga = DB::select('CALL getHubunganKeluarga()');
        $jemaat  = DB::table('jemaat')
                ->leftJoin('registrasi_jemaat','jemaat.no_registrasi','=','registrasi_jemaat.nama_keluarga')
                ->where('id_jemaat',$id_jemaat)->first();

        $bulan = date("m", strtotime($tanggal_lahir));
        $tahun = date("Y", strtotime($tanggal_lahir));
        $thn = substr($tahun,2,2);
        $format = "SBK".$bulan.$thn;
        $kode_sbk = buatkode($thn,$format);
        if ($request->hasFile('sbk')){
            $sbk = $kode_sbk ."." . $request->file('sbk')->getClientOriginalExtension();
        }else {
            $sbk = null;
        }

        return view('layouts.forms.daftarJemaat', compact('registrasi', 'pendidikan', 'pekerjaan', 'bpendidikan', 'keluarga','jemaat'));
    }

    /**
     * Display the specified resource.
     */
    public function create(Request $request)
    {
        $response = DB::table('jemaat')->insert( [
            'id_registrasi' => $request->id_registrasi,
                'nama_depan' => $request->nama_depan,
                'nama_belakang' => $request->nama_belakang,
                'gelar_depan' => $request->gelar_depan,
                'gelar_belakang' => $request->gelar_belakang,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'sbk' => $request->sbk,
                'sns' => $request->sns,
                'sbp' => $request->sbp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_hub_keluarga' => $request->id_hub_keluarga,
                'id_pendidikan' => $request->id_pendidikan,
                'id_bidang_pendidikan' => $request->id_bidang_pendidikan,
                // 'id_bidang_pendidikan_lain' => $request->id_bidang_pendidikan_lain,
                'id_pekerjaan' => $request->id_pekerjaan,
                'nama_pekerjaan_lain' => $request->nama_pekerjaan_lain,
                'gol_darah' => $request->gol_darah,
                'alamat' => $request->alamat,
                'nama_keluarga' => $request->nama_keluarga,
                'no_telepon' => $request->no_telepon,
                'keterangan'=> $request->keterangan,
        ]);

        if (!$response) {
        Alert::error('Tambah Jemaat', 'Tambah Jemaat Gagal');
        return back();
        }
        Alert::success('Tambah Jemaat', 'Tambah Jemaat Berhasil');
        return redirect()->route('jemaat');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id_jemaat = $request->id_jemaat;
        $registrasi = DB::select('CALL getRegistrasiJemaat()');
        $pendidikan = DB::select('CALL getPendidikan()');
        $pekerjaan = DB::select('CALL getPekerjaan()');
        $bpendidikan = DB::select('CALL getBidangPendidikan()');
        $keluarga = DB::select('CALL getHubunganKeluarga()');

        $jemaat  = DB::table('jemaat')->orderBy('id_jemaat')->get();
        $bjemaat = DB::table('jemaat')->where('id_jemaat',$id_jemaat)->first();


        return view('layouts.forms.updateJemaat',compact('registrasi','pendidikan','pekerjaan','bpendidikan','keluarga','jemaat','bjemaat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_jemaat' => 'required',
            'id_registrasi' => 'required',
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'id_hub_keluarga' => 'required',
            'id_pendidikan' => 'required',
            'id_pekerjaan' => 'required',
            'alamat' => 'required',
        ]);

                $id_jemaat = $request->input('id_jemaat');
                $id_registrasi = $request->input('id_registrasi');
                $nama_depan = $request->input('nama_depan');
                $nama_belakang = $request->input('nama_belakang');
                $gelar_depan = $request->input('gelar_depan');
                $gelar_belakang = $request->input('gelar_belakang');
                $tempat_lahir = $request->input('tempat_lahir');
                $tanggal_lahir = $request->input('tanggal_lahir');
                $jenis_kelamin = $request->input('jenis_kelamin');
                $id_hub_keluarga = $request->input('id_hub_keluarga');
                $id_pendidikan = $request->input('id_pendidikan');
                $id_bidang_pendidikan = $request->input('id_bidang_pendidikan');
                // 'id_bidang_pendidikan_lain' => $request->id_bidang_pendidikan_lain,
                $id_pekerjaan = $request->input('id_pekerjaan');
                $nama_pekerjaan_lain = $request->input('nama_pekerjaan_lain');
                $gol_darah = $request->input('gol_darah');
                $alamat = $request->input('alamat');
                $no_telepon = $request->input('no_telepon');
                $keterangan= $request->input('keterangan');

        $response = DB::table('jemaat')->where('id_jemaat',$id_jemaat)->update([
            'id_jemaat' => $id_jemaat,
            'id_registrasi' => $id_registrasi,
            'nama_depan' => $nama_depan,
            'nama_belakang' => $nama_belakang,
            'gelar_depan' => $gelar_depan,
            'gelar_belakang' => $gelar_belakang,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'id_hub_keluarga' => $id_hub_keluarga,
            'id_pendidikan' => $id_pendidikan,
            'id_bidang_pendidikan' => $id_bidang_pendidikan,
            'id_pekerjaan' => $id_pekerjaan,
            'nama_pekerjaan_lain' => $nama_pekerjaan_lain,
            'gol_darah' => $gol_darah,
            'alamat' => $alamat,
            'no_telepon' => $no_telepon,
            'keterangan' => $keterangan
        ]);

        if (!$response) {
            Alert::error('Update Jemaat', 'Update Jemaat Gagal');

            return back();
        }
        Alert::success('Update Jemaat', 'Update Jemaat Berhasil');

    return redirect()->route('jemaat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_jemaat)
    {
        $gambar = DB::table('jemaat')->where('id_jemaat',$id_jemaat)->first();
        Storage::delete(['/sbks/'.$gambar->sbk]);
        Storage::delete(['/snss/'.$gambar->sns]);
        $data = DB::table('jemaat')->where('id_jemaat',$id_jemaat)->delete();

        if($data == null){

            Alert::error('Hapus Jemaat', 'Hapus Jemaat Gagal');
            // $failedMessage = Session::get('failed');
            return redirect()->route('jemaat');
        }else{
            Alert::success('Hapus Jemaat', 'Hapus Jemaat Berhasil');
            // $successMessage = Session::get('success');
            return redirect()->route('jemaat');
        }
    }
}
