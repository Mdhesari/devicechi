
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
            ],
            'location' => [
                'city' => 'شهر',
                'state' => 'منطقه',
            ],
            'contact' => [
                'add' => 'اضافه کردن به اطلاعات تماس'
            ]
        ],
        'placeholder' => [
            'price' => 'قیمت را وارد کنید.',
            'upload' => [
                'init' => 'برای بارگذاری تصاویر اینجا کلیک کنید',
                'drop' => 'عکس ها را اینجا رها کنید...',
            ],
            'location' => [
                'city' => 'انتخاب شهر...',
                'state' => 'انتخاب منطقه...',
                'state_loading' => 'در حال بارگذاری مناطق...',
            ]
        ],
        'success' => [
            'contact' => [
                'add' => [
                    'title' => 'اطلاعات تماس جدید با موفقیت اضافه شد.',
                    'description' => '',
                ],
            ],
        ],
        'error' => [
            'price' => [
                'invalid' => 'قیمت بیشتر از حد مجاز است!',
            ],
            'pictures' => [
                'max' => 'شما حداکثر میتوانید ۹ تصویر را برای هر آگهی ثبت کنید.',
                'min' => 'برای ثبت آگهی باید حداقل ۳ تصویر را بارگذاری کنید.',
            ],
            'location' => [
                'city' => [
                    'title' => 'مشکلی در انتخاب شهر بوجود آمده است',
                    'desc' => 'لطفا دوباره امتحان کنید...',
                ],
                'state' => [
                    'title' => 'مشکلی در انتخاب منطقه بوجود آمده است',
                    'desc' => 'لطفا دوباره امتحان کنید...',
                ],
            ],
        ],
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

        'choose_location' => [
            'title' => 'انتخاب شهر',
            'desc' => 'لطفا شهر و منطقه سکونت خود را انتخاب کنید.',
        ],

        'choose_contact' => [
            'title' => 'اطلاعات تماس',
            'desc' => 'لطفا اطلاعات تماس خود را وارد کنید.',
        ],

        'upload_picture' => [
            'title' => 'بارگذاری تصاویر',
            'desc' => 'لطفا عکس های گرفته شده از دستگاه خود را بارگذاری کنید.',
        ],

        'btn' => [
            'continue' => 'ادامه',
        ]
    ]

];
