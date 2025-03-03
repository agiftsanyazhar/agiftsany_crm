<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Lead;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin' || Auth::user()->role === 'manager') {
            $customers = Customer::distinct()->select('lead_id')->get();
        } else {
            $lead = Lead::where('user_id', Auth::user()->id)->first();
            $customers = Customer::distinct()->where('lead_id', $lead->id)->select('lead_id')->get();
        }

        $data = [
            'title' => 'Customers',
            'customers' => $customers,
        ];

        return view('dashboard.customer.index', $data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lead = Lead::findOrFail($id);
        $customers = Customer::where('lead_id', $lead->id)->get();

        $data = [
            'title' => 'Customer',
            'lead' => $lead,
            'customers' => $customers,
        ];

        return view('dashboard.customer.detail', $data);
    }
}
