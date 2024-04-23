<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModels;
use App\Models\VendorModels;
use App\Models\ProductModels;
use App\Models\CategoryModels;
use App\Models\DetailProductsImages;

class DetailProducts extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        if ($search || $status) {
            $data = DetailProductsImages::select(
                'detail_product_images.*',
                'master_product.product as product_name',
                'detail_product_images.id as brosur_id',
            )
                ->leftJoin('master_product', 'detail_product_images.code_product', '=', 'master_product.code_product')
                ->where(function ($query) use ($search) {
                    $query->where('detail_product_images.code_product', 'like', '%' . $search . '%')
                        ->orWhere('master_product.product', 'like', '%' . $search . '%');
                })
                ->when($status, function ($query, $status) {
                    return $query->where('detail_product_images.status', '=', $status);
                })
                ->orderBy('detail_product_images.created_at', 'desc')
                ->paginate(10);
        } else {
            $data = DetailProductsImages::select(
                'detail_product_images.*',
                'master_product.product as product_name',
                'detail_product_images.id as brosur_id',
            )
                ->leftJoin('master_product', 'detail_product_images.code_product', '=', 'master_product.code_product')
                ->orderBy('detail_product_images.created_at', 'desc')
                ->paginate(10);
        }
        $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
        if (!$user) {
            $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
        }
        $category = CategoryModels::all();
        return view('detail_products.index', [
            'title' => 'Brosur Produk',
            'modul' => 'Detail Products',
            'route' => 'gallery-list',
            'data' => $data,
            'params' => $search,
            'category' => $category,
            'user' => $user,
            'status' => $status,
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
        $product = ProductModels::all();
        $category = CategoryModels::all();
        return view('detail_products.create', [
            'title' => 'Tambah Data',
            'modul' => 'Detail Products',
            'route' => 'gallery-list',
            'product' => $product,
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
            'status' => 'required',
            'images' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Pastikan file gambar telah diunggah
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $validatedData['images'] = base64_encode(file_get_contents($image->path()));
        }

        // Tambahkan remark ke dalam data yang divalidasi
        $validatedData['created_by'] = auth()->user()->fullname;

        // Buat objek Model dan simpan ke dalam database
        $result = DetailProductsImages::create($validatedData);
        if ($result) {
            return redirect()->route('gallery-list.index')->with('success', '1 Produk berhasil ditambahkan');
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
        $product = ProductModels::all();
        $data = DetailProductsImages::find($id);
        return view('detail_products.update', [
            'title' => 'Ubah Data',
            'modul' => 'Detail Products',
            'route' => 'gallery-list',
            'data' => $data,
            'product' => $product,
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
            'status' => 'required',
            'images' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Pastikan file gambar telah diunggah
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $validatedData['images'] = base64_encode(file_get_contents($image->path()));
        }

        // Tambahkan remark ke dalam data yang divalidasi
        $validatedData['created_by'] = auth()->user()->fullname;

        // Buat objek Model dan simpan ke dalam database
        $result = DetailProductsImages::where('id', $id)->update($validatedData);
        if ($result) {
            return redirect()->route('gallery-list.index')->with('success', '1 Produk berhasil diubah');
        }

        return back()->with('error', 'Maaf!, Inputan tidak boleh kosong')->withInput($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = DetailProductsImages::find($id);
        $data->delete();
        return redirect()->route('gallery-list.index')->with('success', '1 Data produk berhasil dihapus');
    }
}
