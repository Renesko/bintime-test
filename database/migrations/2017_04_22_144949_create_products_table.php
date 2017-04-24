<?php

use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    protected $connection = 'mongodb';
    private $table = 'products';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->connection)
            ->table($this->table, function (Blueprint $collection) {
                $collection->index('name');
                $collection->index('manufacturer');
                $collection->unique(['name', 'manufacturer']);
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->connection)
            ->table($this->table, function (Blueprint $collection) {
                $collection->drop();
            });
    }
}