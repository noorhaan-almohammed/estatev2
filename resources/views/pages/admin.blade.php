@vite(['resources/css/admin.css'])
@auth
    @if (Auth::user()->role == 'admin')
        @extends('layouts.nav')
        <link rel="shortcut icon" href="{{ Vite::asset('resources/images/logo.svg') }}" type="image/x-icon">

        @section('content')
            <div class="container">
                <table class="responsive-table">
                    <caption>معاملات عملاؤك</caption>
                    <thead>
                        <tr>
                            <th scope="col">اسم الزبون</th>
                            <th scope="col">المدينة</th>
                            <th scope="col">العنوان</th>
                            <th scope="col">المساحة</th>
                            <th scope="col">عدد الغرف</th>
                            <th scope="col">تفاصيل إضافية</th>
                            <th scope="col">حالة العقار</th>
                            <th scope="col">نوع المعاملة</th>
                            <th scope="col">المبلغ</th>
                            <th scope="col">طريقة الدفع</th>
                            <th scope="col">وسيلة الاتصال</th>
                            <th scope="col">معلومات الاتصال</th>
                            <th scope="col">حالة المعاملة |
                                اضافة ملاحظة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->city->name }}</td>
                                <td>{{ $transaction->property_address }}</td>
                                <td>{{ $transaction->property_area }}</td>
                                <td>{{ $transaction->property_rooms }}</td>
                                <td>{{ $transaction->description }}</td>
                                <td>{{ $transaction->property_status }}</td>
                                <td>{{ $transaction->transactionType->type }}</td>
                                <td>{{ $transaction->cost }}</td>
                                <td>{{ $transaction->paymentMethod->method }}</td>
                                <td>{{ $transaction->contactMethod->method }}</td>
                                <td>{{ $transaction->contact_info }}</td>
                                <td>
                                    <form action="{{ route('updateTransaction', $transaction->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <select name="transaction_status" required>
                                            <option value="{{ $transaction->transaction_status }}" selected>
                                                {{ $transaction->transaction_status }}</option>
                                            <option value="معلقة">معلقة</option>
                                            <option value="قيد الانجاز">قيد الانجاز</option>
                                            <option value="منجزة">منجزة</option>
                                            <option value="مرفوضة">مرفوضة</option>
                                        </select>
                                        <input type="text" name="note" value="{{ $transaction->note ?? 'لا يوجد' }}">
                                        <input type="submit" value="حفظ">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endsection
    @endif

@endauth

@section('content')
    <div class="container unAuth">
        <p class="unAuth"> أنت غير مخول للدخول لهذه الصفحة . سجل دخول أولا! </p>
    </div>
@endsection
