<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طباعة بيانات الاعتماد</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .credential-card {
            width: 350px;
            padding: 25px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .credential-card h3 {
            margin: 0 0 20px;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .credential-card p {
            font-size: 16px;
            color: #555;
            margin: 15px 0;
            line-height: 1.6;
        }
        .credential-card .label {
            font-weight: bold;
            color: #000;
        }
        .credential-card .value {
            font-family: 'Courier New', Courier, monospace;
            background-color: #e9ecef;
            padding: 5px 8px;
            border-radius: 4px;
            display: inline-block;
        }
        .credential-card .password {
            color: #d9534f;
            font-weight: bold;
        }
        @media print {
            body {
                background-color: #fff;
            }
            .credential-card {
                box-shadow: none;
                border: 2px solid #000;
                margin: 0;
            }
        }
    </style>
</head>
<body onload="window.print();">

    <div class="credential-card">
        <h3>بيانات الاعتماد</h3>
        <p><span class="label">الرقم التعريفي:</span> <span class="value">{{ $admin->login_id }}</span></p>
        <p><span class="label">الاسم:</span> <span class="value">{{ $admin->name }}</span></p>
        <p><span class="label">كلمة المرور:</span> <span class="value password">{{ $admin->plain_password }}</span></p>
    </div>

</body>
</html> 