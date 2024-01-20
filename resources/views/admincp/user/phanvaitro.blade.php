@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container-fluid">
    <!-- Tiêu đề -->
    <div class="card-header">
        <center>
        <h3><b>Username: {{$user->name}}</b></h3>
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
                <div class="card-header">Thêm vai trò</div>
                <div class="card-body">
                    <form action="{{url('insert-role')}}" method="post">
                        @csrf
                        <table class="table table-striped table-dark">
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{old('role')}}" name="role" aria-describedby="emailHelp" placeholder="Tên vai trò ...">
                                    </div>
                                    <div class="form-group">
                                        <input style="margin-top:10px" type="submit" name="insertrols" value="Thêm vai trò" class="btn btn-primary">
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
                <div class="card-header">Cấp vai trò cho user:</div>
                <div class="card-body">
                    <form action="{{url('/insert_roles',[$user->id])}}" method="post">
                        @csrf
                        <table class="table table-striped table-dark">
                            <tr>
                                <td>
                                    @foreach($role as $key => $r)
                                        @if(isset($all_column_roles))
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role" id="{{$r->id}}" value="{{$r->name}}" {{$r->id==$all_column_roles->id ? 'checked' : ''}}>
                                            <label class="form-check-label" for="{{$r->id}}">{{$r->name}}</label>
                                        </div>
                                        @else
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="role" id="{{$r->id}}" value="{{$r->name}}">
                                            <label class="form-check-label" for="{{$r->id}}">{{$r->name}}</label>
                                        </div>
                                        @endif
                                    @endforeach
                                    <div class="form-group">
                                        <input style="margin-top:10px" type="submit" name="insertroles" value="Cấp vai trò cho user" class="btn btn-primary">
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
