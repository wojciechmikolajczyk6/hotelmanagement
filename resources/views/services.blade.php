@extends('frontlayout')
@section('content')
    <div class="container my-4">
        <h1 class="text-center border-bottom">Usługi</h1>
        @foreach($services as $service)
            <div class="row my-4">
                <div class="col-md-4">
                    <a href="/service/{{$service->id}}"><img src="{{ asset('storage/'.$service->photo)}}" width="100%" class="img-thumbnail" alt ="..."></a>
                </div>
                <div class="col-md-8">
                    <h3>{{$service->title}}</h3>
                    <p>{{$service->desc}}</p>
                    <p>
                        <a href="/service/{{$service->id}}" class="btn btn-sm btn-primary">więcej informacji</a>
                    </p>
                </div>
            </div>
    @endforeach
@endsection
