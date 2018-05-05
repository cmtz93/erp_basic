
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Helpers\Migration;
use Modules\Inventory\Models\Category;
use Modules\Inventory\Models\Manufacturer;

class CreateProductsTable extends Migration
{

    protected $module = 'inventory';
    protected $table = 'products';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            //create table            
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('sku')->nullable();
                $table->string('barcode')->nullable();
                $table->text('description')->nullable();
                $table->string('cover')->nullable();
                $table->integer('status')->default(0);

                $table->unsignedInteger('category_id');
                $table->unsignedInteger('manufacturer_id');

                $table->foreign('category_id')
                    ->references('id')
                    ->on($this->prefix . 'categories')
                        ->onUpdate('CASCADE');

                $table->foreign('manufacturer_id')
                    ->references('id')
                    ->on($this->prefix . 'manufacturers')
                        ->onUpdate('CASCADE');

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
