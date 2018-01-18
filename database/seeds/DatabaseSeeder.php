<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $data_atual = new DateTime;

        $generos = array_map(function ($genero) use ($data_atual){
            return ['nome' => $genero, 'created_at' => $data_atual];
        },[
            'Ação',
            'Comédia',
            'Fantasia',
            'Policial',
            'Terror',
            'Aventura',
            'Suspense',
            'Animação',
            'Ficção Científica',
            'Romance',
            'Drama',
            'Musical',
            'Documentário',
            'Crime',
            'Espionagem',
            'Esporte',
            'Faroeste',
            'Guerra',
            'Mistério',
            'Novela',
            'Histórico',
            'Artes Marciais',
            'Médico'
        ]);

        DB::table('generos')->insert($generos);

        $emissoras = array_map(function ($emissora) use ($data_atual){
            return ['nome' => $emissora, 'created_at' => $data_atual];
        },[
            'Netflix',
            'Showtime',
            'USA Network',
            'MTV',
            'Space',
            'Showcase',
            'History',
            'Fox',
            'HBO',
            'The CW Television Network',
            'American Movie Classics',
            'American Broadcasting Company',
            'Syfy',
            'Columbia Broadcasting System',
            'Starz'
        ]);

        DB::table('emissoras')->insert($emissoras);

        DB::table('users')->insert([
            'nome' => 'Administrador',
            'sobrenome' => 'Administrador',
            'email' => 'admin@insidetv.com',
            'password' => bcrypt('c9p5au8naa'),
            'remember_token' => null,
            'access_level' => 1,
            'created_at' => $data_atual,
        ]);
    }
}
