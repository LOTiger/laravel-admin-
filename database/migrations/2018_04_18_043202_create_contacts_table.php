<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id')->comment('在线报名id');
            $table->string('name')->comment('学员名称');
            $table->string('phone')->comment('联系手机');
            $table->string('email')->comment('电子邮箱');
            $table->string('QQNum')->comment('qq号码');
            $table->string('wechatNum')->nullable()->comment('微信号码');
            $table->text('content')->nullable()->comment('留言内容');
            $table->integer('lesson_id')->comment('报名课程id');

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
        Schema::dropIfExists('contacts');
    }
}
