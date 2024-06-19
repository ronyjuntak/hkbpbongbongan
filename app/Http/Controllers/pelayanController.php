<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


class pelayanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pelayan'] = DB::table('pelayan_gereja')
                        ->leftJoin('jemaat','pelayan_gereja.id_jemaat','=','jemaat.id_jemaat')
                        ->get();

        return view('layouts.formSearch.pelayan', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showDetails(Request $request)
    {
        $id_pelayan = $request->id_pelayan;
        $status = DB::table('status')->get();
        $jemaat = DB::select('CALL getJemaat()');
        $pelayan = DB::table('pelayan_gereja')
                ->join('status','pelayan_gereja.id_status_pelayanan','=','status.id_status')
                ->join('jemaat','pelayan_gereja.id_jemaat','=','jemaat.id_jemaat')
                ->where('id_pelayan',$id_pelayan)
                ->first();

        return view('layouts.forms.detailPelayan', compact('pelayan','jemaat','status'));
    }

    public function create(Request $request)
    {

        $request->validate([
            'id_jemaat' => 'required',
            'tanggal_tahbisan' => 'required',
            'tanggal_akhir_jawatan' => 'required',
            'jabatan' => 'required',
            'keterangan' => 'required',
        ]);


            $id_jemaat = $request->input('id_jemaat');
            $tanggal_tahbisan = $request->input('tanggal_tahbisan');
            $tanggal_akhir_jawatan = $request->input('tanggal_akhir_jawatan');
            $jabatan = $request->input('jabatan');
            $keterangan = $request->input('keterangan');

            $response = DB::table('pelayan_gereja')->insert( [
                'id_jemaat' => $id_jemaat,
                'tanggal_tahbisan' => $tanggal_tahbisan,
                'jabatan' => $jabatan,
                'tanggal_akhir_jawatan' => $tanggal_akhir_jawatan,
                'keterangan' => $keterangan,
            ]);


            if (!$response) {
            Alert::error('Tambah Pelayan', 'Tambah Pelayan Gagal');
            return back();
            }
            Alert::success('Tambah Pelayan', 'Tambah Pelayan Berhasil');
            return redirect()->route('pelayan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $jemaat = DB::select('CALL getJemaat()');


        return view('layouts.forms.daftarPelayan', compact('jemaat'));
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id_pelayan = $request->id_pelayan;
        $jemaat = DB::select('CALL getJemaat()');

        $pelayan = DB::table('pelayan_gereja')->orderBy('id_pelayan')->get();
        $bpelayan = DB::table('pelayan_gereja')
                    ->leftJoin('jemaat','jemaat.id_jemaat','=','pelayan_gereja.id_jemaat')
                    ->where('id_pelayan',$id_pelayan)
                    ->first();

        return view('layouts.forms.updatePelayan',compact('jemaat','pelayan','bpelayan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_pelayan' => 'required',
            'id_jemaat' => 'required',
            'tanggal_tahbisan' => 'required',
            'tanggal_akhir_jawatan' => 'required',
            'jabatan' => 'required',
            'keterangan' => 'required',
        ]);

            $id_pelayan = $request->input('id_pelayan');
            $id_jemaat = $request->input('id_jemaat');
            $tanggal_tahbisan = $request->input('tanggal_tahbisan');
            $tanggal_akhir_jawatan = $request->input('tanggal_akhir_jawatan');
            $jabatan = $request->input('jabatan');
            $keterangan = $request->input('keterangan');

            $response = DB::table('pelayan_gereja')->where('id_pelayan',$id_pelayan)->update([
                'id_pelayan' => $id_pelayan,
                'id_jemaat' => $id_jemaat,
                'tanggal_tahbisan' => $tanggal_tahbisan,
                'tanggal_akhir_jawatan' => $tanggal_akhir_jawatan,
                'jabatan' => $jabatan,
                'keterangan' => $keterangan,
            ]);

            if (!$response) {
            Alert::error('Update Pelayan', 'Update Pelayan Gagal');
            return back();
            }

            Alert::success('Update Pelayan', 'Update Pelayan Berhasil');
            return redirect()->route('pelayan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_pelayan)
    {
        $data = DB::table('pelayan_gereja')->where('id_pelayan',$id_pelayan)->delete();
        if($data == null){
            // $failedMessage = Session::get('failed');
            Alert::error('Hapus Pelayan', 'Hapus Pelayan Gagal');
            return redirect()->route('pelayan');
        }else{
            // $successMessage = Session::get('success');
            Alert::success('Hapus Pelayan', 'Hapus Pelayan Berhasil');
            return redirect()->route('pelayan');
        }

    }
}
