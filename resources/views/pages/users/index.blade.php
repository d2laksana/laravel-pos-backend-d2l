@extends('layouts.app')


@section('title', 'Users')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/ionicons201/css/ionicons.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Users</h1>
                <a href="{{ route('users.create') }}" class="btn btn-primary ml-4">
                    <i class="ion ion-plus-round" data-pack="default" data-tags="add, include, new, invite, +"></i>
                    <span class="ml-2">Add Users</span>
                </a>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Users</div>
                </div>
            </div>

            <div class="section-body">
                @include('layouts.alert')
                <h2 class="section-title">Users</h2>

                <div class="card">
                    <div class="card-header">
                        <h4>All Users</h4>
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
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->role == 'admin')
                                                <div class="badge badge-success">{{ Str::ucfirst($user->role) }}</div>
                                            @else
                                                <div class="badge badge-primary">{{ Str::ucfirst($user->role) }}</div>
                                            @endif
                                        </td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href='{{ route('users.edit', $user->id) }}'
                                                    class="btn btn-sm btn-info btn-icon">
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </a>

                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    class="ml-2">
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    <button class="btn btn-sm btn-danger btn-icon confirm-delete">
                                                        <i class="fas fa-times"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="float-right">
                                {{ $users->links() }}
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
