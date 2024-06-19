<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Exception;
use Illuminate\Http\Request;
use app\Helpers\ApiFormatter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

class kegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['kegiatan'] = DB::table('jenis_kegiatan')->get();
        return view('layouts.formSearch.kegiatan', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function details(Request $request)
    {
        $id_jenis_kegiatan = $request->id_jenis_kegiatan;
        $kegiatan = DB::table('jenis_kegiatan')
                ->where('id_jenis_kegiatan',$id_jenis_kegiatan)
                ->first();

        return view('layouts.forms.detailKegiatan',compact('kegiatan','id_jenis_kegiatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kegiatan = DB::table('kegiatan')->get();
        return view('layouts.forms.daftarKegiatan',compact('kegiatan'));
    }

    /**
     * Display the specified resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'nama_jenis_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required',
            'waktu_kegiatan' => 'required',
            'lokasi_kegiatan' => 'required',
            'keterangan' => 'required',
        ]);
        $nama_jenis_kegiatan = $request->get('nama_jenis_kegiatan');
        $tanggal_kegiatan = $request->get('tanggal_kegiatan');
        $waktu_kegiatan = $request->get('waktu_kegiatan');
        $lokasi_kegiatan = $request->get('lokasi_kegiatan');
        $keterangan = $request->get('keterangan');

        $response = DB::table('jenis_kegiatan')->insert( [
            'nama_jenis_kegiatan' => $nama_jenis_kegiatan,
            'tanggal_kegiatan' => $tanggal_kegiatan,
            'waktu_kegiatan' => $waktu_kegiatan,
            'lokasi_kegiatan' => $lokasi_kegiatan,
            'keterangan' => $keterangan
        ]);
        if (!$response) {
            Alert::error('Tambah Kegiatan', 'Tambah Kegiatan Gagal');
            return back()->withErrors(['message' => 'error when create RPP']);
        }
            Alert::success('Tambah Kegiatan', 'Tambah Kegiatan Berhasil');
            return redirect()->route('kegiatan');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id_jenis_kegiatan)
    {
        // $id_jenis_kegiatan = $request->id_jenis_kegiatan;
        $kegiatan = DB::table('jenis_kegiatan')->orderBy('id_jenis_kegiatan')->get();
        $bkegiatan = DB::table('jenis_kegiatan')->where('id_jenis_kegiatan',$id_jenis_kegiatan)->first();
        return view('layouts.forms.updateKegiatan',compact('bkegiatan','kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_jenis_kegiatan' => 'required',
            'nama_jenis_kegiatan' => 'required',
            'tanggal_kegiatan' => 'required',
            'waktu_kegiatan' => 'required',
            'lokasi_kegiatan' => 'required',
            'keterangan' => 'required',
        ]);

        $id_jenis_kegiatan = $request->input('id_jenis_kegiatan');
        $nama_jenis_kegiatan = $request->input('nama_jenis_kegiatan');
        $tanggal_kegiatan = $request->input('tanggal_kegiatan');
        $waktu_kegiatan = $request->input('waktu_kegiatan');
        $lokasi_kegiatan = $request->input('lokasi_kegiatan');
        $keterangan = $request->input('keterangan');

        $response = DB::table('jenis_kegiatan')->where('id_jenis_kegiatan',$id_jenis_kegiatan)->update( [
            'id_jenis_kegiatan' => $id_jenis_kegiatan,
            'nama_jenis_kegiatan' => $nama_jenis_kegiatan,
            'tanggal_kegiatan' => $tanggal_kegiatan,
            'waktu_kegiatan' => $waktu_kegiatan,
            'lokasi_kegiatan' => $lokasi_kegiatan,
            'keterangan' => $keterangan
        ]);
        if (!$response) {
            Alert::error('Update Kegiatan', 'Update Kegiatan Gagal');
            return back();
        // return redirect()->route('rpp');
        }
        Alert::success('Update Kegiatan', 'Update Kegiatan Berhasil');
        return redirect()->route('kegiatan');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_jenis_kegiatan)
    {
        $data['kegiatan'] = DB::table('jenis_kegiatan')->where('id_jenis_kegiatan',$id_jenis_kegiatan)->delete();
        if($data == null){

            Alert::error('Hapus Kegiatan', 'Hapus Kegiatan Gagal');
            // $failedMessage = Session::get('failed');
            return redirect()->route('kegiatan');
        }else{
            Alert::success('Hapus Kegiatan', 'Hapus Kegiatan Berhasil');
            // $successMessage = Session::get('success');
            return redirect()->route('kegiatan');
        }
    }
}
