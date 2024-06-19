<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use app\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;


class sidiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['sidi'] = DB::table('registrasi_sidi')->get();

        return view('layouts.formSearch.sidi',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function details($id)
    {
        $data['sidi'] = DB::table('registrasi_sidi')->get();

        return view('layouts.forms.detailSidih',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sektor = DB::table('wijk')->orderBy('id_wijk')->get();
        $jemaat = DB::select('CALL getJemaats');
        return view('layouts.forms.daftarSidih',compact('jemaat','sektor'));
    }

    /**
     * Display the specified resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'tgl_baptis' => 'required',
            'nama_ayah' => 'required',
            'sektor' => 'required',
            'nama_ibu' => 'required',
            'nama_pendeta_sidi' => 'required',
            'tanggal_lahir' => 'required',
            // 'tanggal_sidi' => 'required',
            'tempat_lahir' => 'required',
            // 'keterangan' => 'required',
        ]);

        $response = DB::table('registrasi_sidi')->insert( [
            'nama_lengkap' => $request->nama_lengkap,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'tgl_baptis' => $request->tgl_baptis,
                'sektor' => $request->sektor,
                'nama_pendeta_sidi' => $request->nama_pendeta_sidi,
                'keterangan' => $request->keterangan,
                'tanggal_sidi' => $request->tanggal_sidi
        ]);
        if (!$response) {
        Alert::error('Tambah Sidi', 'Tambah Sidi Gagal');
            return redirect()->back();
        // return redirect()->route('rpp');
        }
        Alert::success('Tambah Sidi', 'Tambah Sidi Berhasil');

        return redirect()->route('sidi');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_registrasi_sidi)
    {
        $data['sidi']  = DB::table('registrasi_sidi')->where('id_registrasi_sidi',$id_registrasi_sidi)->get();

        return view('layouts.forms.updateSidi',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id_registrasi_sidi = $request->id_registrasi_sidi;
        $response = DB::table('registrasi_sidi')->where('id_registrasi_sidi',$id_registrasi_sidi)->update( [
                'id_registrasi_sidi' => $request->id_registrasi_sidi,
                'nama_lengkap' => $request->nama_lengkap,
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'tgl_baptis' => $request->tgl_baptis,
                'sektor' => $request->sektor,
                'nama_pendeta_sidi' => $request->nama_pendeta_sidi,
                'keterangan' => $request->keterangan,
                'tanggal_sidi' => $request->tanggal_sidi
        ]);
        if (!$response) {
        Alert::success('Update Sidi', 'Update Sidi Berhasil');

            return redirect()->back();
        // return redirect()->route('rpp');
        }
        Alert::success('Update Sidi', 'Update Sidi Berhasil');
        return redirect()->route('sidi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_registrasi_sidi)
    {
        $data = DB::table('registrasi_sidi')->where('id_registrasi_sidi',$id_registrasi_sidi)->delete();

        if($data == null){
            Alert::error('Hapus Sidi', 'Hapus Sidi Gagal');
            return redirect()->route('sidi');
            // $failedMessage = Session::get('failed');
            // return redirect()->route('daftarSidi', compact('failedMessage'));
        }else{
            Alert::success('Hapus Sidi', 'Hapus Sidi Berhasil');
            return redirect()->route('sidi');

            // $successMessage = Session::get('success');
            // return redirect()->route('sidi',compact('successMessage'));
        }
    }
}
