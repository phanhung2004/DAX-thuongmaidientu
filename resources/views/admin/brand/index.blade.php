@extends('admin.layout')
@section('title', 'Danh sách Brand')
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
                                <h3 class="card-title">Danh sách Brand</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Name</th>
                                            <th>Logo</th>
                                            <th>
                                                <a href="{{ route('brand.create') }}" class="btn btn-primary">Thêm mới</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $stt => $brand)
                                            <tr>
                                                <td>{{ $stt + 1 }}</td>
                                                <td>{{ $brand->name }}</td>
                                                <td><img src="{{ asset('/storage/' . $brand->logo) }}" style="width: 80px; height: 80px;" alt=""></td>
                                                <td class="d-flex">
                                                        <a href="{{ route('brand.edit', $brand->id) }}"
                                                            class="btn btn-primary mr-1">Edit</a>
                                                        <form action="{{ route('brand.delete', $brand->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Bạn có muốn xóa không?')" class="btn btn-danger">Delete</button>
                                                        </form>
                                                </td>
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
