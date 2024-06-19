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

class pernikahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id_pernikahan = $request->id_pernikahan;
        $bnikah = DB::table('pernikahan')
                ->leftJoin('registrasi_pernikahan','pernikahan.id_registrasi_pernikahan','=','registrasi_pernikahan.id_registrasi_nikah')
                ->orderBy('id_pernikahan')
                ->get();
        // $nikah = DB::table('pernikahan')
        //         ->leftJoin('registrasi_pernikahan','pernikahan.id_registrasi_pernikahan','=','registrasi_pernikahan.id_registrasi_nikah')
        //         ->where('id_pernikahan',$id_pernikahan)
        //         ->first();

        return view('layouts.formSearch.pernikahan',compact('bnikah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function details(Request $request)
    {
        $id_pernikahan = $request->id_pernikahan;
        $bnikah = DB::table('pernikahan')->orderBy('id_pernikahan')->get();
        $nikah = DB::table('pernikahan')
                ->leftJoin('registrasi_pernikahan','pernikahan.id_registrasi_pernikahan','=','registrasi_pernikahan.id_registrasi_nikah')
                ->where('id_pernikahan',$id_pernikahan)
                ->first();

        return view('layouts.forms.detailPernikahan',compact('nikah','bnikah'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $nikahan = DB::select('CALL getRegistrasiNikah()');
        $gereja = DB::select('CALL getGereja()');

        return view('layouts.forms.daftarPernikahan', compact('nikahan', 'gereja'));
    }

    /**
     * Display the specified resource.
     */
    public function create(Request $request)
    {
        $response = DB::table('pernikahan')->insert( [
            'id_registrasi_pernikahan' => $request->id_registrasi_pernikahan,
            'tgl_pernikahan' => $request->tgl_pernikahan,
            'nats_pernikahan' => $request->nats_pernikahan,
            'id_gereja_nikah' => $request->id_gereja_nikah,
            'nama_gereja_non_HKBP' =>$request->nama_gereja_non_HKBP,
            'nama_pendeta' => $request->nama_pendeta,
            'keterangan' => $request->keterangan,
        ]);
        if (!$response) {
            Alert::error('Tambah pernikahan', 'Tambah pernikahan Gagal');
            return back();
        // return redirect()->route('rpp');
        }

            Alert::success('Tambah pernikahan', 'Tambah pernikahan Berhasil');
            return redirect()->route('pernikahan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_pernikahan)
    {
        $nikahan = DB::select('CALL getRegistrasiNikah()');
        $gereja = DB::select('CALL getGereja()');
        $nikah = DB::table('pernikahan')
                ->leftJoin('registrasi_pernikahan','pernikahan.id_registrasi_pernikahan','=','registrasi_pernikahan.id_registrasi_nikah')
                ->orderBy('id_pernikahan')
                ->get();
        $regnikah = DB::table('registrasi_pernikahan')->orderBy('id_registrasi_nikah')->get();
        $bnikah = DB::table('pernikahan')
                ->leftJoin('registrasi_pernikahan','pernikahan.id_registrasi_pernikahan','=','registrasi_pernikahan.id_registrasi_nikah')
                ->where('id_pernikahan',$id_pernikahan)
                ->first();

        return view('layouts.forms.updatePernikahan', compact('nikahan','gereja','nikah','bnikah','regnikah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id_pernikahan = $request->id_pernikahan;
        $response = DB::table('pernikahan')->where('id_pernikahan',$id_pernikahan)->update([
            'id_pernikahan' => $request->id_pernikahan,
            'id_registrasi_pernikahan' => $request->id_registrasi_pernikahan,
            'tgl_pernikahan' => $request->tgl_pernikahan,
            'nats_pernikahan' => $request->nats_pernikahan,
            'id_gereja_nikah' => $request->id_gereja_nikah,
            'nama_gereja_non_HKBP' =>$request->nama_gereja_non_HKBP,
            'nama_pendeta' => $request->nama_pendeta,
            'keterangan' => $request->keterangan,
        ]);
        if (!$response) {
            Alert::error('Update pernikahan', 'Update pernikahan Gagal');
            return back();
        // return redirect()->route('rpp');
        }

            Alert::success('Update pernikahan', 'Update pernikahan Berhasil');
            return redirect()->route('pernikahan');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_pernikahan)
    {
        $data = DB::table('pernikahan')->where('id_pernikahan',$id_pernikahan)->delete();

        if($data == null){
            Alert::error('Hapus Pernikahan', 'Hapus Pernikahan Gagal');
            // $failedMessage = Session::get('failed');
            return redirect()->route('pernikahan');
        }else{
            Alert::success('Hapus Pernikahan', 'Hapus Pernikahan Berhasil');
            // $successMessage = Session::get('success');
            return redirect()->route('pernikahan');
        }
    }
}
