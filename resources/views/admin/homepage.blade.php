<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>الصفحة الرئيسية - الأطباء</title>


    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body class="bg-gradient-to-l from-blue-50 to-blue-100 font-sans">
    <header class="bg-blue-700 text-white p-4 text-center">
        <div class="text-lg font-semibold">مرحبا بك، ماجد</div>
        <input type="text" class="mt-2 w-full max-w-md mx-auto p-2 rounded-lg text-black"
            placeholder="ابحث عن طبيب مناسب" />
    </header>

    <section class="grid grid-cols-4 gap-2 md:gap-3 mb-6 md:mb-8">
        <div
            class="bg-white p-3 md:p-4 rounded-xl shadow flex flex-col items-center text-center hover:shadow-lg transition-shadow">
            <div class="bg-purple-100 p-3 md:p-4 rounded-full mb-3 flex items-center justify-center">
                <img src="{{ asset('assets/icon/MedCons.png') }}" alt="خدمة تمريض" class="w-14 h-14">
            </div>
            <p class="font-medium text-gray-700 text-sm md:text-base"> استشارة طبية</p>
        </div>
        <div
            class="bg-white p-3 md:p-4 rounded-xl shadow flex flex-col items-center text-center hover:shadow-lg transition-shadow">
            <div class="bg-orange-100 p-3 md:p-4 rounded-full mb-3 flex items-center justify-center">
                <img src="{{ asset('assets/icon/embulance.png') }}" alt="خدمة اسعاف" class="w-14 h-14">
            </div>
            <p class="font-medium text-gray-700 text-sm md:text-base">خدمة اسعاف</p>
        </div>
        <div
            class="bg-white p-3 md:p-4 rounded-xl shadow flex flex-col items-center text-center hover:shadow-lg transition-shadow">
            <div class="bg-purple-100 p-3 md:p-4 rounded-full mb-3 flex items-center justify-center">
                <img src="{{ asset('assets/icon/nursing.png') }}" alt="خدمة تمريض" class="w-14 h-14">
            </div>
            <p class="font-medium text-gray-700 text-sm md:text-base">خدمة تمريض</p>
        </div>
     <div
            class="bg-white p-3 md:p-4 rounded-xl shadow flex flex-col items-center text-center hover:shadow-lg transition-shadow">
            <div class="bg-purple-100 p-3 md:p-4 rounded-full mb-3 flex items-center justify-center">
                <img src="{{ asset('assets/icon/Drug.png') }}" alt="خدمة تمريض" class="w-14 h-14">
            </div>
            <p class="font-medium text-gray-700 text-sm md:text-base">دواء </p>
        </div>
    </section>

    <main class="p-4">

        {{-- 🔹 أفضل الأطباء --}}
        <section class="mb-6 md:mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">أفضل الأطباء</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">
                @foreach ($schedules as $schedule)
                    <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-lg transition-shadow">
                        <img alt="{{ $schedule->doctor->doctor_name }}" class="w-full h-40 object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBtBYQz0L8yGEQeQxE3B3BlBlEiNjCCtKqc8Yivq3FZhQxeouWOJ3u3jjeLvJYsYKoqIBMenkuK0gQjZ8t7Ls-KyBjktumljis6MUj3iAnXh2QE8xHicv-YLWMfFDCokWYI9ayU0pCtYmRwJmSKOPkOhqe-sGvJhZ3vW9k-KVXLL2GWSku_iu29qwwBizBQeiEkuKE7W3BPyvB4HIbhLcSnqlFFY7_IQJU8L2_ZUGRkPQiorlGfRoAAjxb8S3FMg97hvVe8kYTQ6hA" />
                        <div class="p-3 text-right">
                            <h3 class="font-semibold text-gray-700"> {{ $schedule->doctor->doctor_name }}</h3>
                            <p class="text-sm text-gray-500">
                                {{ $schedule->doctor->specialty->specialty_name ?? 'تخصص غير محدد' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        {{-- 🔸 إعلانات --}}
        <section class="mb-6 md:mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">إعلانات</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                <div class="carousel-item">
                    <div
                        class="bg-gradient-to-br from-indigo-600 to-purple-600 text-white p-6 rounded-2xl shadow-xl h-48 flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute -top-8 -left-8 w-32 h-32 bg-white/10 rounded-full"></div>
                        <div class="absolute -bottom-12 -right-4 w-40 h-40 bg-white/10 rounded-full"></div>
                        <div class="z-10">
                            <h3 class="text-xl font-bold">مستشفى الأمل</h3>
                            <p class="text-sm opacity-80 mt-1">رعاية صحية متكاملة بخبرات عالمية.</p>
                        </div>
                        <a href="#"
                            class="z-10 self-start bg-white/20 hover:bg-white/30 text-white text-sm font-semibold py-2 px-4 rounded-lg transition-colors">اعرف
                            المزيد</a>
                    </div>
                </div>

                <div class="carousel-item">
                    <div
                        class="bg-gradient-to-br from-teal-500 to-cyan-500 text-white p-6 rounded-2xl shadow-xl h-48 flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-full h-full opacity-20">
                            <svg height="100%" width="100%" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <pattern id="smallGrid" width="10" height="10" patternUnits="userSpaceOnUse">
                                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5" />
                                    </pattern>
                                </defs>
                                <rect width="100%" height="100%" fill="url(#smallGrid)" />
                            </svg>
                        </div>
                        <div class="z-10">
                            <h3 class="text-xl font-bold">د. أحمد خالد</h3>
                            <p class="text-sm opacity-80 mt-1">استشاري قلب وأوعية دموية زائر. احجز موعدك الآن.</p>
                        </div>
                        <a href="#"
                            class="z-10 self-start bg-white/20 hover:bg-white/30 text-white text-sm font-semibold py-2 px-4 rounded-lg transition-colors">احجز
                            موعد</a>
                    </div>
                </div>

                <div class="carousel-item">
                    <div
                        class="bg-gradient-to-br from-pink-500 to-rose-500 text-white p-6 rounded-2xl shadow-xl h-48 flex flex-col justify-between relative overflow-hidden">
                        <span
                            class="material-icons absolute top-4 right-4 text-white opacity-50 text-5xl transform rotate-12">local_hospital</span>
                        <div class="z-10">
                            <h3 class="text-xl font-bold">عيادات النور التخصصية</h3>
                            <p class="text-sm opacity-80 mt-1">نخبة من الأطباء في خدمتكم. خصومات خاصة هذا الشهر.</p>
                        </div>
                        <a href="#"
                            class="z-10 self-start bg-white/20 hover:bg-white/30 text-white text-sm font-semibold py-2 px-4 rounded-lg transition-colors">عرض
                            العروض</a>
                    </div>
                </div>

                <div class="carousel-item">
                    <div
                        class="bg-gradient-to-br from-yellow-400 to-amber-500 text-gray-800 p-6 rounded-2xl shadow-xl h-48 flex flex-col justify-between relative overflow-hidden">
                        <div
                            class="absolute top-0 left-0 w-20 h-20 bg-gray-800/10 rounded-full -translate-x-1/2 -translate-y-1/2">
                        </div>
                        <div class="z-10">
                            <h3 class="text-xl font-bold">البروفيسور سارة لي</h3>
                            <p class="text-sm opacity-80 mt-1 text-gray-700">خبيرة تغذية عالمية. قادمة قريباً لإجراء
                                استشارات.</p>
                        </div>
                        <a href="#"
                            class="z-10 self-start bg-gray-800/20 hover:bg-gray-800/30 text-gray-800 text-sm font-semibold py-2 px-4 rounded-lg transition-colors">سجل
                            اهتمامك</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="mb-6 md:mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">الأطباء المتاحون</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                <div
                    class="bg-blue-600 text-white p-4 md:p-6 rounded-xl shadow-lg flex flex-col md:flex-row items-center relative overflow-hidden text-right">
                    <div class="md:w-2/3 mb-4 md:mb-0 md:pl-4">
                        <h3 class="text-lg md:text-xl font-semibold mb-1">هل تبحث عن طبيب أسنان متخصص؟</h3>
                        <p class="text-sm font-medium mb-2">د. كوثر أحمد</p>
                        <div class="flex items-center justify-end mb-3">
                            <span class="material-icons text-gray-300 text-base">star_border</span>
                            <span class="material-icons text-yellow-400 text-base">star</span>
                            <span class="material-icons text-yellow-400 text-base">star</span>
                            <span class="material-icons text-yellow-400 text-base">star</span>
                            <span class="material-icons text-yellow-400 text-base">star</span>
                        </div>
                        <button
                            class="bg-white text-blue-600 font-semibold py-2 px-4 rounded-lg hover:bg-blue-50 transition-colors">احجز
                            الآن</button>
                    </div>
                    <div class="md:w-1/3 relative h-32 md:h-auto">
                        <img alt="Dr. Kawsar Ahmed"
                            class="rounded-lg w-full h-full md:absolute md:left-[-20px] md:bottom-[-20px] md:w-auto md:h-48 object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAmTvZ3hGMhiNcNvKYqfTIB5cyzlD-kvUdmkW5FXA9tQ-Oc_ezkw0BC_KX_3CNxib6v98Fb2mZqRe4_lvrkNocDy6IibIP6WCjKyqE1p7a2diHQ7Pf7YHlJFLhpB5DhOLYR4vZnZoERrVw8Q80tsPuuq6PLn5xs0gDIimQEkojCppcFxpW8bFIZ7MdVeihecDNCcgoOkAsaZjSTXB0FOUykGSJLLnWA9s18Hn_xTgjW0dsw7zEA_NY8Aa62Pt3GbS62bTFcUno0jZI" />
                    </div>
                </div>
                <div
                    class="bg-purple-600 text-white p-4 md:p-6 rounded-xl shadow-lg flex flex-col md:flex-row items-center relative overflow-hidden text-right">
                    <div class="md:w-2/3 mb-4 md:mb-0 md:pl-4">
                        <h3 class="text-lg md:text-xl font-semibold mb-1">هل تبحث عن طبيب متخصص؟</h3>
                        <p class="text-sm font-medium mb-2">د. سبيشيا ليست</p>
                        <div class="flex items-center justify-end mb-3">
                            <span class="material-icons text-gray-300 text-base">star_border</span>
                            <span class="material-icons text-gray-300 text-base">star_border</span>
                            <span class="material-icons text-yellow-400 text-base">star</span>
                            <span class="material-icons text-yellow-400 text-base">star</span>
                            <span class="material-icons text-yellow-400 text-base">star</span>
                        </div>
                        <button
                            class="bg-white text-purple-600 font-semibold py-2 px-4 rounded-lg hover:bg-purple-50 transition-colors">احجز
                            الآن</button>
                    </div>
                    <div class="md:w-1/3 relative h-32 md:h-auto">
                        <img alt="Specialist Doctor"
                            class="rounded-lg w-full h-full md:absolute md:left-[-20px] md:bottom-[-20px] md:w-auto md:h-48 object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDaUgHqq6cXZG9_SNcWhKeyfhuobxyFPrRCHjYIVORIv-MTj2XR1uOac1bxJ7nI1oH5KDMJr5KFB6WJoLdZRYRskDJaYBvI_djBUqMgm9OVOQ1S1bp631qXTcO1nLmjK239AErSm0iSP94jzmcrqiuBlUwIAJQko_SpK4wMYuD7HkKeyZefZ05mEG1Cfyj5z04SPzjcugtts9BMbVo244VvSYyLlkoj9b1gMmhscJNY4qs6DG4clAkEHiTb4XWSzRSbDgxWAS3a8oA" />
                    </div>
                </div>
            </div>
        </section>
        <section class="mb-6 md:mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">المزيد من الأطباء المتاحين</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-lg transition-shadow text-right">
                    <div class="relative">
                        <img alt="Dr. Kawsar Ahmed" class="w-full h-48 object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwq3OULUM74VwRWge2OTSpfflw-xP6cCdb4XhBeD7cl7ezlVAkvkp_ZHpKK1dyEkCrDt8x7OnEmcO4b-9d6VbzxJOdFTgFyylU_CpRfDGaI5ju-Hhb_ivbA9qhdpHbMqCLSjyK6hFvHVeGpq3eEbjYqAscvWswOPvNINaapxXPqai5pyIiawVX_6O7--8zSdI6VIXvWNETotQBlAGztQCdfzxc3QqvmcJmhVMXKQfPy693e5TuZYJKw2sMbXDO2h6LUuoNtJvCsG0" />
                        <span
                            class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-md">متصل</span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-800">د. كوثر أحمد</h3>
                        <p class="text-sm text-gray-500 mb-1">بكالوريوس طب وجراحة، ماجستير فلسفة</p>
                        <p class="text-sm text-gray-500 mb-2">4+ سنوات</p>
                        <p class="text-xl font-bold text-blue-600 mb-3">$199 <span
                                class="text-sm text-gray-500 font-normal">شامل الضريبة</span></p>
                        <button
                            class="w-full bg-blue-600 text-white font-semibold py-2.5 px-4 rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center">
                            <span class="material-icons ml-2">videocam</span> شاهد الطبيب الآن
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow overflow-hidden hover:shadow-lg transition-shadow text-right">
                    <div class="relative">
                        <img alt="Dr. Kumpa" class="w-full h-48 object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDy4saQBmZRyOvYLae8iDewvCvH-QSjDLzuOZC8LJV8fylAtdAw5vQ5paG25iQf6Dd_tahYpj0sfBlFW6yS5d5QaKldhYro1kCL_cV_JjkLQb6HVz49MFOWcjCvVl100_OBSSY1R6vFA_En0Kt2sFjWTH-I_DG5f0l2j-5hz2umT1GsFYD1Jp2QkvXcKB6h3tixOCIViAQTZ2Xg2VAXOuzjRto8DINsNyg2VOFZhCeIVMIoDAHmegF9wlCLQv6ejghQ0ptJJYNfhLE" />
                        <span
                            class="absolute top-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded-md">متصل</span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-800">د. كومبا</h3>
                        <p class="text-sm text-gray-500 mb-1">بكالوريوس طب وجراحة، زمالة كلية الأطباء والجراحين</p>
                        <p class="text-sm text-gray-500 mb-2">6+ سنوات</p>
                        <p class="text-xl font-bold text-blue-600 mb-3">$299 <span
                                class="text-sm text-gray-500 font-normal">شامل الضريبة</span></p>
                        <button
                            class="w-full bg-blue-600 text-white font-semibold py-2.5 px-4 rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center">
                            <span class="material-icons ml-2">videocam</span> شاهد الطبيب الآن
                        </button>
                    </div>
                </div>
                <div
                    class="bg-white rounded-xl shadow overflow-hidden hover:shadow-lg transition-shadow hidden sm:block text-right">
                    <div class="relative">
                        <img alt="Dr. Jhon Doe" class="w-full h-48 object-cover"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCS9JP3ye112Wp4NKZjPuwK8U7Jb_iERdAAqvFp0EQgMAidR4MYnnzrCy34ZQl9O6__mTye5mAyJEsIUChs9XOe83yyLm-vnc0YOOMPap-XkdcwIEIZgi3BaX90tfwS97ygA9yAS7OMVCqQyTghhTTQawlSjsFhA78uSo0HGlQNkWn9dlxLNIxa7AnEMozDZTN8Un4Uf4nvuMGJerRUjPgvM5s19L7Lm24Bk0fcm71fMbpVQrKqF7yPaYcgt5aP_n4fac4WJTEqVYM" />
                        <span class="absolute top-2 left-2 bg-gray-400 text-white text-xs px-2 py-1 rounded-md">غير
                            متصل</span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg text-gray-800">د. جون دو</h3>
                        <p class="text-sm text-gray-500 mb-1">دكتور في الطب، أخصائي</p>
                        <p class="text-sm text-gray-500 mb-2">10+ سنوات</p>
                        <p class="text-xl font-bold text-blue-600 mb-3">$150 <span
                                class="text-sm text-gray-500 font-normal">شامل الضريبة</span></p>
                        <button
                            class="w-full bg-gray-400 text-white font-semibold py-2.5 px-4 rounded-lg cursor-not-allowed flex items-center justify-center">
                            <span class="material-icons ml-2">videocam_off</span> غير متصل
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-blue-700 text-white p-4 text-sm flex justify-around">
        <a href="#">الرئيسية</a>
        <a href="#">بحث</a>
        <a href="#">فيديو</a>
        <a href="#">محادثة</a>
        <a href="#">حسابي</a>
    </footer>

    <script>
        document.querySelector('.search-bar').addEventListener('input', function(e) {
            const query = e.target.value.toLowerCase();
            document.querySelectorAll('.doctor-card').forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(query) ? '' : 'none';
            });
        });
    </script>
</body>

</html>
