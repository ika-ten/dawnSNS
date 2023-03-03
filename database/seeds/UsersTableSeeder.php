<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'username' => 'aaa',
                'mail' => 'aaa@aaa.a',
                'password' => Hash::make('aaa'), //パスワードをハッシュ化、もとの文字列から変換する
                'bio' => '自己紹介文',
                'images' => 'aaa.png',
                'created_at' => '2023-3-1 18:35:48',
                'updated_at' => '2023-3-1 18:35:48',
            ],
            [
                'username' => 'bbb',
                'mail' => 'bbb@bbb.b',
                'password' => Hash::make('bbb'), //パスワードをハッシュ化、もとの文字列から変換する
                'bio' => '自己紹介文',
                'images' => 'bbb.png',
                'created_at' => '2023-3-1 18:35:48',
                'updated_at' => '2023-3-1 18:35:48',
            ],
            [
                'username' => 'ccc',
                'mail' => 'ccc@ccc.c',
                'password' => Hash::make('ccc'), //パスワードをハッシュ化、もとの文字列から変換する
                'bio' => '自己紹介文',
                'images' => 'ccc.png',
                'created_at' => '2023-3-1 18:35:48',
                'updated_at' => '2023-3-1 18:35:48',
            ],
            [
                'username' => 'ddd',
                'mail' => 'ddd@ddd.d',
                'password' => Hash::make('ddd'), //パスワードをハッシュ化、もとの文字列から変換する
                'bio' => '自己紹介文',
                'images' => 'ddd.png',
                'created_at' => '2023-3-1 18:35:48',
                'updated_at' => '2023-3-1 18:35:48',
            ],
            [
                'username' => 'eee',
                'mail' => 'eee@eee.e',
                'password' => Hash::make('eee'), //パスワードをハッシュ化、もとの文字列から変換する
                'bio' => '自己紹介文',
                'images' => 'eee.png',
                'created_at' => '2023-3-1 18:35:48',
                'updated_at' => '2023-3-1 18:35:48',
            ],
        ]);
    }
}
