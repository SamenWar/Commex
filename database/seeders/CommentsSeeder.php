<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Comments;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Создаем 50 комментариев с помощью фабрики
        Comments::factory()->count(50)->create();

        // Если вы хотите создать связанные комментарии, вы можете добавить дополнительную логику.
        // Например, для каждого комментария создать 1-3 дочерних комментария:
        $comments = Comments::all();
        foreach ($comments as $comment) {
            Comments::factory()->count(rand(1, 3))->create(['parent_id' => $comment->id]);
        }
    }
}
