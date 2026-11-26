<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (Schema::hasTable('blokbay_invoices')) {
            return;
        }

        // One row per Akaunting invoice sent to Blokbay: the payment link and its status.
        Schema::create('blokbay_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id');
            $table->unsignedInteger('document_id');
            $table->string('blokbay_id', 64)->nullable();
            $table->string('url', 300)->nullable();
            $table->string('number', 64)->nullable();
            $table->string('status', 16)->default('open');
            $table->unsignedInteger('attempt')->default(0);
            $table->unsignedInteger('transaction_id')->nullable();
            $table->timestamps();

            $table->unique(['company_id', 'document_id']);
            $table->index(['company_id', 'blokbay_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('blokbay_invoices');
    }
};
