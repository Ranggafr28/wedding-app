<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\RoleModels;
use App\Models\CustomerModels;
use App\Models\VendorModels;

class roleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $data = RoleModels::where('role', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        } else {
            $data = RoleModels::query()->orderBy('created_at', 'desc')->paginate(5);
        }

        $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
        if (!$user) {
            $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
        }
        return view('master_role.index', [
            'title' => 'Master Role',
            'modul' => 'Master Role',
            'route' => 'role',
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
        return view('master_role.create', [
            'title' => 'Tambah Data',
            'modul' => 'Master Role',
            'route' => 'role',
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role' => 'required',
        ]);
        RoleModels::create($validatedData);
        return redirect()->route('role.index')->with('success', 'Berhasil menambahkan 1 data role');
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
        $data = RoleModels::find($id);
        $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
        if (!$user) {
            $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
        }

        return view('master_role.update', [
            'title' => 'Ubah Data',
            'modul' => 'Master Role',
            'route' => 'role',
            'data' => $data,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'role' => 'required',
        ]);
        Carbon::setLocale('id');
        $validatedData['updated_at'] = Carbon::now();
        RoleModels::where('id', $id)
            ->update($validatedData);
        return redirect()->route('role.index')->with('update', 'Berhasil mengubah 1 data role');
        return back()->with('error', 'Maaf!, Inputan tidak boleh kosong')->withInput(old('role'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = RoleModels::find($id);
        $data->delete();
        return redirect()->route('role.index')->with('delete', 'Berhasil menghapus 1 data role');
    }
}
