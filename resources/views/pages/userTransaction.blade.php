@extends('layouts.nav')
<link rel="shortcut icon" href="{{ Vite::asset('resources/images/logo.svg') }}" type="image/x-icon">

@vite(['resources/css/admin.css'])

@section('content')
    <div class="container">
        <table class="responsive-table">
            <caption>معاملاتك</caption>
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
                    <th scope="col">حالة المعاملة </th>
                    <th scope="col">اضافة ملاحظة</th>
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
                        <td>{{ $transaction->transaction_status }}</td>
                        <td>{{ $transaction->note }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
