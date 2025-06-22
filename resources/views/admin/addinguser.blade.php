<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة المستخدمين</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            direction: rtl;
            background: linear-gradient(to left, #f5f7fa, #c3cfe2);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #2c3e50;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.3rem;
            color: #444;
        }
        input, select {
            width: 100%;
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
        }
        .btn-row {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        button {
            background: #3498db;
            color: white;
            border: none;
            padding: 0.6rem 1.4rem;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background: #2980b9;
        }
        .delete-btn {
            background: #e74c3c;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }
        .error {
            color: #e74c3c;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>إدارة المستخدمين</h2>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- Search + List --}}
    <div class="form-group">
        <label for="search-user">بحث عن مستخدم</label>
        <input type="text" id="search-user" placeholder="ابحث بالاسم أو البريد...">
    </div>

    <div class="form-group">
        <label for="user-list">قائمة المستخدمين</label>
        <select size="5" id="user-list">
            @foreach ($users as $u)
                <option value="{{ $u->id }}">{{ $u->username }} - {{ $u->email }}</option>
            @endforeach
        </select>
    </div>

    {{-- Shared Form --}}
    <form method="POST" id="user-form" action="{{ route('users.store') }}">
        @csrf
        <input type="hidden" name="_method" id="form-method" value="POST">
        <input type="hidden" id="selected-user-id">

        <div class="form-group">
            <label for="username">اسم المستخدم</label>
            <input type="text" name="username" id="username">
            @error('username') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="first_name">الاسم الأول</label>
            <input type="text" name="first_name" id="first_name">
            @error('first_name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="last_name">الاسم الأخير</label>
            <input type="text" name="last_name" id="last_name">
            @error('last_name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="email">البريد الإلكتروني</label>
            <input type="email" name="email" id="email">
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="password_hash">كلمة المرور</label>
            <input type="password" name="password_hash" id="password_hash">
            @error('password_hash') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="phone_number">رقم الهاتف</label>
            <input type="text" name="phone_number" id="phone_number">
            @error('phone_number') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="user_type">نوع المستخدم</label>
            <select name="user_type" id="user_type">
                <option value="">-- اختر --</option>
                <option value="admin">مدير</option>
                <option value="doctor">طبيب</option>
                <option value="patient">مريض</option>
            </select>
            @error('user_type') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="governorate_id">المحافظة</label>
            <select name="governorate_id" id="governorate_id">
                <option value="">-- اختر --</option>
                @foreach ($governorates as $gov)
                    <option value="{{ $gov->id }}">{{ $gov->governorate_name }}</option>
                @endforeach
            </select>
            @error('governorate_id') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="district_id">المديرية</label>
           <select name="district_id" id="district_id">
    <option value="">-- اختر --</option>
    @foreach ($districts as $dist)
        <option value="{{ $dist->id }}" data-gov="{{ $dist->governorate_id }}">
            {{ $dist->district_name }}
        </option>
    @endforeach
</select>
            @error('district_id') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="btn-row">
            <button type="button" id="add-btn">إضافة</button>
            <button type="button" id="update-btn">تعديل</button>
            <button type="submit" id="save-btn" disabled>حفظ</button>
            <button type="submit" id="delete-btn" class="delete-btn" formaction="" formmethod="POST" disabled
                onclick="event.preventDefault(); if(confirm('تأكيد الحذف؟')) { document.getElementById('delete-form').submit(); }">
                حذف
            </button>
        </div>
    </form>

    <form id="delete-form" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
</div>

<script>
    const users = @json($users);
    const govSelect = document.getElementById('governorate_id');
    const districtSelect = document.getElementById('district_id');
    const userList = document.getElementById('user-list');
    const searchInput = document.getElementById('search-user');
    const form = document.getElementById('user-form');
    const saveBtn = document.getElementById('save-btn');
    const addBtn = document.getElementById('add-btn');
    const updateBtn = document.getElementById('update-btn');
    const deleteBtn = document.getElementById('delete-btn');
    const methodInput = document.getElementById('form-method');
    const deleteForm = document.getElementById('delete-form');

    function clearForm() {
        form.reset();
        methodInput.value = 'POST';
        form.action = "{{ route('users.store') }}";
        deleteBtn.disabled = true;
        saveBtn.disabled = false;
        deleteForm.action = '';
        document.getElementById('selected-user-id').value = '';
        filterDistrictsByGovernorate('');
    }

    function filterDistrictsByGovernorate(govId) {
        Array.from(districtSelect.options).forEach(option => {
            if (!option.value) return;
            const belongsTo = option.getAttribute('data-gov');
            option.style.display = (belongsTo == govId) ? 'block' : 'none';
        });
        districtSelect.value = '';
    }

    // Filter district options initially
    filterDistrictsByGovernorate('');

    // Filter users by search
    searchInput.addEventListener('input', function () {
        const term = this.value.toLowerCase();
        userList.innerHTML = '';
        users.filter(u =>
            u.username.toLowerCase().includes(term) ||
            u.email.toLowerCase().includes(term)
        ).forEach(u => {
            const option = document.createElement('option');
            option.value = u.id;
            option.text = `${u.username} - ${u.email}`;
            userList.appendChild(option);
        });
    });

    // Update button clicked → fill form with selected user data
    updateBtn.addEventListener('click', () => {
        const id = userList.value;
        if (!id) return;
        const user = users.find(u => u.id == id);
        if (!user) return;

        methodInput.value = 'PATCH';
        form.action = `/admin/users/${user.id}`;
        deleteForm.action = `/admin/users/${user.id}`;
        saveBtn.disabled = false;
        deleteBtn.disabled = false;

        document.getElementById('selected-user-id').value = user.id;
        document.getElementById('username').value = user.username;
        document.getElementById('first_name').value = user.first_name;
        document.getElementById('last_name').value = user.last_name;
        document.getElementById('email').value = user.email;
        document.getElementById('phone_number').value = user.phone_number || '';
        document.getElementById('user_type').value = user.user_type;
        document.getElementById('governorate_id').value = user.governorate_id;
        filterDistrictsByGovernorate(user.governorate_id);
        document.getElementById('district_id').value = user.district_id;
        document.getElementById('password_hash').value = '';
    });

    // Add button clicked → prepare form for new entry
    addBtn.addEventListener('click', () => {
        clearForm();
    });

    // Governorate change → filter district list
    govSelect.addEventListener('change', () => {
        filterDistrictsByGovernorate(govSelect.value);
    });
</script>

</body>
</html>