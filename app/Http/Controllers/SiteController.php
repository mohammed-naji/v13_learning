<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.index');
    }

    public function about()
    {
        return view('site.about');
    }

    public function courses()
    {
        $courses = Course::latest('id')->get();

        return view('site.courses', compact('courses'));
    }

    public function contact()
    {
        return view('site.contact');
    }

    public function course($id)
    {
        $course = Course::findOrFail($id);

        return view('site.course', compact('course'));
    }

    public function enroll($id)
    {
        $course = Course::findOrFail($id);

        $price = $course->price;

        // Prepare the checkout
        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
                    "&amount=" . $price.
                    "&currency=USD" .
                    "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $responseData = json_decode( $responseData, true );

        $id = $responseData['id'];

        return view('site.enroll', compact('course', 'id'));
    }

    public function payment(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $resourcePath = $request->resourcePath;

        $url = "https://eu-test.oppwa.com".$resourcePath;
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if(curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);



        $responseData = json_decode($responseData, true);

        $transaction_id = $responseData['id'];
        $code = $responseData['result']['code'];

        if($code == "000.100.110") {

            Auth::user()->courses()->attach($id);

            Payment::create([
                'transaction_id' => $transaction_id,
                'amount' => $course->price,
                'user_id' => Auth::id(),
                'course_id' => $course->id
            ]);

            $type = 'success';
            $msg = 'Payment Done Successfully';

            return view('site.status', compact('type', 'msg'));

        }else {
            $type = 'danger';
            $msg = 'Payment Failed';

            return view('site.status', compact('type', 'msg'));;
        }

    }

    public function review(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'rating' => 'required'
        ]);

        Review::create([
            'star' => $request->rating,
            'content' => $request->comment,
            'user_id' => Auth::id(),
            'course_id' => $id
        ]);

        return redirect()->back();
    }
}
