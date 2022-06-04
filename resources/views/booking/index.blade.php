@extends('layout')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"> Wszystkie rezerwacje:
        <a href="/admin/booking/create" class="float-right btn btn-success btn-sm"> Dodaj nową rezerwację</a>
        </h6>
    </div>
    <div class="card-body">
        @if(Session::has('success'))
            <p class="text-success"> {{session('success')}}</p>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Klient</th>
                    <th>Numer pokoju</th>
                    <th>Typ pokoju</th>
                    <th>Data zameldowania</th>
                    <th>Data wymeldowania</th>
                    <th>Akcja</th>
                </tr>
                <tfoot>
                <tr>
                    <th>#</th>
                    <th>Klient</th>
                    <th>Numer pokoju</th>
                    <th>Typ pokoju</th>
                    <th>Data zameldowania</th>
                    <th>Data wymeldowania</th>
                    <th>akcja</th>
                </tr>
                </tfoot>
                <tbody>
                <tr>
                @foreach($data as $booking)
                    <th>{{$booking->id}}</th>
                    <th>{{$booking->customer->full_name}}</th>
                    <th>{{$booking->room->title}}</th>
                    <th>{{$booking->room->roomtype->title}}</th>
                    <th>{{$booking->checkin_date}}</th>
                    <th>{{$booking->checkout_date}}</th>
                    <th><a href="/admin/booking/{{$booking->id}}/delete" onclick="return confirm('Jestes pewny ze chcesz usunac rezerwacje?')"><i class="fa fa-trash"</a> </th>
                </tr>
                @endforeach
                </tbody>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
