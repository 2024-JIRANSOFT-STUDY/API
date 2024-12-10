<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->id()->comment('기본 키');
            $table->string('user_id')->comment('사용자 ID');
            $table->string('receiver')->comment('받는 사람 이름');
            $table->string('situation')->comment('편지 작성 상황 (생일, 결혼 등)');
            $table->integer('my_age')->comment('작성자 나이');
            $table->enum('my_gender', ['male', 'female'])->comment('작성자 성별');
            $table->integer('friendly')->comment('친근함 정도 (1-5)');
            $table->string('essential_comment')->nullable()->comment('필수로 포함할 내용');
            $table->string('tone_content')->nullable()->comment('말투 파일 내용 (선택사항)');
            $table->longText('generated_content')->nullable()->comment('GPT로 생성된 편지 내용');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};