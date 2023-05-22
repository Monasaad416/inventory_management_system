<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                $sections =[
                ['section_name'=>'section-1','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','created_by' =>'ahmed'],
                ['section_name'=>'section-2','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','created_by' =>'mohhamed'],
                ['section_name'=>'section-3','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','created_by' =>'ali'],
                ['section_name'=>'section-4','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','created_by' =>'mohammed'],

                ['section_name'=>'section-5','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','created_by' =>'ahmed'],
                ['section_name'=>'section-6','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','created_by' =>'mohhamed'],
                ['section_name'=>'section-7','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','created_by' =>'ali'],
                ['section_name'=>'section-8','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','created_by' =>'mohammed'],

                ['section_name'=>'section-9','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','created_by' =>'ahmed'],
                ['section_name'=>'section-10','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','created_by' =>'mohhamed'],
                ['section_name'=>'section-11','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','created_by' =>'ali'],
                ['section_name'=>'section-12','description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.','created_by' =>'mohammed'],
            ];

        foreach( $sections as $section){
        Section::create([
            'section_name'=> $section['section_name'],
            'description'=>$section['description'],
            'created_by'=>$section['created_by'],

       ]);
        }
    }
}
