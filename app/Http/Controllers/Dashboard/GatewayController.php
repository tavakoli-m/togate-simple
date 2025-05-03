<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Gateway\StoreGatewayRequest;
use App\Http\Requests\Dashboard\Gateway\UpdateGatewayRequest;
use App\Mail\SendGatewayApiKeyMail;
use App\Models\Payment\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class GatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gateways = Gateway::where('user_id',Auth::id())->where('status',1)->paginate(20);

        return view('dashboard.gateway.index',compact('gateways'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.gateway.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGatewayRequest $request)
    {
        $inputs = $request->validated();

        $api_key = str()->random(65);

        $inputs['api_key'] = $api_key;

        $inputs['user_id'] = Auth::id();
        
        $inputs['allowed_ips'] = explode(' ',$inputs['allowed_ips'] ?? '');

        $gateway = Gateway::create($inputs);

        Mail::to(Auth::user()->email)->queue(new SendGatewayApiKeyMail($gateway));

        return to_route('dashboard.gateway.index')->with('swal-success','درگاه با موفقیت ساخته شد واطلاعات ان به ایمیل شما ارسال شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gateway $gateway)
    {
        return view('dashboard.gateway.edit',compact('gateway'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGatewayRequest $request, Gateway $gateway)
    {
        $inputs = $request->validated();

        $inputs['allowed_ips'] = explode(' ',$inputs['allowed_ips'] ?? '');

        $gateway->update($inputs);

        return to_route('dashboard.gateway.index')->with('swal-success','درگاه با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gateway $gateway)
    {
        $gateway->update(['status' => 2]);

        return back()->with('swal-success','عملیات حذف درگاه پرداخت با موفقیت انجام شد');
    }
}
