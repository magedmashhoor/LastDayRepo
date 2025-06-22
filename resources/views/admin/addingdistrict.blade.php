<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة المديريات</title>
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
            margin-bottom: 1.5rem;
            color: #3a3a3a;
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
            padding: 0.6rem 1.3rem;
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
        <h2>إدارة المديريات</h2>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- Add New District --}}
        <form method="POST" action="{{ route('districts.store') }}">
            @csrf
            <div class="form-group">
                <label for="district_name">اسم المديرية</label>
                <input type="text" name="district_name" id="district_name" required>
                @error('district_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="governorate_id">اختر المحافظة</label>
                <select name="governorate_id" id="governorate_id" required>
                    <option value="">-- اختر --</option>
                    @foreach ($governorates as $gov)
                        <option value="{{ $gov->id }}">{{ $gov->governorate_name }}</option>
                    @endforeach
                </select>
                @error('governorate_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div style="text-align: center;">
                <button type="submit">إضافة</button>
            </div>
        </form>

        <hr style="margin: 2rem 0;">

        {{-- Search and Manage Existing --}}
        <div class="form-group">
            <label for="search-district">بحث عن مديرية</label>
            <input type="text" id="search-district" placeholder="أدخل اسم المديرية...">
        </div>

        <div class="form-group">
            <label for="district-list">قائمة المديريات</label>
            <select size="5" id="district-list">
                @foreach ($districts as $d)
                    <option value="{{ $d->id }}">{{ $d->district_name }} ({{ $d->governorate->governorate_name }})</option>
                @endforeach
            </select>
        </div>

        {{-- Edit / Delete --}}
        <div class="form-group">
            <label for="edit-district-name">تعديل اسم المديرية</label>
            <input type="text" id="edit-district-name">
        </div>

        <div class="form-group">
            <label for="edit-governorate-id">تعديل المحافظة</label>
            <select id="edit-governorate-id">
                <option value="">-- اختر --</option>
                @foreach ($governorates as $gov)
                    <option value="{{ $gov->id }}">{{ $gov->governorate_name }}</option>
                @endforeach
            </select>
        </div>

        <div style="display: flex; justify-content: center; gap: 1rem; margin-top: 1.5rem;">
            <form method="POST" id="update-form" action="">
                @csrf
                @method('PATCH')
                <input type="hidden" name="district_name" id="update-name">
                <input type="hidden" name="governorate_id" id="update-gov">
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
        const districts = @json($districts);
        const searchInput = document.getElementById('search-district');
        const listBox = document.getElementById('district-list');
        const nameEdit = document.getElementById('edit-district-name');
        const govEdit = document.getElementById('edit-governorate-id');
        const updateBtn = document.getElementById('update-btn');
        const deleteBtn = document.getElementById('delete-btn');
        const updateForm = document.getElementById('update-form');
        const deleteForm = document.getElementById('delete-form');
        const updateName = document.getElementById('update-name');
        const updateGov = document.getElementById('update-gov');

        searchInput.addEventListener('input', function () {
            const term = this.value.toLowerCase();
            listBox.innerHTML = '';
            districts.filter(d => d.district_name.toLowerCase().includes(term)).forEach(d => {
                const option = document.createElement('option');
                option.value = d.id;
                option.text = `${d.district_name} (${d.governorate.governorate_name})`;
                listBox.appendChild(option);
            });
        });

        listBox.addEventListener('change', function () {
            const id = this.value;
            const d = districts.find(item => item.id == id);
            if (d) {
                nameEdit.value = d.district_name;
                govEdit.value = d.governorate_id;
                updateName.value = d.district_name;
                updateGov.value = d.governorate_id;

                updateForm.action = `/admin/districts/${d.id}`;
                deleteForm.action = `/admin/districts/${d.id}`;
                updateBtn.disabled = false;
                deleteBtn.disabled = false;
            }
        });

        nameEdit.addEventListener('input', () => updateName.value = nameEdit.value);
        govEdit.addEventListener('change', () => updateGov.value = govEdit.value);
    </script>
</body>
</html>