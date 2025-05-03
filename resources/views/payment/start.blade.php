<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>پرداخت با ترون</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="bg-white p-6 rounded-2xl shadow-lg text-center max-w-md w-full">
    <h2 class="text-xl font-bold mb-4">آدرس کیف پول ترون (TRC20)</h2>
    <h2 class="text-xl font-bold mb-4">تعداد : {{ convertEnglishToPersian($payment->amount) }}</h2>

    <div id="qrcode" class="mx-auto mb-4"></div>

    <p class="text-sm break-all text-gray-700 mb-4" id="wallet-address">
      {{ $payment->wallet_address }}
    </p>

    <div class="text-gray-600 text-sm mb-2">
      زمان باقی‌مانده:
      <span id="countdown" class="font-bold text-red-500"></span>
    </div>

    <div id="expired-message" class="text-red-600 font-bold hidden mt-4">
      زمان تمام شد!
    </div>
  </div>

  <script>
    const walletAddress = "{{ $payment->wallet_address }}";
    const expirationTime = {{ \Carbon\Carbon::parse($payment->expired_at)->timestamp }} * 1000; // تبدیل به میلی‌ثانیه

    new QRCode(document.getElementById("qrcode"), {
      text: walletAddress,
      width: 150,
      height: 150,
    });

    const countdownEl = document.getElementById("countdown");
    const expiredMessage = document.getElementById("expired-message");

    const interval = setInterval(() => {
      const now = new Date().getTime();
      const distance = expirationTime - now;

      if (distance <= 0) {
        clearInterval(interval);
        countdownEl.textContent = "00:00";
        expiredMessage.classList.remove("hidden");

        location.href= "/"
        return;
      }

      const minutes = Math.floor(distance / 1000 / 60);
      const seconds = Math.floor((distance % (60 * 1000)) / 1000);
      countdownEl.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
    }, 1000);

    setInterval(() => {
        fetch("/api/check.json/{{ $payment->token }}").then(res => res.json()).then(res => {
            if(res.success){
                return location.href = res.call_back_url
            }
        })
    },10000)
  </script>
</body>
</html>
