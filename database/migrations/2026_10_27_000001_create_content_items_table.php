<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up():void{Schema::create('content_items',function(Blueprint $t){$t->id();$t->string('type')->index();$t->string('title');$t->string('slug')->nullable()->index();$t->string('status')->default('Published')->index();$t->integer('sort_order')->default(0);$t->json('data')->nullable();$t->timestamps();$t->unique(['type','slug']);});} public function down():void{Schema::dropIfExists('content_items');} };
