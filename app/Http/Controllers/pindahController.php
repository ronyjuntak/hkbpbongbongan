<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use app\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class pindahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pindah'] = DB::table('head_pindah')
                    ->leftJoin('jemaat','head_pindah.id_jemaat','=','jemaat.id_jemaat')
                    ->get();

        return view('layouts.formSearch.pindah',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function details($id_head_reg_pindah)
    {
        $data['pindah'] = DB::table('head_pindah')
                ->leftJoin('jemaat','head_pindah.id_jemaat','=','jemaat.id_jemaat')
                ->where('id_head_reg_pindah',$id_head_reg_pindah)
                ->first();

        return view('layouts.forms.detailPindah', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_head_reg_pindah = $request->id_head_reg_pindah;
        $registrasi = DB::table('registrasi_jemaat')->get();
        $jemaat = DB::table('jemaat')->get();
        $gereja = DB::select('CALL getGereja()');
        $pindah = DB::table('head_pindah')
                ->leftJoin('registrasi_jemaat','head_pindah.is_registrasi','=','registrasi_jemaat.id_registrasi')
                ->leftJoin('jemaat','head_pindah.id_jemaat','=','jemaat.id_jemaat')
                ->where('id_head_reg_pindah',$id_head_reg_pindah)
                ->get();

        return view('layouts.forms.daftarPindah', compact('registrasi', 'jemaat', 'gereja','pindah'));
    }

    /**
     * Display the specified resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            // 'is_registrasi' => 'required',
            'id_jemaat' => 'required',
            'no_surat_pindah' => 'required',
            'tgl_pindah' => 'required',
            'tgl_warta' => 'required',
            // 'id_gereja_tujuan' => 'required',
            // 'nama_gereja' => 'required',
            // 'keterangan' => 'required',
        ]);

        $is_registrasi = $request->input('is_registrasi');
        $id_jemaat = $request->input('id_jemaat');
        $no_surat_pindah = $request->input('no_surat_pindah');
        $tgl_pindah = $request->input('tgl_pindah');
        $tgl_warta = $request->input('tgl_warta');
        $id_gereja_tujuan = $request->input('id_gereja_tujuan');
        $nama_gereja = $request->input('nama_gereja');
        $keterangan = $request->input('keterangan');

        $response = DB::table('head_pindah')->insert( [
            'is_registrasi'=> $is_registrasi,
            'id_jemaat'=> $id_jemaat,
            'no_surat_pindah'=> $no_surat_pindah,
            'tgl_pindah'=> $tgl_pindah,
            'tgl_warta'=> $tgl_warta,
            'id_gereja_tujuan'=> $id_gereja_tujuan,
            // 'nama_gereja'=> $nama_gereja,
            // 'keterangan'=> $keterangan,
        ]);


        if (!$response) {
            Alert::error('Tambah Jemaat', 'Tambah Jemaat Gagal');
            return back()->withErrors(['message' => 'error when create RPP']);
        // return redirect()->route('rpp');
        }

            Alert::success('Tambah Jemaat', 'Tambah Jemaat Berhasil');
            return redirect()->route('pindah');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id_head_reg_pindah = $request->id_head_reg_pindah;
        $registrasi = DB::select('CALL getRegistrasiJemaat()');
        $jemaat = DB::select('CALL getJemaats()');
        $gereja = DB::select('CALL getGereja()');
        $pindah = DB::table('head_pindah')->orderBy('id_head_reg_pindah')->get();
        $bpindah  = DB::table('head_pindah')
                ->leftJoin('registrasi_jemaat','head_pindah.is_registrasi','=','registrasi_jemaat.id_registrasi')
                ->leftJoin('jemaat','head_pindah.id_jemaat','=','jemaat.id_jemaat')
                ->where('id_head_reg_pindah',$id_head_reg_pindah)
                ->first();

        return view('layouts.forms.updatePindah',compact('registrasi','jemaat','gereja','pindah','bpindah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $response = DB::table('head_pindah')->update( [
            'id_head_reg_pindah' => $request->id_head_reg_pindah,
            // 'is_registrasi'=> $request->is_registrasi,
            //     'id_jemaat'=> $request->id_jemaat,
                'no_surat_pindah'=> $request->no_surat_pindah,
                'tgl_pindah'=> $request->tgl_pindah,
                'tgl_warta'=> $request->tgl_warta,
                'id_gereja_tujuan'=> $request->id_gereja_tujuan,
                'nama_gereja'=> $request->nama_gereja,
                'keterangan'=> $request->keterangan,
        ]);
        if (!$response) {
            Alert::error('Update Jemaat Pindah', 'Update Jemaat Pindah Gagal');
            return back();
        // return redirect()->route('rpp');
        }

            Alert::success('Update Jemaat Pindah', 'Update Jemaat Pindah Berhasil');
            return redirect()->route('pindah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_head_reg_pindah)
    {
        $data = DB::table('head_pindah')->where('id_head_reg_pindah',$id_head_reg_pindah)->delete();

        if($data == null){
            Alert::error('Hapus Pindah', 'Hapus Pindah Gagal');
            // $failedMessage = Session::get('failed');
            return redirect()->route('pindah');
        }else{
            Alert::success('Hapus Pindah', 'Hapus Pindah Berhasil');
            // $successMessage = Session::get('success');
            return redirect()->route('pindah');
        }
    }
}
