<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Payment\Gateway;
use App\Models\Payment\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $myGateWays = Gateway::select('id')->where('user_id',Auth::id())->where('status',1)->get()->toArray();

        $payments = Payment::whereIn('gateway_id',$myGateWays)->paginate(50);

        return view('dashboard.payment.index',compact('payments'));
    }
}
