<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة المحافظات</title>
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
        .error {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 0.3rem;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
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
        <h2>إدارة المحافظات</h2>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- Add New Governorate --}}
        <form method="POST" action="{{ route('governorates.store') }}">
            @csrf
            <div class="form-group">
                <label for="new-gov-name">إضافة محافظة جديدة</label>
                <input type="text" name="governorate_name" id="new-gov-name" value="{{ old('governorate_name') }}" required>
                @error('governorate_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div style="text-align: center;">
                <button type="submit">إضافة</button>
            </div>
        </form>

        <hr style="margin: 2rem 0;">

        {{-- Governorate Search --}}
        <div class="form-group">
            <label for="gov-search">بحث عن محافظة</label>
            <input type="text" id="gov-search" placeholder="أدخل اسم المحافظة للبحث...">
        </div>

        {{-- Governorate List --}}
        <div class="form-group">
            <label for="gov-list">قائمة المحافظات</label>
            <select size="5" id="gov-list">
                @foreach ($governorates as $gov)
                    <option value="{{ $gov->id }}">{{ $gov->governorate_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Governorate Edit & Delete --}}
        <form method="POST" id="update-form" action="">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="edit-gov-name">اسم المحافظة المحددة</label>
                <input type="text" name="governorate_name" id="edit-gov-name" value="" required>
            </div>
           <div style="display: flex; justify-content: center; gap: 1rem; margin-top: 1.5rem;">
    <form method="POST" id="update-form" action="" style="margin: 0;">
        @csrf
        @method('PATCH')
        <button type="submit" id="update-btn" disabled>تحديث</button>
    </form>

    <form method="POST" id="delete-form" action="" style="margin: 0;">
        @csrf
        @method('DELETE')
        <button type="submit" id="delete-btn" class="delete-btn" disabled>حذف</button>
    </form>
</div>

    <script>
        const governorates = @json($governorates);
        const searchBox = document.getElementById('gov-search');
        const listBox = document.getElementById('gov-list');
        const editInput = document.getElementById('edit-gov-name');
        const updateBtn = document.getElementById('update-btn');
        const deleteBtn = document.getElementById('delete-btn');
        const updateForm = document.getElementById('update-form');
        const deleteForm = document.getElementById('delete-form');

        // Filter list based on search
        searchBox.addEventListener('input', function() {
            const term = this.value.toLowerCase();
            listBox.innerHTML = '';
            governorates
                .filter(g => g.governorate_name.toLowerCase().includes(term))
                .forEach(g => {
                    const option = document.createElement('option');
                    option.value = g.id;
                    option.text = g.governorate_name;
                    listBox.appendChild(option);
                });
        });

        // Populate edit/delete forms
        listBox.addEventListener('change', function() {
            const selectedId = this.value;
            const gov = governorates.find(g => g.id == selectedId);
            if (gov) {
                editInput.value = gov.governorate_name;
                updateBtn.disabled = false;
                deleteBtn.disabled = false;
                updateForm.action = `/admin/governorates/${gov.id}`;
                deleteForm.action = `/admin/governorates/${gov.id}`;
            }
        });
    </script>
</body>
</html>