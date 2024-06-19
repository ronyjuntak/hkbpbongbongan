<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use app\Helpers\ApiFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Laravel\Ui\Presets\React;
use RealRashid\SweetAlert\Facades\Alert;

class martumpolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['martumpol'] = DB::table('registrasi_pernikahan')->get();

        return view('layouts.formSearch.martumpol',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function detail(Request $request)
    {
        $id_registrasi_nikah = $request->id_registrasi_nikah;
        $martumpol = DB::table('registrasi_pernikahan')
                    ->where('id_registrasi_nikah',$id_registrasi_nikah)
                    ->first();

        return view('layouts.forms.detailMartumpol',compact('martumpol'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_jemaat = $request->id_jemaat;
        $bjemaat = DB::table('registrasi_pernikahan')
                ->leftJoin('jemaat','registrasi_pernikahan.id_jemaat_perempuan','=','jemaat.id_jemaat')
                ->where('id_jemaat',$id_jemaat)
                ->first();
        $jemaat = DB::select('CALL getJemaats()');
        $gereja = DB::select('CALL getGereja()');

        return view('layouts.forms.daftarMartumpol', compact('jemaat', 'gereja','bjemaat'));
    }

    /**
     * Display the specified resource.
     */
    public function create(Request $request)
    {
        $response = DB::table('registrasi_pernikahan')->insert( [
            'id_gereja_martumpol'=> $request->id_gereja_martumpol,
                'tgl_martumpol'=> $request->tgl_martumpol,
                'tgl_warta_martumpol'=> $request->tgl_warta_martumpol,
                'nama_gereja_martumpol'=> $request->nama_gereja_martumpol,
                'nomor_surat_martumpol'=> $request->nomor_surat_martumpol,
                'nama_pendeta_martumpol'=> $request->nama_pendeta_martumpol,
                'id_gereja_pemberkatan'=> $request->id_gereja_pemberkatan,
                'tgl_pemberkatan'=> $request->tgl_pemberkatan,
                'tgl_warta_pemberkatan'=> $request->tgl_warta_pemberkatan,
                'nama_gereja_pemberkatan'=> $request->nama_gereja_pemberkatan,
                'nomor_surat_pemberkatan'=> $request->nomor_surat_pemberkatan,
                'nama_pendeta_pemberkatan'=> $request->nama_pendeta_pemberkatan,
                'keterangan'=> $request->keterangan,
                'nama_lengkap_laki'=> $request->nama_lengkap_laki,
                'id_jemaat_laki'=> $request->id_jemaat_laki,
                'id_gereja_laki'=> $request->id_gereja_laki,
                'nama_gereja_laki'=> $request->nama_gereja_laki,
                'nama_ayah_laki'=> $request->nama_ayah_laki,
                'nama_ibu_laki'=> $request->nama_ibu_laki,
                'nama_lengkap_perempuan'=> $request->nama_lengkap_perempuan,
                'id_jemaat_perempuan'=> $request->id_jemaat_perempuan,
                'id_gereja_perempuan'=> $request->id_gereja_perempuan,
                // 'nama_gereja_perempuan'=> $request->nama_gereja_perempuan,
                'nama_ayah_perempuan'=> $request->nama_ayah_perempuan,
                'nama_ibu_perempuan'=> $request->nama_ibu_perempuan,
        ]);
        if (!$response) {
            return back();
            Alert::error('Tambah Martumpol', 'Tambah Martumpol Gagal');
            // return redirect()->route('rpp');
        }

            Alert::success('Tambah Martumpol', 'Tambah Martumpol Berhasil');
            return redirect()->route('martumpol');
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Request $request)
    {
        $id_registrasi_nikah = $request->id_registrasi_nikah;
        $jemaat = DB::select('CALL getJemaat()');
        $gereja = DB::select('CALL getGereja()');
        $martumpol = DB::table('registrasi_pernikahan')->orderBy('id_registrasi_nikah')->get();
        $bmartumpol = DB::table('registrasi_pernikahan')
                ->where('id_registrasi_nikah',$id_registrasi_nikah)
                ->first();
        return view('layouts.forms.updateMartumpol',compact('jemaat','gereja','martumpol','bmartumpol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request ->validate([
            'id_registrasi_nikah'=> 'required',
            'tgl_martumpol'=> 'required',
            'tgl_warta_martumpol'=> 'required',
            'nomor_surat_martumpol'=> 'required',
            'nama_pendeta_martumpol'=> 'required',
            'tgl_pemberkatan'=> 'required',
            'tgl_warta_pemberkatan'=> 'required',
            'nomor_surat_pemberkatan'=> 'required',
            'keterangan'=> 'required',
            'nama_lengkap_laki'=> 'required',
            'nama_gereja_laki'=> 'required',
            'nama_ayah_laki'=> 'required',
            'nama_ibu_laki'=> 'required',
            'nama_lengkap_perempuan'=> 'required',
            'id_jemaat_perempuan'=> 'required',
            'nama_gereja_perempuan'=> 'required',
            'nama_ayah_perempuan'=> 'required',
            'nama_ibu_perempuan'=> 'required',
        ]);

            $id_registrasi_nikah = $request->input('id_registrasi_nikah');
            $id_gereja_martumpol = $request->input('id_gereja_martumpol');
            $tgl_martumpol = $request->input('tgl_martumpol');
            $tgl_warta_martumpol = $request->input('tgl_warta_martumpol');
            $nama_gereja_martumpol = $request->input('nama_gereja_martumpol');
            $nomor_surat_martumpol = $request->input('nomor_surat_martumpol');
            $nama_pendeta_martumpol = $request->input('nama_pendeta_martumpol');
            $id_gereja_pemberkatan = $request->input('id_gereja_pemberkatan');
            $tgl_pemberkatan = $request->input('tgl_pemberkatan');
            $tgl_warta_pemberkatan = $request->input('tgl_warta_pemberkatan');
            $nama_gereja_pemberkatan = $request->input('nama_gereja_pemberkatan');
            $nomor_surat_pemberkatan = $request->input('nomor_surat_pemberkatan');
            $nama_pendeta_pemberkatan = $request->input('nama_pendeta_pemberkatan');
            $keterangan = $request->input('keterangan');
            $nama_lengkap_laki = $request->input('nama_lengkap_laki');
            $id_jemaat_laki = $request->input('id_jemaat_laki');
            $id_gereja_laki = $request->input('id_gereja_laki');
            $nama_gereja_laki = $request->input('nama_gereja_laki');
            $nama_ayah_laki = $request->input('nama_ayah_laki');
            $nama_ibu_laki = $request->input('nama_ibu_laki');
            $nama_lengkap_perempuan = $request->input('nama_lengkap_perempuan');
            $id_jemaat_perempuan = $request->input('id_jemaat_perempuan');
            $id_gereja_perempuan = $request->input('id_gereja_perempuan');
            $nama_gereja_perempuan = $request->input('nama_gereja_perempuan');
            $nama_ayah_perempuan = $request->input('nama_ayah_perempuan');
            $nama_ibu_perempuan = $request->input('nama_ibu_perempuan');
        $response = DB::table('registrasi_pernikahan')->where('id_registrasi_nikah',$id_registrasi_nikah)->update( [
            'id_registrasi_nikah'=> $id_registrasi_nikah,
            'id_gereja_martumpol'=> $id_gereja_martumpol,
            'tgl_martumpol'=> $tgl_martumpol,
            'tgl_warta_martumpol'=> $tgl_warta_martumpol,
            'nama_gereja_martumpol'=> $nama_gereja_martumpol,
            'nomor_surat_martumpol'=> $nomor_surat_martumpol,
            'nama_pendeta_martumpol'=> $nama_pendeta_martumpol,
            'id_gereja_pemberkatan'=> $id_gereja_pemberkatan,
            'tgl_pemberkatan'=> $tgl_pemberkatan,
            'tgl_warta_pemberkatan'=> $tgl_warta_pemberkatan,
            'nama_gereja_pemberkatan'=> $nama_gereja_pemberkatan,
            'nomor_surat_pemberkatan'=> $nomor_surat_pemberkatan,
            'nama_pendeta_pemberkatan'=> $nama_pendeta_pemberkatan,
            'keterangan'=> $keterangan,
            'nama_lengkap_laki'=> $nama_lengkap_laki,
            'id_jemaat_laki'=> $id_jemaat_laki,
            'id_gereja_laki'=> $id_gereja_laki,
            'nama_gereja_laki'=> $nama_gereja_laki,
            'nama_ayah_laki'=> $nama_ayah_laki,
            'nama_ibu_laki'=> $nama_ibu_laki,
            'nama_lengkap_perempuan'=> $nama_lengkap_perempuan,
            'id_jemaat_perempuan'=> $id_jemaat_perempuan,
            'id_gereja_perempuan'=> $id_gereja_perempuan,
            'nama_gereja_perempuan'=> $nama_gereja_perempuan,
            'nama_ayah_perempuan'=> $nama_ayah_perempuan,
            'nama_ibu_perempuan'=> $nama_ibu_perempuan,
        ]);
        if (!$response) {
            return back();
            Alert::error('Update Martumpol', 'Update Martumpol Gagal');
            // return redirect()->route('rpp');
        }

            Alert::success('Update Martumpol', 'Update Martumpol Berhasil');
            return redirect()->route('martumpol');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_registrasi_nikah)
    {
        $data = DB::table('registrasi_pernikahan')->where('id_registrasi_nikah',$id_registrasi_nikah)->delete();

        if($data == null){
            // $failedMessage = Session::get('failed');
            Alert::error('Hapus Martumpol', 'Hapus Martumpol Gagal');
            return redirect()->route('martumpol');
        }else{
            // $successMessage = Session::get('success');
            Alert::success('Hapus Martumpol', 'Hapus Martumpol Berhasil');
            return redirect()->route('martumpol');
        }
    }
}
