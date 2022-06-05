@extends('layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Dodaj nową rezerwację
                        <a href="/admin/booking/" class="btn btn-success float-right">Wróć na poprzednią stronę</a></h6>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="text-primary text-danger">{{$error}}</p>
                        @endforeach
                    @endif
                    @if(Session::has('success'))
                        <p class="text-primary text-center">{{session('success')}}</p>
                    @endif
                    <div class="table-responsive">
                        <form method="post" enctype="multipart/form-data" action="/admin/booking">
                        @csrf
                        <table class="table table-bordered">
                            <tr>
                                <th>Wybierz klienta <span>*</span></th>
                                <td>
                                <select name="customer_id" class="form-control">
                                    <option>--- WYBIERZ KLIENTA ----</option>
                                    @foreach($data as $customer)
                                        <option value="{{$customer->id}}">{{$customer->full_name}}</option>


                                    @endforeach
                                </select>
                                </td>
                            </tr>
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
                                    <input type="hidden" name="roomprice" class="room-price" value="" >
                                    <input name='submit' type="submit" class="btn btn-primary"/>
                                </td>
                            </tr>
                        </table>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->





    </div>
    <!-- /.container-fluid -->
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
