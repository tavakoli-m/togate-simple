@extends('dashboard.layouts.master')

@section('head-tag')
<title>ساخت درگاه جدید</title>
@endsection

@section('content')
<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    ساخت درگاه جدید
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <a href="{{ route('dashboard.gateway.index') }}" class="btn btn-info btn-sm">بازگشت</a>
            </section>

            <section>

                <form action="{{ route('dashboard.gateway.store') }}" class="row" method="POST">
                    @csrf

                    <section class="col-12 col-md-6">
                        <div class="form-check">
                            <label for="name">نام</label>
                            <input type="name" name="name" id="name" class="form-control form-control-sm" value="{{ old('name') }}" />
                        </div>
                        <div class="mt-2">
                            @error('name')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                    </section>


                    <section class="col-12 col-md-6">
                        <div class="form-check">
                            <label for="min_settlement">حداقل مبلغ پرداخت (0 به معنای تسویه بعد از هر پرداخت)</label>
                            <input type="text" name="min_settlement" id="min_settlement" class="form-control form-control-sm" value="{{ old('min_settlement') }}" />
                        </div>
                        <div class="mt-2">
                            @error('min_settlement')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                    </section>


                    <section class="col-12">
                        <div class="form-check">
                            <label for="settlement_address">ادرس تسویه</label>
                            <input type="text" name="settlement_address" id="settlement_address" class="form-control form-control-sm" value="{{ old('settlement_address') }}" />
                        </div>
                        <div class="mt-2">
                            @error('settlement_address')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                    </section>



                    <section class="col-12">
                        <div class="form-check">
                            <label for="fee_method">روش پرداخت کارمزد</label>
                            <select name="fee_method" id="fee_method" class="form-control form-control-sm">
                                <option value="1">پرداخت کننده</option>
                                <option value="2">پذیرنده</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            @error('fee_method')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                    </section>


                    <section class="col-12">
                        <div class="form-check">
                            <label for="allowed_ips">IP های مجاز (با فاصله از هم جدا کنید)</label>
                            <input type="text" name="allowed_ips" id="allowed_ips" class="form-control form-control-sm" value="{{ old('allowed_ips') }}" />
                        </div>
                        <div class="mt-2">
                            @error('allowed_ips')
                            <span class="alert_required bg-danger text-white p-1 rounded" role="alert">
                                <strong>
                                    {{ $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                    </section>


                    <section class="col-12">
                        <button class="btn btn-primary btn-sm">ثبت</button>
                    </section>
            </section>
            </form>
        </section>

    </section>
</section>
</section>
@endsection