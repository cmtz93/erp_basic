<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Helpers\Migration;

class CreateAttributesTable extends Migration
{
    protected $module = 'inventory';
    protected $table = 'attributes';
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
                $table->string('name')->unique();
                $table->string('value_type')->default('text');
                $table->integer('status')->default(0);
                $table->boolean('is_stock')->default(false);

                //$table->morphs('attributable')->nullable();

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
        Schema::dropIfExists($this->table);
    }
}
