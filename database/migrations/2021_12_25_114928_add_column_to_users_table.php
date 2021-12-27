<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('address')->after('password');
            $table->date('dob')->after('password');
            $table->enum('status',['1','0'])->after('password');
            $table->string('education',50)->after('password');
            $table->bigInteger('pincode')->after('password');
            $table->string('profile_pic',100)->after('password');
            $table->string('country',30)->after('password');
            $table->string('city',30)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('dob');
            $table->dropColumn('status');
            $table->dropColumn('education');
            $table->dropColumn('pincode');
            $table->dropColumn('profile_pic');
            $table->dropColumn('country');
            $table->dropColumn('city');
        });
    }
}
