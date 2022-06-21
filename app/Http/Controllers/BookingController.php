<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Booking;
use MongoDB\Driver\Session;
use App\Models\RoomType;
use Carbon\Carbon;
use Twilio\Rest\Client;

//require 'vendor/autoload.php';
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        $bookings=Booking::all();
        return view('booking.index', ['data' => $bookings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=Customer::all();
        return view('booking.create', ['data'=>$data]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'room_id' => 'required',
            'checkin_date' => 'required',
            'checkout_date' => 'required',
            'adults' => 'required',
            'roomprice' => 'required',
        ]);

        $todayDate = date('Y-m-d');
        $DateFormat = Carbon::createFromFormat('Y-m-d', $todayDate);

        $checkindate=Carbon::createFromFormat('Y-m-d', $request->checkin_date);
        $checkoutdate = Carbon::createFromFormat('Y-m-d', $request->checkout_date);
        $result = $checkindate->lt($checkoutdate);
        if($DateFormat->gt($checkindate)){
            if($request->ref == 'frontbooking'){
            return redirect ('/booking')->with('failed','nieprawidlowa data zameldowania');}
            else {
                return redirect ('/admin/booking/create')->with('failed','nieprawidlowa data zameldowania');
            }
        }
        if($DateFormat->gt($checkoutdate)){
            if($request->ref == 'frontbooking'){
            return redirect ('/booking')->with('failed','nieprawidlowa data wymeldowania');}
            else {
                return redirect ('/admin/booking/create')->with('failed','nieprawidlowa data wymeldowania');
            }
        }
        if($checkindate->eq($checkoutdate)){
            if($request->ref == 'frontbooking'){
            return redirect ('/booking')->with('failed','Data zameldowania nie moze byc taka sama jak wymeldowanoa');}
            else {
                return redirect ('/admin/booking/create')->with('failed','Data zameldowania nie moze byc taka sama jak wymeldowanoa');
            }
        }
        if($result == false){
            if($request->ref == 'frontbooking'){
            return redirect ('/booking')->with('failed','Nieprawidlowa data. Nie jest mozliwe wymeldowanie sie przed meldunkiem');}
            else{
                return redirect ('/admin/booking/create')->with('failed','Nieprawidlowa data. Nie jest mozliwe wymeldowanie sie przed meldunkiem');}

        }

        $totalDays = $checkoutdate->diffInDays($checkindate);

        if($request->payment_method == 'cash'){

        }



        if($request->ref == 'frontbooking'){
        $bookingSession = [
            'customer_id' => $request->customer_id,
            'room_id' => $request->room_id,
            'checkin_date' => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
            'adults' => $request->adults,
            'children' => $request->children,
            'roomprice' => $request->roomprice,
            'payment_method' => $request->payment_method
        ];
        session($bookingSession);
        // Cash payment in hotel.
        if($request->payment_method == 'cash'){
            $data=new Booking;
            $data->customer_id = session('data')[0]->id;
            $data->room_id = session('room_id');
            $data->checkin_date = session('checkin_date');
            $data->checkout_date = session('checkout_date');
            $data->adults = session('adults');
            $data->children = session('children');
            $data->payment_method = session('payment_method');
            $data->total_cash = $totalDays * session('roomprice');

            $data->save();
            return view('booking.success');

        }


            $request->session([

            ]);
            \Stripe\Stripe::setApiKey('sk_test_51L4krXBeFTh5SNhT6srv4WD9rxn1OBQuFJ5rBcSoC9pFQaAN1EahUiYinYRrM0zv0h9LkKZmzJMahCYYjrKZM3rQ00ASZUevGj');


            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'pln',
                        'product_data' => [
                            'name' => 'room',
                        ],
                        'unit_amount' => $request->roomprice * 100 * $totalDays,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => 'http://hotel21062022.herokuapp.com/booking/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'http://hotel21062022.herokuapp.com/booking/fail',
              //  'success_url' => 'http://127.0.0.1:8000/booking/success?session_id={CHECKOUT_SESSION_ID}',
            //    'cancel_url' => 'http://127.0.0.1:8000/booking/fail',
            ]);
            return redirect($session->url);

        }else {
            $data=new Booking;
            $data->customer_id = $request->customer_id;
            $data->room_id = $request->room_id;
            $data->checkin_date = $request->checkin_date;
            $data->checkout_date = $request->checkout_date;
            $data->adults = $request->adults;
            $data->children = $request->children;
            $data->total_cash = $totalDays * session('roomprice');
            $data->save();
            return redirect ('admin/booking/create')->with('success','rezerwacja została utworzona');
        }


        \Stripe\Stripe::setApiKey('sk_test_51L4krXBeFTh5SNhT6srv4WD9rxn1OBQuFJ5rBcSoC9pFQaAN1EahUiYinYRrM0zv0h9LkKZmzJMahCYYjrKZM3rQ00ASZUevGj');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('bookings')->where('id', $id)->delete();

        return redirect ('/admin/booking/')->with('success', 'rezerwacja usunieta.');
    }
    //Check available rooms

    public function available_rooms(Request $request, $checkindate){
        $split_date =explode('|', $checkindate, 2);
        $checkin = $split_date[0];
        $checkout = $split_date[1];

        //$arooms=DB::SELECT("SELECT * FROM rooms WHERE id NOT IN (SELECT room_id FROM bookings WHERE
        //        ('$checkout' BETWEEN '$checkin' and '$checkout') and ('$checkin' BETWEEN '$checkin' and '$checkout' ))");
        $arooms=DB::SELECT("SELECT * FROM rooms WHERE id NOT IN (SELECT room_id FROM bookings WHERE
                '$checkin' BETWEEN checkin_date and checkout_date and '$checkout' BETWEEN checkin_date and checkout_date)");
        $data=[];
        foreach($arooms as $room){
            $roomTypes=RoomType::find($room->room_type_id);
            $data[]=['room'=>$room, 'roomtype'=>$roomTypes];

        }

        //return response()->json($checkin);
        //return response()->json($checkout);


        return response()->json(['data'=>$data]);

    }

    public function customerbooking()
    {

        return view('booking-form');

    }

    function booking_payment_success(Request $request){
        \Stripe\Stripe::setApiKey('sk_test_51L4krXBeFTh5SNhT6srv4WD9rxn1OBQuFJ5rBcSoC9pFQaAN1EahUiYinYRrM0zv0h9LkKZmzJMahCYYjrKZM3rQ00ASZUevGj');
        $session=\Stripe\Checkout\Session::retrieve($request->get('session_id'));
        $customer=\Stripe\Customer::retrieve($session->customer);
        if($session->payment_status == 'paid'){
            $data=new Booking;
            $data->customer_id = session('data')[0]->id;
            $data->room_id = session('room_id');
            $data->checkin_date = session('checkin_date');
            $data->checkout_date = session('checkout_date');
            $data->adults = session('adults');
            $data->children = session('children');
            $data->save();
            $message="Rezerwacja pokoju ". session('room_id'). " potwierdzona. Data zameldowania: ".session('checkin_date').", data wymeldowania: ". session('checkout_date');


//            $recipients = '+48519426851';
//            $this->sendMessage($message, '+48519426851');
            return view('booking.success');

        }
    }
    function booking_payment_fail(Request $request){
        return view('booking.failed');
    }
    //Annulation of reservation by client in the profile pannel.
    public function destroy_front($id){
        DB::table('bookings')->where('id', $id)->delete();

        return redirect ('/profile/'.Session('data')[0]->id)->with('success', 'rezerwacja usunieta.');

    }


//    private function sendMessage($message, $recipients)
//    {
//        $account_sid = getenv("TWILIO_SID");
//        $auth_token = getenv("TWILIO_AUTH_TOKEN");
//        $twilio_number = getenv("TWILIO_NUMBER");
//        $client = new Client($account_sid, $auth_token);
//        $client->messages->create($recipients,
//            ['from' => $twilio_number, 'body' => $message] );
//
//    }

}
