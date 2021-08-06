<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;


class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request)
    {
        $nama = $request->input('nama');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $foto = $request->input('foto');
        $alamat = $request->input('alamat');
        $noTelp = $request->input('noTelp');
        $sekolahAsal = $request->input('sekolahAsal');
        $namaOrtu = $request->input('namaOrtu');

        $register = User::create([
            'nama' => $nama,
            'email' => $email,
            'password' => $password,
            'foto' => $foto,
            'alamat' => $alamat,
            'noTelp' => $noTelp,
            'sekolahAsal' => $sekolahAsal,
            'namaOrtu' => $namaOrtu

        ]);

        if ($register){
           
            return response()->json(
                [
                    'success'=>true,
                    'message'=>'Register Success',
                    'data'=>$register
                ], 201);
        } else {
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Register Fail',
                    'data'=>''
                ], 400);
        }

    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if (Hash::check($password, $user->password)){
            $api_token = base64_encode(Str::random(40));

            $user->update([
                'api_token' => $api_token
            ]);
            $user = User::where('email', $email)->first();

            return response()->json(
                [
                    'success'=>true,
                    'message'=>'Login Success',
                    'data'=>$user
                ], 201);
        } else {
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Login Fail',
                    'data'=>''
                ], 400);
        }
    }

    public function mail(Request $request) {
        $to_name = $request->input('name');
        $to_email = $request->input('email');
        $data = array('name'=>$to_name, "body" => "Your Registration is Success");
             
        Mail::send('mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('Registration Success');
            $message->from('reyhan.rifqi.tech@gmail.com','Sekolah');
        });
    }

    //
}
