<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Helpers\Migration;

class CreateCategoriesTable extends Migration
{
    protected $module = 'inventory';
    protected $table = 'categories';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {            
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->text('description')->nullable();
                $table->boolean('status')->default(true);
                $table->unsignedInteger('category_id')->nullable();
                $table->string('cover')->nullable();
                $table->string('icon')->nullable();
                $table->timestamps();
                $table->softDeletes();

                /// FK
                $table->foreign('category_id')
                    ->on($this->table)
                    ->references('id')
                    ->onDelete('CASCADE');
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
        DB::transaction(function () {
            Schema::dropIfExists($this->table);
        });
    }
}
