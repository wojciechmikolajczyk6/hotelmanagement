@extends('frontlayout')
@section('content')

    <div class="container my-4">
        <h3 class="m-3">{{$service->title}}</h3>
        <p>{{$service->full_desc}}</p>
        <p>Aktualnie nie ma mozliwosci zamowienia uslug na stronie internetowej, prosze udac sie do recepcji.</p>
    </div>

@endsection
