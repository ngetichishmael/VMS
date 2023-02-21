<?php

namespace Database\Seeders;

use App\Models\Block;
use Illuminate\Database\Seeder;

class BlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blockNames = ['Block A', 'Block B', 'Block C', 'Block D', 'Block E'];
        foreach ($blockNames as $name) {
            Block::create([
                'premise_id' => 1,
                'name' => $name,
            ]);
        }
        $blockNames2 = ['Block F', 'Block G', 'Block H', 'Block I', 'Block J'];
        foreach ($blockNames2 as $name) {
            Block::create([
                'premise_id' => 2,
                'name' => $name,
            ]);
        }
        $blockNames3 = ['Block 1', 'Block 2', 'Block 3', 'Block 4', 'Block 5'];
        foreach ($blockNames3 as $name) {
            Block::create([
                'premise_id' => 3,
                'name' => $name,
            ]);
        }$blockNames4 = ['Block 6', 'Block 7', 'Block 8', 'Block 9', 'Block 10'];
        foreach ($blockNames4 as $name) {
            Block::create([
                'premise_id' => 4,
                'name' => $name,
            ]);
        }
        $blockNames5 = ['Block M', 'Block N', 'Block O', 'Block P', 'Block Q'];
        foreach ($blockNames5 as $name) {
            Block::create([
                'premise_id' => 5,
                'name' => $name,
            ]);
        }
        $blockNames6 = ['Block M', 'Block N', 'Block O', 'Block P', 'Block Q'];
        foreach ($blockNames6 as $name) {
            Block::create([
                'premise_id' => 6,
                'name' => $name,
            ]);
        }
        $blockNames7 = ['Block M', 'Block N', 'Block O', 'Block P', 'Block Q'];
        foreach ($blockNames7 as $name) {
            Block::create([
                'premise_id' => 7,
                'name' => $name,
            ]);
        }
        $blockNames8 = ['Block M', 'Block N', 'Block O', 'Block P', 'Block Q'];
        foreach ($blockNames8 as $name) {
            Block::create([
                'premise_id' => 8,
                'name' => $name,
            ]);
        }
    }
}
