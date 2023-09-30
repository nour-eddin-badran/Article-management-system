<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Modules\EnumManager\Enums\UserStatusEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('type')->index()->comment('trainer|trainee|managerial');
            $table->string('email')->index();
            $table->string('mobile', 25)->nullable()->unique()->index();
            $table->string('password');
            $table->string('status')->default(UserStatusEnum::UNVERIFIED)->index();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
