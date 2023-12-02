<?php
    namespace App\Models;

class Listing
{
    public static function all()
    {
        return [
            [
                'id' => 1,
                'title' => 'Listing One',
                'description' => 'One description One'
            ],
            [
                'id' => 2,
                'title' => 'Listing Two',
                'description' => 'Two description One'
            ],
            [
                'id' => 3,
                'title' => 'Listing Three',
                'description' => 'Three description One'
            ]
        ];
    }

    public static function find($id){
        $listings = self::all();

        foreach($listings as $listing)
        {
            if($listing['id'] == $id ){
                return $listing;

            }
        }

    }
}
