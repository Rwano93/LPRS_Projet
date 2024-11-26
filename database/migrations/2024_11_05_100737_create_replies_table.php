<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliesTable extends Migration
{
public function up()
{
Schema::create('replies', function (Blueprint $table) {
$table->id();
$table->foreignId('discussion_id')->constrained()->onDelete('cascade'); // Lien avec la discussion
$table->foreignId('user_id')->constrained()->onDelete('cascade'); // Lien avec l'utilisateur
$table->text('content'); // Contenu de la réponse
$table->timestamps();
});
}

public function down()
{
Schema::dropIfExists('replies');
}
}
