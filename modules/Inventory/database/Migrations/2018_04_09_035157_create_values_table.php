<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Helpers\Migration;
use Modules\Inventory\Models\Attribute;

class CreateValuesTable extends Migration
{

    protected $module = 'inventory';
    protected $table = 'values';
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
                $table->string('value');
                $table->text('description')->nullable();
                $table->boolean('status')->default(true);
                $table->unsignedInteger('attribute_id');

                $table->timestamps();
                $table->softDeletes();
            
                $table->foreign('attribute_id')
                    ->on($this->prefix . 'attributes')
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
        Schema::dropIfExists($this->table);
    }
}
