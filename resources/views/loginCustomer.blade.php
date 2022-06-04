@extends('frontlayout')
@section('content')

    <div class="container my-4">
        <h3 class="m-3">Logowanie</h3>
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <p class="text-primary text-danger">{{$error}}</p>
            @endforeach
        @endif
        @if(Session::has('success'))
            <p class="text-primary text-center">{{session('success')}}</p>
        @endif
        @if(Session::has('fail'))
            <p class="text-primary text-danger">{{session('fail')}}</p>
        @endif
        <form method="POST" action="customer/login">
            @csrf
            <table class="table table-bordered">
                <tr>
                    <th>Email:<span> *</span></th>
                    <td><input required type="email" name="email" class="form-control"></td>
                </tr>
                <tr>
                    <th>Hasło:<span> *</span></th>
                    <td><input required type="password" name="password" class="form-control"></td>
                </tr>
                <tr>
                    <td colspan='2'><input  type="submit" class="btn btn-success"></td>
                </tr>
            </table>
        </form>
    </div>

@endsection
