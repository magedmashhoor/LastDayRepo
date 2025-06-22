<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة الخدمات</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            direction: rtl;
            background: linear-gradient(to left, #f5f7fa, #c3cfe2);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem;
        }
        .form-container {
            max-width: 650px;
            margin: auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
            padding: 2rem;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1.2rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #444;
        }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 0.7rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.2rem;
        }
        .error {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 0.3rem;
        }
        button {
            background: #3498db;
            color: white;
            border: none;
            padding: 0.65rem 1.3rem;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #2980b9;
        }
        .delete-btn {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>إدارة الخدمات</h2>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- Add New Service --}}
        <form method="POST" action="{{ route('services.store') }}">
            @csrf
            <div class="form-group">
                <label for="service_name">اسم الخدمة</label>
                <input type="text" name="service_name" id="service_name" required>
                @error('service_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="service_description">وصف الخدمة (اختياري)</label>
                <textarea name="service_description" id="service_description" rows="3"></textarea>
                @error('service_description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div style="text-align:center">
                <button type="submit">إضافة</button>
            </div>
        </form>

        <hr style="margin:2rem 0;">

        {{-- Search + List --}}
        <div class="form-group">
            <label for="search-service">بحث عن خدمة</label>
            <input type="text" id="search-service" placeholder="أدخل اسم الخدمة...">
        </div>

        <div class="form-group">
            <label for="service-list">قائمة الخدمات</label>
            <select size="5" id="service-list">
                @foreach ($services as $s)
                    <option value="{{ $s->id }}">{{ $s->service_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Edit --}}
        <div class="form-group">
            <label for="edit-service-name">تعديل اسم الخدمة</label>
            <input type="text" id="edit-service-name">
        </div>

        <div class="form-group">
            <label for="edit-service-desc">تعديل الوصف</label>
            <textarea id="edit-service-desc" rows="3"></textarea>
        </div>

        <div style="display: flex; justify-content: center; gap: 1rem;">
            <form method="POST" id="update-form" action="">
                @csrf
                @method('PATCH')
                <input type="hidden" name="service_name" id="update-name">
                <input type="hidden" name="service_description" id="update-desc">
                <button type="submit" id="update-btn" disabled>تحديث</button>
            </form>

            <form method="POST" id="delete-form" action="">
                @csrf
                @method('DELETE')
                <button type="submit" id="delete-btn" class="delete-btn" disabled>حذف</button>
            </form>
        </div>
    </div>

    <script>
        const services = @json($services);
        const searchInput = document.getElementById('search-service');
        const listBox = document.getElementById('service-list');
        const editName = document.getElementById('edit-service-name');
        const editDesc = document.getElementById('edit-service-desc');
        const updateForm = document.getElementById('update-form');
        const deleteForm = document.getElementById('delete-form');
        const updateBtn = document.getElementById('update-btn');
        const deleteBtn = document.getElementById('delete-btn');
        const updateName = document.getElementById('update-name');
        const updateDesc = document.getElementById('update-desc');

        searchInput.addEventListener('input', function () {
            const term = this.value.toLowerCase();
            listBox.innerHTML = '';
            services
                .filter(s => s.service_name.toLowerCase().includes(term))
                .forEach(s => {
                    const option = document.createElement('option');
                    option.value = s.id;
                    option.text = s.service_name;
                    listBox.appendChild(option);
                });
        });

        listBox.addEventListener('change', function () {
            const id = this.value;
            const service = services.find(s => s.id == id);
            if (service) {
                editName.value = service.service_name;
                editDesc.value = service.service_description || '';
                updateName.value = service.service_name;
                updateDesc.value = service.service_description || '';
                updateForm.action = `/admin/services/${service.id}`;
                deleteForm.action = `/admin/services/${service.id}`;
                updateBtn.disabled = false;
                deleteBtn.disabled = false;
            }
        });

        editName.addEventListener('input', () => updateName.value = editName.value);
        editDesc.addEventListener('input', () => updateDesc.value = editDesc.value);
    </script>
</body>
</html>