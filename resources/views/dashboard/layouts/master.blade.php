<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard.layouts.head-tag')
    @yield('head-tag')

</head>

<body dir="rtl">

@include('dashboard.layouts.header')


<section class="body-container">

    @include('dashboard.layouts.sidebar')


    <section id="main-body" class="main-body">


        @yield('content')

    </section>
</section>


@include('dashboard.layouts.script')
@yield('script')

@include('dashboard.alerts.sweetalert.success-alert')
@include('dashboard.alerts.sweetalert.error-alert')


</body>

</html>
