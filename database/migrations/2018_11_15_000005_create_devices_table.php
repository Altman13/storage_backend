<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'devices';

    /**
     * Run the migrations.
     * @table devices
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->nullable();
            $table->enum('status', ['свободен', 'в ремонте', 'списан', 'в аренде'])->default('свободен');
            $table->string('name', 45)->nullable();
            $table->unsignedInteger('category_idcategory');
            $table->unsignedInteger('storages_id');
            $table->string('barcode', 45)->nullable();

            $table->index(["storages_id"], 'fk_devices_storages1_idx');

            $table->index(["category_idcategory"], 'fk_device_category1_idx');

            $table->unique(["barcode"], 'barcode_UNIQUE');


            $table->foreign('category_idcategory', 'fk_device_category1_idx')
                ->references('id')->on('catigories')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('storages_id', 'fk_devices_storages1_idx')
                ->references('id')->on('storages')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
