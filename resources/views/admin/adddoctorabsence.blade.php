<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <title>سجل غياب الأطباء</title>
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
    select, input, textarea {
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
    <h2>سجل غياب الأطباء</h2>

    @if (session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- List of existing absences --}}
    <div class="form-group">
      <label for="absence-list">قائمة الغيابات</label>
      <select size="5" id="absence-list">
        @foreach ($absences as $a)
          <option value="{{ $a->id }}">
            {{ $a->doctor->doctor_name }} - من {{ $a->start_date }} إلى {{ $a->end_date }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- Absence Form --}}
    <form method="POST" id="absence-form" action="{{ route('absences.store') }}">
      @csrf
      <input type="hidden" name="_method" id="form-method" value="POST">
      <input type="hidden" id="selected-absence-id">

      <div class="form-group">
        <label for="doctor_id">اسم الطبيب</label>
        <select name="doctor_id" id="doctor_id">
          <option value="">-- اختر --</option>
          @foreach ($doctors as $doc)
            <option value="{{ $doc->id }}" {{ old('doctor_id') == $doc->id ? 'selected' : '' }}>
              {{ $doc->doctor_name }}
            </option>
          @endforeach
        </select>
        @error('doctor_id') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="start_date">تاريخ بداية الغياب</label>
        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}">
        @error('start_date') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="end_date">تاريخ نهاية الغياب</label>
        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}">
        @error('end_date') <div class="error">{{ $message }}</div> @enderror
      </div>

      <div class="form-group">
        <label for="reason">سبب الغياب</label>
        <textarea name="reason" id="reason" rows="2">{{ old('reason') }}</textarea>
        @error('reason') <div class="error">{{ $message }}</div> @enderror
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
const absences = @json($absences);
const absenceList = document.getElementById('absence-list');
const absenceForm = document.getElementById('absence-form');
const formMethod = document.getElementById('form-method');
const deleteForm = document.getElementById('delete-form');
const addBtn = document.getElementById('add-btn');
const updateBtn = document.getElementById('update-btn');
const saveBtn = document.getElementById('save-btn');
const deleteBtn = document.getElementById('delete-btn');

function clearAbsenceForm() {
  document.getElementById('doctor_id').selectedIndex = 0;
  document.getElementById('start_date').value = '';
  document.getElementById('end_date').value = '';
  document.getElementById('reason').value = '';
  document.getElementById('selected-absence-id').value = '';

  formMethod.value = 'POST';
  absenceForm.action = "{{ route('absences.store') }}";
  deleteForm.action = '';
  saveBtn.disabled = false;
  deleteBtn.disabled = true;
}

// Load data from selected absence
updateBtn.addEventListener('click', () => {
  const id = absenceList.value;
  if (!id) return;

  const record = absences.find(a => a.id == id);
  if (!record) return;

  document.getElementById('selected-absence-id').value = id;
  document.getElementById('doctor_id').value = record.doctor_id;
  document.getElementById('start_date').value = record.start_date;
  document.getElementById('end_date').value = record.end_date;
  document.getElementById('reason').value = record.reason || '';

  formMethod.value = 'PATCH';
  absenceForm.action = `/admin/absences/${record.id}`;
  deleteForm.action = `/admin/absences/${record.id}`;
  saveBtn.disabled = false;
  deleteBtn.disabled = false;
});

// Reset form for new entry
addBtn.addEventListener('click', () => {
  clearAbsenceForm();
});
</script>
</body>
</html>