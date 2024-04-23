<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ProductModels;
use App\Models\CustomerModels;
use App\Models\VendorModels;
use App\Models\CategoryModels;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $search = $request->input('search');
    if ($search) {
      $data = CategoryModels::where('category', 'like', '%' . $search . '%')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    } else {
      $data = CategoryModels::query()->orderBy('created_at', 'desc')->paginate(10);
    }
    $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
    if (!$user) {
      $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
    }
    return view('master_category.index', [
      'title' => 'Master Kategori',
      'modul' => 'Master Kategori',
      'route' => 'category',
      'data' => $data,
      'user' => $user,
      'params' => $search,
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
    $vendor = VendorModels::all();
    return view('master_category.create', [
      'title' => 'Tambah Data',
      'modul' => 'Master Kategori',
      'route' => 'category',
      'vendor' => $vendor,
      'user' => $user
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    Carbon::setLocale('id');
    $validatedData = $request->validate([
      'category' => 'required',
    ]);

    $validatedData['created_by'] = auth()->user()->fullname;
    $validatedData['created_date'] = Carbon::now();
    $validatedData['remark'] = $request->remark;
    $result = CategoryModels::create($validatedData);
    if ($result) {
      return redirect()->route('category.index')->with('success', 'Berhasil menambahkan 1 kategori baru');
    }

    return back()->with('error', 'Maaf!, Inputan tidak boleh kosong')->withInput($request->all());
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
    $data = CategoryModels::find($id);

    return view('master_category.update', [
      'title' => 'Ubah Data',
      'modul' => 'Master Kategori',
      'route' => 'category',
      'data' => $data,
      'user' => $user
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $validatedData = $request->validate([
      'category' => 'required',
    ]);
    // Tambahkan remark ke dalam data yang divalidasi
    $validatedData['remark'] = $request->remark;
    $result = CategoryModels::where('id', $id)
      ->update($validatedData);
    if ($result) {
      return redirect()->route('category.index')->with('update', 'Berhasil mengubah 1 data kategori');
    }

    return back()->with('error', 'Maaf!, Inputan tidak boleh kosong')->withInput($request->all());
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $data = CategoryModels::find($id);
    $data->delete();
    return redirect()->route('category.index')->with('delete', 'Berhasil menghapus 1 data kategori');
  }
}
