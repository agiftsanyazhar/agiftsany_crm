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
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Address') }}</th>
                                <th>{{ __('Status') }}</th>
                                @if (Auth::user()->role == 'manager')
                                    <th>
                                        {{ __('Action') }}
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leads as $lead)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $lead->name }}</td>
                                    <td>{{ $lead->email }}</td>
                                    <td>{{ $lead->phone }}</td>
                                    <td>{{ $lead->address }}</td>
                                    <td>
                                        @if ($lead->status == "pending")
                                            <span class="badge bg-warning">{{ ucwords($lead->status) }}</span>
                                        @elseif ($lead->status == "approved")
                                            <span class="badge bg-success">{{ ucwords($lead->status) }}</span>
                                        @elseif ($lead->status == "rejected")
                                            <span class="badge bg-danger">{{ ucwords($lead->status) }}</span>
                                        @endif
                                    </td>
                                    @if (Auth::user()->role == 'manager')
                                        <td>
                                            @if ($lead->status == 'pending')
                                                <form action="{{ route('dashboard.lead.update-status', $lead->id) }}" method="POST">
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
