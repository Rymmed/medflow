<?php

namespace App\Http\Controllers;

use App\Mail\NewUserWelcome;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return view('super-admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('super-admin.admins.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lastName' => 'required|string',
            'firstName' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|boolean',
            'phone_number' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin = new User;
        $admin->lastName = $request->lastName;
        $admin->firstName = $request->firstName;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->gender = $request->gender;
        $admin->phone_number = $request->phone_number;
        $admin->role = 'admin';
        $admin->save();
        Mail::to($admin->email)->send(new NewUserWelcome($admin));
        return redirect()->back()->with('success', 'Administrateur ajouté avec succès.');
    }

    public function show($id)
    {
        $admin = User::findOrFail($id);
        return view('super-admin.admins.show', compact('admin'));
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('super-admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'lastName' => 'required|string',
            'firstName' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$id,
            'gender' => 'required|boolean',
            'phone_number' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Mise à jour des données de l'utilisateur
        $admin = User::findOrFail($id);
        $admin->lastName = $request->lastName;
        $admin->firstName = $request->firstName;
        $admin->email = $request->email;
        $admin->gender = $request->gender;
        $admin->phone_number = $request->phone_number;
        $admin->save();

        return redirect()->back()->with('success', 'Profil utilisateur mis à jour avec succès.');
    }

    public function activate($id)
    {
        $admin = User::findOrFail($id);
        $admin->update(['status' => true]);
        return redirect()->route('admins.index')->with('success', 'Le compte de l\'administrateur a été activé avec succès.');
    }
    public function deactivate($id)
    {
        $admin = User::findOrFail($id);
        $admin->update(['status' => false]);
        return redirect()->route('admins.index')->with('success', 'Le compte de l\'administrateur a été désactivé avec succès.');
    }
    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Administrateur supprimé avec succès.');
    }
}
