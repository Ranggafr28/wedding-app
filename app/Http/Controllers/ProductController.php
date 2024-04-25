<?php

namespace App\Http\Controllers;

use App\Models\CategoryModels;
use Illuminate\Http\Request;
use App\Models\ProductModels;
use App\Models\CustomerModels;
use App\Models\VendorModels;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $search = $request->input('search');
    $status = $request->input('status');
    $categoryFilter = $request->input('category');
    $data = ProductModels::selectRaw('master_product.*, master_vendor.fullname AS vendor_name, master_product.id AS product_id')
      ->leftJoin('master_vendor', 'master_product.vendor_id', '=', 'master_vendor.vendor_id');

    if ($search) {
      $data->where(function ($query) use ($search) {
        $query->where('master_product.code_product', 'like', '%' . $search . '%')
          ->orWhere('master_product.product', 'like', '%' . $search . '%');
      });
    }

    if ($status) {
      $data->where('master_product.status', $status);
    }

    if ($categoryFilter) {
      $data->where('master_product.category', $categoryFilter);
    }

    // Check if the user has the vendor role and filter data accordingly
    if (auth()->user()->role == 'vendor') {
      $data->where('master_product.vendor_id', auth()->user()->user_id);
    }

    $data = $data->orderBy('master_product.created_at', 'desc')->paginate(10);

    $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
    if (!$user) {
      $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
    }
    $category = CategoryModels::all();
    return view('master_product.index', [
      'title' => 'Master Produk',
      'modul' => 'Master Produk',
      'route' => 'product',
      'data' => $data,
      'params' => $search,
      'status' => $status,
      'categoryFilter' => $categoryFilter,
      'category' => $category,
      'user' => $user
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
    // jika role user vendor maka ambil data vendor user ini saja, jika bukan ambil semua data vendor
    $vendor = auth()->user()->role == 'vendor' ? VendorModels::where('vendor_id', auth()->user()->user_id)->get() : VendorModels::all();
    $category = CategoryModels::all();
    return view('master_product.create', [
      'title' => 'Tambah Data',
      'modul' => 'Master Produk',
      'route' => 'product',
      'vendor' => $vendor,
      'category' => $category,
      'user' => $user
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'code_product' => 'required',
      'product' => 'required',
      'price' => 'required',
      'vendor_id' => 'required',
      'category' => 'required',
      'type' => 'required',
      'status' => 'required',
      'picture' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Pastikan file gambar telah diunggah
    if ($request->hasFile('picture')) {
      $image = $request->file('picture');
      $validatedData['picture'] = base64_encode(file_get_contents($image->path()));
    }

    // Tambahkan remark ke dalam data yang divalidasi
    $validatedData['price'] = str_replace(["Rp.", "."], "", $request->price);
    $validatedData['remark'] = $request->remark;

    // Buat objek Model dan simpan ke dalam database
    $result = ProductModels::create($validatedData);
    if ($result) {
      return redirect()->route('product.index')->with('success', '1 Produk berhasil ditambahkan');
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
    $data = ProductModels::find($id);
    // jika role user vendor maka ambil data vendor user ini saja, jika bukan ambil semua data vendor
    $vendor = auth()->user()->role == 'vendor' ? VendorModels::where('vendor_id', auth()->user()->user_id)->get() : VendorModels::all();
    $category = CategoryModels::all();
    return view('master_product.update', [
      'title' => 'Ubah Data',
      'modul' => 'Master Produk',
      'route' => 'product',
      'data' => $data,
      'vendor' => $vendor,
      'category' => $category,
      'user' => $user
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $validatedData = $request->validate([
      'code_product' => 'required',
      'product' => 'required',
      'price' => 'required',
      'vendor_id' => 'required',
      'category' => 'required',
      'type' => 'required',
      'status' => 'required',
      'picture' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Pastikan file gambar telah diunggah
    if ($request->hasFile('picture')) {
      $image = $request->file('picture');
      $validatedData['picture'] = base64_encode(file_get_contents($image->path()));
    }
    $validatedData['price'] = str_replace(["Rp.", "."], "", $request->price);
    // Tambahkan remark ke dalam data yang divalidasi
    $validatedData['remark'] = $request->remark;
    $result = ProductModels::where('id', $id)
      ->update($validatedData);
    if ($result) {
      return redirect()->route('product.index')->with('success', '1 Data produk berhasil diubah');
    }

    return back()->with('error', 'Maaf!, Inputan tidak boleh kosong')->withInput($request->all());
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $data = ProductModels::find($id);
    $data->delete();
    return redirect()->route('product.index')->with('success', '1 Data produk berhasil dihapus');
  }
}
