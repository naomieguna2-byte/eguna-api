
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('students', 'student_number')) {
            Schema::table('students', function (Blueprint $table) {
                $table->string('student_number')->nullable()->unique();
            });
        }

        if (!Schema::hasColumn('students', 'firstname')) {
            Schema::table('students', function (Blueprint $table) {
                $table->string('firstname');
            });
        }

        if (!Schema::hasColumn('students', 'middlename')) {
            Schema::table('students', function (Blueprint $table) {
                $table->string('middlename')->nullable();
            });
        }

        if (!Schema::hasColumn('students', 'lastname')) {
            Schema::table('students', function (Blueprint $table) {
                $table->string('lastname');
            });
        }

        if (!Schema::hasColumn('students', 'course')) {
            Schema::table('students', function (Blueprint $table) {
                $table->string('course');
            });
        }

        if (!Schema::hasColumn('students', 'year_level')) {
            Schema::table('students', function (Blueprint $table) {
                $table->unsignedTinyInteger('year_level')->default(1);
            });
        }
    }

    public function down(): void
    {
        // Leave existing columns intact to protect existing data.
    }
};
