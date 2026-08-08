<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Extends the legacy academic tables without changing their existing keys.
     * The live application already uses `college` for colleges, institutes,
     * centres, units and directorates, so a separate duplicate catalogue is
     * deliberately avoided.
     */
    public function up(): void
    {
        Schema::table('college', function (Blueprint $table) {
            if (!Schema::hasColumn('college', 'parent_id')) {
                $table->unsignedBigInteger('parent_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('college', 'sort_order')) {
                $table->unsignedSmallInteger('sort_order')->default(0)->after('status');
            }
            $table->index('slug', 'college_slug_index');
            $table->index('colleges_type_id', 'college_type_index');
            $table->index('parent_id', 'college_parent_index');
        });

        Schema::table('dept', function (Blueprint $table) {
            $table->index('college_id', 'dept_college_index');
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->index('college_id', 'staff_college_index');
            $table->index('dept_id', 'staff_dept_index');
            $table->index(['college_id', 'staff_degree_id'], 'staff_college_degree_index');
        });

        Schema::table('college_details', function (Blueprint $table) {
            if (!Schema::hasColumn('college_details', 'dean_name')) {
                $table->string('dean_name')->nullable()->after('college_id');
                $table->string('dean_name_en')->nullable()->after('dean_name');
                $table->string('dean_title')->nullable()->after('dean_name_en');
                $table->string('dean_title_en')->nullable()->after('dean_title');
                $table->string('dean_email')->nullable()->after('dean_title_en');
                $table->string('dean_picture')->nullable()->after('dean_email');
                $table->text('dean_bio')->nullable()->after('dean_picture');
                $table->text('dean_bio_en')->nullable()->after('dean_bio');
            }
            $table->index('college_id', 'college_details_college_index');
        });

        $this->seedOfficialStructure();
    }

    public function down(): void
    {
        // The data is editorial content; rolling back must not delete it.
        Schema::table('college_details', function (Blueprint $table) {
            $table->dropIndex('college_details_college_index');
            if (Schema::hasColumn('college_details', 'dean_name')) {
                $table->dropColumn(['dean_name', 'dean_name_en', 'dean_title', 'dean_title_en', 'dean_email', 'dean_picture', 'dean_bio', 'dean_bio_en']);
            }
        });
        Schema::table('staff', function (Blueprint $table) {
            $table->dropIndex('staff_college_index');
            $table->dropIndex('staff_dept_index');
            $table->dropIndex('staff_college_degree_index');
        });
        Schema::table('dept', function (Blueprint $table) {
            $table->dropIndex('dept_college_index');
        });
        Schema::table('college', function (Blueprint $table) {
            $table->dropIndex('college_slug_index');
            $table->dropIndex('college_type_index');
            $table->dropIndex('college_parent_index');
            $table->dropColumn(['parent_id', 'sort_order']);
        });
    }

    private function seedOfficialStructure(): void
    {
        $typeIds = DB::table('colleges_types')->pluck('id', 'titleEn')->all();
        $records = [
            ['كلية الطب', 'Faculty of Medicine', 'medicine', 'College', 10, []],
            ['كلية الزراعة', 'Faculty of Agriculture', 'agriculture', 'College', 20, []],
            ['كلية التربية', 'Faculty of Education', 'education', 'College', 30, []],
            ['كلية التربية - مرحلة الأساس', 'Faculty of Basic Education', 'education-basic', 'College', 40, ['educationbasic']],
            ['كلية الاقتصاد والعلوم الإدارية', 'Faculty of Economics and Administrative Sciences', 'economics', 'College', 50, ['economicscience']],
            ['كلية علوم الحاسوب وتقانة المعلومات', 'Faculty of Computer Science and Information Technology', 'csit', 'College', 60, ['computer-science']],
            ['كلية العلوم الصحية', 'Faculty of Health Sciences', 'health-science', 'College', 70, ['healthscience']],
            ['كلية علوم التقانة', 'Faculty of Science and Technology', 'science-technology', 'College', 80, ['sciencetechnology']],
            ['كلية علوم الغابات', 'Faculty of Forestry Sciences', 'forestry', 'College', 90, ['forests']],
            ['كلية علوم وتقانة الإنتاج الحيواني', 'Faculty of Animal Production Science and Technology', 'animal-production', 'College', 100, ['animalprod']],
            ['كلية تنمية المجتمع', 'Faculty of Community Development', 'community-development', 'College', 110, ['societydevelopment']],
            ['كلية اللغات والعلوم اللغوية', 'Faculty of Languages and Linguistics', 'languages', 'College', 120, ['languagesscience']],
            ['كلية الدراسات العليا والبحث العلمي', 'Faculty of Graduate Studies and Scientific Research', 'graduate-studies', 'Deanship', 130, []],
            ['معهد دراسات السلام والتنمية', 'Institute for Peace and Development Studies', 'peace-development', 'Institute', 200, ['PDRC']],
            ['معهد جبل مرة للبحوث والدراسات الأفريقية', 'Jebel Marra Institute for Research and African Studies', 'jebel-marra', 'Institute', 210],
            ['معهد القرآن الكريم وتأصيل العلوم', 'Institute of the Holy Quran and Islamization of Knowledge', 'quran-institute', 'Institute', 220],
            ['مركز البيئة ونقل التقانة', 'Centre for Environment and Technology Transfer', 'environment-technology-transfer', 'Center', 300],
            ['مركز المعلومات', 'Information Centre', 'information-centre', 'Center', 310],
            ['وحدة التقويم والاعتماد', 'Quality Assurance and Accreditation Unit', 'quality-assurance', 'Unit', 400],
            ['وحدة التخطيط الاستراتيجي', 'Strategic Planning Unit', 'strategic-planning', 'Unit', 410],
            ['إدارة العلاقات العامة والإعلام', 'Directorate of Public Relations and Media', 'public-relations-media', 'Administration', 500],
            ['إدارة البحث العلمي', 'Directorate of Scientific Research', 'scientific-research', 'Administration', 510],
            ['إدارة العلاقات الخارجية', 'Directorate of External Relations', 'external-relations', 'Administration', 520],
            ['إدارة الخدمات', 'Directorate of Services', 'services-directorate', 'Administration', 530, []],
        ];

        foreach ($records as $record) {
            [$arabic, $english, $slug, $type, $order] = $record;
            $aliases = $record[5] ?? [];
            $existing = DB::table('college')->whereIn('slug', array_merge([$slug], $aliases))->first();
            $payload = [
                'name_ar' => $arabic,
                'name_en' => $english,
                'slug' => $slug,
                'title' => $arabic,
                'titleEn' => $english,
                'colleges_type_id' => $typeIds[$type] ?? ['College' => 1, 'Institute' => 2, 'Center' => 3, 'Unit' => 4, 'Deanship' => 5, 'Administration' => 6][$type],
                'status' => 1,
                'sort_order' => $order,
                'updated_at' => now(),
            ];

            if ($existing) {
                // Keep a working legacy URL active; all internal links are
                // generated from the stored slug and therefore remain stable.
                if ($existing->slug !== $slug) {
                    unset($payload['slug']);
                }
                DB::table('college')->where('id', $existing->id)->update($payload);
            } else {
                $payload['created_at'] = now();
                DB::table('college')->insert($payload);
            }
        }
    }
};
