<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => bcrypt('useradmin'),
            'level' => 'admin'
        ]);

        User::create([
            'name' => 'Leon',
            'email' => 'leon@mail.com',
            'password' => bcrypt('userleon'),
            'level' => 'user'
        ]);

        Article::create([
            'title' => 'Kurangi Sampah Demi Lingkungan',
            'content' => 'Sampah menjadi permasalahan yang tidak ada habisnya sebelum manusia mempunyai kesadaran diri mengenai lingkungan. Banyaknya konsumsi setiap hari membuat manusia selalu menghasilkan banyak sampah setiap harinya. Demi mengurangi sampah yang ada, masyarakat hendaknya menggunakan barang yang didaur ulang. Misalnya saja, untuk kebutuhan kantong plastik kita bisa menggunakan satu kantong saja yang bisa dipakai berulang-ulang. Hal ini akan membantu mengurangi sampah dan menjadikan bumi lebih sehat.',
            'thumbnail' => '3231260562.jpg',
            'creator_id' => '2',
            'article-seo' => 'kurangi-sampah-demi-lingkungan',
            'like' => 0,
        ]);

        Comment::create([
            'user_id' => '2',
            'article_id' => '1',
            'comments' => 'Terima kasih sudah mau membaca !',
        ]);
    }
}
