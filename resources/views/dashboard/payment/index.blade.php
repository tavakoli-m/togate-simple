@extends('dashboard.layouts.master')

@section('head-tag')
<title>پرداخت ها</title>
@endsection

@section('content')
<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    پرداخت ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <section>
                    <a href="#" class="btn btn-info btn-sm disabled">ساخت پرداخت جدید</a>
                </section>

            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>کلید پرداخت</th>
                            <th>شناسه درگاه</th>
                            <th>روش پرداخت کارمزد</th>
                            <th>مبلغ</th>
                            <th>کارمزد</th>
                            <th>تاریخ انقضا</th>
                            <th>توضیحات</th>
                            <th>وضعیت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->token }}</td>
                            <td>{{ $payment->gateway->name }}</td>
                            <td>{{ $payment->fee_method === 1 ? 'پرداخت کننده' : 'پذیرنده' }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->fee_amount }}</td>
                            <td>{{ $payment->expired_at }}</td>
                            <td>{{ $payment->description ?? '-' }}</td>
                            <td>
                                @switch($payment->status)
                                    @case(1)
                                        در حال پردازش
                                    @break
                                    @case(2)
                                        کنسل شده
                                    @break
                                    @case(3)
                                        منقضی شده
                                    @break
                                    @case(4)
                                        پرداخت شده
                                    @break
                                @endswitch
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>


            <section style="overflow: auto">
                {{ $payments->links('pagination::bootstrap-4') }}
            </section>




        </section>
    </section>
</section>

@endsection