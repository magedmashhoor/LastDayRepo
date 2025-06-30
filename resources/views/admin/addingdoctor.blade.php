<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>إدارة الأطباء</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            direction: rtl;
            background: linear-gradient(to left, #f5f7fa, #c3cfe2);
            /*font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;*/

            font-family: 'Noto Kufi Arabic', 'Amiri', 'Arial', sans-serif;
            padding: 2rem;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 2rem;
            border-radius: 12px;
            /* box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);*/
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

        select,
        select option {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-color: white !important;
            color: #111 !important;
        }

        select {
            direction: rtl;
            text-align: right;
            color: black;
            background-color: white;
        }

        select option {
            background-color: white;
            direction: rtl;
            text-align: right;
            color: black !important;


            /* Optional, but helps visibility */
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            color: black;
            /* Add this line */
            background-color: white;
            /* Optional: ensures contrast */
        }

        #specialty_id option,
        #subspecialty_id option {
            color: black;

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
        <h2>إدارة الأطباء</h2>
        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        {{-- Search --}}
        <div class="form-group">
            <label for="search-doctor">بحث عن طبيب</label>
            <input type="text" id="search-doctor" placeholder="ابحث باسم الطبيب أو التخصص...">
        </div>

        {{-- List --}}
        <div class="form-group">
            <label for="doctor-list">قائمة الأطباء</label>
            <select size="5" id="doctor-list">
                @foreach ($doctors as $d)
                    <option value="{{ $d->id }}">{{ $d->doctor_name }} - {{ $d->specialty->name ?? '' }}</option>
                @endforeach
            </select>
        </div>

        {{-- Form --}}
        <form method="POST" id="doctor-form" action="{{ route('doctors.store') }}">
            @csrf
            <input type="hidden" name="_method" id="form-method" value="POST">
            <input type="hidden" id="selected-doctor-id">

            <div class="form-group">
                <label for="doctor_name">الاسم الكامل</label>
                <input type="text" name="doctor_name" id="doctor_name" value="{{ old('doctor_name') }}">
                @error('doctor_name')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="gender">الجنس</label>
                <select name="gender" id="gender">
                    <option value="">-- اختر --</option>
                    <option value="ذكر" {{ old('gender') == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                    <option value="أنثى" {{ old('gender') == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                </select>
                @error('gender')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="specialty_id">التخصص</label>
                <select name="specialty_id" id="specialty_id">
                    <option value="">-- اختر --</option>
                    @foreach ($specialties as $s)
                        <option value="{{ $s->id }}" {{ old('specialty_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->specialty_name }}</option>
                    @endforeach
                </select>
                @error('specialty_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="subspecialty_id">التخصص الفرعي</label>
                <select name="subspecialty_id" id="subspecialty_id">
                    <option value="">-- اختياري --</option>
                    @foreach ($subspecialties as $ss)
                        <option value="{{ $ss->id }}" data-specialty-id="{{ $ss->specialty_id }}"
                            {{ old('subspecialty_id') == $ss->id ? 'selected' : '' }}>
                            {{ $ss->subspecialty_name }}
                        </option>
                    @endforeach
                </select>
                @error('subspecialty_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="governorate_id">المحافظة</label>
                <select name="governorate_id" id="governorate_id">
                    <option value="">-- اختر --</option>
                    @foreach ($governorates as $g)
                        <option value="{{ $g->id }}" {{ old('governorate_id') == $g->id ? 'selected' : '' }}>
                            {{ $g->governorate_name }}</option>
                    @endforeach
                </select>
                @error('governorate_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="district_id">المديرية</label>
                <select name="district_id" id="district_id">
                    <option value="">-- اختر --</option>
                    @foreach ($districts as $d)
                        <option value="{{ $d->id }}" data-gov="{{ $d->governorate_id }}"
                            {{ old('district_id') == $d->id ? 'selected' : '' }}>
                            {{ $d->district_name }}
                        </option>
                    @endforeach
                </select>
                @error('district_id')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="qualification_degree">الدرجة العلمية</label>
                <input type="text" name="qualification_degree" id="qualification_degree"
                    value="{{ old('qualification_degree') }}">
                @error('qualification_degree')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="bio">النبذة التعريفية</label>
                <textarea name="bio" id="bio" rows="2">{{ old('bio') }}</textarea>
                @error('bio')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="btn-row">
                <button type="button" id="add-btn">إضافة</button>
                <button type="button" id="update-btn">تعديل</button>
                <button type="submit" id="save-btn" disabled>حفظ</button>
                <button type="submit" id="delete-btn" class="delete-btn" formaction="" formmethod="POST" disabled
                    onclick="event.preventDefault(); if(confirm('تأكيد الحذف؟')) { document.getElementById('delete-form').submit(); }">حذف</button>
            </div>
        </form>
        <form id="delete-form" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
        <script>
            const doctors = @json($doctors);
            const specialtySelect = document.getElementById('specialty_id');
            const subspecialtySelect = document.getElementById('subspecialty_id');
            const governorateSelect = document.getElementById('governorate_id');
            const districtSelect = document.getElementById('district_id');
            const doctorList = document.getElementById('doctor-list');
            const searchInput = document.getElementById('search-doctor');
            const form = document.getElementById('doctor-form');
            const saveBtn = document.getElementById('save-btn');
            const addBtn = document.getElementById('add-btn');
            const updateBtn = document.getElementById('update-btn');
            const deleteBtn = document.getElementById('delete-btn');
            const methodInput = document.getElementById('form-method');
            const deleteForm = document.getElementById('delete-form');

            // Backup original subspecialty and district options
            const allSubOptions = Array.from(subspecialtySelect.options).filter(opt => opt.value);
            const allDistrictOptions = Array.from(districtSelect.options).filter(opt => opt.value);

            // Specialties → Subspecialties
            function filterSubspecialties() {
                const selectedId = specialtySelect.value;
                subspecialtySelect.innerHTML = '<option value="">-- اختياري --</option>';
                allSubOptions.forEach(opt => {
                    if (opt.dataset.specialtyId === selectedId) {
                        subspecialtySelect.appendChild(opt.cloneNode(true));
                    }
                });
            }
            specialtySelect.addEventListener('change', filterSubspecialties);

            // Governorates → Districts
            function filterDistricts() {
                const selectedGov = governorateSelect.value;
                districtSelect.innerHTML = '<option value="">-- اختر --</option>';
                allDistrictOptions.forEach(opt => {
                    if (opt.dataset.gov === selectedGov) {
                        districtSelect.appendChild(opt.cloneNode(true));
                    }
                });
            }
            governorateSelect.addEventListener('change', filterDistricts);

            // Clear form without breaking dropdowns
            function clearForm() {
                document.getElementById('doctor_name').value = '';
                document.getElementById('gender').selectedIndex = 0;
                specialtySelect.selectedIndex = 0;
                governorateSelect.selectedIndex = 0;
                document.getElementById('qualification_degree').value = '';
                document.getElementById('bio').value = '';
                document.getElementById('selected-doctor-id').value = '';

                methodInput.value = 'POST';
                form.action = "{{ route('doctors.store') }}";
                deleteForm.action = '';
                saveBtn.disabled = false;
                deleteBtn.disabled = true;

                subspecialtySelect.innerHTML = '<option value="">-- اختياري --</option>';
                districtSelect.innerHTML = '<option value="">-- اختر --</option>';
            }

            // Search filtering
            searchInput.addEventListener('input', function() {
                const term = this.value.toLowerCase();
                doctorList.innerHTML = '';
                doctors.filter(d =>
                    d.doctor_name.toLowerCase().includes(term) ||
                    d.specialty?.name?.toLowerCase().includes(term)
                ).forEach(d => {
                    const option = document.createElement('option');
                    option.value = d.id;
                    option.text = `${d.doctor_name} - ${d.specialty?.name || ''}`;
                    doctorList.appendChild(option);
                });
            });

            // Load data on update click
            updateBtn.addEventListener('click', () => {
                const id = doctorList.value;
                if (!id) return;
                const doc = doctors.find(d => d.id == id);
                if (!doc) return;

                methodInput.value = 'PATCH';
                form.action = `/admin/doctors/${doc.id}`;
                deleteForm.action = `/admin/doctors/${doc.id}`;
                saveBtn.disabled = false;
                deleteBtn.disabled = false;
                document.getElementById('selected-doctor-id').value = doc.id;
                document.getElementById('doctor_name').value = doc.doctor_name;
                document.getElementById('gender').value = doc.gender;
                document.getElementById('specialty_id').value = doc.specialty_id;
                document.getElementById('qualification_degree').value = doc.qualification_degree || '';
                document.getElementById('bio').value = doc.bio || '';
                document.getElementById('governorate_id').value = doc.governorate_id;

                // Trigger filtered options
                filterSubspecialties();
                filterDistricts();

                // Then select the correct dependent values
                document.getElementById('subspecialty_id').value = doc.subspecialty_id || '';
                document.getElementById('district_id').value = doc.district_id || '';
            });

            // Add new doctor (reset mode)
            addBtn.addEventListener('click', () => {
                clearForm();
                filterSubspecialties();
                filterDistricts();
            });
        </script>
    </div> <!-- end .container -->

</body>

</html>
