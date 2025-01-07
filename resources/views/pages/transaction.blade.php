@extends('layouts.nav')
@section('content')
    @vite(['resources/css/transaction.css']);
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <section class="transaction-hero">
        <div class="info">
            <h1>مرحبا بكم في منصة تسيير معاملات العقارات للمغتربين</h1>
            <p>نحن هنا لتسهيل وتبسيط جميع معاملاتكم القانونية الخاصة بالعقارات، أينما كنتم حول العالم.</p>
        </div>
    </section>

    <section class="start-transaction">
        <h2>ابدأ معاملتك</h2>
        <div class="body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="form">
                <form id="transaction-form" action="{{ url('/storeTransaction') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h3>تفاصيل العقار:</h3>
                    <div class="part description">
                        <label for="city">المدينة</label>
                        <select name="city_id" id="city" required>
                            <option value="" selected>اختر مدينة</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <div class="error">{{ $message }}</div>
                        @enderror

                        <label for="property_address">العنوان:</label>
                        <input type="text" placeholder="العنوان الكامل للعقار" name="property_address" required>
                        @error('property_address')
                            <div class="error">{{ $message }}</div>
                        @enderror

                        <label for="property_area">المساحة:</label>
                        <input type="number" placeholder="المساحة (متر مربع)" name="property_area" required>
                        @error('property_area')
                            <div class="error">{{ $message }}</div>
                        @enderror

                        <label for="property_rooms">عدد الغرف:</label>
                        <input type="number" placeholder="عدد الغرف" name="property_rooms">
                        @error('property_rooms')
                            <div class="error">{{ $message }}</div>
                        @enderror

                        <label for="description">تفاصيل العقار:</label>
                        <input type="text" placeholder="تفاصيل إضافية للعقار" rows="4" name="description">
                        @error('description')
                            <div class="error">{{ $message }}</div>
                        @enderror

                        <label for="property_status">حالة العقار:</label>
                        <select name="property_status" required>
                            <option value="" selected>حالة العقار</option>
                            <option value="عقار جديد">عقار جديد</option>
                            <option value="عقار مستعمل">عقار مستعمل</option>
                            <option value="أرض منظمة للبناء">أرض منظمة للبناء</option>
                            <option value="أرض زراعية">أرض زراعية</option>
                            <option value="قيد الانشاء">قيد الإنشاء</option>
                        </select>
                        @error('property_status')
                            <div class="error">{{ $message }}</div>
                        @enderror

                        <label for="transaction_types">نوع المعاملة:</label>
                        <select name="transaction_type_id" id="transaction_types" required>
                            <option value="" selected>نوع العقد</option>
                            @foreach ($transaction_types as $transaction_type)
                                <option value="{{ $transaction_type->id }}">{{ $transaction_type->type }}</option>
                            @endforeach
                        </select>
                        @error('transaction_type')
                            <div class="error">{{ $message }}</div>
                        @enderror

                        <label for="cost">المبلغ المطلوب:</label>
                        <input type="number" placeholder="سعر العقار أو ايجار الشهر" name="cost" required>
                        @error('cost')
                            <div class="error">{{ $message }}</div>
                        @enderror

                        <label for="payment_methods">طريقة الدفع:</label>
                        <select name="payment_method_id" id="payment_methods" required>
                            <option value="" selected>اختر طريقة الدفع</option>
                            @foreach ($payment_methods as $payment_method)
                                <option value="{{ $payment_method->id }}">{{ $payment_method->method }}</option>
                            @endforeach
                        </select>
                        @error('payment_type')
                            <div class="error">{{ $message }}</div>
                        @enderror

                    </div>

                    {{-- ****************************************************************************************************************************************************************** --}}
                    <h3>إضافة صور العقار:</h3>
                    <div class="part property-images gallary-container">
                        <div id="property-images-container">
                            <label for="property_images" class="custom-file-label">
                                <i class="fas fa-plus"></i>
                            </label>
                            <input type="file" name="property_images[]" id="property_images" multiple
                                accept=".jpg,.jpeg,.png,.webp,.gif" onchange="previewImages(event)">
                            @error('property_images')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="preview" id="preview-container"></div>
                    </div>

                    {{-- ******************************************************************************************************************************************************************** --}}
                    <h3> الوثائق المطلوبة:</h3>
                    <div class="part property-documents gallary-container">
                        <div id="required_documents-container">
                            <label for="required_documents" class="custom-file-label">
                                <i class="fas fa-plus"></i>
                            </label>
                            <input type="file" name="required_documents[]" id="required_documents" multiple
                                accept=".jpg,.jpeg,.png,.webp,.gif,.pdf" onchange="previewDocuments(event)">
                            @error('required_documents')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="preview" id="documents-preview-container"></div>
                    </div>

                    {{-- ******************************************************************************************************************************************************************** --}}
                    <h3> معلومات الاتصال:</h3>
                    <div class="part contact_info">
                        <div>
                            <label for="contact_methods">وسيلة الاتصال:</label>
                            <select name="contact_method_id" id="contact_methods" required>
                                <option value="" selected>اختر وسيلة الاتصال</option>
                                @foreach ($contactMethods as $method)
                                    <option value="{{ $method->id }}">{{ $method->method }}</option>
                                @endforeach
                            </select>
                            @error('contact_method_id')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="contact_info">معلومات الاتصال:</label>
                            <input type="text" placeholder="معلومات جهة الاتصال" name="contact_info" required>
                            @error('contact_info')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <h3>تسديد الرسوم :</h3>
                    <div class="cost_info">
                        <label style="text-align: center;color: #00563f54;">رسوم المعاملة للموقع 3 دولار للمعاملة <br>نضمن
                            لك تنفيذ جميع
                            الاجراءات الخاصة بهذه المعاملة
                            بكل سرية و موثوقية مع فريق متخصص من المحامين و مسيري المعاملات ذوي الخبرة</label>
                        <input type="hidden" id="amount" name="amount" value="3" readonly>
                    </div>

                    <div class="item">
                        <label style="width: 100px">بيانات البطاقة:</label>
                        <div id="card-element" style="width: 100%;"></div>
                    </div>

                    <div id="card-errors" role="alert"></div>

                    <div class="submit">
                        <button type="submit" class="submit btn-primary">إرسال المعاملة والدفع</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        function createPreviewElement(file, index, type) {
            const wrapper = document.createElement('div');
            wrapper.style.marginBottom = '10px';
            wrapper.style.display = 'flex';
            wrapper.style.flexDirection = 'column';
            wrapper.style.alignItems = 'center';
            wrapper.style.rowGap = '10px';

            if (type === 'image') {
                const imageElement = document.createElement('img');
                imageElement.src = file;
                imageElement.style.width = '100px';
                imageElement.style.height = '100px';
                imageElement.style.objectFit = 'cover';
                imageElement.style.marginRight = '10px';
                wrapper.appendChild(imageElement);
            } else {
                const fileNameElement = document.createElement('span');
                fileNameElement.textContent = file;
                fileNameElement.style.marginRight = '10px';
                wrapper.appendChild(fileNameElement);
            }

            const commentInput = document.createElement('input');
            commentInput.type = 'text';
            commentInput.name = `${type}_comments[${index}]`;
            commentInput.placeholder = `أضف تعليقًا على هذه ${type === 'image' ? 'الصورة' : 'الوثيقة'}`;
            commentInput.style.width = '300px';
            commentInput.style.background = 'white';

            wrapper.appendChild(commentInput);

            return wrapper;
        }

        function handleFiles(event, containerId, filterImagesOnly = false) {
            const previewContainer = document.getElementById(containerId);
            previewContainer.innerHTML = '';
            const files = event.target.files;

            Array.from(files).forEach((file, index) => {
                const reader = new FileReader();
                const isImage = file.name.match(/\.(jpg|jpeg|png)$/i);

                reader.onload = function(e) {
                    const fileType = isImage ? 'image' : 'document';
                    if (!filterImagesOnly || isImage) {
                        const previewElement = createPreviewElement(
                            isImage ? e.target.result : file.name,
                            index,
                            fileType
                        );
                        previewContainer.appendChild(previewElement);
                    }
                };

                reader.readAsDataURL(file);
            });
        }

        function previewImages(event) {
            handleFiles(event, 'preview-container');
        }

        function previewDocuments(event) {
            handleFiles(event, 'documents-preview-container', true);
        }
        const stripe = Stripe(
            'pk_test_51ONXM0DCnvSZulvvRJCUdzqajOBsSoeP1o25GSQctKDvEYf7dgTPJn6XlIGu4aLqjU8mKByPfK4UcCL673wCDwpX00bVUfXybD'
            );
        const elements = stripe.elements();
        const cardElement = elements.create('card');
        cardElement.mount('#card-element');

        const form = document.getElementById('transaction-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const {
                token,
                error
            } = await stripe.createToken(cardElement);

            if (error) {
                document.getElementById('card-errors').textContent = error.message;
            } else {
                const formData = new FormData(form);
                formData.append('stripeToken', token.id);

                fetch('{{ route('storeTransaction') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData,
                    })
                    .then(response => response.text())
                    .then(text => {
                        try {
                            const data = JSON.parse(text);
                            if (data.success) {
                                alert('تم إرسال المعاملة والدفع بنجاح!');
                                window.location.href = '{{ url('/') }}';
                            } else {
                                alert(data.message || 'حدث خطأ أثناء معالجة الطلب.');
                            }
                        } catch (error) {
                            console.error('Response is not valid JSON:', text);
                            alert('حدث خطأ غير متوقع. الرجاء المحاولة لاحقاً.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('حدث خطأ أثناء الاتصال بالخادم.');
                    });
            }
        });
    </script>
@endsection
