<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModels;
use App\Models\VendorModels;
use App\Models\TransactionModels;
use App\Models\TransactionPayment;
use App\Models\CheckoutProducts;
use App\Models\TransactionApproval;
use Carbon\Carbon;

class TransactionAdmin extends Controller
{
    public function transactionList()
    {

        $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
        if (!$user) {
            $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
        }
        $data = TransactionModels::leftJoin('master_customer', 'transaction.customer_id', '=', 'master_customer.user_id')
            ->orderBy('transaction.no_trans', 'DESC')
            ->paginate(10);
        return view('admin.master_transaction.transactionList', [
            'title' => 'List Transaksi',
            'modul' => 'Transaksi Approval',
            'route' => 'transactionList',
            'user' => $user,
            'data' => $data,
        ]);
    }

    public function transactionDetail($no_trans)
    {
        $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
        if (!$user) {
            $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
        }
        // ambil data transaksi
        $transactions = TransactionModels::Where('no_trans', $no_trans)->first();
        // ambil data costumer
        $customer = CustomerModels::Where('user_id', $transactions->customer_id)->first();
        // ambil data tagihan costumer per nomor transaksi
        $bills = TransactionPayment::Where('no_trans', $no_trans)->get();
        // ambil data produk yang dibeli
        $products = CheckoutProducts::where('no_trans', $no_trans)
            ->join('master_product', 'checkout_products.code_product', '=', 'master_product.code_product')
            ->get();
        // Mengumpulkan id vendr dari setiap produk
        $vendorIds = $products->pluck('vendor_id')->unique()->toArray();
        // Mengambil vendor berdasarkan vendor_id yang terkumpul
        $vendor = VendorModels::whereIn('master_vendor.vendor_id', $vendorIds)
            ->leftJoin('transaction_approval', 'master_vendor.vendor_id', '=', 'transaction_approval.vendor_id')
            ->get();

        // mengkalkulasi selisih hari dengan tanggal acara
        $currentDate = Carbon::now();
        $dataDate = Carbon::createFromFormat('Y-m-d', $transactions->event_date);
        $diffInDays = $currentDate->diffInDays($dataDate, false);

        return view('admin.master_transaction.transactionDetail', [
            'title' => 'Transaksi Detail',
            'modul' => 'Transaksi Detail',
            'route' => 'transactionDetail',
            'user' => $user,
            'transactions' => $transactions,
            'bills' => $bills,
            'products' => $products,
            'diffInDays' => $diffInDays,
            'vendor' => $vendor,
            'customer' => $customer,
            'no_trans' => $no_trans,
        ]);
    }

    public function transactionApproval()
    {
        $user = CustomerModels::where('user_id', auth()->user()->user_id)->first();
        if (!$user) {
            $user = VendorModels::where('vendor_id', auth()->user()->user_id)->first();
        }
        $data = TransactionModels::leftJoin('master_customer', 'transaction.customer_id', '=', 'master_customer.user_id')
            ->leftJoin('transaction_approval', 'transaction.no_trans', '=', 'transaction_approval.no_trans')
            ->where('transaction_approval.vendor_id', '=', auth()->user()->user_id)
            ->orderBy('transaction.no_trans', 'DESC')
            ->paginate(10);

        return view('admin.master_transaction.transactionApproval', [
            'title' => 'Persetujuan Transaksi',
            'modul' => 'Persetujuan Transaksi',
            'route' => 'transactionApproval',
            'user' => $user,
            'data' => $data,
        ]);
    }
    public function storeTransactionAprroval(Request $request, $no_trans)
    {
        $storeData = TransactionApproval::create([
            'no_trans' => $no_trans,
            'vendor_id' => $request->vendor_id,
            'created_at' => Carbon::now(),
        ]);
        if ($storeData) {
            return redirect()->route('transactionDetail', ['no_trans' => $no_trans])->with('success', 'Berhasil mengirimkan notifikasi');
        };
        return back();
    }
    public function approval(Request $request)
    {
        $storeData = TransactionApproval::where('no_trans', $request->no_trans)->where('vendor_id', auth()->user()->user_id)->update([
            'approve' => $request->approval,
            'updated_at' => Carbon::now(),
        ]);
        if ($storeData) {
            return redirect()->route('transactionApproval')->with('success', 'Berhasil memberikan respon');
        }
    }
}
