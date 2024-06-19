<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\File;

class keluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['keluarga'] = DB::table('registrasi_jemaat')
                            ->leftJoin('wijk','registrasi_jemaat.id_wijk','=','wijk.id_wijk')
                            ->get();
        return view('layouts.formSearch.keluarga',$data);
    }

    public function cetakKeluarga()
    {
        $data['cetakkeluarga'] = DB::table('registrasi_jemaat')
                                ->leftJoin('wijk','registrasi_jemaat.id_wijk','=','wijk.id_wijk')
                                ->orderBy('registrasi_jemaat.id_wijk')
                                ->get();
        return view('layouts.formSearch.cetak-keluarga',$data);
    }

    public function lapkel(Request $request)
    {
        $id_wijk = $request->id_wijk;
        $cetaklapkel = DB::table('registrasi_jemaat')->where('id_wijk',$id_wijk)->first();
        $cetaklapkels = DB::table('registrasi_jemaat')->where('registrasi_jemaat.id_wijk',$id_wijk)->get();

        if (isset($_POST['exportexcel'])){
            $time = date("d-m-Y H:i:s");
            // Fungsi header dengan mengirimkan raw data excel
            header("Content-type: application/vnd-ms-excel");
            // Mendefinisikan nama file ekspor "hasil-export.xls"
            header("Content-Disposition: attachment; filename=Laporan Keluarga $time.xls");
            return view('layouts.formSearch.cetaklapkelexcel',compact('id_wijk','cetaklapkel','cetaklapkels'));
        }
        return view('layouts.formSearch.cetaklapkel',compact('cetaklapkel','cetaklapkels','id_wijk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
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

        $data = [
            'no_registrasi' => $no_registrasi,
            'tgl_registrasi' => $tgl_registrasi,
            'nama_keluarga' => $nama_keluarga,
            'id_wijk' => $id_wijk,
            'id_jenis_register' => $id_jenis_register,
            'id_gereja' => $id_gereja,
            'nama_gereja_nonHKBP' => $nama_gereja_nonHKBP,
            'no_hp' => $no_hp,
            'alamat' => $alamat,
            'id_user' => $id_user,
            'skp' => $skp,
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

    /**
     * Show the form for creating a new resource.
     */
    public function detail(Request $request)
    {
        $id_registrasi = $request->id_registrasi;
        $pendeta = DB::select('CALL getPendeta()');
        $keluarga = DB::table('registrasi_jemaat')
                ->leftJoin('wijk','registrasi_jemaat.id_wijk','=','wijk.id_wijk')
                ->leftJoin('jenis_registrasi','registrasi_jemaat.id_jenis_register','=','jenis_registrasi.id_jenis_registrasi')
                ->leftJoin('status','registrasi_jemaat.status','=','status.status')
                ->where('id_registrasi',$id_registrasi)
                ->first();

        return view('layouts.forms.detailKeluarga',compact('keluarga','pendeta'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jenis_registrasi = DB::table('jenis_registrasi')->get();
        $gereja = DB::table('gereja')->get();
        $status = DB::table('status')->orderBy('id_jenis_status')->get();
        $id_wijk = DB::table('wijk')->get();
        return view('layouts.forms.daftarKeluarga',compact('jenis_registrasi','gereja','status','id_wijk'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id_registrasi = $request->id_registrasi;
        $pendeta = DB::select('CALL getPendeta()');
        $keluarga  = DB::table('registrasi_jemaat')->orderBy('id_registrasi')->get();
        $bkeluarga = DB::table('registrasi_jemaat')
                    ->where('id_registrasi',$id_registrasi)
                    ->first();
        return view('layouts.forms.updateKeluarga',compact('pendeta','keluarga','bkeluarga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // $request->validate([

        //     'nama_keluarga' => 'required',
        //     'id_wijk' => 'required',
        // ]);

            $id_registrasi = $request->input('id_registrasi');
            $no_registrasi = $request->input('no_registrasi');
            $tgl_registrasi = $request->input('tgl_registrasi');
            $nama_keluarga = $request->input('nama_keluarga');
            $id_wijk = $request->input('id_wijk');
            $id_jenis_register = $request->input('id_jenis_register');
            $id_gereja = $request->input('id_gereja');
            $nama_gereja_nonHKBP = $request->input('nama_gereja_nonHKBP');
            $no_register_sebelumnya = $request->input('no_register_sebelumnya');
            $tgl_warta = $request->input('tgl_warta');
            $id_status_registrasi = $request->input('id_status_registrasi');

        $response = DB::table('registrasi_jemaat')->where('id_registrasi',$id_registrasi)->update([
            // 'id_registrasi' => $id_registrasi,
            // 'no_registrasi' => $no_registrasi,
            // 'tgl_registrasi' => $tgl_registrasi,
            'nama_keluarga' => $nama_keluarga,
            // 'id_wijk' => $id_wijk,
            // 'id_jenis_register' => $id_jenis_register,
            // 'id_gereja' => $id_gereja,
            // 'nama_gereja_nonHKBP' => $nama_gereja_nonHKBP,
            // 'no_register_sebelumnya' => $no_register_sebelumnya,
            // 'tgl_warta' => $tgl_warta,
            // 'id_status_registrasi' => $id_status_registrasi,
        ]);

        if (!$response) {
            Alert::error('Update Keluarga','Update Keluarga Gagal');
            return back();
        }
            Alert::success('Update Keluarga','Update Keluarga Berhasil');
            return redirect()->route('keluarga');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_registrasi)
    {
        $gambar = DB::table('registrasi_jemaat')->where('id_registrasi',$id_registrasi)->first();
        Storage::delete(['/skps/'.$gambar->skp]);
        $keluarga = DB::table('registrasi_jemaat')->where('id_registrasi',$id_registrasi)->delete();
        if($keluarga == null){
            // $failedMessage = Session::get('failed');
        Alert::error('Hapus Keluarga', 'Hapus Keluarga Gagal');
            return redirect()->route('keluarga');
        }else{
            // $successMessage = Session::get('success');
        Alert::success('Hapus Keluarga', 'Hapus Keluarga Berhasil');
            return redirect()->route('keluarga');
        }
    }
}
