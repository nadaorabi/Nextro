<div class="tab-pane" id="account">
  <h6 class="mb-4">تسجيل الحضور</h6>

  <p class="text-muted mb-4 text-center">قم بمسح رمز QR لإثبات حضورك.</p>

  <!-- زر بدء المسح -->
  <div class="text-center mb-4">
    <button class="btn btn-outline-primary btn-lg d-flex flex-column align-items-center mx-auto"
            style="width: 200px;" onclick="startQRScanner()">
      <i class="fas fa-qrcode fa-2x mb-2"></i>
      <span>مسح رمز QR</span>
    </button>
  </div>

  <!-- منطقة عرض الكاميرا -->
  <div id="qr-reader" style="width: 100%; max-width: 350px; margin: 0 auto; display: none;"></div>

  <!-- نتيجة QR -->
  <div class="text-center mt-4" id="qr-result" style="font-weight: bold; color: green;"></div>

  <!-- مكتبة HTML5 QR -->
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

  <!-- JS لتشغيل الكاميرا -->
  <script>
    function startQRScanner() {
      const qrReader = document.getElementById("qr-reader");
      const qrResult = document.getElementById("qr-result");

      qrReader.style.display = "block";
      qrResult.innerText = "جارٍ فتح الكاميرا...";

      const html5QrCode = new Html5Qrcode("qr-reader");

      html5QrCode.start(
        { facingMode: "environment" },
        {
          fps: 10,
          qrbox: 250
        },
        qrCodeMessage => {
          html5QrCode.stop().then(() => {
            qrReader.style.display = "none";
            qrResult.innerHTML = `✅ تم تسجيل الحضور بنجاح<br><small style="font-size:14px;">الكود: ${qrCodeMessage}</small>`;
          }).catch(err => {
            qrResult.innerText = "فشل في إيقاف الكاميرا.";
            console.error(err);
          });
        },
        errorMessage => {
          // تجاهل أخطاء المسح اللحظية
        }
      ).catch(err => {
        qrResult.innerText = "تعذر تشغيل الكاميرا. الرجاء السماح بالوصول.";
        console.error(err);
      });
    }
  </script>

  <!-- تنسيقات -->
  <style>
    .tab-pane {
      background-color: #fdfdfd;
      padding: 20px;
      border-radius: 10px;
    }

    h6 {
      font-weight: bold;
      font-size: 20px;
      text-align: center;
    }

    .btn span {
      font-size: 15px;
    }

    #qr-reader {
      border: 2px solid #007bff;
      border-radius: 10px;
      padding: 10px;
    }
  </style>
</div>
