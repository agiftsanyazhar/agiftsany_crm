<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Exception;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::all();

        $data = [
            'title' => 'Leads',
            'leads' => $leads,
        ];

        return view('dashboard.lead.index', $data);
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $lead = Lead::where('id', $id)->firstOrFail();

            $newStatus = $request->input('status');

            if (!in_array($newStatus, ['pending', 'approved', 'rejected'])) {
                return redirect()->back()->with('error', 'Invalid status.');
            }

            $lead->update(['status' => $newStatus]);

            $status = 'success';
            $message = 'Lead status successfully updated.';
        } catch (Exception $e) {
            $status = 'error';
            $message = 'Failed to update status: ' . $e->getMessage();
        }

        return redirect()->back()->with($status, $message);
    }
}
