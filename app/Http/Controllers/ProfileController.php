<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CustomerModels;
use App\Models\VendorModels;
use App\Models\CategoryModels;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {

    $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
    if (!$user) {
      $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
    }
    $category = CategoryModels::all();
    return view('profile', [
      'title' => 'Profile',
      'modul' => 'Profile',
      'route' => 'profile',
      'user' => $user,
      'category' => $category,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    Carbon::setLocale('id');
    $user = User::where('user_id', auth()->user()->user_id)->first();
    if ($request->password != null) {
      $validatedData = $request->validate([
        'password' => 'required',
      ]);
      // Hash password baru
      $hashedPassword = Hash::make($request->password);
      // Update password pengguna
      $validatedData['password'] = $hashedPassword;
      User::where('user_id', $id)
        ->update($validatedData);
      return redirect()->route('profile.index')->with('success', 'Berhasil mengubah password');
    } elseif ($request->file('avatar')) {
      $validatedData = $request->validate([
        'avatar' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
      ]);
      $image = $request->file('avatar');
      $validatedData['avatar'] = base64_encode(file_get_contents($image->path()));

      $profile = $user->role == 'customer' ? CustomerModels::where('user_id', $id)->first() : VendorModels::where('vendor_id', $id)->first();

      if ($profile) {
        $profile->update($validatedData);
        return redirect()->route('profile.index')->with('success', 'Berhasil mengubah foto profil');
      } else {
        // Jika profil tidak ditemukan, beri respons sesuai kebutuhan aplikasi Anda
        return redirect()->route('profile.index')->with('error', 'Maaf!, Gagal mengubah foto profil');
      }
    } else {
      if ($user->role == 'customer') {
        $validatedData = $request->validate([
          'fullname' => 'required',
          'phone' => 'required',
        ]);
        $validatedData['email'] = $request->email;
        $validatedData['address'] = $request->address;
        $validatedData['city'] = $request->city;
        $validatedData['updated_at'] = Carbon::now();
        CustomerModels::where('user_id', $id)
          ->update($validatedData);
        return redirect()->route('profile.index')->with('success', 'Berhasil mengubah data profil');
        return back()->with('error', 'Maaf!, Gagal mengubah data');
      } else if ($user->role == 'vendor') {
        $validatedData = $request->validate([
          'fullname' => 'required',
          'phone' => 'required',
        ]);
        $validatedData['email'] = $request->email;
        $validatedData['address'] = $request->address;
        $validatedData['city'] = $request->city;
        $validatedData['updated_at'] = Carbon::now();
        VendorModels::where('vendor_id', $id)
          ->update($validatedData);
        return redirect()->route('profile.index')->with('success', 'Berhasil mengubah data profil');
        return back()->with('error', 'Maaf!, Gagal mengubah data');
      }
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
