<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RoleModels;
use App\Models\User;
use App\Models\CustomerModels;
use App\Models\VendorModels;

class userController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $search = $request->input('search');
    if ($search) {
      $data = User::where('fullname', 'like', '%' . $search . '%')
        ->orWhere('username', 'like', '%' . $search . '%')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    } else {
      $data = User::query()->orderBy('created_at', 'desc')->paginate(10);
    }

    $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
    if (!$user) {
      $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
    }

    return view('master_user.index', [
      'title' => 'Master User',
      'modul' => 'Master User',
      'route' => 'user',
      'data' => $data,
      'params' => $search,
      'user' => $user,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
    if (!$user) {
      $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
    }
    $rolesToExclude = ['customer'];
    $role = RoleModels::whereNotIn('role', $rolesToExclude)->get();
    return view('master_user.create', [
      'title' => 'Tambah Data',
      'modul' => 'Master User',
      'route' => 'user',
      'role' => $role,
      'user' => $user,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'fullname' => 'required',
      'username' => 'required',
      'phone' => 'required',
      'password' => 'required',
      'role' => 'required',
      'email' => 'required|email',
    ]);
    $uuid = Str::uuid();
    $now = now();
    $hashedPassword = Hash::make($request->password);
    if ($request->role == 'customer') {
      $result = CustomerModels::create([
        'user_id' => $uuid,
        'fullname' => $request->fullname,
        'email' => $request->email,
        'phone' => $request->phone,
        'created_at' => $now,
      ]);
    } elseif ($request->role == 'vendor') {
      $result = VendorModels::create([
        'vendor_id' => $uuid,
        'fullname' => $request->fullname,
        'email' => $request->email,
        'phone' => $request->phone,
        'created_at' => $now,
      ]);
    }
    if ($result) {
      User::create([
        'user_id' => $uuid,
        'fullname' => $request->fullname,
        'username' => $request->username,
        'password' => $hashedPassword,
        'role' => $request->role,
        'created_at' => $now,
      ]);
      return redirect()->route('user.index')->with('success', 'berhasil menambahkan 1 user');
    }
    return back()->with('error', 'Maaf!, Inputan tidak boleh kosong')->withInput(old('role'));
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
    $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
    if (!$user) {
      $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
    }
    $data = User::find($id);
    $rolesToExclude = ['customer'];
    $role = RoleModels::whereNotIn('role', $rolesToExclude)->get();
    return view('master_user.update', [
      'title' => 'Update Data',
      'modul' => 'Master User',
      'route' => 'user',
      'data' => $data,
      'role' => $role,
      'user' =>  $user,
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $data = User::find($id);
    $validatedData = $request->validate([
      'username' => 'required',
    ]);
    $now = now();
    if ($request->password == null) {
      $validatedData['password'] = $data->password;
    } else {
      $validatedData['password'] = $request->password;
    }
    $validatedData['updated_at'] = $now;
    User::where('id', $id)
      ->update($validatedData);
    return redirect()->route('user.index')->with('success', 'Berhasil mengubah data user');
    return back()->with('error', 'Maaf!, Inputan tidak boleh kosong')->withInput(old('username'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    DB::transaction(function () use ($id) {
      User::where('user_id', $id)->delete();
      CustomerModels::where('user_id', $id)->delete();
      VendorModels::where('vendor_id', $id)->delete();
    });
    return redirect()->route('user.index')->with('success', '1 Data user berhasil dihapus');
  }
}
