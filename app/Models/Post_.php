<?php

namespace App\Models;

class Post
{
    private static $blog_posts = [
        [
            "title" => "Lorem ipsum dolor sit 1",
            "slug" => "lorem-ipsum-dolor-sit-1",
            "author" => "Admin ACES 1",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad repellendus adipisci ipsa excepturi optio, atque sunt, laudantium quam amet repellat perferendis sed sint blanditiis impedit vel voluptates molestiae ea asperiores expedita libero neque! Quaerat natus, error illum, atque dolores reiciendis provident delectus dicta minus quod sint corporis dignissimos perspiciatis fuga sed magni in quis itaque? Nihil repellat similique magni accusantium maxime ratione, aspernatur eaque dolores facilis doloremque ullam totam corporis laudantium aliquam consectetur tenetur aperiam! Quas, deserunt! Non, voluptatum vel."
        ],
        [
            "title" => "Lorem ipsum dolor sit 2",
            "slug" => "lorem-ipsum-dolor-sit-2",
            "author" => "Admin ACES 2",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad repellendus adipisci ipsa excepturi optio, atque sunt, laudantium quam amet repellat perferendis sed sint blanditiis impedit vel voluptates molestiae ea asperiores expedita libero neque! Quaerat natus, error illum, atque dolores reiciendis provident delectus dicta minus quod sint corporis dignissimos perspiciatis fuga sed magni in quis itaque?"
        ],
    ];

    public static function all(){
        return collect(self::$blog_posts);
    }

    public static function find($slug){
        $posts = static::all();
        return $posts->firstWhere('slug', $slug);
    }
}
