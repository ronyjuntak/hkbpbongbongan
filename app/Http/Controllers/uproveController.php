<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use app\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class uproveController extends Controller
{

    public function baptis()
    {
        $baptis['baptiss'] = Http::get('http://127.0.0.1:8070/api/baptis')->collect();

        $data = array_merge($baptis);

        return view('layouts.formSearch.uproveBaptis', $data);
    }

    public function userUproveBaptis()
    {
        $user = Auth::user();

        $response = DB::table('registrasi_baptis');

        $baptis['userBaptiss'] = $response->get()->where('id_user', $user->id);

        $data = array_merge($baptis);

        return view('layouts.user_2.user_uprove_baptis', $data);
    }


    public function uproveBaptis1($id)
    {
        try {
            $response = Http::put('http://127.0.0.1:8070/api/uproveBaptis1/'.$id);
            $statusCode = $response->status();

            if ($statusCode === 200) {
                Alert::success('Uprove Baptis', 'Uprove Baptis Berhasil');
                return redirect()->route('aksesUproveBaptis');
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function uproveBaptis2($id)
    {
        try {
            $response = Http::put('http://127.0.0.1:8070/api/uproveBaptis2/'.$id);
            $statusCode = $response->status();

            if ($statusCode === 200) {
                Alert::success('Tolak Uprove Baptis', 'Tolak Uprove Baptis Berhasil');
                return redirect()->route('aksesUproveBaptis');
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function prvJemaat()
    {
        $jemaat['prvJemaats'] = DB::table('jemaat')->get();

        $data = array_merge($jemaat);

        return view('layouts.formSearch.uproveJemaat', $data);
    }

    public function userUproveJemaat()
    {
        $user = Auth::user();

        $response = DB::table('jemaat');

        $jemaat['userJemaats'] = $response->get()->where('id_user', $user->id);

        $data = array_merge($jemaat);

        return view('layouts.user_2.user_uprove_jemaat', $data);
    }

    public function uproveJemaat1($id_jemaat)
    {
        try {
            // $response = Http::put('http://127.0.0.1:8070/api/uproveJemaat1/'.$id);
            // $statusCode = $response->status();

            // if ($statusCode === 200) {
            //     Alert::success('Uprove Jemaat', 'Uprove Jemaat Berhasil');
            //     return redirect()->route('aksesUproveJemaat');
            // }
            DB::table('jemaat')->where('id_jemaat',$id_jemaat)->update([
                'status' => 1
            ]);
            Alert::success('Uprove Jemaat','Uprove Jemaat Berhasil');
            return redirect()->route('aksesUproveJemaat');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function uproveJemaat2($id_jemaat)
    {
        try {
            // $response = Http::put('http://127.0.0.1:8070/api/uproveJemaat2/'.$id);
            // $statusCode = $response->status();

            // if ($statusCode === 200) {
            //     Alert::success('Tolak Uprove Jemaat', 'Tolak Uprove Jemaat Berhasil');
            //     return redirect()->route('aksesUproveJemaat');
            // }
            DB::table('jemaat')->where('id_jemaat',$id_jemaat)->update([
                'status' => 2
            ]);
            Alert::success('Uprove Jemaat','Uprove Jemaat Berhasil');
            return redirect()->route('aksesUproveJemaat');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function martumpol()
    {
        $martumpol['martumpols'] = DB::table('registrasi_pernikahan')->get();

        $data = array_merge($martumpol);

        return view('layouts.formSearch.uproveMartumpol', $data);
    }

    public function userUproveMartumpol()
    {
        $user = Auth::user();

        $response = DB::table('registrasi_calon_mempelai');

        $martumpol['userMartumpols'] = $response->get()->where('id_user', $user->id);

        $data = array_merge($martumpol);

        return view('layouts.user_2.user_uprove_martumpol', $data);
    }

    public function uproveMartumpol1($id_registrasi_nikah)
    {
        try {
            // $response = Http::put('http://127.0.0.1:8070/api/uproveMartumpol1/'.$id);
            // $statusCode = $response->status();

            // if ($statusCode === 200) {
            //     Alert::success('Uprove Martumpol', 'Uprove Martumpol Berhasil');
            //     return redirect()->route('aksesUproveMartumpol');
            // }
            DB::table('registrasi_pernikahan')->where('id_registrasi_nikah',$id_registrasi_nikah)->update([
                'status' => 1
            ]);
            Alert::success('Uprove Martumpol','Uprove Martumpol Berhasil');
            return redirect()->route('aksesUproveMartumpol');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function uproveMartumpol2($id_registrasi_nikah)
    {
        try {
            // $response = Http::put('http://127.0.0.1:8070/api/uproveMartumpol2/'.$id);
            // $statusCode = $response->status();

            // if ($statusCode === 200) {
            //     Alert::success('Tolak Uprove Martumpol', 'Tolak Uprove Martumpol Berhasil');
            //     return redirect()->route('aksesUproveMartumpol');
            // }
            DB::table('registrasi_pernikahan')->where('id_registrasi_nikah',$id_registrasi_nikah)->update([
                'status' => 2
            ]);
            Alert::success('Tolak Uprove Martumpol','Tolak Uprove Martumpol Berhasil');
            return redirect()->route('aksesUproveMartumpol');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function pernikahan()
    {
        $nikah['nikahs'] = DB::table('pernikahan')
        ->leftJoin('registrasi_pernikahan','pernikahan.id_registrasi_pernikahan','=','registrasi_pernikahan.id_registrasi_nikah')
        ->get();

        $data = array_merge($nikah);

        return view('layouts.formSearch.uprovePernikahan', $data);
    }

    public function userUprovePernikahan()
    {
        $user = Auth::user();

        $response = DB::table('registrasi_pernikahan');

        $nikah['userNikahs'] = $response->get()->where('id_user', $user->id);

        $data = array_merge($nikah);

        return view('layouts.user_2.user_uprove_nikah', $data);
    }

    public function uprovePernikahan1($id_registrasi_pernikahan)
    {
        try {
            // $response = Http::put('http://127.0.0.1:8070/api/uproveNikah1/'.$id);
            // $statusCode = $response->status();

            // if ($statusCode === 200) {
            //     Alert::success('Uprove Pernikahan', 'Uprove Pernikahan Berhasil');
            //     return redirect()->route('aksesUprovePernikahan');
            // }
            DB::table('pernikahan')->where('id_registrasi_pernikahan',$id_registrasi_pernikahan)->update([
                'id_status' => 2
            ]);
            Alert::success('Uprove Nikah','Uprove Pernikahan Berhasil');
            return redirect()->route('aksesUprovePernikahan');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function uprovePernikahan2($id_registrasi_pernikahan)
    {
        try {
            // $response = Http::put('http://127.0.0.1:8070/api/uproveNikah2/'.$id);
            // $statusCode = $response->status();

            // if ($statusCode === 200) {
            //     Alert::success('Tolak Uprove Pernikahan', 'Tolak Uprove Pernikahan Berhasil');
            //     return redirect()->route('aksesUprovePernikahan');
            // }
            DB::table('pernikahan')->where('id_registrasi_pernikahan',$id_registrasi_pernikahan)->update([
                'id_status' => 3
            ]);
            Alert::success('Tolak Nikah','Tolak Pernikahan Berhasil');
            return redirect()->route('aksesUprovePernikahan');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function pindah()
    {
        $pindah['pindahs'] = DB::table('head_pindah')
        ->leftJoin('jemaat','head_pindah.id_jemaat','=','jemaat.id_jemaat')
        ->get();

        $data = array_merge($pindah);

        return view('layouts.formSearch.uprovePindah', $data);
    }

    public function userUprovePindah()
    {
        $user = Auth::user();

        $response = DB::table('head_pindah');

        $pindah['userPindahs'] = $response->get()->where('id_user', $user->id);

        $data = array_merge($pindah);

        return view('layouts.user_2.user_uprove_pindah', $data);
    }

    public function uprovePindah1($id_head_reg_pindah)
    {
        try {
            // $response = Http::put('http://127.0.0.1:8070/api/uprovePindah1/'.$id);
            // $statusCode = $response->status();

            // if ($statusCode === 200) {
            //     Alert::success('Uprove Jemaat Pindah', 'Uprove Jemaat Pindah Berhasil');
            //     return redirect()->route('aksesUprovePindah');
            // }
            DB::table('head_pindah')->where('id_head_reg_pindah',$id_head_reg_pindah)->update([
                'id_status' => 1
            ]);
            Alert::success('Uprove Jemaat Pindah','Uprove Jemaat Pindah Berhasil');
            return redirect()->route('aksesUprovePindah');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function uprovePindah2($id_head_reg_pindah)
    {
        try {
            // $response = Http::put('http://127.0.0.1:8070/api/uprovePindah2/'.$id);
            // $statusCode = $response->status();

            // if ($statusCode === 200) {
            //     Alert::success('Tolak Uprove Jemaat Pindah', 'Tolak Uprove Jemaat Pindah Berhasil');
            //     return redirect()->route('aksesUprovePindah');
            // }
            DB::table('head_pindah')->where('id_head_reg_pindah',$id_head_reg_pindah)->update([
                'id_status' => 2
            ]);
            Alert::success('Tolak Uprove Jemaat Pindah','Tolak Uprove Jemaat Pindah Berhasil');
            return redirect()->route('aksesUprovePindah');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function keluarga()
    {
        $keluarga['keluargas'] = DB::table('registrasi_jemaat')->get();
        $data = array_merge($keluarga);
        return view('layouts.formSearch.uproveKeluarga', $data);
    }

    public function userUproveKeluarga()
    {
        $user = Auth::user();
        $response = DB::table('registrasi_jemaat');
        $keluarga['userKeluargas'] = $response->get()->where('id_user', $user->id);
        $data = array_merge($keluarga);
        return view('layouts.user_2.user_uprove_keluarga',$data);
    }

    public function uproveKeluarga1 ($id_registrasi)
    {
        try {
            // $response = DB::table('registrasi_sidi',$id_registrasi_sidi)->get();
            // $statusCode = $response->get('status');
            // if ($statusCode === 200) {
            //     Alert::success('Uprove Sidi', 'Uprove Sidi Berhasil');
            //     return redirect()->route('aksesUproveSidi');
            // }
            DB::table('registrasi_jemaat')->where('id_registrasi',$id_registrasi)->update([
                'status' => 1
            ]);
            Alert::success('Uprove Keluarga','Uprove Keluarga Berhasil');
            return redirect()->route('aksesUproveKeluarga');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function uproveKeluarga2 ($id_registrasi)
    {
        try {
            // $response = DB::table('registrasi_sidi',$id_registrasi_sidi)->get();
            // $statusCode = $response->get('status');
            // if ($statusCode === 200) {
            //     Alert::success('Uprove Sidi', 'Uprove Sidi Berhasil');
            //     return redirect()->route('aksesUproveSidi');
            // }
            DB::table('registrasi_jemaat')->where('id_registrasi',$id_registrasi)->update([
                'status' => 12
            ]);
            Alert::success('Tolak Uprove Keluarga','Tolak Uprove Keluarga Berhasil');
            return redirect()->route('aksesUproveKeluarga');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function sidi()
    {
        $sidi['sidis'] = DB::table('registrasi_sidi')->get();

        $data = array_merge($sidi);

        return view('layouts.formSearch.uproveSidi', $data);
    }

    public function userUproveSidi()
    {
        $user = Auth::user();

        $response = DB::table('registrasi_sidi');

        $sidi['userSidis'] = $response->get()->where('id_user', $user->id);

        $data = array_merge($sidi);

        return view('layouts.user_2.user_uprove_sidi', $data);
    }

    public function uproveSidi1($id_registrasi_sidi)
    {
        try {
            // $response = DB::table('registrasi_sidi',$id_registrasi_sidi)->get();
            // $statusCode = $response->get('status');
            // if ($statusCode === 200) {
            //     Alert::success('Uprove Sidi', 'Uprove Sidi Berhasil');
            //     return redirect()->route('aksesUproveSidi');
            // }
            DB::table('registrasi_sidi')->where('id_registrasi_sidi',$id_registrasi_sidi)->update([
                'id_status' => 2
            ]);
            Alert::success('Uprove Sidi','Uprove Sidi Berhasil');
            return redirect()->route('aksesUproveSidi');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function uproveSidi2($id_registrasi_sidi)
    {
        try {
            // $response = DB::table('registrasi_sidi')->get();
            // $statusCode = $response->get('status');

            // if ($statusCode === 200) {
            //     Alert::success('Tolak Uprove Sidi', 'Tolak Uprove Sidi Berhasil');
            //     return redirect()->route('aksesUproveSidi');
            // }
            DB::table('registrasi_sidi')->where('id_registrasi_sidi',$id_registrasi_sidi)->update([
                'id_status' => 3
            ]);
            Alert::success('Tolak Uprove Sidi','Tolak Uprove Sidi Berhasil');
            return redirect()->route('aksesUproveSidi');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
