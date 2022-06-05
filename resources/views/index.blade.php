
@if(Session('data'))
@if(Session('data')[0]->active == 0)
    <script type="text/javascript">

        window.location.href = '/accountValidation';
    </script>
    @endif
    @endif

@extends('frontlayout')
@section('content')




{{--        service section--}}
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
{{--    <div class="row my-4">--}}
{{--        <div class="col-md-4">--}}
{{--            <img src="/img/room.jpg" class="img-thumbnail" alt ="...">--}}
{{--        </div>--}}
{{--        <div class="col-md-8">--}}
{{--            <h3>Naglowek uslug</h3>--}}
{{--            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et--}}
{{--                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip--}}
{{--                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu--}}
{{--                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia--}}
{{--                deserunt mollit anim id est laborum."</p>--}}
{{--            <p>--}}
{{--                <a href="#" class="btn btn-sm btn-primary">Read more</a>--}}
{{--            </p>--}}
{{--        </div>--}}
{{--    </div>--}}

</div>

{{--        service section ends--}}
{{-- Gallery section--}}
<div class="container my-4">
    <h1 class="text-center border-bottom">Galeria</h1>
    <div class="row my-4">
        @foreach ($roomtypes as $roomtype)
        <div class="col-md-3 ">
            <div class="card">
                <h5 class="card-header text-center">{{$roomtype->title}}</h5>
                <div class="card-body">
                    @foreach($roomtype->roomimgs as $index => $img)
                        <td>

                        <a href="{{ asset('storage/'.$img->image_path)}}" data-lightbox="{{$roomtype->id}}">
                            @if($index > 0)
                            <img class="img-fluid hide" src="{{ asset('storage/'.$img->image_path)}}"/></a>
                            @else
                                <img class="img-fluid" src="{{ asset('storage/'.$img->image_path)}}"/></a>
                                @endif

                        </td>
                    @endforeach

                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
{{--gallery section ends--}}


@endsection

