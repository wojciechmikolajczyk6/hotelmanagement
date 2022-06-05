@extends('frontlayout')
@section('content')

    @if(Session('data'))
        @if(Session('data')[0]->active == 0)
            <script type="text/javascript">

                window.location.href = '/accountValidation';
            </script>
        @endif
    @endif


    @if(Session::has('customerLogin'))
    <div class="container my-4">
        <h3 class="m-3">Rezerwacja pokoju</h3>
        <div class="card-body">
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="text-primary text-danger">{{$error}}</p>
                @endforeach
            @endif
                @if(Session::has('failed'))
                    <p class="text-danger text-center">{{session('failed')}}</p>
                @endif
            @if(Session::has('success'))
                <p class="text-primary text-center">{{session('success')}}</p>
            @endif
            <div class="table-responsive">
                <form method="post" enctype="multipart/form-data" action="/admin/booking">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>Data zameldowania <span>*</span></th>
                            <td><input type="date" name="checkin_date" class="form-control checkindate"/></td>
                        </tr>
                        <tr>
                            <th>Data wymeldowania <span>*</span></th>
                            <td><input type="date" name="checkout_date" class="form-control"/></td>
                        </tr>
                        <tr>
                            <th>Dostępne pokoje: <span>*</span></th>
                            <td>
                                <select name="room_id" class="form-control room-list">
                                    <option>--- Prosze wybrac date zameldowania ---</option>
                                </select>
                                <p>Cena: <span class="show-room-price">*</span> za dobę</p>
                            </td>
                        </tr>
                        <tr>
                            <th>Liczba osób dorosłych <span>*</span></th>
                            <td><input type="number" name="adults" class="form-control"/></td>
                        </tr>
                        <tr>
                            <th>Liczba dzieci <span>*</span></th>
                            <td><input type="number" name="children" class="form-control"/></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <input type="hidden" name="customer_id" value="{{(session('data')[0]->id)}}">
                                <input type="hidden" name="roomprice" class="room-price" value="" >
                                <input type="hidden" name="ref" value="frontbooking">
                                <input name='submit' type="submit" class="btn btn-primary"/>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    @else
        <p>Aby dokonać rezerwacji należy <a href="/login">zalogować</a> się na konto użytkownika</p>

    @endif

@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".checkindate").on('blur', function(){
                var _checkindate=$(this).val();
                console.log(_checkindate);
                $.ajax({
                    url: "/admin/booking/available-rooms/"+_checkindate,
                    dataType: 'json',
                    beforeSend:function(){
                        $(".room-list").html('<option>--- Prosze wybrac date zameldowania ---</option>');

                    },
                    success:function (res){
                        var _html='';
                        $.each(res.data, function(index,row){
                            _html+='<option data-price="'+row.roomtype.price+'" value="'+row.room.id+'">'+row.room.title+' - '+row.roomtype.title+'</option>';
                        });
                        $(".room-list").html(_html);


                        var _price = $(".room-list").find('option:selected').attr('data-price');
                        $(".room-price").val(_price);
                        $(".show-room-price").text(_price);

                    }
                });

            });
            $(document).on("change", ".room-list", function(){
                var _price = $(this).find('option:selected').attr('data-price');
                $(".room-price").val(_price);
                $(".show-room-price").text(_price);
            });

        });
    </script>
@endsection
