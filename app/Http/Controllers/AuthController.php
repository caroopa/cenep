<?php

namespace App\Http\Controllers;

use App\Mail\MailTemplate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
  public function showLoginForm()
  {
    return view('/admin/login');
  }

  public function login(Request $request)
  {
    $credentials = [
      "email" => $request->username,
      "password" => $request->password
    ];

    $remember = ($request->has("remember")) ? true : false;

    if (Auth::attempt($credentials, $remember)) {
      $request->session()->regenerate();
      return redirect()->intended(route("admin"));
    } else {
      return view('admin/login')->with('error', 'Usuario y/o contraseña incorrectas.');
    }
  }

  public function sendMail()
  {
    $user = User::where('email', 'admin')->first();
    $newPassword = Str::random(8);
    $user->update(['password' => bcrypt($newPassword)]);

    try {
      Mail::to("palearicaro@gmail.com")->send(new MailTemplate($newPassword));
      error_log('Correo electrónico enviado correctamente.');
    } catch (\Exception $e) {
      error_log('Error al enviar el correo electrónico: ' . $e->getMessage());
    }
    return redirect()->route('login')->with('sent', 'Se ha enviado un mail a *****.');
  }

  public function update(Request $request)
  {
    $request->validate([
      'antigua' => 'required',
      'nueva1' => 'required',
      'nueva2' => 'required|same:nueva1',
    ]);

    // Verificar la contraseña antigua
    if (!Hash::check($request->antigua, auth()->user()->password)) {
      return view('admin/form-password')->with('error', 'La contraseña antigua no es la correcta. Inténtelo de nuevo.');
    }

    // Actualizar la contraseña
    auth()->user()->update(['password' => Hash::make($request->nueva1)]);

    return view('admin/form-password')->with('success', 'Contraseña cambiada correctamente.');
  }

  public function logout()
  {
    Auth::logout();
    return redirect('/admin/login');
  }
}
