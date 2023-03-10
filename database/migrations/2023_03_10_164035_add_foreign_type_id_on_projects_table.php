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
        Schema::table('projects', function (Blueprint $table) {
            // Definsco la colonna
            $table->unsignedBigInteger('type_id')->nullable()->after('id');
            // Definisco la colonna con cui dovrò avere una relazione ( si riferisce dellla colonna id sulla tabella types)
            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // PRIMA COSA Slego la relazione (trucco : far partire la migrate la down non la esegue quindi copio e incollo il nome  in Projects strucure la foreign key della colonna )
            $table->dropForeign('projects_type_id_foreign');
            // Poi droppo la colonna
            $table->dropColumn('type_id');
        });
    }
};
