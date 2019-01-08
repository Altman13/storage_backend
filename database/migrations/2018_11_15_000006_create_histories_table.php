<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'histories';

    /**
     * Run the migrations.
     * @table histories
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->nullable();
            $table->date('data')->nullable();
            $table->unsignedInteger('device_iddevice');
            $table->unsignedInteger('employees_id');

            $table->index(["employees_id"], 'fk_histories_employees1_idx');

            $table->index(["device_iddevice"], 'fk_history_lease_device1_idx');


            $table->foreign('device_iddevice', 'fk_history_lease_device1_idx')
                ->references('id')->on('devices')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('employees_id', 'fk_histories_employees1_idx')
                ->references('id')->on('employees')
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
