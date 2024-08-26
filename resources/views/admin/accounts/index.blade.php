@extends('admin.layout')
@section('title', 'Danh sách account')
@section('body')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách sản phẩm</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>FullName</th>
                                            <th>UserName</th>
                                            <th>Email</th>
                                            <th>active</th>
                                            <th>Role</th>
                                            <th>
                                                <a href="{{ route('createAccount') }}" class="btn btn-primary">Thêm
                                                    mới</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $stt => $user)
                                            <tr>
                                                <td>{{ $stt + 1 }}</td>
                                                <td>{{ $user->fullname }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if($user->role != 'admin')

                                                        @if ($user->active)
                                                            <form action="{{ route('users.updateStatus', $user->id) }}" method="post">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-success">Hoat Dong</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('users.updateStatus', $user->id) }}" method="post">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-warning">Ngung hoat dong</button>
                                                            </form>
                                                        @endif

                                                    @endif
                                                </td>
                                                <td>{{ $user->role }}</td>
                                                @if($user->role != 'admin')
                                                    <td class="d-flex">
                                                        <a href="{{ route('editAccount', $user->id) }}"
                                                            class="btn btn-primary mr-1">Edit</a>
                                                            <form action="{{ route('delete', $user->id) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" onclick="return confirm('Bạn có muốn xóa không?')" class="btn btn-danger">Delete</button>
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
                </div>
            </div>
        </section>
    </div>
@endsection
