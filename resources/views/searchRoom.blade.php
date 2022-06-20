@extends('frontlayout')
@section('content')
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
                    <td colspan="4">
                        <input type="hidden" name="roomprice" class="room-price" value="" >
                        <input type="hidden" name="ref" value="frontbooking">
                        <input name='submit' type="submit" class="btn btn-primary"/>
                    </td>
                </tr>




@endsection
