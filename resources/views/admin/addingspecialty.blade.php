<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة التخصصات</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            direction: rtl;
            background: linear-gradient(to left, #f5f7fa, #c3cfe2);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem;
        }

        .form-container {
            max-width: 600px;
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

        input[type="text"], select {
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
            margin-right: 0.5rem;
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
        <h2>إدارة التخصصات</h2>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- Add Specialty --}}
        <form method="POST" action="{{ route('specialties.store') }}">
            @csrf
            <div class="form-group">
                <label for="specialty_name">اسم التخصص الجديد</label>
                <input type="text" name="specialty_name" id="specialty_name" required>
                @error('specialty_name')
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
            <label for="search-specialty">بحث عن تخصص</label>
            <input type="text" id="search-specialty" placeholder="أدخل اسم التخصص للبحث...">
        </div>

        <div class="form-group">
            <label for="specialty-list">قائمة التخصصات</label>
            <select size="5" id="specialty-list">
                @foreach ($specialties as $s)
                    <option value="{{ $s->id }}">{{ $s->specialty_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Edit Selected --}}
        <div class="form-group">
            <label for="edit-specialty-name">تعديل اسم التخصص</label>
            <input type="text" id="edit-specialty-name">
        </div>

        <div style="display: flex; justify-content: center; gap: 1rem;">
            <form method="POST" id="update-form" action="">
                @csrf
                @method('PATCH')
                <input type="hidden" name="specialty_name" id="update-value">
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
        const specialties = @json($specialties);
        const searchInput = document.getElementById('search-specialty');
        const listBox = document.getElementById('specialty-list');
        const editInput = document.getElementById('edit-specialty-name');
        const updateForm = document.getElementById('update-form');
        const deleteForm = document.getElementById('delete-form');
        const updateValue = document.getElementById('update-value');
        const updateBtn = document.getElementById('update-btn');
        const deleteBtn = document.getElementById('delete-btn');

        searchInput.addEventListener('input', function () {
            const term = this.value.toLowerCase();
            listBox.innerHTML = '';
            specialties
                .filter(s => s.specialty_name.toLowerCase().includes(term))
                .forEach(s => {
                    const option = document.createElement('option');
                    option.value = s.id;
                    option.text = s.specialty_name;
                    listBox.appendChild(option);
                });
        });

        listBox.addEventListener('change', function () {
            const id = this.value;
            const selected = specialties.find(s => s.id == id);
            if (selected) {
                editInput.value = selected.specialty_name;
                updateValue.value = selected.specialty_name;
                updateForm.action = `/admin/specialties/${selected.id}`;
                deleteForm.action = `/admin/specialties/${selected.id}`;
                updateBtn.disabled = false;
                deleteBtn.disabled = false;
            }
        });

        editInput.addEventListener('input', () => {
            updateValue.value = editInput.value;
        });
    </script>
</body>
</html>