<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModels;
use App\Models\VendorModels;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $data = CustomerModels::where('fullname', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $data = CustomerModels::query()->orderBy('created_at', 'desc')->paginate(10);
        }

        $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
        if (!$user) {
            $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
        }

        return view('admin.master_customer.index', [
            'title' => 'Master Customer',
            'modul' => 'Master Customer',
            'route' => 'customer',
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
