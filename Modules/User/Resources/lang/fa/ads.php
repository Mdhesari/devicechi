
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Ads Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'create' => [
        'title' => 'ایجاد آگهی جدید',
        'btn_title' => 'ایجاد آگهی جدید',
    ],

    'form' => [
        'label' => [
            'price' => 'قیمت',
            'age' => [
                'min' => 'کمتر از :month ماه',
                'max' => 'بیشتر از :month ماه',
                'between' => ':min - :max ماه'
            ]
        ],
        'placeholder' => [
            'price' => 'قیمت را وارد کنید.'
        ],
        'error' => [
            'price' => [
                'invalid' => 'قیمت بیشتر از حد مجاز است!',
            ]
        ]
    ],

    'wizard' => [
        'choose_brand' => [
            'title' => 'انتخاب برند',
            'desc' => 'برند دستگاه خود را انتخاب کنید',
        ],

        'choose_model' => [
            'title' => 'انتخاب مدل',
            'desc' => 'مدل دستگاه خود را انتخاب کنید',
        ],

        'choose_variant' => [
            'title' => 'انتخاب رم و حافظه',
            'desc' => 'رم و حافظه دستگاه خود را انتخاب کنید.',
        ],

        'choose_age' => [
            'title' => 'زمان خرید دستگاه',
            'desc' => 'دستگاه را چه مدت است که خریده اید؟!',
        ],

        'choose_price' => [
            'title' => 'قیمت گذاری',
            'desc' => 'لطفا برای دستگاه خود قیمت گذاری کنید.',
        ],

        'choose_accessory' => [
            'title' => 'انتخاب لوازم جانبی',
            'desc' => 'لوازم جانبی موجود دستگاه خود را انتخاب کنید.',
        ],

        'btn' => [
            'continue' => 'ادامه',
        ]
    ]

];
