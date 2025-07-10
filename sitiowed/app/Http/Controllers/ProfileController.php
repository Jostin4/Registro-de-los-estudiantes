<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller
{
    // Mostrar perfil del usuario
    public function profile()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }

    // Actualizar información del perfil
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Perfil actualizado correctamente');
    }

    // Mostrar configuración
    public function settings()
    {
        $user = Auth::user();
        return view('profile.settings', compact('user'));
    }

    // Cambiar contraseña
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Contraseña cambiada correctamente');
    }

    // Actualizar configuración de notificaciones
    public function updateNotifications(Request $request)
    {
        $request->validate([
            'email_notifications' => 'boolean',
            'push_notifications' => 'boolean',
        ]);

        $user = Auth::user();
        $user->update([
            'email_notifications' => $request->has('email_notifications'),
            'push_notifications' => $request->has('push_notifications'),
        ]);

        return back()->with('success', 'Configuración de notificaciones actualizada');
    }
} 