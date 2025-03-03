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
            @if (Auth::user()->role == 'admin')
                <div class="card-header">
                    <h5 class="card-title">
                        <span>
                            <button type="button" class="btn btn-primary text-white" title="Add" data-bs-toggle="modal" data-bs-target="#modal-form"
                                onclick="openFormDialog('modal-form', 'add')"><i class="bi bi-plus-lg"></i></button>
                        </span>
                    </h5>
                </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Price') }}</th>
                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'customer')
                                    <th>
                                        {{ __('Action') }}
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                    @if (Auth::user()->role == 'admin')
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-warning text-white" title="Edit" data-bs-toggle="modal"
                                                    data-bs-target="#modal-form"
                                                    onclick="openFormDialog('modal-form', 'edit', '{{ $product->id }}', '{{ $product->name }}', '{{ $product->description }}', '{{ $product->price }}')">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" title="Delete"
                                                    onclick="deleteDialog('{{ route('dashboard.product.destroy', $product->id) }}')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </div>
                                        </td>
                                    @endif
                                    @if (Auth::user()->role == 'customer')
                                        <td>
                                            <form action="{{ route('dashboard.product.buy-product', $product->id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="submit" class="btn btn-success" title="Buy" name="product_id" value="{{ $product->id }}">
                                                        <i class="bi bi-cart"></i>
                                                    </button>
                                                </div>
                                            </form>
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

    <!-- Modal -->
    <div class="modal fade text-left" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content rounded shadow">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" id="form-modal" action="{{ route('dashboard.product.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label>Name<span class="text-danger fw-bold">*</span></label>
                                    <input class="form-control clear-after" type="hidden" name="id">
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>

                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label>Description<span class="text-danger fw-bold">*</span></label>
                                    <textarea class="form-control" rows="3" name="description" required></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label>Price<span class="text-danger fw-bold">*</span></label>
                                    <input type="number" class="form-control" name="price" required>
                                </div>
                            </div>

                            <span class="text-danger fw-bold">* Required</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Cancel</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1" onclick="saveForm()">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Save</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function saveForm() {
            const requiredInputs = [
                { name: 'name', label: 'Name' },
                { name: 'description', label: 'Description' },
                { name: 'price', label: 'Price' },
            ];

            let hasErrors = false;

            requiredInputs.forEach(input => {
                const inputField = document.querySelector(`input[name="${input.name}"], textarea[name="${input.name}"]`);
                if (inputField.value.trim() === '') {
                    alertDialog(input.name, input.label);
                    hasErrors = true;
                }
            });

            if (!hasErrors) {
                document.getElementById('form-modal').submit();
            }
        }

        function confirmDelete(deleteUrl) {
            const confirmed = window.confirm("Are you sure you want to delete this?");
            
            if (confirmed) {
                window.location.href = deleteUrl;
            }
        }
    </script>
    
    <script>
        function openFormDialog(target, type, id, name, description, price) {
            if (type === 'add') {
                $('#' + target + ' form').attr('action', '{{ route('dashboard.product.store') }}');
                $('#' + target + ' .form-control').val('');
                $('#' + target + ' input[name="name"]').attr('required', 'required');
                $('#' + target + ' textarea[name="description"]').attr('required', 'required');
                $('#' + target + ' input[name="price"]').attr('required', 'required');
            } else if (type === 'edit') {
                $('#' + target + ' .clear-after').val('');
                $('#' + target + ' form').attr('action', '{{ route('dashboard.product.update') }}');
                $('#' + target + ' .clear-after[name="id"]').val(id);
                $('#' + target + ' input[name="name"]').val(name);
                $('#' + target + ' textarea[name="description"]').val(description);
                $('#' + target + ' input[name="price"]').val(price);
            }
            $('#' + target).modal('toggle');
            $('#' + target).attr('data-operation-type', type);
        }
    </script>
@endsection
