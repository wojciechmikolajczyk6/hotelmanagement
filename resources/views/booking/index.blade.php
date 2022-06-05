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
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    <th>{{$booking->customer->full_name ?? "Uzytkownik usunięty"}}</th>
                    <th>{{$booking->room->title ?? "Pokoj usuniety z systemu"}}</th>
                    <th>{{$booking->room->roomtype->title ?? "Pokój usunięty z systemu"}}</th>
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
</div>
@endsection
@section('scripts')

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/js/demo/datatables-demo.js"></script>
@endsection
