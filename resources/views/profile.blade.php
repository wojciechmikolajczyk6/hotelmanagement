@extends('frontlayout')
@section('content')


    @if(Session('data')[0]->active == '0')
        <script type="text/javascript">

            window.location.href = '/accountValidation';
        </script>
        @else

{{--{{dd(Session('data'))}}--}}
    @if(!Session('data'))
        <script type="text/javascript">
            window.location.href = '/login';
        </script>
        @endif
        @if(Session('data'))
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <div class="well">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <p class="text-primary text-danger">{{$error}}</p>
            @endforeach
        @endif
        @if(Session::has('success'))
            <p class="text-primary text-center">{{session('success')}}</p>
        @endif
        <ul class="nav nav-tabs">
            <li class="active"><a href="#home" data-toggle="tab">Profil</a></li>
            <li><a href="#profile" data-toggle="tab">Hasło</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane active in" id="home">
                    <form method="post" enctype="multipart/form-data" action="/admin/customers/{{$customer->id}}">
                        @csrf
                        @method('put')
                    <input type="hidden" name="customer_id" value="{{(session('data')[0]->id)}}">
                    <input type="hidden" name="ref" value="frontprofile">
                    <label>Adres e-mail</label>
                    <input name="email" type="email" value="{{$customer->email}}" class="input-xlarge">
                    <label>Imie i nazwisko</label>
                    <input name="full_name" type="text" value="{{$customer->full_name}}" class="input-xlarge">
                    <label>Numer telefonu</label>
                    <input name="phone" type="number" value="{{$customer->phone}}" class="input-xlarge">
                        <label>Zdjęcie</label>
                        <td><input type="file" name="photo" class="input-xlarge"/>
                            <input value="{{$customer->photo}}" type="hidden" name="last_photo"/>
                            <img src="{{ asset('storage/'.$customer->photo)}}" width="120px" height="120px" alt=""></td>
                    <br>
                    <br>
                    <label>Adres</label>
                    <textarea name="address" value="{{$customer->address}}" rows="3" class="input-xlarge">{{$customer->address}}</textarea>
                        <div>
                            <button class="btn btn-primary">Zmień dane</button>
                        </div>
            </div>
            <div class="tab-pane fade" id="profile">
                    <label>Zmiana hasla</label>
                    <input type="password" name="password" class="input-xlarge">
                    <div>
                        <button class="btn btn-primary">Zmień dane</button>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" id="dataTable" width="100" cellspacing="0">
            <thead>
            <tr>
                <th>Numer rezerwacji</th>
                <th>Numer pokoju</th>
                <th>Typ pokoju</th>
                <th>Data zameldowania</th>
                <th>Data wymeldowania</th>
            </tr>
            <tfoot>
            <tr>
                <th>Numer rezerwacji</th>
                <th>Numer pokoju</th>
                <th>Typ pokoju</th>
                <th>Data zameldowania</th>
                <th>Data wymeldowania</th>
            </tr>
            </tfoot>
            <tbody>
            <p>Lista rezerwacji:</p>
            <tr>
{{--              {{dd($customer->bookings)}}--}}
                @foreach($customer->bookings as $data)
                    <th>{{$data->id}}</th>
                    <th>{{$data->room->title ?? "Pokój usunięty z systemu."}}</th>
                    <th>{{$data->room->roomtype->title ?? "Pokój usunięty z systemu"}}</th>
                    <th>{{$data->checkin_date}}</th>
                    <th>{{$data->checkout_date}}</th></tr>
            @endforeach
            </tbody>
            </thead>
        </table>
@endif
@endsection
@endif

