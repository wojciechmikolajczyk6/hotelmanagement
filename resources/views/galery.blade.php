@extends('frontlayout')
@section('content')

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
