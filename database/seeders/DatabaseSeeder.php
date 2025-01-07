<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\City;
use App\Models\User;
use App\Models\Transaction;
use App\Models\ContactMethod;
use App\Models\PaymentMethod;
use App\Models\TransactionType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ])

        User::create([
            'name' => 'khaled',
            'email' => 'khaled999@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);
        City::create(['name' => 'حمص']);
        City::create(['name' => 'دمشق']);
        City::create(['name' => 'ريف دمشق']);
        City::create(['name' => 'حلب']);
        City::create(['name' => 'حماه']);
        City::create(['name' => 'الرقة']);
        City::create(['name' => 'إدلب']);
        City::create(['name' => 'دير الزور']);
        City::create(['name' => 'القنيطرة']);
        City::create(['name' => 'اللاذقية']);
        City::create(['name' => 'طرطوس']);
        City::create(['name' => 'درعا']);
        City::create(['name' => 'السويداء']);
        City::create(['name' => 'الحسكة']);
        City::create(['name' => 'القامشلي']);

        ContactMethod::create(['method'=>'واتس اب']);
        ContactMethod::create(['method'=>'مسنجر']);
        ContactMethod::create(['method'=>'اتصال عادي']);
        ContactMethod::create(['method'=>'ايميل']);
        ContactMethod::create(['method'=>'فاكس']);

        TransactionType::create(['type'=>'بيع']);
        TransactionType::create(['type'=>'شراء']);
        TransactionType::create(['type'=>'إيجار']);
        TransactionType::create(['type'=>'هبة(نقل ملكية بدون بيع)']);
        TransactionType::create(['type'=>'تصديق']);
        TransactionType::create(['type'=>'تجديد']);
        TransactionType::create(['type'=>'رهن']);
        TransactionType::create(['type'=>'استثمار']);
        TransactionType::create(['type'=>'حجز']);
        TransactionType::create(['type'=>'تنازل']);
        TransactionType::create(['type'=>'وصية']);
        TransactionType::create(['type'=>'تقسيم ورثة']);
        TransactionType::create(['type'=>'وكالة']);
        TransactionType::create(['type'=>'مبادلة']);

        PaymentMethod::create(['method'=>'حوالة مصرفية']);
        PaymentMethod::create(['method'=>'حوالة بنكية']);
        PaymentMethod::create(['method'=>'دفع مباشر']);
        PaymentMethod::create(['method'=>'دفع الكتروني']);
        PaymentMethod::create(['method'=>'تبادل']);


        Transaction::create([
            'user_id' => 2,
            'city_id' => 2,
            'contact_method_id' => 2,
            'payment_method_id' => 2,
            'transaction_type_id' => 2,
            'cost' => 20,
            'description' => 'تفاصيل',
            'contact_info' => '+96358421554',
            'property_area' => 60,
            'property_rooms' => 4,
            'property_status' => 'عقار جديد',
            'property_address' => 'عنوان دقيق',
            'transaction_status' => 'معلقة'
        ]);
        Transaction::create([
            'user_id' => 2,
            'city_id' => 2,
            'contact_method_id' => 2,
            'payment_method_id' => 2,
            'transaction_type_id' => 2,
            'cost' => 20,
            'description' => 'تفاصيل',
            'contact_info' => '+96358421554',
            'property_area' => 60,
            'property_rooms' => 4,
            'property_status' => 'عقار جديد',
            'property_address' => 'عنوان دقيق',
            'transaction_status' => 'معلقة'
        ]);
        Transaction::create([
            'user_id' => 2,
            'city_id' => 2,
            'contact_method_id' => 2,
            'payment_method_id' => 2,
            'transaction_type_id' => 2,
            'cost' => 20,
            'description' => 'تفاصيل',
            'contact_info' => '+96358421554',
            'property_area' => 60,
            'property_rooms' => 4,
            'property_status' => 'عقار جديد',
            'property_address' => 'عنوان دقيق',
            'transaction_status' => 'معلقة'
        ]);
        Transaction::create([
            'user_id' => 2,
            'city_id' => 2,
            'contact_method_id' => 2,
            'payment_method_id' => 2,
            'transaction_type_id' => 2,
            'cost' => 20,
            'description' => 'تفاصيل',
            'contact_info' => '+96358421554',
            'property_area' => 60,
            'property_rooms' => 4,
            'property_status' => 'عقار جديد',
            'property_address' => 'عنوان دقيق',
            'transaction_status' => 'معلقة'
        ]);
    }
}
