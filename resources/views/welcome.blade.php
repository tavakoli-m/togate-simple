<!DOCTYPE html>
<html lang="fa" dir="rtl" class="font-iran-sans">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>توگیت | درگاه پرداخت ارز دیجیتال</title>
  @Vite(['resources/fonts/iran-sans/fontiran.css', 'resources/css/app.css'])
</head>
<body class="bg-gray-50 text-right font-iran-sans">

  <!-- Navbar -->
  <header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex space-x-reverse items-center justify-between">
      <div class="text-2xl font-bold text-blue-700">togate.ir</div>
      <nav class="space-x-reverse space-x-6 text-sm text-blue-700">
        <a href="#docs" class="hover:underline">مستندات</a>
        @guest
        <a href="{{ route('auth.login.form') }}" class="hover:underline">ورود</a>
        <a href="{{ route('auth.register.form') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mr-4">ثبت‌نام</a>
        @endguest
        @auth
        <a href="#register" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mr-4">حساب کاربری</a>
        @endauth
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="flex flex-col-reverse md:flex-row items-center justify-between px-6 py-20 max-w-7xl mx-auto">
    <div class="md:w-1/2 space-y-6 text-center md:text-right">
      <h1 class="text-4xl font-extrabold text-blue-700 leading-tight">درگاه پرداخت ارز دیجیتال سریع، امن و مطمئن</h1>
      <p class="text-lg text-gray-700">
        توگیت پلتفرمی برای دریافت و تسویه پرداخت‌های کریپتویی است؛ مناسب فروشگاه‌ها، فریلنسرها، استارتاپ‌ها و هر کسب‌وکاری که می‌خواهد بدون دغدغه رمزارز بپذیرد.
      </p>
      <div class="space-x-reverse space-x-4">
        <a href="{{ route('auth.register.form') }}" class="px-6 py-3 bg-blue-600 text-white rounded shadow hover:bg-blue-700">شروع کنید</a>
        <a href="#docs" class="px-6 py-3 border border-blue-600 text-blue-600 rounded hover:bg-blue-100">مستندات</a>
      </div>
    </div>
    <div class="md:w-1/2 mb-10 md:mb-0">
      <img src="https://cdn-icons-png.flaticon.com/512/9068/9068676.png" alt="Crypto Gateway" class="w-full max-w-sm mx-auto">
    </div>
  </section>

  <!-- Why Us Section -->
  <section id="features" class="bg-white py-16 px-6 max-w-7xl mx-auto">
    <h2 class="text-3xl font-extrabold text-blue-700 text-center mb-12">چرا togate.ir؟</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 text-center">
      <div class="bg-blue-50 p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="text-4xl mb-4 text-blue-600">✅</div>
        <h3 class="text-xl font-semibold text-blue-700 mb-2">کارمزد کم</h3>
        <p class="text-gray-600 text-sm">در ازای خدمات قدرتمند، کمترین کارمزد را دریافت می‌کنیم.</p>
      </div>
      <div class="bg-blue-50 p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="text-4xl mb-4 text-blue-600">🔒</div>
        <h3 class="text-xl font-semibold text-blue-700 mb-2">امنیت بالا</h3>
        <p class="text-gray-600 text-sm">استفاده از پروتکل‌های رمزنگاری پیشرفته برای حفظ امنیت تراکنش‌ها.</p>
      </div>
      <div class="bg-blue-50 p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="text-4xl mb-4 text-blue-600">⚡</div>
        <h3 class="text-xl font-semibold text-blue-700 mb-2">استفاده آسان</h3>
        <p class="text-gray-600 text-sm">رابط کاربری ساده، پنل حرفه‌ای و مستندات دقیق برای توسعه‌دهندگان.</p>
      </div>
      <div class="bg-blue-50 p-6 rounded-xl shadow hover:shadow-lg transition">
        <div class="text-4xl mb-4 text-blue-600">🌟</div>
        <h3 class="text-xl font-semibold text-blue-700 mb-2">قابل اعتماد</h3>
        <p class="text-gray-600 text-sm">بیش از ۵۰۰ کسب‌وکار به ما اعتماد کرده‌اند و از خدمات ما استفاده می‌کنند.</p>
      </div>
    </div>
  </section>



  <!-- FAQ Section -->
  <section id="faq" class="py-20 max-w-4xl mx-auto px-6">
    <h2 class="text-3xl font-extrabold text-blue-700 text-center mb-12">سؤالات متداول</h2>
    <div class="space-y-6">
      <div>
        <h3 class="text-xl font-bold text-blue-700">آیا نیاز به احراز هویت دارم؟</h3>
        <p class="text-gray-600">خیر, به هیچ عنوان نیاز به احراز هویت نیست</p>
      </div>
      <div>
        <h3 class="text-xl font-bold text-blue-700">از چه رمزارزهایی پشتیبانی می‌کنید؟</h3>
        <p class="text-gray-600">فعلا فقط از TRX پشتیبانی میکنیم ولی در اینده ارز های بیشتری رو پشتیبانی خواهیم کرد</p>
      </div>
      <div>
        <h3 class="text-xl font-bold text-blue-700">تسویه‌ها به چه صورت انجام می‌شود؟</h3>
        <p class="text-gray-600">تسویه ها با به صورت خودکار بعد از رسیدن مبلغ کیف پول به حداقل مقدار تایین شده توسط شما انجام خواهد شد</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-blue-600 text-white py-8 text-center">
    <p class="mb-2">© 2025 togate.ir - تمامی حقوق محفوظ است.</p>
    <p class="text-sm">ساخته شده برای آینده پرداخت‌های دیجیتال</p>
  </footer>

</body>
</html>
