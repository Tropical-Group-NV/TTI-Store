<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_mail', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('uid')->nullable();
            $table->text('emailTo')->nullable();
            $table->integer('status')->nullable();
            $table->longText('message')->nullable();
            $table->longText('error')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_mail');
    }
};
