<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'employees';

    /**
     * Run the migrations.
     * @table employees
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->nullable();
            $table->string('fio', 150);
            $table->string('barecode', 30);
            $table->string('phone', 20);
            $table->enum('rank', ['разработчик', 'тестировщик']);
            $table->unsignedInteger('department_iddepartment');
            $table->unsignedInteger('user_iduser');

            $table->index(["user_iduser"], 'fk_epmployee_user1_idx');

            $table->index(["department_iddepartment"], 'fk_epmployee_department1_idx');


            $table->foreign('department_iddepartment', 'fk_epmployee_department1_idx')
                ->references('id')->on('departments')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_iduser', 'fk_epmployee_user1_idx')
                ->references('id')->on('users')
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
