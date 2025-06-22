<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة التخصصات الفرعية</title>
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
        <h2>إدارة التخصصات الفرعية</h2>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- Add Subspecialty --}}
        <form method="POST" action="{{ route('subspecialties.store') }}">
            @csrf
            <div class="form-group">
                <label for="subspecialty_name">اسم التخصص الفرعي</label>
                <input type="text" name="subspecialty_name" id="subspecialty_name" required>
                @error('subspecialty_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="specialty_id">التخصص الرئيسي</label>
                <select name="specialty_id" id="specialty_id" required>
                    <option value="">-- اختر --</option>
                    @foreach ($specialties as $s)
                        <option value="{{ $s->id }}">{{ $s->specialty_name }}</option>
                    @endforeach
                </select>
                @error('specialty_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div style="text-align: center;">
                <button type="submit">إضافة</button>
            </div>
        </form>

        <hr style="margin: 2rem 0;">

        {{-- Search + List --}}
        <div class="form-group">
            <label for="search-sub">بحث عن تخصص فرعي</label>
            <input type="text" id="search-sub" placeholder="أدخل الاسم...">
        </div>

        <div class="form-group">
            <label for="sub-list">قائمة التخصصات الفرعية</label>
            <select size="5" id="sub-list">
                @foreach ($subspecialties as $sub)
                    <option value="{{ $sub->id }}">
                        {{ $sub->subspecialty_name }} ({{ $sub->specialty->specialty_name }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Edit --}}
        <div class="form-group">
            <label for="edit-sub-name">تعديل اسم التخصص الفرعي</label>
            <input type="text" id="edit-sub-name">
        </div>

        <div class="form-group">
            <label for="edit-specialty-id">تعديل التخصص الرئيسي</label>
            <select id="edit-specialty-id">
                <option value="">-- اختر --</option>
                @foreach ($specialties as $s)
                    <option value="{{ $s->id }}">{{ $s->specialty_name }}</option>
                @endforeach
            </select>
        </div>

        <div style="display: flex; justify-content: center; gap: 1rem; margin-top: 1rem;">
            <form method="POST" id="update-form" action="">
                @csrf
                @method('PATCH')
                <input type="hidden" name="subspecialty_name" id="update-name">
                <input type="hidden" name="specialty_id" id="update-specialty">
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
        const subs = @json($subspecialties);
        const search = document.getElementById('search-sub');
        const listBox = document.getElementById('sub-list');
        const editName = document.getElementById('edit-sub-name');
        const editSpecialty = document.getElementById('edit-specialty-id');
        const updateForm = document.getElementById('update-form');
        const deleteForm = document.getElementById('delete-form');
        const updateBtn = document.getElementById('update-btn');
        const deleteBtn = document.getElementById('delete-btn');
        const updateName = document.getElementById('update-name');
        const updateSpec = document.getElementById('update-specialty');

        search.addEventListener('input', function () {
            const term = this.value.toLowerCase();
            listBox.innerHTML = '';
            subs.filter(s => s.subspecialty_name.toLowerCase().includes(term))
                .forEach(s => {
                    const option = document.createElement('option');
                    option.value = s.id;
                    option.text = `${s.subspecialty_name} (${s.specialty.specialty_name})`;
                    listBox.appendChild(option);
                });
        });

        listBox.addEventListener('change', function () {
            const id = this.value;
            const sub = subs.find(s => s.id == id);
            if (sub) {
                editName.value = sub.subspecialty_name;
                editSpecialty.value = sub.specialty_id;
                updateForm.action = `/admin/subspecialties/${sub.id}`;
                deleteForm.action = `/admin/subspecialties/${sub.id}`;
                updateName.value = sub.subspecialty_name;
                updateSpec.value = sub.specialty_id;
                updateBtn.disabled = false;
                deleteBtn.disabled = false;
            }
        });

        editName.addEventListener('input', () => updateName.value = editName.value);
        editSpecialty.addEventListener('change', () => updateSpec.value = editSpecialty.value);
    </script>
</body>
</html>