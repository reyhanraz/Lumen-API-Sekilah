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
                
                    $register
                , 201);
        } else {
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Register Fail',
                    'data'=>''
                ], 400);
        }

    }

    public function update(Request $request){
        $nama = $request->input('nama');
        $email = $request->input('email');
        $foto = $request->input('foto');
        $alamat = $request->input('alamat');
        $noTelp = $request->input('noTelp');
        $sekolahAsal = $request->input('sekolahAsal');
        $namaOrtu = $request->input('namaOrtu');

        $user = User::where('email', $email)->first();

        $update = $user->update([
            'nama' => $nama,
            'foto' => $foto,
            'alamat' => $alamat,
            'noTelp' => $noTelp,
            'sekolahAsal' => $sekolahAsal,
            'namaOrtu' => $namaOrtu
        ]);

        if ($update){
            $data = User::where('email', $email)->first();
            return response()->json(
                
                    $data
                , 201);
        } else {
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Update Fail',
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
                
                    $user
                , 201);
        } else {
            return response()->json(
                [
                    'success'=>false,
                    'message'=>'Login Fail',
                    'data'=>''
                ], 400);
        }
    }

    public function checkEmailRegistered(Request $request)
    {
        $email = $request->input('email');

        $user = User::where('email', $email)->first();

            return response()->json(
                $user, 200);
        
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $user = User::where('id',$id)->delete();
        if ($user){
            return response()->json(
                $user, 201
            );
        }
    }

    public function mail(Request $request) {
        $to_name = $request->input('name');
        $to_email = $request->input('email');
        $body = $request->input('message');
        $data = array('name'=>$to_name, "body" => $body);
             
        $mail = Mail::send('mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('Registration Success');
            $message->from('reyhan.rifqi.tech@gmail.com','Sekolah');
        });

        
            return response()->json([
                'name' => $to_name,
                'message' => $body,
                'email' => $to_email
            ],201);
        
    }

    //
}
