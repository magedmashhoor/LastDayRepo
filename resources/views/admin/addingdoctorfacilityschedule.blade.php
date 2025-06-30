<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>جداول دوام الأطباء في المرافق</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      direction: rtl;
      background: linear-gradient(to left, #f5f7fa, #c3cfe2);
      font-family: 'Noto Kufi Arabic', 'Amiri', 'Arial', sans-serif;
      padding: 2rem;
    }
    .container {
      max-width: 900px;
      margin: auto;
      background: white;
      padding: 2rem;
      border-radius: 12px;
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
    input,
    textarea {
      width: 100%;
      padding: 0.6rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      background-color: white;
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
    <h2>جداول دوام الأطباء</h2>

    @if (session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- Select existing schedule --}}
    <div class="form-group">
      <label for="schedule-list">قائمة الجداول</label>
      <select size="5" id="schedule-list">
        @foreach ($schedules as $s)
          <option value="{{ $s->id }}">
            {{ $s->doctor->doctor_name }} - {{ $s->facility->facility_name }} - {{ $s->day->day_name }} - {{ $s->shift_type }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- Schedule Form --}}
    <form method="POST" id="schedule-form" action="{{ route('schedules.store') }}">
      @csrf
      <input type="hidden" name="_method" id="form-method" value="POST">
      <input type="hidden" id="selected-schedule-id">

      <div class="form-group">
        <label for="doctor_id">اسم الطبيب</label>
        <select name="doctor_id" id="doctor_id">
          <option value="">-- اختر --</option>
          @foreach ($doctors as $d)
            <option value="{{ $d->id }}" {{ old('doctor_id') == $d->id ? 'selected' : '' }}>
              {{ $d->doctor_name }}
            </option>
          @endforeach
        </select>
        @error('doctor_id') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="facility_id">المرفق الصحي</label>
        <select name="facility_id" id="facility_id">
          <option value="">-- اختر --</option>
          @foreach ($facilities as $f)
            <option value="{{ $f->id }}" {{ old('facility_id') == $f->id ? 'selected' : '' }}>
              {{ $f->facility_name }}
            </option>
          @endforeach
        </select>
        @error('facility_id') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="day_id">اليوم</label>
        <select name="day_id" id="day_id">
          <option value="">-- اختر --</option>
          @foreach ($days as $d)
            <option value="{{ $d->id }}" {{ old('day_id') == $d->id ? 'selected' : '' }}>
              {{ $d->day_name }}
            </option>
          @endforeach
        </select>
        @error('day_id') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="shift_type">نوع الدوام</label>
        <select name="shift_type" id="shift_type">
          <option value="">-- اختر --</option>
          <option value="صباح" {{ old('shift_type') == 'صباح' ? 'selected' : '' }}>صباح</option>
          <option value="مساء" {{ old('shift_type') == 'مساء' ? 'selected' : '' }}>مساء</option>

        </select>
        @error('shift_type') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="start_time">من الساعة</label>
        <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}">
        @error('start_time') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="end_time">إلى الساعة</label>
        <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}">
        @error('end_time') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="is_active">مفعل؟</label>
        <select name="is_active" id="is_active">
          <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>نعم</option>
          <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>لا</option>
        </select>
        @error('is_active') <div class="error">{{ $message }}</div> @enderror
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
const schedules = @json($schedules);
const scheduleList = document.getElementById('schedule-list');
const scheduleForm = document.getElementById('schedule-form');
const methodInput = document.getElementById('form-method');
const deleteForm = document.getElementById('delete-form');
const addBtn = document.getElementById('add-btn');
const updateBtn = document.getElementById('update-btn');
const saveBtn = document.getElementById('save-btn');
const deleteBtn = document.getElementById('delete-btn');

function clearScheduleForm() {
    document.getElementById('doctor_id').selectedIndex = 0;
    document.getElementById('facility_id').selectedIndex = 0;
    document.getElementById('day_id').selectedIndex = 0;
    document.getElementById('shift_type').selectedIndex = 0;
    document.getElementById('start_time').value = '';
    document.getElementById('end_time').value = '';
    document.getElementById('is_active').value = '1';
    document.getElementById('selected-schedule-id').value = '';

    methodInput.value = 'POST';
    scheduleForm.action = "{{ route('schedules.store') }}";
    deleteForm.action = '';
    saveBtn.disabled = false;
    deleteBtn.disabled = true;
}

updateBtn.addEventListener('click', () => {
    const id = scheduleList.value;
    if (!id) return;

    const schedule = schedules.find(s => s.id == id);
    if (!schedule) return;

    methodInput.value = 'PATCH';
    scheduleForm.action = `/admin/schedules/${schedule.id}`;
    deleteForm.action = `/admin/schedules/${schedule.id}`;
    saveBtn.disabled = false;
    deleteBtn.disabled = false;
    document.getElementById('selected-schedule-id').value = schedule.id;
    document.getElementById('doctor_id').value = schedule.doctor_id;
    document.getElementById('facility_id').value = schedule.facility_id;
    document.getElementById('day_id').value = schedule.day_id;
    document.getElementById('shift_type').value = schedule.shift_type;
    document.getElementById('start_time').value = schedule.start_time;
    document.getElementById('end_time').value = schedule.end_time;
    document.getElementById('is_active').value = schedule.is_active ? '1' : '0';
});

addBtn.addEventListener('click', () => {
    clearScheduleForm();
});

</script>
</body>
</html>