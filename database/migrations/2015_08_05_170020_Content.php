<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Content extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create(
            'content',
            function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('category_id')->index();
                $table->timestamp('publish_at')->index();
                $table->boolean('active');
                $table->string('caption');
                $table->text('description');
                $table->longText('text');
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content');
    }
}
