<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Insert default languages
        DB::table('langs')->insert([
            ['name' => 'Python', 'logo' => 'https://img.icons8.com/color/50/python--v1.png'],
            ['name' => 'JavaScript', 'logo' => 'https://img.icons8.com/color/50/javascript--v1.png'],
            ['name' => 'PHP', 'logo' => 'https://img.icons8.com/nolan/50/php--v2.png'],
            ['name' => 'Java', 'logo' => 'https://img.icons8.com/3d-fluency/50/java-coffee-cup-logo.png'],
            ['name' => 'C#', 'logo' => 'https://img.icons8.com/nolan/50/c-sharp-logo.png'],
            ['name' => 'Bash', 'logo' => 'https://img.icons8.com/color-glass/50/console.png'],
            ['name' => 'Swift', 'logo' => 'https://img.icons8.com/color/50/swift.png'],
            ['name' => '.NET', 'logo' => 'https://img.icons8.com/3d-fluency/50/java-coffee-cup-logo.png'],
            ['name' => 'Kotlin', 'logo' => 'https://img.icons8.com/color/50/kotlin.png'],
            ['name' => 'TypeScript', 'logo' => 'https://img.icons8.com/fluency/50/typescript--v2.png'],
            ['name' => 'Go', 'logo' => 'https://img.icons8.com/3d-fluency/50/java-coffee-cup-logo.png'],
            ['name' => 'Ruby', 'logo' => 'https://img.icons8.com/nolan/50/ruby-programming-language.png'],
        ]);

        DB::table('snippet_types')->insert([
            ['name' => 'multi']
        ]);
    }
}
