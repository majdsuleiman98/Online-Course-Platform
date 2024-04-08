<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Course;
use App\Models\Learning;
use Stripe;
use Auth;
class CardController extends Controller
{
    public function showCart()
    {
        if(session()->has('cart'))
        {
            $cart=new Cart(session()->get('cart'));
        }
        else {
            $cart=null;
        }
        return view('cart',compact('cart'));
    }
    public function addToCart(Course $course)
    {
        if(session()->has('cart')) {
            $cart=new Cart(session()->get('cart'));
        }
        else {
            $cart=new Cart();
        }
        $cart->add($course);
        session()->put('cart',$cart);
        $notification = array(
            'message_id' => 'Course has been Added To Cart Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function removefromCart(Course $course)
    {
        $cart=new Cart(session()->get('cart'));
        $cart->remove($course->id);
        if($cart->totalQty<=0)
        {
            session()->forget('cart');
        }
        else
        {
            session()->put('cart',$cart);
        }
        $notification = array(
			'message_id' => 'Course has been removed from cart Successfully',
			'alert-type' => 'success'
		);
        return redirect()->back()->with($notification);
    }


    public function show_payment_page()
    {
        if(session()->has('cart'))
        {
            $cart=new Cart(session()->get('cart'));
        }
        else {
            $cart=null;
        }
        return view("payment",compact("cart"));
    }
    public function checkout(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
        'amount'=>($request->total_price)*100,
        'currency'=>'USD',
        'source'=>$request->stripeToken,
        'description'=>"test payment from username : ".Auth::user()->name." - userID : ".Auth::user()->id
        ]);
        foreach($request->course_id as $index => $course) {
            Learning::create([
                'user_id'=>$request->user_id,
                'course_id'=>$request->course_id[$index],
                ]);
            }
        session()->forget('cart');
        $notification = array(
			'message_id' => 'You have new Courses',
	        'alert-type' => 'success'
		);
        return redirect()->route('my-courses')->with($notification);
    }
}
