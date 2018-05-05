<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            //
            Schema::create('activities', function (Blueprint $table) {
                $table->increments('id');
                $table->longText('description');
                $table->string('user_type');
                $table->integer('user_id')->nullable();
                $table->longText('route')->nullable();
                $table->ipAddress('ip_address')->nullable();
                $table->text('user_agent')->nullable();
                $table->string('locale')->nullable();
                $table->longText('referer')->nullable();
                $table->string('method_type')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
