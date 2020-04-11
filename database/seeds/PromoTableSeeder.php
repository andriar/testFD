<?php

use Illuminate\Database\Seeder;
use App\Models\Promo;
use App\Models\Feature;

class PromoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        $features1 = [];
        array_push($features1, 
        array(
            "title"=> "RESOURCE POWER",
            "body"=> "0.5 X",
            "imp"=> true,
        ),
        array(
            "title"=> "Disk Space",
            "body"=> "500 MB",
            "imp"=> false,
        ),
        array(
            "title"=> "Bandwidth",
            "body"=> "Unlimited",
            "imp"=> false,
        ),
        array(
            "title"=> "Databases",
            "body"=> "Unlimited",
            "imp"=> false,
        ),
        array(
            "title"=> "Domain",
            "body"=> "1",
            "imp"=> false,
        ),
        array(
            "title"=> "Backup",
            "body"=> "Instant",
            "imp"=> false,
        ),
        array(
            "title"=> "Gratis Selamanya",
            "body"=> "Unlimited SSL",
            "imp"=> false,
        )
    );

    $features2 = [];
        array_push($features2, 
        array(
            "title"=> "RESOURCE POWER",
            "body"=> "1 X",
            "imp"=> true,
        ),
            array(
                "title"=> "Disk Space",
                "body"=> "500 MB",
                "imp"=> false,
            ),
            array(
                "title"=> "Bandwidth",
                "body"=> "Unlimited",
                "imp"=> false,
            ),
            array(
                "title"=> "POP3 Email",
                "body"=> "Unlimited",
                "imp"=> false,
            ),
            array(
                "title"=> "Databases",
                "body"=> "Unlimited",
                "imp"=> false,
            ),
            array(
                "title"=> "Addon Domain",
                "body"=> "10",
                "imp"=> false,
            ),
            array(
                "title"=> "Backup",
                "body"=> "Instant",
                "imp"=> false,
            ),
            array(
                "title"=> "Selamanya",
                "body"=> "Domain Gratis",
                "imp"=> false,
            ),
            array(
                "title"=> "Gratis Selamanya",
                "body"=> "Unlimited SSL",
                "imp"=> false,
            )
        );

        $features3 = [];
        array_push($features3, 
            array(
                "title"=> "RESOURCE POWER",
                "body"=> "2 X",
                "imp"=> true,
            ),
            array(
                "title"=> "Disk Space",
                "body"=> "Unlimited",
                "imp"=> false,
            ),
            array(
                "title"=> "Bandwidth",
                "body"=> "Unlimited",
                "imp"=> false,
            ),
            array(
                "title"=> "POP3 Email",
                "body"=> "Unlimited",
                "imp"=> false,
            ),
            array(
                "title"=> "Databases",
                "body"=> "Unlimited",
                "imp"=> false,
            ),
            array(
                "title"=> "Addon Domain",
                "body"=> "Unlimited",
                "imp"=> false,
            ),
            array(
                "title"=> "Backup",
                "body"=> "Instant",
                "imp"=> false,
            ),
            array(
                "title"=> "Selamanya",
                "body"=> "Domain Gratis",
                "imp"=> false,
            ),
            array(
                "title"=> "Gratis Selamanya",
                "body"=> "Unlimited SSL",
                "imp"=> false,
            ),
            array(
                "title"=> "Name Server",
                "body"=> "Private",
                "imp"=> false,
            ),
            array(
                "title"=> "Mail Protection",
                "body"=> "SpamAssasin",
                "imp"=> false,
            )
        );

        $features4 = [];
        array_push($features4, 
            array(
                "title"=> "RESOURCE POWER",
                "body"=> "3 X",
                "imp"=> true,
            ),
            array(
                "title"=> "Disk Space",
                "body"=> "Unlimited",
                "imp"=> false,
            ),
            array(
                "title"=> "Bandwidth",
                "body"=> "Unlimited",
                "imp"=> false,
            ),
            array(
                "title"=> "POP3 Email",
                "body"=> "Unlimited",
                "imp"=> false,
            ),
            array(
                "title"=> "Databases",
                "body"=> "Unlimited",
                "imp"=> false,
            ),
            array(
                "title"=> "Addon Domain",
                "body"=> "Unlimited",
                "imp"=> false,
            ),
            array(
                "title"=> "Backup & Restore",
                "body"=> "Magic Auto",
                "imp"=> false,
            ),
            array(
                "title"=> "Selamanya",
                "body"=> "Domain Gratis",
                "imp"=> false,
            ),
            array(
                "title"=> "Gratis Selamanya",
                "body"=> "Unlimited SSL",
                "imp"=> false,
            ),
            array(
                "title"=> "Name Server",
                "body"=> "Private",
                "imp"=> false,
            ),
            array(
                "title"=> "Layanan Support",
                "body"=> "Prioritas",
                "imp"=> false,
                "star"=> true,
            ),
            array(
                "title"=> "Pro Mail Protection",
                "body"=> "SpamExpert",
                "imp"=> false,
            )
        );
    
         $promo1 = array(
            "title"=> "Bayi",
			"price"=> "19.000",
			"real_price"=> "14.900",
			"discount"=> 0,
			"users"=> "938",
			"time"=> "bln",
            "best_price"=> false,
            );
             $promo2 = array(
            	"title"=> "Pelajar",
			"price"=> "46.900",
			"real_price"=> "23.450",
			"discount"=> 0,
			"users"=> "4.168",
			"time"=> "bln",
			"best_price"=> false,
            );
             $promo3 = array(
           "title"=> "Personal",
			"price"=> "58.900",
			"real_price"=> "38.900",
			"discount"=> 0,
			"users"=> "10.017",
			"time"=> "bln",
			"best_price"=> true,
            );
             $promo4 = array(
           	"title"=> "Bisnis",
			"price"=> "109.900",
			"real_price"=> "65.900",
			"discount"=> 0.4,
			"users"=> "3.552",
			"time"=> "bln",
			"best_price"=> false,
            );
        $promo = [];
        array_push($promo, $promo1, $promo2, $promo3, $promo4);

        $num = 0;
        foreach ($promo as $key => $value) {
            $num++;
            $dete = [];
            if($num == 1){
                $dete = $features1;
            }else if($num == 2){
                $dete = $features2;
            }
            else if($num == 3){
                $dete = $features3;
            }
            else if($num == 4){
                $dete = $features4;
            }
            $data = Promo::create($value);
                foreach ($dete as $kuy => $value2) {
                    $doto = array_merge($value2, array("promo_id" => $data['id']));
                    Feature::create($doto);
                }
        }
    }
}
