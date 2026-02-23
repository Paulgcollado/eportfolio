<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\PruebaCorreo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Throwable;

class MailController extends Controller
{
    public function prueba()
    {
        try {
            $type = 'success';
            $message = '¡Correo enviado correctamente!';
            Mail::to(Auth::user()->email)->send(new PruebaCorreo);
        } catch (Throwable $e) {
            $type = 'error';
            $message = $e->getMessage();
        }

        return redirect(route('home'))->with($type, $message);
    }
}
