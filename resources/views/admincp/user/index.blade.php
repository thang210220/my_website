@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @php
                    $count = count($user);
                @endphp
                <div class="card-header">Danh sách User: {{$count}}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped table-dark" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên User</th>
                                <th>Email</th>
                                <th style="width: 100px">Vai trò (Role)</th>
                                <th>Quyền (Permission)</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $key => $u)
                            <tr>
                                <th style="font-size: 18px">{{ $key }}</th>
                                <th style="width: 200px; font-size: 18px">{{ $u->name }}</th>
                                <th style="width: 250px; font-size: 18px">{{ $u->email }}</th>
                                <th style="width: 100px">
                                    @foreach($u->roles as $key => $role)
                                        <h3 style="font-size: 18px">{{ $role->name }}</h3>
                                    @endforeach
                                </th>
                                <th style="width: 600px">
                                    @foreach($role->permissions as $key => $permission)
                                        <span class="badge text-bg-primary"  style="font-size: 18px">{{ $permission->name }}</span>
                                    @endforeach
                                </th>
                                <th>
                                    <a href="{{url('phan-vaitro/'.$u->id)}}" class="btn btn-success" style="width: 110px; margin-bottom: 10px;">Phân vai trò</a>
                                    <a href="{{url('phan-quyen/'.$u->id)}}" class="btn btn-info" style="width: 110px; margin-bottom: 10px;">Phân quyền</a>
                                    <a href="{{route('user.edit',[$u->id])}}" class="btn btn-primary" style="width: 110px; margin-bottom: 10px;">Edit</a>
                                    <form action="{{route('user.destroy',[$u->id])}}" method="post">
                                        @method ('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có muốn xóa không?');" class="btn btn-danger" style="width: 110px; margin-bottom: 10px;">Xóa</button>
                                    </form>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
