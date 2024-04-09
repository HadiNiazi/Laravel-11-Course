<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // id primary
            $table->string('title');
            $table->text('description');
            $table->text('image');
            $table->timestamps(); // created_at updated_at

        });


            // $table->foreignId('user_id')->constrained();


            // ===== Data Types  ====  //
            // string()
            // text(), tinyText() MediumText() longText()
            // boolean() true false
            // int(), unsignedInteger(), bigInt(), bigIncreaments()

            // ===== Constraints  ====  //
            // id() primary key
            // foriegn key
            // default()
            // nullable()
            // after() before()


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('posts', function (Blueprint $table) {

        //     $table->dropForeign(['user_id']);

        //     $table->dropColumn('user_id');
        // });
        // Schema::dropColumns(['status_1']);
        Schema::dropIfExists('posts');
    }
};
