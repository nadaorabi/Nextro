<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>المواد التعليمية</title>
    
    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Cairo Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8f9fa;
        }
        
        .main-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }
        
        .main-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 60px;
            height: 4px;
            background-color: #3498db;
            border-radius: 2px;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }
        
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #eee;
            padding: 20px;
            border-radius: 15px 15px 0 0 !important;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table th {
            font-weight: 600;
            color: #2c3e50;
            background-color: #f8f9fa;
            border-bottom: 2px solid #eee;
        }
        
        .table td {
            vertical-align: middle;
            color: #34495e;ياالالم
        }
        
        .badge {
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 500;
        }
        
        .badge-primary {
            background-color: #3498db;
        }
        
        .badge-success {
            background-color: #2ecc71;
        }
        
        .btn-group .btn {
            padding: 8px 16px;
            border-radius: 8px;
            margin: 0 5px;
            font-weight: 500;
        }
        
        .btn-add {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-add:hover {
            background-color: #2980b9;
            color: white;
            transform: translateY(-2px);
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }
        
        .empty-state i {
            font-size: 48px;
            color: #bdc3c7;
            margin-bottom: 15px;
        }
        
        .empty-state p {
            color: #7f8c8d;
            font-size: 16px;
        }
        
        .status-active {
            color: #27ae60;
            background-color: #daf6e6;
            padding: 6px 12px;
            border-radius: 6px;
        }
        
        .status-inactive {
            color: #c0392b;
            background-color: #fad7d3;
            padding: 6px 12px;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="main-title">المواد التعليمية</h2>
                
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">قائمة المواد التعليمية</h5>
                        <button class="btn btn-add" onclick="addMaterial()">
                            <i class="fas fa-plus ml-2"></i>
                            إضافة مادة جديدة
                        </button>
                    </div>
                    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم المادة</th>
                                        <th>الوصف</th>
                                        <th>النوع</th>
                                        <th>الأستاذ</th>
                                        <th>الحالة</th>
                                        <th>تاريخ الإنشاء</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody id="materialsTableBody">
                                    <!-- سيتم إضافة الصفوف عن طريق JavaScript -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // بيانات تجريبية
        const materials = [
            {
                id: 1,
                name: 'الرياضيات للصف الأول',
                description: 'كتاب الرياضيات الأساسي للصف الأول الابتدائي',
                type: 'كتاب',
                teacher: 'أ. محمد الأحمد',
                status: true,
                created_at: '2024-01-15'
            },
            {
                id: 2,
                name: 'اللغة العربية',
                description: 'منهج اللغة العربية الشامل',
                type: 'منهج',
                teacher: 'أ. سارة يوسف',
                status: true,
                created_at: '2024-01-16'
            },
            {
                id: 3,
                name: 'العلوم العامة',
                description: 'مادة العلوم للمرحلة المتوسطة',
                type: 'مادة',
                teacher: 'د. خالد العلي',
                status: false,
                created_at: '2024-01-17'
            }
        ];

        function renderTable() {
            const tbody = document.getElementById('materialsTableBody');
            tbody.innerHTML = materials.map((item, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.name}</td>
                    <td>${item.description}</td>
                    <td><span class="badge badge-primary">${item.type}</span></td>
                    <td>${item.teacher}</td>
                    <td>
                        <span class="${item.status ? 'status-active' : 'status-inactive'}">
                            ${item.status ? 'نشط' : 'غير نشط'}
                        </span>
                    </td>
                    <td>${item.created_at}</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-info btn-sm" onclick="editMaterial(${item.id})">
                                <i class="fas fa-edit"></i> تعديل
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteMaterial(${item.id})">
                                <i class="fas fa-trash"></i> حذف
                            </button>
                            <button class="btn btn-secondary btn-sm" onclick="showFiles(${item.id})">
                                <i class="fas fa-folder-open"></i> ملفات المادة
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function addMaterial() {
            alert('سيتم توجيهك إلى صفحة إضافة مادة جديدة');
        }

        function editMaterial(id) {
            alert('تعديل المادة رقم: ' + id);
        }

        function deleteMaterial(id) {
            if (confirm('هل أنت متأكد من حذف هذه المادة؟')) {
                const index = materials.findIndex(m => m.id === id);
                if (index > -1) {
                    materials.splice(index, 1);
                    renderTable();
                }
            }
        }

        function showFiles(id) {
            alert('عرض ملفات المادة رقم: ' + id);
        }

        // تحميل البيانات عند تحميل الصفحة
        window.onload = renderTable;
    </script>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 