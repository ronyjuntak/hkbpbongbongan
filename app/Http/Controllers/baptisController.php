<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use app\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class baptisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['baptis'] = DB::table('registrasi_baptis')->get();

        return view('layouts.formSearch.baptis',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function details(Request $request)
    {
        $id_registrasi_baptis = $request->id_registrasi_baptis;
        $pendeta = DB::select('CALL getPendeta()');
        $baptis = DB::table('registrasi_baptis')
                ->where('id_registrasi_baptis',$id_registrasi_baptis)
                ->first();

        return view('layouts.forms.detailBaptis',compact('baptis','pendeta'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_registrasi_baptis = $request->id_registrasi_baptis;
        $pendeta = DB::select('CALL getPendeta()');
        // $data['pendeta'] = ApiFormatter::createApi('200', 'Success', $pendeta);
        $baptism = DB::table('registrasi_baptis')
                ->leftJoin('pelayan_gereja','registrasi_baptis.id_pendeta','=','pelayan_gereja.id_pelayan')
                ->where('id_registrasi_baptis',$id_registrasi_baptis)
                ->get();
        return view('layouts.forms.daftarBaptis', compact('pendeta','baptism'));
    }
    public function edit(Request $request)
    {
        $id_registrasi_baptis = $request->id_registrasi_baptis;
        $pendeta = DB::select('CALL getPendeta()');
        $baptis  = DB::table('registrasi_baptis')->orderBy('id_registrasi_baptis')->get();
        $bbaptis = DB::table('registrasi_baptis')
                    ->leftJoin('pelayan_gereja','registrasi_baptis.id_pendeta','=','pelayan_gereja.id_pelayan')
                    ->where('id_registrasi_baptis',$id_registrasi_baptis)
                    ->first();
        return view('layouts.forms.updateBaptis',compact('pendeta','baptis','bbaptis'));
    }

    /**
     * Display the specified resource.
     */
    public function create(Request $request)
    {

        $response = DB::table('registrasi_baptis')->insert( [
            'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'nama_lengkap' => $request->nama_lengkap,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'tanggal_baptis' => $request->tanggal_baptis,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_pendeta' => $request->id_pendeta,
                'keterangan' => $request->keterangan,
        ]);

        if (!$response) {
            Alert::error('Tambah Baptis', 'Tambah Baptis Gagal');
            return back();
        }
            Alert::success('Tambah Baptis', 'Tambah Baptis Berhasil');
            return redirect()->route('baptis');
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_registrasi_baptis' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'id_pendeta' => 'required',
            'keterangan' => 'required',
        ]);

            $id_registrasi_baptis = $request->input('id_registrasi_baptis');
            $nama_ayah = $request -> input('nama_ayah');
            $nama_ibu = $request -> input('nama_ibu');
            $nama_lengkap = $request -> input('nama_lengkap');
            $tempat_lahir = $request -> input('tempat_lahir');
            $tanggal_lahir = $request -> input('tanggal_lahir');
            $alamat = $request -> input('alamat');
            $tanggal_baptis = $request ->input('tanggal_baptis');
            $jenis_kelamin = $request ->input('jenis_kelamin');
            $id_pendeta = $request ->input('id_pendeta');
            $keterangan = $request ->input('keterangan');

        $response = DB::table('registrasi_baptis')->where('id_registrasi_baptis',$id_registrasi_baptis)->update([
                'id_registrasi_baptis' => $id_registrasi_baptis,
                'nama_ayah' => $nama_ayah,
                'nama_ibu' => $nama_ibu,
                'nama_lengkap' => $nama_lengkap,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'alamat' => $alamat,
                'tanggal_baptis' => $tanggal_baptis,
                'jenis_kelamin' => $jenis_kelamin,
                'id_pendeta' => $id_pendeta,
                'keterangan' => $keterangan,
        ]);

        if (!$response) {
            Alert::error('Update Baptis', 'Update Baptis Gagal');
            return back();
        }
            Alert::success('Update Baptis', 'Update Baptis Berhasil');
            return redirect()->route('baptis');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_registrasi_baptis)
    {
        $data = DB::table('registrasi_baptis')->where('id_registrasi_baptis',$id_registrasi_baptis)->delete();

        if($data == null){
            // $failedMessage = Session::get('failed');

            Alert::error('Hapus Baptis', 'Hapus Baptis Gagal');
            return redirect()->route('baptis');
        }else{
            // $successMessage = Session::get('success');
            Alert::success('Hapus Baptis', 'Hapus Baptis Berhasil');
            return redirect()->route('baptis');
        }
    }
}
