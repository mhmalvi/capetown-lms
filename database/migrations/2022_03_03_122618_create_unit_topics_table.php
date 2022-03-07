<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_topics', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('subject_id');
            $table->tinyInteger('order');
            $table->longText('description');
            $table->longText('attachments')->nullable();
            $table->boolean('can_user_submit')->default(false);

            $table->foreign('subject_id')
                ->references('id')
                ->on('subjects')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes('deleted_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_topics');
    }
}
