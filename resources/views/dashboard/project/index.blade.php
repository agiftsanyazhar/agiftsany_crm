@extends('layouts.dashboard.app')

@section('container')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $title }}</h3>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Customer') }}</th>
                                <th>{{ __('Project') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Status') }}</th>
                                @if (Auth::user()->role == 'manager')
                                    <th>
                                        {{ __('Action') }}
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $project->lead->name }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->description }}</td>
                                    <td>
                                        @if ($project->status == "pending")
                                            <span class="badge bg-warning">{{ ucwords($project->status) }}</span>
                                        @elseif ($project->status == "approved")
                                            <span class="badge bg-success">{{ ucwords($project->status) }}</span>
                                        @elseif ($project->status == "rejected")
                                            <span class="badge bg-danger">{{ ucwords($project->status) }}</span>
                                        @endif
                                    </td>
                                    @if (Auth::user()->role == 'manager')
                                        <td>
                                            @if ($project->status == 'pending')
                                                <form action="{{ route('dashboard.project.update-status', $project->id) }}" method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="submit" class="btn btn-success" title="Approve" name="status" value="approved">
                                                            <i class="bi bi-check-lg"></i>
                                                        </button>
                                                        <button type="submit" class="btn btn-danger" title="Reject" name="status" value="rejected">
                                                            <i class="bi bi-x-lg"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            @else
                                                
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
