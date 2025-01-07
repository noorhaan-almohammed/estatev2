<!DOCTYPE html>
<html>
<head>
    <title>رسالة تنبيه بسير معاملتك</title>
</head>
<body>
    <h2> المعاملة رقم {{ $details['transaction_id'] }}</h2>
    <p>أصبحت معاملتك  {{ $details['transaction_status'] }}</p>
    <p> وتم وضع الملاحظة التالية : {{ $details['note'] }}</p>
    <a href="{{ route('userViewTransaction', $details['user_id']) }}">
        مراجعة التغييرات
    </a>
</body>
</html>
