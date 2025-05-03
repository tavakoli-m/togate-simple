@extends('dashboard.layouts.master')

@section('head-tag')
<title>درگاه ها</title>
@endsection

@section('content')
<section class="row">
    <section class="col-12">
        <section class="main-body-container">
            <section class="main-body-container-header">
                <h5>
                    درگاه ها
                </h5>
            </section>

            <section class="d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                <section>
                    <a href="{{ route('dashboard.gateway.create') }}" class="btn btn-info btn-sm">ساخت درگاه جدید</a>
                </section>

            </section>

            <section class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>IP های مجاز</th>
                            <th>حداقل مقدار تسویه</th>
                            <th>موجودی فعلی</th>
                            <th>روش پرداخت کارمزد</th>
                            <th class="max-width-16-rem text-left"><i class="fa fa-cogs"></i> تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gateways as $gateway)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $gateway->name }}</td>
                            <td>
                                @if ($gateway->allowed_ips)
                                 @foreach ($gateway->allowed_ips as $ip)
                                     <p>{{ $ip }}</p>
                                 @endforeach   
                                @else
                                *
                                @endif
                            </td>
                            <td>{{ $gateway->min_settlement }}</td>
                            <td>{{ $gateway->current_balance }}</td>
                            <td>{{ $gateway->fee_method === 1 ? 'پرداخت کننده' : 'پذیرنده' }}</td>
                            <td>
                                <form action="{{ route('dashboard.gateway.destroy', $gateway) }}" id="deleteForm" method="POST" style="text-align: left">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('dashboard.gateway.edit', $gateway) }}" class="btn btn-sm btn-primary"><span><i class="fa fa-edit"></i></span></a>
                                    <button class="btn btn-sm btn-danger delete"><span><i class="fa fa-trash-alt"></i></span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>


            <section style="overflow: auto">
                {{ $gateways->links('pagination::bootstrap-4') }}
            </section>




        </section>
    </section>
</section>

@endsection

@section('script')
@include('dashboard.alerts.sweetalert.delete-confirm', ['className' => 'delete'])
@endsection