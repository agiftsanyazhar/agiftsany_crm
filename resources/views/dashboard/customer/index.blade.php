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
                                <th>{{ __('Customer Name') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $customer->lead->name }}</td>
                                    <td>
                                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
                                            <a href="{{ route('dashboard.customer.show', $customer->lead->id) }}" class="btn btn-primary text-white" title="Show">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                        @endif
                                        {{-- @if (Auth::user()->role == 'admin' || Auth::user()->role == 'manager')
                                            <form action="{{ route('dashboard.project.update-status', $customer->id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-success" title="Complete" name="status" value="Completed">
                                                    <i class="fas fa-check"></i> Complete
                                                </button>
                                                <button type="submit" class="btn btn-danger" title="Cancel" name="status" value="Canceled">
                                                    <i class="fas fa-times"></i> Cancel
                                                </button>
                                            </form>
                                        @endif --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
