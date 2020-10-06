<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Book;
use App\Category;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
    	
        for ($i=0; $i < 50; $i++) { 
            $category = Category::create(['category_name' => ucfirst($faker->word),'status'=>'1']);
        }
        $category = Category::inRandomOrder()->limit(5)->get();
		for ($i=0; $i < 50; $i++) { 
            $book = Book::create(['book_title' => ucfirst($faker->name),'book_author'=>'1','issued_on'=>date('Y-m-d H:i:s'),'status'=>'1']);
            $book->Categories()->attach($book);
         }
        
         
    
    }
}
