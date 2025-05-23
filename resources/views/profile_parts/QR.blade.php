<div class="tab-pane" id="account">
    <h6 class="mb-4">Attendance Registration</h6>

    <p class="text-muted mb-4 text-center">Scan the QR code to confirm your attendance.</p>

    <!-- Scan button -->
    <div class="text-center mb-4">
      <button class="btn btn-outline-primary btn-lg d-flex flex-column align-items-center mx-auto"
              style="width: 200px;" onclick="startQRScanner()">
        <i class="fas fa-qrcode fa-2x mb-2"></i>
        <span>Scan QR Code</span>
      </button>
    </div>

    <!-- Camera view -->
    <div id="qr-reader" style="width: 100%; max-width: 350px; margin: 0 auto; display: none;"></div>

    <!-- QR result -->
    <div class="text-center mt-4" id="qr-result" style="font-weight: bold; color: green;"></div>

    <!-- HTML5 QR Library -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <!-- Camera JS -->
    <script>
      function startQRScanner() {
        const qrReader = document.getElementById("qr-reader");
        const qrResult = document.getElementById("qr-result");

        qrReader.style.display = "block";
        qrResult.innerText = "Opening camera...";

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
              qrResult.innerHTML = `✅ Attendance registered successfully<br><small style="font-size:14px;">Code: ${qrCodeMessage}</small>`;
            }).catch(err => {
              qrResult.innerText = "Failed to stop the camera.";
              console.error(err);
            });
          },
          errorMessage => {
            // Ignore scan errors
          }
        ).catch(err => {
          qrResult.innerText = "Unable to access camera. Please allow access.";
          console.error(err);
        });
      }
    </script>

    <!-- Styles -->
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
