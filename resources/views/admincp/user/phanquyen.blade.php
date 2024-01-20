@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container-fluid">
    <!-- Tiêu đề -->
    <div class="card-header">
        <center>
        <h3><b>Username: {{$user->name}}</b></h3>
        @if(isset($name_roles))
        <h4>Vai trò hiện tại: {{$name_roles}}</h4>
        @endif
        </center>
    </div><br>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card-header">Thêm quyền</div>
                <div class="card-body">
                    <form action="{{url('insert-permission')}}" method="post">
                        @csrf
                        <table class="table table-striped table-dark">
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{old('permission')}}" name="permission" aria-describedby="emailHelp" placeholder="Tên quyền ...">
                                    </div>
                                    <div class="form-group">
                                        <input style="margin-top:10px" type="submit" name="insertpers" value="Thêm quyền" class="btn btn-primary">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Cấp quyền cho vai trò:</div>
                <div class="card-body">
                    <form action="{{url('/insert_permission',[$user->id])}}" method="post">
                        @csrf
                        <table class="table table-striped table-dark">
                            <tr>
                                <td>
                                    <div style="margin-top:10px" class="form-group">
                                        @foreach($permission as $key => $per)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="permission[]" value="{{$per->id}}" id="{{$per->id}}"
                                                @foreach($get_permission_via_role as $key => $get)
                                                    @if($get->id == $per->id)
                                                        checked
                                                    @endif
                                                @endforeach
                                            >
                                            <label class="form-check-label" for="{{$per->id}}">
                                                {{$per->name}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <input style="margin-top:10px" type="submit" name="insertroles" value="Cấp quyền cho user" class="btn btn-primary">
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
