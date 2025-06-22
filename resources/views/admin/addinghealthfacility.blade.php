<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إدارة المرافق الصحية</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            direction: rtl;
            background: linear-gradient(to left, #f5f7fa, #c3cfe2);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem;
        }
        .container {
            max-width: 900px;
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
            color: #333;
        }
        input, select, textarea {
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
            margin-top: 4px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>إدارة المرافق الصحية</h2>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- Search & List --}}
    <div class="form-group">
        <label for="search-facility">بحث عن مرفق</label>
        <input type="text" id="search-facility" placeholder="ابحث باسم المنشأة أو العنوان...">
    </div>

    <div class="form-group">
        <label for="facility-list">قائمة المرافق</label>
        <select size="5" id="facility-list">
            @foreach ($facilities as $f)
                <option value="{{ $f->id }}">{{ $f->facility_name }} - {{ $f->address }}</option>
            @endforeach
        </select>
    </div>

    {{-- Shared Form --}}
    <form method="POST" id="facility-form" action="{{ route('health_facilities.store') }}">
        @csrf
        <input type="hidden" name="_method" id="form-method" value="POST">
        <input type="hidden" id="selected-facility-id">

        <div class="form-group">
            <label for="facility_name">اسم المنشأة</label>
            <input type="text" name="facility_name" id="facility_name">
            @error('facility_name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="facility_type">نوع المنشأة</label>
            <input type="text" name="facility_type" id="facility_type">
            @error('facility_type') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="address">العنوان</label>
            <textarea name="address" id="address" rows="2"></textarea>
            @error('address') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="phone_number_1">رقم الهاتف 1</label>
            <input type="text" name="phone_number_1" id="phone_number_1">
            @error('phone_number_1') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="phone_number_2">رقم الهاتف 2</label>
            <input type="text" name="phone_number_2" id="phone_number_2">
            @error('phone_number_2') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="whatsapp_number">رقم الواتساب</label>
            <input type="text" name="whatsapp_number" id="whatsapp_number">
            @error('whatsapp_number') <div class="error">{{ $message }}</div> @enderror
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

        <div class="form-group">
            <label for="responsible_user_id">المستخدم المسؤول</label>
            <select name="responsible_user_id" id="responsible_user_id">
                <option value="">-- اختر --</option>
                @foreach ($users as $u)
                    <option value="{{ $u->id }}">{{ $u->username }}</option>
                @endforeach
            </select>
            @error('responsible_user_id') <div class="error">{{ $message }}</div> @enderror
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
    const facilities = @json($facilities);
    const governorateSelect = document.getElementById('governorate_id');
    const districtSelect = document.getElementById('district_id');
    const facilityList = document.getElementById('facility-list');
    const searchInput = document.getElementById('search-facility');
    const form = document.getElementById('facility-form');
    const saveBtn = document.getElementById('save-btn');
    const addBtn = document.getElementById('add-btn');
    const updateBtn = document.getElementById('update-btn');
    const deleteBtn = document.getElementById('delete-btn');
    const methodInput = document.getElementById('form-method');
    const deleteForm = document.getElementById('delete-form');

    function clearForm() {
        form.reset();
        methodInput.value = 'POST';
        form.action = "{{ route('health_facilities.store') }}";
        deleteBtn.disabled = true;
        saveBtn.disabled = false;
        deleteForm.action = '';
        document.getElementById('selected-facility-id').value = '';
        filterDistricts('');
    }

    function filterDistricts(govId) {
        Array.from(districtSelect.options).forEach(option => {
            if (!option.value) return;
            const belongsTo = option.getAttribute('data-gov');
            option.style.display = (belongsTo == govId) ? 'block' : 'none';
        });
        districtSelect.value = '';
    }

    // Filter districts when governorate changes
    governorateSelect.addEventListener('change', () => {
        filterDistricts(governorateSelect.value);
    });

    // Search functionality
    searchInput.addEventListener('input', function () {
        const term = this.value.toLowerCase();
        facilityList.innerHTML = '';
        facilities.filter(f =>
            f.facility_name.toLowerCase().includes(term) ||
            f.address.toLowerCase().includes(term)
        ).forEach(f => {
            const option = document.createElement('option');
            option.value = f.id;
            option.text = `${f.facility_name} - ${f.address}`;
            facilityList.appendChild(option);
        });
    });

    // Update button clicked → fill form
    updateBtn.addEventListener('click', () => {
        const id = facilityList.value;
        if (!id) return;
        const facility = facilities.find(f => f.id == id);
        if (!facility) return;

        methodInput.value = 'PATCH';
        form.action = `/admin/HealthFacility/${facility.id}`;
        deleteForm.action = `/admin/HealthFacility/${facility.id}`;
        saveBtn.disabled = false;
        deleteBtn.disabled = false;

        document.getElementById('selected-facility-id').value = facility.id;
        document.getElementById('facility_name').value = facility.facility_name;
        document.getElementById('facility_type').value = facility.facility_type;
        document.getElementById('address').value = facility.address;
        document.getElementById('phone_number_1').value = facility.phone_number_1 || '';
        document.getElementById('phone_number_2').value = facility.phone_number_2 || '';
        document.getElementById('whatsapp_number').value = facility.whatsapp_number || '';
        document.getElementById('governorate_id').value = facility.governorate_id;
        filterDistricts(facility.governorate_id);
        document.getElementById('district_id').value = facility.district_id;
        document.getElementById('responsible_user_id').value = facility.responsible_user_id || '';
    });

    // Add button → prep form for new entry
    addBtn.addEventListener('click', clearForm);
</script>
</div> <!-- end .container -->
</body>
</html>