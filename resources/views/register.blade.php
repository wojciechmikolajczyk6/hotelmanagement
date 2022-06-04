@extends('frontlayout')
@section('content')

    <div class="container my-4">
        <h3 class="m-3">Rejestracja</h3>
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <p class="text-primary text-danger">{{$error}}</p>
            @endforeach
        @endif
        @if(Session::has('success'))
            <p class="text-primary text-center">{{session('success')}}</p>
        @endif
        <form method="POST" action="admin/customers">
            @csrf
        <table class="table table-bordered">
        <tr>
            <th>Imie i nazwisko:<span> *</span></th>
            <td><input required type="text" name="full_name" class="form-control"></td>
        </tr>
            <tr>
                <th>Email:<span> *</span></th>
                <td><input required type="email" name="email" class="form-control"></td>
            </tr>
            <tr>
                <th>Hasło:<span> *</span></th>
                <td><input required type="password" name="password" class="form-control"></td>
            </tr>
            <tr>
                <th>Numer telefonu:<span> *</span></th>
                <td><input required type="number" name="phone" class="form-control"></td>
            </tr>
            <tr>
                <th>Adres:</th>
                <td><textarea name="address" class="form-control"></textarea></td>
            </tr>
            <tr>
                <input type="hidden" name="front" value="customer">
                <td colspan='2'><input  type="submit" class="btn btn-success"></td>
            </tr>
        </table>
        </form>
    </div>

@endsection
