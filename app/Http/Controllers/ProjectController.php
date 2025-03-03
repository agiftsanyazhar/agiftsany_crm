<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::whereHas('lead', function ($query) {
            $query->where('status', 'approved');
        })->get();

        $data = [
            'title' => 'Projects',
            'projects' => $projects,
        ];

        return view('dashboard.project.index', $data);
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $project = Project::where('id', $id)->firstOrFail();

            $newStatus = $request->input('status');

            if (!in_array($newStatus, ['pending', 'approved', 'rejected'])) {
                return redirect()->back()->with('error', 'Invalid status.');
            }

            $project->update(['status' => $newStatus]);

            $status = 'success';
            $message = 'Project status successfully updated.';
        } catch (Exception $e) {
            $status = 'error';
            $message = 'Failed to update status: ' . $e->getMessage();
        }

        return redirect()->back()->with($status, $message);
    }
}
