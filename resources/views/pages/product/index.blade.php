@extends('layouts.app')


@section('title', 'Products')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/ionicons201/css/ionicons.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Products</h1>
                <a href="{{ route('products.create') }}" class="btn btn-primary ml-4">
                    <i class="ion ion-plus-round" data-pack="default" data-tags="add, include, new, invite, +"></i>
                    <span class="ml-2">Add Product</span>
                </a>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Product</div>
                </div>
            </div>

            <div class="section-body">
                @include('layouts.alert')
                <h2 class="section-title">Products</h2>

                <div class="card">
                    <div class="card-header">
                        <h4>All Product</h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table-striped table">
                                <tr>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($products as $item)
                                    {{-- @dd($item) --}}
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <img src="{{ asset('assets/images/' . $item->image) }}" alt="image"
                                                class="img-fluid" width="100">
                                        </td>
                                        <td>{{ Str::ucfirst($item->category_name) }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <td>Rp. {{ $item->price }}</td>
                                        <td>
                                            @if (Auth::user()->role == 'admin')
                                                <a href="{{ route('products.edit', $item->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <a href="#" class="btn btn-danger"
                                                    onclick="event.preventDefault(); document.getElementById('products-delete').submit()">Delete</a>
                                                <form action="{{ route('products.destroy', $item->id) }}" method="POST"
                                                    id="products-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @else
                                                <a href="#" class="btn btn-primary disabled">Edit</a>
                                                <a href="#" class="btn btn-danger disabled">Delete</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="float-right">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/components-table.js') }}"></script>
@endpush
