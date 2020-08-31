<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Binusian;
use Alert;
use App\Karyawan;
use App\Anak;
use App\Shift;
use App\Transaction;
use App\Batch;
use Carbon\Carbon;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login');
    }

    public function registered(Request $request)
    {
        if ($request->session()->has('binusian_id')) {
            $binusian_id = $request->session()->get('binusian_id');
            $datas = DB::table('transaction_registration')
                        ->join('master_shift_quota','transaction_registration.shift_id','=','master_shift_quota.shift_id')
                        ->select('transaction_registration.binusian_id','transaction_registration.anak_ke','master_shift_quota.shift_info','transaction_registration.created_at')
                        ->where('binusian_id','=',$binusian_id)
                        ->orderBy('transaction_registration.anak_ke', 'ASC')
                        ->get();
            return view('registered',compact('datas'));
        } else {
            return redirect('/');
        }
    }

    public function regist()
    {
        return view('regist');
    }

    public function clearAll(Request $request){
        $binusian_id = $request->session()->get('binusian_id');
        $status = Transaction::where('binusian_id','=',$binusian_id)->delete();
        if ($status > 0) {
            Alert::warning('Clear Data Success','If You Want to Register Again, Fill the Form Again');
            return back();
        } else {
            Alert::Failed('Clear Data Failed','Please Contact the Administator');
            return back();
        }
    }

    public function forbidden(Request $request){
        if ($request->session()->has('binusian_id')) {
            return view('forbidden');
        } else {
            return redirect('/');
        }
    }

    public function logout(Request $request){
        if ($request->session()->has('binusian_id')) {
            $request->session()->forget('binusian_id');
            return redirect('/');
        } else{
            return redirect('/');
        }
    }

    public function dashboard(Request $request){
        if ($request->session()->has('binusian_id')) {
            $binusian_id = $request->session()->get('binusian_id');
            $data = Karyawan::where('binusian_id',$binusian_id)->first();
            if (($data->lokasi_kerja == 'SS') || ($data->lokasi_kerja == 'KA') || ($data->lokasi_kerja == 'KJ')) {
                $children = Anak::where('binusian_id',$binusian_id)->orderBy('anak_ke','ASC')->get();
                $shifts = Shift::all();
                $batch = Batch::where('batch_id','01')->first();
                $count = Transaction::select('shift_id')->count();
                $registered = Transaction::where('binusian_id','=',$binusian_id)->get();
                $first = Transaction::where('binusian_id','=',$binusian_id)->limit(1)->orderByDesc('created_at')->first();
                $other = Transaction::all();
                return view('dashboard',compact('data','children','shifts','batch','registered','first','count'));
            } else {
                return view('forbidden');
            }
            
        } else {
            return redirect('/');
        }
        
    }

    public function loginModal(Request $request){
        $request->validate([
            'binusian_id' => 'required|max:12',
            'password' => 'required'
        ]);

        $data = Binusian::where('binusian_id', $request->binusian_id)->first();
        if (is_null($data)) {
            Alert::warning('Login Failed','Wrong Binusian ID or Password');
            return redirect('/');
        } else {
            if (Hash::check($request->password, $data->password)) {   
                $request->session()->put('binusian_id', $request->binusian_id);
                return redirect('/dashboard');
            } else {
                Alert::warning('Login Failed','Wrong Binusian ID or Password');
                return redirect('/');
            }
        }
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUser(Request $request)
    {
        $request->validate([
            'binusian_id' => 'required|max:12',
            'password' => 'required'
        ]);
        $check = Binusian::where('binusian_id',$request->binusian_id);
        if (is_null($check)) {
            return redirect('/regist')->with('regist_warning','User Used');
        } else {
            $password = Hash::make($request->password);
            $insert = Binusian::create([
                'binusian_id' => $request->binusian_id,
                'password' => $password
            ]);

            if ($insert) {
                return redirect('/regist')->with('regist','User Created');
            } else {
                return redirect('/regist')->with('regist_fail','User Failed to Create');
            }
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //array from form
        $childs = $request->childs;
        //binusian_id
        $binusian_id = $request->session()->get('binusian_id'); 
        //shift id
        $shift_id = $request->shift_id; 
        //set time to jakarta
        date_default_timezone_set("Asia/Jakarta"); 
        //time
        $time = Carbon::now(); 
        //count length array
        $count = count($childs);
        $status = '';
        
        //entry form session
        $watch = Batch::where('batch_id','01')->first();
        $start_date = $watch->start_date;
        $end_date = $watch->end_date;
        // filter fill form session
        if (($time >= $start_date) && ($time <= $end_date)) {
            for ($i=0; $i < $count; $i++) { 
                //delete data, before insert data in transaction registration
                Transaction::where('binusian_id','=',$binusian_id)->where('anak_ke','=',$childs[$i])->delete();
                $data = Transaction::create([
                    'binusian_id' => $binusian_id,
                    'shift_id' => $shift_id,
                    'anak_ke' => $childs[$i],
                    'created_at' => $time,
                    'updated_at' => null
                ]);
                if ($data) {
                    $status = $status . $i;
                }
            }
            $count2 = strlen($status);
            if ($count == $count2) {
                Alert::success('Registration Success','Your Registration Success');
                return redirect('/dashboard/registered');
            } else {
                Alert::warning('Registration Failed','Something Wrong, Please Contact Admin');
                return back();
            }
        } else {
            Alert::warning('Registration Failed','Your Resgistration Out of Registration Session Date');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //array from form
        $childs = $request->childs;
        //binusian_id
        $binusian_id = $request->session()->get('binusian_id'); 
        //shift id
        $shift_id = $request->shift_id; 
        //set time to jakarta
        date_default_timezone_set("Asia/Jakarta"); 
        //time
        $time = Carbon::now(); 
        //count length array
        $count = count($childs);
        $status = '';
        
        //entry form session
        $watch = Batch::where('batch_id','01')->first();
        $start_date = $watch->start_date;
        $end_date = $watch->end_date;
        // filter fill form session
        if (($time >= $start_date) && ($time <= $end_date)) {
            for ($i=0; $i < $count; $i++) { 
                //delete data, before insert data in transaction registration
                Transaction::where('binusian_id','=',$binusian_id)->where('anak_ke','=',$childs[$i])->delete();
                $data = Transaction::create([
                    'binusian_id' => $binusian_id,
                    'shift_id' => $shift_id,
                    'anak_ke' => $childs[$i],
                    'created_at' => $time,
                    'updated_at' => null
                ]);
                if ($data) {
                    $status = $status . $i;
                }
            }
            $count2 = strlen($status);
            if ($count == $count2) {
                Alert::success('Update Success','Your Update Success');
                return redirect('/dashboard/registered');
            } else {
                Alert::warning('Update Failed','Something Wrong, Please Contact Administrator');
                return back();
            }
        } else {
            Alert::warning('Update Failed','Your Update Out of Registration Session Date');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
