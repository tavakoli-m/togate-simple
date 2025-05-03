<aside id="sidebar" class="sidebar">
    <section class="sidebar-container">
        <section class="sidebar-wrapper">
            <a href="{{ route('dashboard.index') }}" class="sidebar-link">
                <i class="fas fa-home"></i>
                <span>خانه</span>
            </a>
            <a href="{{ route('dashboard.gateway.index') }}" class="sidebar-link">
                <i class="fas fa-dollar-sign"></i>
                <span>درگاه ها</span>
            </a>
            <a href="{{ route('dashboard.payment.index') }}" class="sidebar-link">
                <i class="fas fa-dollar-sign"></i>
                <span>پرداخت ها</span>
            </a>
        </section>
    </section>
</aside>
