<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::connection('cts')->statement("SET SESSION sql_mode='NO_ZERO_IN_DATE';");

        Schema::connection('cts')->create('bookings', function (Blueprint $table) {
            $table->unsignedMediumInteger('id')->autoIncrement();
            $table->date('date')->default('0000-00-00');
            $table->time('from')->default('00:00:00');
            $table->time('to')->default('00:00:00');
            $table->string('position')->default('');
            $table->integer('member_id')->default(0);
            $table->string('type')->default('');
            $table->unsignedMediumInteger('type_id')->default(0);
            $table->mediumInteger('groupID')->nullable();
            $table->dateTime('time_booked')->default('0000-00-00 00:00:00');
            $table->bigInteger('local_id');
            $table->unsignedBigInteger('eurobook_id')->nullable();
            $table->tinyInteger('eurobook_import')->default(0);
        });

        // DB::connection('cts')->statement(
        //     "CREATE TABLE `bookings` (
        //       `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
        //       `date` date NOT NULL DEFAULT '0000-00-00',
        //       `from` time NOT NULL DEFAULT '00:00:00',
        //       `to` time NOT NULL DEFAULT '00:00:00',
        //       `position` varchar(12) NOT NULL DEFAULT '',
        //       `member_id` int(7) unsigned NOT NULL DEFAULT 0,
        //       `type` char(2) NOT NULL DEFAULT '',
        //       `type_id` mediumint(8) unsigned NOT NULL DEFAULT 0,
        //       `groupID` mediumint(8) DEFAULT NULL,
        //       `time_booked` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
        //       `local_id` bigint(50) NOT NULL,
        //       `eurobook_id` bigint(50) unsigned DEFAULT NULL,
        //       `eurobook_import` tinyint(1) NOT NULL DEFAULT 0,
        //       PRIMARY KEY (`id`),
        //       KEY `date` (`date`)
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}