<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('locales')) {
            Schema::create('locales', function (Blueprint $table) {
                $table->id();
                $table->integer('section_id')->default(1);
                $table->string('var');
                $table->text('ar')->nullable();
                $table->text('en')->nullable();
                $table->timestamps();

                $table->index('section_id');
                $table->index('var');
            });
        }

        $rows = [
            ['section_id'=>1,'var'=>'siteName','ar'=>'جامعة زالنجي','en'=>'University of Zalingei'],
            ['section_id'=>1,'var'=>'rightsReserved','ar'=>'جميع الحقوق محفوظة','en'=>'All Rights Reserved'],
            ['section_id'=>1,'var'=>'getContent','ar'=>':ar','en'=>':en'],
            ['section_id'=>1,'var'=>'aboutUs','ar'=>'عن الجامعة','en'=>'About Us'],
            ['section_id'=>1,'var'=>'home','ar'=>'الرئيسية','en'=>'Home'],
            ['section_id'=>1,'var'=>'aboutUsDesc','ar'=>'جامعة زالنجي','en'=>'University of Zalingei'],
            ['section_id'=>2,'var'=>'students','ar'=>'الطلاب','en'=>'Students'],
            ['section_id'=>2,'var'=>'student_number','ar'=>'رقم الطالب','en'=>'Student Number'],
            ['section_id'=>2,'var'=>'name_ar','ar'=>'الاسم بالعربية','en'=>'Name (Arabic)'],
            ['section_id'=>2,'var'=>'name_en','ar'=>'الاسم بالإنجليزية','en'=>'Name (English)'],
            ['section_id'=>2,'var'=>'email','ar'=>'البريد الإلكتروني','en'=>'Email'],
            ['section_id'=>2,'var'=>'phone','ar'=>'رقم الهاتف','en'=>'Phone'],
            ['section_id'=>2,'var'=>'national_id','ar'=>'الرقم الوطني','en'=>'National ID'],
            ['section_id'=>2,'var'=>'college','ar'=>'الكلية','en'=>'College'],
            ['section_id'=>2,'var'=>'academic_year','ar'=>'العام الدراسي','en'=>'Academic Year'],
            ['section_id'=>2,'var'=>'control','ar'=>'التحكم','en'=>'Control'],
            ['section_id'=>2,'var'=>'addNewItem','ar'=>'إضافة عنصر جديد','en'=>'Add New Item'],
            ['section_id'=>2,'var'=>'add','ar'=>'إضافة','en'=>'Add'],
            ['section_id'=>2,'var'=>'cpanel','ar'=>'لوحة التحكم','en'=>'Control Panel'],
            ['section_id'=>2,'var'=>'edit','ar'=>'تعديل','en'=>'Edit'],
            ['section_id'=>2,'var'=>'show','ar'=>'عرض','en'=>'Show'],
            ['section_id'=>2,'var'=>'delete','ar'=>'حذف','en'=>'Delete'],
            ['section_id'=>2,'var'=>'results','ar'=>'النتائج','en'=>'Results'],
            ['section_id'=>2,'var'=>'department','ar'=>'القسم','en'=>'Department'],
            ['section_id'=>2,'var'=>'dept','ar'=>'القسم','en'=>'Department'],
            ['section_id'=>2,'var'=>'subject_name','ar'=>'اسم المادة','en'=>'Subject Name'],
            ['section_id'=>2,'var'=>'marks','ar'=>'الدرجة','en'=>'Marks'],
            ['section_id'=>2,'var'=>'grade','ar'=>'التقدير','en'=>'Grade'],
            ['section_id'=>2,'var'=>'semester','ar'=>'الفصل الدراسي','en'=>'Semester'],
            ['section_id'=>1,'var'=>'news','ar'=>'الأخبار','en'=>'News'],
            ['section_id'=>1,'var'=>'latestNews','ar'=>'آخر الأخبار','en'=>'Latest News'],
            ['section_id'=>1,'var'=>'allNews','ar'=>'كل الأخبار','en'=>'All News'],
            ['section_id'=>1,'var'=>'more','ar'=>'المزيد','en'=>'More'],
            ['section_id'=>1,'var'=>'services','ar'=>'الخدمات','en'=>'Services'],
            ['section_id'=>1,'var'=>'universitySystems','ar'=>'الأنظمة الجامعية','en'=>'University Systems'],
            ['section_id'=>1,'var'=>'events','ar'=>'الفعاليات','en'=>'Events'],
            ['section_id'=>1,'var'=>'contactUs','ar'=>'اتصل بنا','en'=>'Contact Us'],
            ['section_id'=>1,'var'=>'importantLinks','ar'=>'روابط مهمة','en'=>'Important Links'],
            ['section_id'=>1,'var'=>'addressLine1','ar'=>'السودان - ولاية وسط دارفور - زالنجي','en'=>'Sudan - Central Darfur State - Zalingei'],
            ['section_id'=>1,'var'=>'addressPhone','ar'=>'+249 71 123 4567','en'=>'+249 71 123 4567'],
            ['section_id'=>1,'var'=>'addressEmail','ar'=>'info@zalingei.edu.sd','en'=>'info@zalingei.edu.sd'],
            ['section_id'=>1,'var'=>'VCSpeachTitle','ar'=>'كلمة مدير الجامعة','en'=>'Message from the Rector'],
            ['section_id'=>1,'var'=>'VCSpeachTxt','ar'=>'مرحباً بكم في جامعة زالنجي...','en'=>'Welcome to the University of Zalingei...'],
            ['section_id'=>1,'var'=>'VCPic','ar'=>'/public/universo/assets/img/rector.jpg','en'=>'/public/universo/assets/img/rector.jpg'],
            ['section_id'=>1,'var'=>'universityHome','ar'=>'الرئيسية','en'=>'Home'],
            ['section_id'=>1,'var'=>'collegeHome','ar'=>'الرئيسية','en'=>'Home'],
            ['section_id'=>1,'var'=>'aboutCollege','ar'=>'عن الكلية','en'=>'About'],
            ['section_id'=>1,'var'=>'VMO','ar'=>'الرؤية والرسالة والأهداف','en'=>'Vision, Mission & Objectives'],
            ['section_id'=>1,'var'=>'regulations','ar'=>'اللوائح','en'=>'Regulations'],
            ['section_id'=>1,'var'=>'programs','ar'=>'البرامج','en'=>'Programs'],
            ['section_id'=>1,'var'=>'calendar','ar'=>'التقويم','en'=>'Calendar'],
            ['section_id'=>1,'var'=>'admission','ar'=>'القبول','en'=>'Admission'],
            ['section_id'=>1,'var'=>'departments','ar'=>'الأقسام','en'=>'Departments'],
            ['section_id'=>1,'var'=>'collegeNews','ar'=>'الأخبار','en'=>'News'],
            ['section_id'=>1,'var'=>'collegeAnnouncements','ar'=>'الإعلانات','en'=>'Announcements'],
            ['section_id'=>1,'var'=>'staff','ar'=>'الهيئة التدريسية','en'=>'Staff'],
            ['section_id'=>1,'var'=>'professors','ar'=>'الأساتذة','en'=>'Professors'],
        ];

        foreach ($rows as $row) {
            DB::table('locales')->updateOrInsert(
                ['section_id' => $row['section_id'], 'var' => $row['var']],
                ['ar' => $row['ar'], 'en' => $row['en'], 'updated_at' => now(), 'created_at' => now()]
            );
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('locales');
    }
};
