<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\PendingRegistration;

class RegistrationController extends Controller
{
    public function proceedRegistration($token) {
        $pd = PendingRegistration::where('token', $token);
        $verify = $pd->count();

        if($verify != 1){
            return redirect()->route('front.new.post')->with('status', "Mohon maaf, kode token anda tidak ditemukan, silahkan melakukan pendaftaran ulang");
        }

        $data = $pd->first();
        $pd->delete();

        return view('auth.proceed', compact('data'));
    }

    public function sendNewRegistration(Request $request)
    {
        $random = str_random(40);

        $pr = new PendingRegistration;
        $pr->name = $request->name;
        $pr->email = $request->email;
        $pr->token = $random;
        $pr->save();

        $link = "http://alumni.smkn1klaten.sch.id/auth/proceed/".$random;

        try{
            Mail::send('email.registration', ['name' => $request->name, 'email' => $request->email, 'link' => $link], function ($message) use ($request)
            {
                $message->subject("New Registration | Alumni SMK N 1 Klaten");
                $message->from('noreply@smkn1klaten.sch.id', 'No-Reply');
                $message->to($request->email);
            });
        }
        catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }

        $return = "Proses pendaftaran Berhasil, silahkan buka email anda untuk melanjutkan proses selanjutnya";
        return redirect()->route('front.new.post')->with('status', $return);
    }
}
