<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use app\Helpers\ApiFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\jemaat;
use App\Models\rpp;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class rppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id_rpp = $request->id_rpp;
        $jemaat = DB::table('jemaat')->orderBy('nama_depan')->get();
        $brpp = DB::table('rpp')->orderBy('id_rpp')->get();
        $rpp = DB::table('rpp')
            ->leftJoin('jemaat','jemaat.id_jemaat','=','rpp.id_jemaat')
            ->orderBy('id_rpp')
            ->get();
        return view('layouts.formSearch.rpp', compact('jemaat','rpp','brpp'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store()
    {
        $jemaat = DB::select('CALL getJemaat()');
        $rpp =  DB::select('CALL getJenisRPP()');
        $bjemaat =DB::select('CALL getJemaats()');

        return view('layouts.forms.daftarRpp', compact('rpp', 'jemaat','bjemaat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
            $request->validate([
                'id_jemaat' => 'required',
                'id_jenis_rpp' => 'required',
                'tgl_warta_rpp' => 'required',
                'keterangans' => 'required',
            ]);

            $id_jemaat = $request->input('id_jemaat');
            $id_jenis_rpp = $request->input('id_jenis_rpp');
            $tgl_warta_rpp = $request->input('tgl_warta_rpp');
            $keterangans = $request->input('keterangans');

            $response = DB::table('rpp')->insert( [
                'id_jemaat' => $id_jemaat,
                'id_jenis_rpp' => $id_jenis_rpp,
                'tgl_warta_rpp' => $tgl_warta_rpp,
                'keterangans' => $keterangans
            ]);

            if (!$response) {
            Alert::error('Tambah RPP', 'Tambah RPP Gagal');
            return back();
            }
            Alert::success('Tambah RPP', 'Tambah RPP Berhasil');
            return redirect()->route('rpp');
    }

    /**
     * Display the specified resource.
     */
    public function showDetails(Request $request)
    {
        $id_rpp = $request->id_rpp;
        $rpp = DB::table('rpp')->orderBy('id_rpp')->get();
        $brpp = DB::table('rpp')
            ->leftJoin('jenis_rpp','jenis_rpp.id_jenis_rpp','=','rpp.id_jenis_rpp')
            ->leftJoin('jemaat','rpp.id_jemaat','=','jemaat.id_jemaat')
            ->where('id_rpp',$id_rpp)
            ->first();

        return view('layouts.forms.detailRpp', compact('rpp','brpp'));


    }

    /**
     * Show the form for editing the specified resource.
     */


    // public function tampilkan(){
    //     return view('layouts.forms.daftarRpp');
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id_rpp' => 'required',
            // 'id_jemaat' => 'required',
            'id_jenis_rpp' => 'required',
            'tgl_warta_rpp' => 'required',
            'keterangans' => 'required',
        ]);
        $id_rpp = $request->input('id_rpp');
        // $id_jemaat = $request->input('id_jemaat');
        $id_jenis_rpp = $request->input('id_jenis_rpp');
        $tgl_warta_rpp = $request->input('tgl_warta_rpp');
        $keterangans = $request->input('keterangans');

        $response = DB::table('rpp')->where('id_rpp',$id_rpp)->update( [
            'id_rpp' => $id_rpp,
            // 'id_jemaat' => $id_jemaat,
            'id_jenis_rpp' => $id_jenis_rpp,
            'tgl_warta_rpp' => $tgl_warta_rpp,
            'keterangans' => $keterangans
        ]);
        if (!$response) {
            Alert::error('Update RPP', 'Update RPP Gagal');
            return back();
        // return redirect()->route('rpp');
        }
            Alert::success('Update RPP', 'Update RPP Berhasil');
            return redirect()->route('rpp');

    }


    public function edit($id_rpp)
    {
        $jemaat = DB::select('CALL getJemaat()');
        $jenis =  DB::select('CALL getJenisRPP()');

        $rpp  = DB::table('rpp')->orderBy('id_rpp')->get();
        $brpp = DB::table('rpp')
                ->leftJoin('jemaat','jemaat.id_jemaat','=','rpp.id_jemaat')
                ->where('id_rpp',$id_rpp)
                ->first();
        return view('layouts.forms.updateRpp',compact('jemaat','jenis','rpp','brpp'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_rpp){
        // Session::flash('success', 'Your data has been successfully deleted.');
        // Session::flash('failed', 'Your data was failed to delete.');
        $data = DB::table('rpp')->where('id_rpp',$id_rpp)->delete();

        if($data == null){
            Alert::error('Hapus RPP', 'Hapus RPP Gagal');
            // $failedMessage = Session::get('failed');
            return redirect()->route('rpp');
        }else{
            Alert::success('Hapus RPP', 'Hapus RPP Berhasil');
            // $successMessage = Session::get('success');
            return redirect()->route('rpp');
        }
    }
}
