<?php

namespace Modules\User\Database\Seeders;

use DB;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\PhoneBrand;
use Modules\User\Entities\PhoneModel;

class PhoneModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $models = [

            array(
                'brand_name' => '10.or',
                'name' => 'G2',
            ),

            array(
                'brand_name' => '10.or',
                'name' => 'G',
            ),

            array(
                'brand_name' => '10.or',
                'name' => 'E',
            ),

            array(
                'brand_name' => '10.or',
                'name' => 'D2',
            ),

            array(
                'brand_name' => '10.or',
                'name' => 'D',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone XS Max',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone XS',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone XR',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone X',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone SE 2020',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone SE',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 8 Plus',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 8',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 7 Plus',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 7',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 6S Plus',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 6S',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 6 Plus',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 6',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 5S',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 5C',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 5',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 4S',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 4',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 3GS',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 3G',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 12 Pro Max',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 12 Pro',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 12 Mini',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 12',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 11 Pro Max',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 11 Pro',
            ),

            array(
                'brand_name' => 'Apple',
                'name' => 'iPhone 11',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Zoom ZX550',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Selfie',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Max ZC550KL',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Max Pro M2',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Max Pro M1',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Max M2',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Max M1',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Max',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Live 16GB',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Lite L1',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Go ZC500TG',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Go ZC451TG',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'ZenFone Go ZB552KL',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Go ZB551KL',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'ZenFone Go ZB500KL',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'ZenFone Go ZB450KL',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Go 5.0 LTE T500',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Go 4.5',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone Go',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone C ZC451CG',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 6',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 5Z',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 5 Lite A502CG',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 5 A501CG',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 5 A500KL 16GB',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 5 A500CG 16GB',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 4 Selfie Pro',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 4 A450CG',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 4 A400CG',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 3s Max',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 3 ZE552KL',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 3 Ultra',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 3 Max ZC553KL',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 3 Max ZC520TL',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 3 Laser 32GB',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 3 Deluxe',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 2 ZE551ML',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 2 ZE550ML 16GB',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 2 Laser ZE601KL 32GB',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 2 Laser ZE550KL',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'Zenfone 2 Laser ZE500KL',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => 'ROG Phone 3',
            ),

            array(
                'brand_name' => 'Asus',
                'name' => '6Z',
            ),

            array(
                'brand_name' => 'Blackberry',
                'name' => 'Z30',
            ),

            array(
                'brand_name' => 'Blackberry',
                'name' => 'Z3',
            ),

            array(
                'brand_name' => 'Blackberry',
                'name' => 'Priv 32GB',
            ),

            array(
                'brand_name' => 'Blackberry',
                'name' => 'Passport 32GB',
            ),

            array(
                'brand_name' => 'Blackberry',
                'name' => 'Motion',
            ),

            array(
                'brand_name' => 'Blackberry',
                'name' => 'Leap',
            ),

            array(
                'brand_name' => 'Blackberry',
                'name' => 'KEYone Limited Edition',
            ),

            array(
                'brand_name' => 'Blackberry',
                'name' => 'KEY2 LE',
            ),

            array(
                'brand_name' => 'Blackberry',
                'name' => 'KEY2',
            ),

            array(
                'brand_name' => 'Blackberry',
                'name' => 'Evolve',
            ),

            array(
                'brand_name' => 'Blackberry',
                'name' => 'DTEK60',
            ),

            array(
                'brand_name' => 'Blackberry',
                'name' => 'DTEK50',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Rogue',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Note 8',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Note 6',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Note 5 Lite C',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Note 5 Lite',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Note 5',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Note 3S',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Note 3 Plus',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Note 3 Lite',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Note 3',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Mega 5A',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Mega 5',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Mega 3',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Mega 2.5D',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Max',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Dazen X7',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Cool Play 6',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Cool 3 Plus',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Cool 3',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Cool 2',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'Cool 1',
            ),

            array(
                'brand_name' => 'Coolpad',
                'name' => 'A8',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'X1s',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'X1',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'S6s',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'S6 Pro',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'S6',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'S10 Lite',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Pioneer P6',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Pioneer P5L',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Pioneer P4S',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Pioneer P4',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Pioneer P3S',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Pioneer P3',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Pioneer P2S',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Pioneer P2M',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Pioneer P2',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'P7 Max',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'P7',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'P5W',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Max',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Marathon M5 Plus',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Marathon M5 Lite',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Marathon M5',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Marathon M4',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Marathon M3',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'M7 Power',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'M2',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'F9 Plus',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'F9',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'F205 Pro',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'F205',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'F103 Pro',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'F103',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'F10',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Elife S7 16GB',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Elife S5.5',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Elife S5.1',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Elife S Plus 16GB',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Elife E8',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Elife E7 Mini',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Elife E7',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Elife E6',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Elife E5',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Elife E3',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Dream D1',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Ctrl V6L',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Ctrl V5',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'CTRL V4S',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Ctrl V4',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Ctrl V3',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Ctrl V2',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'Ctrl V1',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'A1 Signature Edition',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'A1 Plus',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'A1 Lite',
            ),

            array(
                'brand_name' => 'Gionee',
                'name' => 'A1',
            ),

            array(
                'brand_name' => 'Google',
                'name' => 'Pixel XL LTE',
            ),

            array(
                'brand_name' => 'Google',
                'name' => 'Pixel 4a',
            ),

            array(
                'brand_name' => 'Google',
                'name' => 'Pixel 3A XL',
            ),

            array(
                'brand_name' => 'Google',
                'name' => 'Pixel 3A',
            ),

            array(
                'brand_name' => 'Google',
                'name' => 'Pixel 3 XL',
            ),

            array(
                'brand_name' => 'Google',
                'name' => 'Pixel 3',
            ),

            array(
                'brand_name' => 'Google',
                'name' => 'Pixel 2 XL',
            ),

            array(
                'brand_name' => 'Google',
                'name' => 'Pixel 2',
            ),

            array(
                'brand_name' => 'Google',
                'name' => 'Pixel',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => 'View 20',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => 'View 10',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => 'Play',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => 'Holly 4 Plus',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => 'Holly 4',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => 'Holly 3 Plus',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => 'Holly 2 Plus',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => 'Holly',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => 'Bee',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '9X Pro',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '9X',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '9S',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '9N',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '9i',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '9A',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '9 Lite',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '8X',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '8C',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '8 Pro',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '8 Lite',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '8',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '7X',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '7S',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '7C',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '7A',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '7',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '6X',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '6 Plus',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '6',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '5X',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '4X',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '4C',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '3X',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '3C',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '20i',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '20',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '10 Lite',
            ),

            array(
                'brand_name' => 'Honor',
                'name' => '10',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Wildfire X',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'U12 Plus',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One X9',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One X Plus',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One X',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One V',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One S9',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One S',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One Remix',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One Mini M4',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One Mini 2',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One Mini',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One ME',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One Max',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One M9 Prime Camera Edition',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One M9 Plus',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One M9',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One M8s',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One M8 Eye',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One M8',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One M7 801e',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One E9s',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One E9 Plus',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One E8',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One Dual Sim',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One A9',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'One 802d',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Evo 4G',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire XC',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire X Dual Sim',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire X',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire VC',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire V',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire U',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire SV',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire P',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire Eye 16GB',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire C',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 830',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 828',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 826X',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 826',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 825',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 820S Dual Sim',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 820Q',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 820G Plus',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 820 Mini',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 820',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 816G Plus',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 816G',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 816D',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 816',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 728G',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 728 Ultra Edition',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 728 16GB',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 700',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 630',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 628',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 626G Plus',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 626',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 620G',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 616',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 612',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 610',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 601',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 600C',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 600',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 526G Plus',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 516C',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 516',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 510',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 501',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 500',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 326G 8GB',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 310',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 300',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 210',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 10 Pro',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Desire 10 Lifestyle',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Butterfly X920D',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Butterfly S',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Butterfly 2',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => 'Butterfly',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => '8S',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => '10 Evo',
            ),

            array(
                'brand_name' => 'HTC',
                'name' => '10 32GB',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'Y9s',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'Y9 Prime 2019',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'Y9 2019',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'P9 32GB',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'P30 Pro',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'P30 Lite',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'P20 Pro',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'P20 Lite',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'Nova 3i',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'Nova 3',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'Nexus 6P',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'Mate 20 Pro',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'Ascend Y600',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'Ascend P7 Single Sim 16GB',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'Ascend P6',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'Ascend G750',
            ),

            array(
                'brand_name' => 'Huawei',
                'name' => 'Ascend G730',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Zero 5 Pro',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Zero 5',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Smart 4 Plus',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Smart 3 Plus',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Smart 2',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'S5 Pro',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'S4',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Note 7',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Note 5 Stylus',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Note 5',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Note 4',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Hot S5',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Hot S3X',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Hot S3',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Hot 9 Pro',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Hot 9',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Hot 7 Pro',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Hot 7',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Hot 6 Pro',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Hot 4 Pro',
            ),

            array(
                'brand_name' => 'Infinix',
                'name' => 'Hot 10',
            ),

            array(
                'brand_name' => 'InFocus',
                'name' => 'Vision 3 Pro',
            ),

            array(
                'brand_name' => 'InFocus',
                'name' => 'Vision 3',
            ),

            array(
                'brand_name' => 'InFocus',
                'name' => 'Turbo 5S',
            ),

            array(
                'brand_name' => 'InFocus',
                'name' => 'Turbo 5 Plus',
            ),

            array(
                'brand_name' => 'InFocus',
                'name' => 'Snap 4',
            ),

            array(
                'brand_name' => 'InFocus',
                'name' => 'M812',
            ),

            array(
                'brand_name' => 'InFocus',
                'name' => 'M680',
            ),

            array(
                'brand_name' => 'InFocus',
                'name' => 'M535 Plus',
            ),

            array(
                'brand_name' => 'InFocus',
                'name' => 'EPIC 1',
            ),

            array(
                'brand_name' => 'InFocus',
                'name' => 'A3',
            ),

            array(
                'brand_name' => 'InFocus',
                'name' => 'A2',
            ),

            array(
                'brand_name' => 'InFocus',
                'name' => 'A1s',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Super 16GB',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Cloud Y2 Ultra',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Cloud Tread',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Cloud Swift 16GB',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Cloud String V 2.0',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Cloud Power Plus',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Cloud Pace',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Cloud N12',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Cloud Flash',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Cloud Crystal 2.5 D',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Cloud 4G Star',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Cloud 4G Smart',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Xtreme V',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Trend 16GB',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Star HD',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Star 5.0',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Star 4G',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Star 2 16GB',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Speed HD',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Speed',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Slice 2',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua S7',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Power+',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Power HD 16GB',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Life 2',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua i7',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua i4 Plus',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua HD',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Glam 8GB',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Dream 8GB',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Dream 2 8GB',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Craze',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Amaze',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua Ace 16GB',
            ),

            array(
                'brand_name' => 'Intex',
                'name' => 'Aqua 4G Plus',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium X',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium S9 Lite',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium S8',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium S5i',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium S5 Ultra',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium S320',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium S3',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium S25 Klick',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium S205',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium S19',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium Pop S315',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium Octane Plus',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium Moghul',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium Machone Plus',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium Machfive',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium Mach Two S360',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium Mach Six VR',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium Mach One S310',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium Hexa',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium Dazzle S201',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Titanium Dazzle 3 S204',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Sparkle V',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'S9 Titanium',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'S7 Titanium',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Quattro L52',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Quattro L51 HD',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Quattro L50',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Platinum P9',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Opium N9',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Opium N7',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'K9 Smart 4G',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'Dazzle 2',
            ),

            array(
                'brand_name' => 'Karbonn',
                'name' => 'A25 Plus',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Z92',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Z80',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Z71',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Z66',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Z61 Pro',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Z53',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Z50',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Z41',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'X81',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'X50 4G',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'X46',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'X38 8GB',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'X3 8GB',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'X11 4G',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'V5 4G',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'V2S',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'V2 3GB RAM 16GB',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Pixel V2 16GB',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Pixel V1',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'P7 3G',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'iris X9 16GB',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Iris X8',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Iris X5',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Iris X10',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Iris X1',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Iris Pro 30',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Iris Fuel 60',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Iris Fuel 50',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Iris Alfa',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Iris 450 Colour 4GB',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'Icon',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'EG932',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'A97',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'A82',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'A79',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'A76 4G',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => 'A71 8GB',
            ),

            array(
                'brand_name' => 'Lava',
                'name' => '405 Plus 4GB',
            ),

            array(
                'brand_name' => 'LeEco',
                'name' => 'Le Max 2',
            ),

            array(
                'brand_name' => 'LeEco',
                'name' => 'Le Max',
            ),

            array(
                'brand_name' => 'LeEco',
                'name' => 'Le 2 Pro',
            ),

            array(
                'brand_name' => 'LeEco',
                'name' => 'Le 2',
            ),

            array(
                'brand_name' => 'LeEco',
                'name' => 'Le 1S Eco',
            ),

            array(
                'brand_name' => 'LeEco',
                'name' => 'Le 1s',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Zuk Z1',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Z6 Pro',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Z2 Plus 64GB',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Z2 Plus 32GB',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Vibe Z2 Pro',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Vibe Z K910L',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Vibe X3',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Vibe X2',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Vibe X S960',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Vibe Shot',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Vibe S1',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'VIBE P1M',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Vibe P1 Turbo',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Vibe P1',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Vibe K5 Plus',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Vibe K5 Note',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Vibe K5',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Sisley S90',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'S930',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'S920',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'S890',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'S860',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'S850',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'S820',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'S660',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'S650',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'S60',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'S580',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Phab Plus',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Phab 2 Pro',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Phab 2 Plus',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'Phab 2',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'P780',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'P70',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'P2',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'K910L',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'K900',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'K9 Note',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'K9',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'K8 Plus',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'K8 Note',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'K8',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'K6 Power',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'K6 Note',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'K4 Note',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'K3 Note',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'K10 Plus',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'K10 Note',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A859',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A850',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A7700',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A706',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A7000 Turbo',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A7000',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A7',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A680',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A6600 Plus',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A6000 Plus',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A6000',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A6 Note',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A536',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A526',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A5000',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A5',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A369i (White, 4 GB)',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A328',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A319',
            ),

            array(
                'brand_name' => 'Lenovo',
                'name' => 'A2010',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'W30 Pro',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'W30',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'W10 Alpha',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'W10',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'V40 ThinQ',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'V30 Plus',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Stylus 2',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Q7',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Q60',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Q6 Plus',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Q6',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Q Stylus Plus',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Q Stylus',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Optimus VU P895',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Optimus G Pro E988',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Optimus G E975',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Optimus 4X HD P880',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Nexus 5X',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Nexus 5',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Nexus 4 16GB',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Max (X160)',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'Magna',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'L90',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'L80 Dual',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'L70 Dual',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'L Fino D295 4GB',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'L Bello Dual D335',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'K7 4G 16GB',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'K10 16GB',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'G8X ThinQ',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'G7 ThinQ',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'G7 Plus ThinQ',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'G6',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'G5',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'G4 Stylus 16GB',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'G4 Dual Sim 32GB',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'G3 Stylus Dual D690',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'G3 D855',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'G3 Beat',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'G2 4G',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'G Pro 2 -D838',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'G FLEX2',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'G FLEX D958',
            ),

            array(
                'brand_name' => 'LG',
                'name' => 'F70 D315',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Wind 7S',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Wind 7i',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Wind 7',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Wind 6',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Wind 4S',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Wind 3',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Wind 2',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Wind 1',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Water 9',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Water 8',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Water 7S',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Water 7',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Water 6',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Water 5',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Water 4',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Water 3',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Water 2',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Water 11',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Water 10',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Water 1',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Flame 8',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Flame 7S',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Flame 7',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Flame 2',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Flame 1',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'F8',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'F1S (Water F1S)',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Earth 2',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'Earth 1',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'C459',
            ),

            array(
                'brand_name' => 'Lyf',
                'name' => 'C451',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Vdeo 5',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Vdeo 4',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Vdeo 3',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Vdeo 2',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Vdeo 1',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Unite 4 Pro',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Unite 4 Plus',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Unite 4',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Unite 3',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Unite 2',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Spark 2 Q334',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'iOne Note',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Infinity N12',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Infinity N11',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Xpress 4G Q413',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Xpress 2 E313',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas XP 4G',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas XL2 A109',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas XL A119',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Win W121',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Turbo Mini A200',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Turbo A250',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Tube A118R',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Spark Q380',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Spark 4G',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Spark 3',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Spark 2 Plus Q350',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Silver 5 Q450',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Selfie Lens Q345',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Selfie A255',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Selfie 4',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Selfie 3',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Pulse 4G',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Power A96',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Play 4G',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Play',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Pep Q371',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Pace 4G',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Nitro A311',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Nitro A310',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Nitro 3 E455',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Nitro 3 E352',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Nitro 2',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Mega 4G',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Mega 2',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Mega',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Magnus A117',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Mad A94',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas L A108',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Knight Cameo A290',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Knight A350',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Knight 2 E471',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Juice A77',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Juice A177',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Juice 4 Q382',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Juice 3 Plus Q394',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Juice 3',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Juice 2',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Infinity Pro',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Infinity Life',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Infinity',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Hue AQ5000',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Hue 2',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas HD Plus A190',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas HD A116i',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas HD A116',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Gold A300',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Fun A76',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Fun A74',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Fire A093',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Fire 5 Q386',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Fire 4G Plus',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Fire 4G',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Fire 4',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Fire 3 A096',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Fire 2 A104',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Express A99',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Evok E483',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Entice',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Elanza A93',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Elanza 2 A121',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Ego A113',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Duet AE90',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Duet 2',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Doodle A111',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Doodle 4',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Doodle 3',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Doodle 2 A240',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Blaze HD',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Blaze 4G Plus',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Blaze 4G',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Beat A114R',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Amaze Q395',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Amaze 4G',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas Amaze 2',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas A1',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas 6 Pro E484',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas 6',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas 5 Lite Q462',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas 5 E481',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas 4 Plus A315',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas 4',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas 2.2 A114',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas 2 Plus A110Q',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas 2 Colors A120',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Canvas 2 A110',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt Supreme 2',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt Supreme',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt Selfie',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt S303',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt S302',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt S301',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt S300',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt Q381',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt Q346',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt Q339',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt Q338',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt Q336',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt Q335',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt Q333',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt Q332',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt Q331',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt Q325',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt Q324',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt Q323',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt D321',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt D320',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt D304',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt D303',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt AD4500',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt AD3520',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt A82',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt A79',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt A69',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt A67',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt A28',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt A089',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt A069',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt A067',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt A066',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bolt A064',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bharat 5 Pro',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bharat 5 Plus',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bharat 5',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bharat 4',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bharat 3',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bharat 2 Plus',
            ),

            array(
                'brand_name' => 'Micromax',
                'name' => 'Bharat 2',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Razr 5G',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Razr 2019',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'One Vision',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'One Power',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'One Macro',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'One Fusion Plus',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'One Action',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Nexus 6',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto Z2 Play 64GB',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto Z2 Force',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto Z Style Mod 64GB',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto Z Play',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto Z',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto X4',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto X Style',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto X Play',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto X Force',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto X 2nd Gen',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto X 1st Gen',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto Turbo 64GB',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto M',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G9',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G8 Power Lite',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G8 Plus',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G7 Power',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G7',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G6 Plus',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G6 Play',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G6',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G5S Plus 64GB',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G5S',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G5 Plus',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G5 16GB',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G4 Plus',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G4 Play',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G4',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G Turbo Edition',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G 3rd Gen',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G 2nd Gen 4G',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G 2nd Gen 3G',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto G 1st Gen',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto E6s',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto E5 Plus',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto E5',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto E4 Plus 32GB',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto E4',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto E3 Power',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto E 2nd Gen',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto E 1st Gen',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto C Plus',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto C',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Edge Plus',
            ),

            array(
                'brand_name' => 'Motorola',
                'name' => 'Moto E7 Plus',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => 'C3 2020',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '9',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '8.1',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '8 Sirocco',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '8',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '7.2',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '7.1',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '7 Plus',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '6.2',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '6.1 Plus',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '6',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '6 2018',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '5.3',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '5.1 Plus',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '5.1',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '5',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '4.2',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '3.2',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '3.1 Plus 32GB',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '3.1',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '3 16GB',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '2.3',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '2.2',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '2.1',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '2',
            ),

            array(
                'brand_name' => 'Nokia',
                'name' => '1',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => 'X 16GB',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => 'One',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => 'Nord',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => '8T 5G',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => '8 Pro',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => '8',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => '7T Pro',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => '7T',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => '7 Pro',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => '7',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => '6T McLaren Edition',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => '6T',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => '6',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => '5T',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => '5',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => '3T',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => '3',
            ),

            array(
                'brand_name' => 'OnePlus',
                'name' => '2',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Reno 4 Pro',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Reno 3 Pro',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Reno2 Z',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Reno 2F',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Reno 2',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Reno 10x Zoom',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Reno',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'R7 plus',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'R7 Lite',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'R5',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'R2001 Yoyo',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'R17 Pro',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'R17',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'R15 Pro',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'R1001 Joy',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'R1 R829',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Neo 7 4G',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Neo 5 2015',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Neo 3',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'N1 Mini',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'N1',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Mirror 5',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Mirror 3',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'K3',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'K1',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Joy Plus',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Joy 3',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Find X2',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Find X',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Find 7A',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Find 7',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Find 5 Mini',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'Find 5',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'F9 Pro',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'F9',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'F7',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'F5 Youth',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'F5',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'F3 Plus',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'F3',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'F1s',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'F17 Pro',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'F17',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'F15',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'F11 Pro',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'F11',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'F1 Plus',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'F1',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A9 2020',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A9',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A83',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A71',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A7',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A5s',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A57',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A53 2020',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A52',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A5',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A5 2020',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A3s',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A37F',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A37',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A31',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A1K',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A12',
            ),

            array(
                'brand_name' => 'Oppo',
                'name' => 'A11K',
            ),

            array(
                'brand_name' => 'Other',
                'name' => 'Smartphone',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'T50',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'T45 4G',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'T44 Lite',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'T41',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'T40 8GB',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'P81',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'P66 Mega',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'P61',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'P55 Novo',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'P55',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'P50',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'P41',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'P11',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga Z1 Pro',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga Z',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga X1 Pro',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga X1',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga U',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga Turbo',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga Tapp',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga Switch',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga S Mini',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga S',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga Ray X',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga Ray 810',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga Ray 610',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga Prim',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga Mark',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga L2',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga L',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga I8',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'ELUGA I2',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga I',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga Arc 2',
            ),

            array(
                'brand_name' => 'Panasonic',
                'name' => 'Eluga A2',
            ),

            array(
                'brand_name' => 'Poco',
                'name' => 'X3',
            ),

            array(
                'brand_name' => 'Poco',
                'name' => 'X2',
            ),

            array(
                'brand_name' => 'Poco',
                'name' => 'M2 Pro',
            ),

            array(
                'brand_name' => 'Poco',
                'name' => 'M2',
            ),

            array(
                'brand_name' => 'Poco',
                'name' => 'F1',
            ),

            array(
                'brand_name' => 'Poco',
                'name' => 'C3',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'XT',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'X50 Pro',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'X3 Super Zoom',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'X3',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'X2 Pro',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'X2',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'X',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'U1',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'Narzo 20A',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'Narzo 20 Pro',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'Narzo 20',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'Narzo 10A',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'Narzo 10',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'C3',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'C2',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'C15',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'C12',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'C11',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'C1',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => 'C1 2019',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '7i',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '7 Pro',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '7',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '6i',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '6 Pro',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '6',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '5s',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '5i',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '5 Pro',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '5',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '3i',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '3 Pro',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '3',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '2 Pro',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '2',
            ),

            array(
                'brand_name' => 'Realme',
                'name' => '1',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Y3',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Y2',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Y1 Lite',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Y1',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note Prime',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note 9 Pro Max',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note 9 Pro',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note 9',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note 8 Pro',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note 8',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note 7S',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note 7 Pro',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note 7',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note 6 Pro',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note 5 Pro',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note 5',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note 4G',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note 4',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note 3',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Note 2',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'K20 Pro',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'K20',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => 'Go',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '9i',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '9A',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '9 Prime',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '9',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '8A Dual',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '8A',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '8',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '7A',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '7',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '6A',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '6 Pro',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '6',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '5A',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '5',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '4A',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '4',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '3S Prime',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '3S Plus',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '3S',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '2 Prime',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '2',
            ),

            array(
                'brand_name' => 'Redmi',
                'name' => '1S',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Z4',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Tizen Z3',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Tizen Z2',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Tizen Z1',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Z Flip',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Young 2',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Young',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Y S5360',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Trend',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Star Pro Duos',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Star Advance',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Star 2',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Star',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S9 Plus Dual Sim',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S9 Dual Sim',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S8 Plus Dual Sim',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S8 Dual Sim',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S7 Edge Dual Sim',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S7 Dual Sim 32GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S6 Edge Plus 32GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S6 Edge',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S6',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S5 Mini',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S5',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S4 Zoom',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S4 Mini 8GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S4 32GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S4 16GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S3 Neo',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S3 Mini 8GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S3 Mini 16GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S3 64GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S3 32GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S3 16GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S20 Ultra',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S20 Plus',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S20 FE',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S20',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S2 Plus',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S2',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S10e',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S10 Plus',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S10 Lite',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S10',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S Duos 3',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S Duos 2',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy S Duos',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Pocket',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy On8 2018',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy On8',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy On7 Pro',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy On7 Prime',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy On7',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy On6 64GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy On5 Pro',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy On5 8GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy On Nxt',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy On Max',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 9',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 8 Dual Sim',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 5 Dual Sim',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 5',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 4 Edge 32GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 4',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 3 Neo',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 3',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 20 Ultra 5G',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 20',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 2 N7100',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 10.1 GT- 8000',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 10 Plus',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 10 Lite',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 10',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Note 1 N7000',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Music Duos',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Mega 6.3',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Mega 5.8',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Mega 2',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy M51',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy M40',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy M31s',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy M31',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy M30s',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy M30',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy M21',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy M20',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy M11',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy M10s',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy M10',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy M01s',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy M01 Core',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy M01',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J8 4GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J7 Pro 64GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J7 Prime',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J7 Prime 2',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J7 Nxt 32GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J7 Nxt',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J7 Max',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J7 Duo',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J7 2016 Edition',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J7',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J6 Plus',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J6 64GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J6',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J5 Prime',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J5 2016 Edition',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J5',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J4 Plus',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J4 32GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J4 16GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J3 Pro',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J3 2016',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J2 Pro',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J2 Ace',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J2 2018',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J2 2017',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J2 2016',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J2',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J1 Ace',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J1 2016',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy J1',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Grand Quattro I8552',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Grand Quattro I8550',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Grand Prime',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Grand Neo Plus',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Grand Neo',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Grand Max',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Grand Duos',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Grand 2',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Golden',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Fold',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Fame',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy F41',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy E7',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy E5',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Core Prime',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Core 2',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Core',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Chat',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy C9 Pro',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy C7 Pro',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Axiom',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Alpha',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Ace Nxt',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Ace 4',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy Ace 3',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A9 Pro',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A9',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A80',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A8 Star',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A8 Plus 64GB',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A8',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A71',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A70s',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A70',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A7 2018',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A7 2017',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A7 2016',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A7',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A6 Plus',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A6',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A51',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A50s',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A50',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A5 2017',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A5 2016',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A5',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A31',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A30s',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A30',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A3 2016',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A3',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A21s',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A20s',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A20',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A10s',
            ),

            array(
                'brand_name' => 'Samsung',
                'name' => 'Galaxy A10',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia ZR',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia ZL',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia Z5 Premium Dual',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia Z5',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia Z3 Plus',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia Z3 Dual',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia Z3 Compact',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia Z3',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia Z2',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia Z1 Mini Compact',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia Z1',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia Z Ultra',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia Z',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia XZ1',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia XZ Premium',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia XZ',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia XA1 Ultra',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia XA1 Plus 32GB',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia XA1',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia XA Ultra',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia XA Dual',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia X',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia U',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia T3',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia T2 Ultra Dual',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia SP',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia SL LT26ii',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia S',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia R1 Plus',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia P',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia Neo L',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia Miro',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia M5 Dual',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia M4 Aqua Dual',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia M2 Dual',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia M2 Aqua',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia M2',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia M',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia L2',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia L',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia J',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia Go',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia E4 Dual',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia E3',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia E1',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia E 4G Dual',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia E',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia C5 Ultra Dual',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia C4 Dual',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia C3',
            ),

            array(
                'brand_name' => 'Sony',
                'name' => 'Xperia C',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Spark Power 2 Air',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Spark Power 2',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Spark Go Plus',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Spark Go 2020',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Spark Go',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Spark 6 Air',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Spark 5 Pro',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Spark 5',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Spark 4 Air',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Spark 4',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Phantom 9',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'i7',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'i5 Pro',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'i3 Pro',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon iSky 3',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon iSky 2',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon iSky',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon iClick 2',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon iClick',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon iAir 2 Plus',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon iAce 2X',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon iAce 2',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon iAce',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon i4',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon i2X',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon i2',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon i Twin',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon i Air',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon i',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon 16',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon 15 Pro',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon 15',
            ),

            array(
                'brand_name' => 'Tecno',
                'name' => 'Camon 12 Air',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Z1x',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Z10',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Z1 Pro',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y95',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y93',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y91i',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y91',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y90',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y83 Pro',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y83',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y81i',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y81',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y71i',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y71',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y69',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y66 32GB',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y55S',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y55L',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y53i',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y53',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y51L',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y50',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y37 16GB',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y31L',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y31',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y30',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y28',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y27L',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y22',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y21L',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y21',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y20i',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y20',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y19',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y17',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y15S',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y15 (2019)',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y12',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y11 2019',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Y11',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Xshot X710',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Xplay5 Elite',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'Xplay5',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'X6S Plus',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'X6S',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'X6 Plus Single Sim',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'X6',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'X50 Pro',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'X50',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'X5 Pro',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'X5 MAX',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'X5',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'X3S',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'X21',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V9 Youth',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V9 Pro',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V9',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V7 Plus 4GB',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V7',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V5s 64GB',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V5 Plus 64GB',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V5',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V3 Max',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V3 32GB',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V20',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V19',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V17 Pro',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V17',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V15 Pro',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V15',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V11 Pro',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V11',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V1 Max',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'V1',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'U20',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'U10',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'S1 Pro',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'S1',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'NEX',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'iQOO 3',
            ),

            array(
                'brand_name' => 'Vivo',
                'name' => 'iQOO 3 5G',
            ),

            array(
                'brand_name' => 'Xiaomi',
                'name' => 'Mi Mix 2 128GB',
            ),

            array(
                'brand_name' => 'Xiaomi',
                'name' => 'Mi Max',
            ),

            array(
                'brand_name' => 'Xiaomi',
                'name' => 'Mi Max 2',
            ),

            array(
                'brand_name' => 'Xiaomi',
                'name' => 'Mi A3',
            ),

            array(
                'brand_name' => 'Xiaomi',
                'name' => 'Mi A2',
            ),

            array(
                'brand_name' => 'Xiaomi',
                'name' => 'Mi A1 64GB',
            ),

            array(
                'brand_name' => 'Xiaomi',
                'name' => 'Mi 5 32GB',
            ),

            array(
                'brand_name' => 'Xiaomi',
                'name' => 'Mi 4i',
            ),

            array(
                'brand_name' => 'Xiaomi',
                'name' => 'Mi 4',
            ),

            array(
                'brand_name' => 'Xiaomi',
                'name' => 'Mi 3',
            ),

            array(
                'brand_name' => 'Xiaomi',
                'name' => 'Mi 10T Pro',
            ),

            array(
                'brand_name' => 'Xiaomi',
                'name' => 'Mi 10T',
            ),

            array(
                'brand_name' => 'Xiaomi',
                'name' => 'Mi 10',
            ),

            array(
                'brand_name' => 'Xiaomi',
                'name' => 'Black Shark 2',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'ZX',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'X910',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'X500',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Win Q900S',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q900T',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q900S Plus',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q900S',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q900',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q800 X-Edition',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q800',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q710S',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q700S Plus',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q700S',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q700i',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q700 Club',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q700',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q610S',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q600S',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q600',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q520S',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q510S',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q500S IPS',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q500',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q3000',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q2500',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q2100',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q2000L',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q2000',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q1200',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q1100',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q1020',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q1011',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q1010i',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q1010',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q1000S Plus',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q1000S',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q1000 Opus 2',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q1000 Opus',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Q1000',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Prime',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Play 8X 1200',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Play 8X 1100',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Play 6X 1000',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Opus HD',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Opus 3',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'One HD',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'One',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Omega 5.5',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Omega 5.0',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'LT900',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'LT 2000',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'ERA X',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'ERA 4K',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'ERA 4G',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Era 2',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Era 1X',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Era',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Cube 5.0',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Black',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'Black 1X 32GB',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'A700S',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'A600',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'A550S IPS',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'A510S',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'A500S Lite',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'A500S',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'A500L',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'A500 Club',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'A500',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'A1010',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => 'A1000S',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => '8X 1020',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => '8X 1000i',
            ),

            array(
                'brand_name' => 'Xolo',
                'name' => '8X 1000 Hive',
            ),

            array(
                'brand_name' => 'Yu',
                'name' => 'Yutopia',
            ),

            array(
                'brand_name' => 'Yu',
                'name' => 'Yureka Plus',
            ),

            array(
                'brand_name' => 'Yu',
                'name' => 'Yureka Note',
            ),

            array(
                'brand_name' => 'Yu',
                'name' => 'Yureka Black',
            ),

            array(
                'brand_name' => 'Yu',
                'name' => 'Yureka 2',
            ),

            array(
                'brand_name' => 'Yu',
                'name' => 'Yureka',
            ),

            array(
                'brand_name' => 'Yu',
                'name' => 'Yuphoria',
            ),

            array(
                'brand_name' => 'Yu',
                'name' => 'Yunique Plus',
            ),

            array(
                'brand_name' => 'Yu',
                'name' => 'Yunique 2',
            ),

            array(
                'brand_name' => 'Yu',
                'name' => 'Yunique',
            ),

            array(
                'brand_name' => 'Yu',
                'name' => 'Yunicorn',
            ),

            array(
                'brand_name' => 'Yu',
                'name' => 'Ace',
            ),
        ];

        $db_models = [];

        PhoneModel::truncate();

        foreach ($models as $model) {

            $brand = PhoneBrand::whereName($model['brand_name'])->first();

            if (is_null($brand)) throw new Exception("Cannot create model with nulled brand");

            $db_models[] = [
                'brand_id' => $brand->id,
                'name' => $model['name'],
            ];
        }

        PhoneModel::insert($db_models);
    }
}
