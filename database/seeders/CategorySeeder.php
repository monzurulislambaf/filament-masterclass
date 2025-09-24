<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
                'description' => 'Electronic devices and gadgets',
                'is_active' => true,
                'sort_order' => 1,
                'children' => [
                    [
                        'name' => 'Smartphones',
                        'slug' => 'smartphones',
                        'description' => 'Mobile phones and smartphones',
                        'is_active' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Laptops',
                        'slug' => 'laptops',
                        'description' => 'Notebooks and laptops',
                        'is_active' => true,
                        'sort_order' => 2,
                    ],
                    [
                        'name' => 'Tablets',
                        'slug' => 'tablets',
                        'description' => 'Tablet computers',
                        'is_active' => true,
                        'sort_order' => 3,
                    ],
                ],
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
                'description' => 'Apparel and fashion items',
                'is_active' => true,
                'sort_order' => 2,
                'children' => [
                    [
                        'name' => "Men's Clothing",
                        'slug' => 'mens-clothing',
                        'description' => 'Clothing for men',
                        'is_active' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => "Women's Clothing",
                        'slug' => 'womens-clothing',
                        'description' => 'Clothing for women',
                        'is_active' => true,
                        'sort_order' => 2,
                    ],
                    [
                        'name' => "Children's Clothing",
                        'slug' => 'childrens-clothing',
                        'description' => 'Clothing for kids',
                        'is_active' => true,
                        'sort_order' => 3,
                    ],
                ],
            ],
            [
                'name' => 'Home & Garden',
                'slug' => 'home-garden',
                'description' => 'Home improvement and garden supplies',
                'is_active' => true,
                'sort_order' => 3,
                'children' => [
                    [
                        'name' => 'Furniture',
                        'slug' => 'furniture',
                        'description' => 'Home furniture',
                        'is_active' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Kitchen',
                        'slug' => 'kitchen',
                        'description' => 'Kitchen appliances and tools',
                        'is_active' => true,
                        'sort_order' => 2,
                    ],
                    [
                        'name' => 'Garden',
                        'slug' => 'garden',
                        'description' => 'Garden tools and supplies',
                        'is_active' => true,
                        'sort_order' => 3,
                    ],
                ],
            ],
            [
                'name' => 'Books',
                'slug' => 'books',
                'description' => 'Books and educational materials',
                'is_active' => true,
                'sort_order' => 4,
                'children' => [
                    [
                        'name' => 'Fiction',
                        'slug' => 'fiction',
                        'description' => 'Fiction books',
                        'is_active' => true,
                        'sort_order' => 1,
                    ],
                    [
                        'name' => 'Non-Fiction',
                        'slug' => 'non-fiction',
                        'description' => 'Non-fiction books',
                        'is_active' => true,
                        'sort_order' => 2,
                    ],
                    [
                        'name' => 'Educational',
                        'slug' => 'educational',
                        'description' => 'Educational materials',
                        'is_active' => true,
                        'sort_order' => 3,
                    ],
                ]
            ],
        ];

        foreach ($categories as $categoryData) {
            $children = $categoryData['children'] ?? [];
            unset($categoryData['children']);
            
            $category = Category::create($categoryData);
            
            foreach ($children as $childData) {
                $childData['parent_id'] = $category->id;
                Category::create($childData);
            }
        }
    }
}