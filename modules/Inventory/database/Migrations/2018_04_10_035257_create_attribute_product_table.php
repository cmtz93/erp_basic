<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Helpers\Migration;

use Modules\Inventory\Models\Attribute;
use Modules\Inventory\Models\Value;
use Modules\Inventory\Models\Product;

class CreateAttributeProductTable extends Migration
{
    protected $module = 'inventory';
    protected $table = 'attribute_products';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            //
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('attribute_id');
                $table->unsignedInteger('product_id');
                $table->unsignedInteger('value_id')->nullable();
                $table->string('value')->nullable();
//                $table->integer('qty')->nullable();
//                $table->decimal('price',7,2)->nullable();
                $table->timestamps();

                $table->foreign('attribute_id')
                    ->on($this->prefix . 'attributes')
                    ->references('id')
                        ->onDelete('CASCADE');

                $table->foreign('product_id')
                    ->on($this->prefix . 'products')
                    ->references('id')
                        ->onDelete('CASCADE');

                $table->foreign('value_id')
                    ->on($this->prefix . 'values')
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
