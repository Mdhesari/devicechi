
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

    'reload' => 'بارگذاری مجدد آگهی ها',
    'latest' => 'آخرین آگهی ها',
    'latest-pro' => 'آگهی های ویژه',
    'not-found' => 'هیچ آگهی درباره :q پیدا نشد.',
    'finalSubmit' => 'ثبت نهایی',
    'preview' => 'پیش نمایش',
    'proceed' => 'ثبت نهایی',
    'pay' => 'پرداخت',
    'tabs' => [
        'all' => 'همه آگهی های من',
        'accepted' => ' آگهی های تایید شده',
        'rejected' => ' آگهی های رد شده',
        'pending' => ' آگهی های در انتظار تایید',
        'uncompleted' => ' آگهی های نا تمام',
        'archive' => ' آگهی های پیش نویس',
        'unavailable' => 'آگهی های منقضی شده',
    ],
    'defaults' => [
        'title' => 'بدون عنوان',
    ],
    'section' => [
        'selection' => [
            'brand' => 'برند انتخاب شده : ',
            'model' => 'مدل انتخاب شده : ',
        ]
    ],
    'success' => [
        'status' => [
            'pending' => 'اگهی شما در انتظار تایید قرار گرفت و پس از بازبینی پشتیبان ما حداکثر تا ۶ ساعت آینده و در صورت نداشتن ایراد منتشر خواهد شد.',
            'archive' => 'آگهی شما با موفقیت پیش نویس شد. شما در هر زمان میتوانید وضعیت آن را تغییر دهید.',
        ],
        'delete' => 'آگهی مورد نظر با موفقیت حذف شد',
        'pending' => 'آگهی جدید در انتظار تایید قرار گرفت',
        'archive' => 'آگهی مورد نظر پیش نویس شد',
    ],
    'warning' => [
        'edit' => 'در صورت ویرایش آگهی و بروزرسانی آگهی تا زمان تایید توسط تیم پشتیبانی آگهی شما غیر فعال خواهد شد.'
    ],
    'status' => [
        /* rejected */
        [
            'label' => 'رد شده',
            'class' => 'bg-danger'
        ],
        /* accepted */
        [
            'label' => 'تایید شده',
            'class' => 'bg-success',
        ],
        /* Pending */
        [
            'label' => 'در انتظار تایید',
            'class' => 'bg-info',
        ],
        /* UNCOMPLETED */
        [
            'label' => 'نا تمام',
            'class' => 'bg-warning',
        ],
        /* UNAVAILABLE */
        [
            'label' => 'منقضی شده ',
            'class' => 'bg-secondary',
        ],
        /* Archive */
        [
            'label' => 'پیش نویس',
            'class' => 'bg-primary'
        ]

    ],
    'create' => [
        'title' => 'ایجاد آگهی جدید',
        'btn_title' => 'ایجاد آگهی جدید',
    ],
    'actions' => [
        'save' => 'انتشار',
        'delete' => 'حذف',
        'back' => 'بازگشت و اصلاح',
        'archive' => 'پیش نویس',
    ],
    'demo' => [
        /* rejected */
        [
            'title' => 'آگهی نامعتبر!',
            'desc' => 'آگهی شما رد شده است. لطفا با توجه به قوانین سایت بعد از اصلاح آگهی دوباره برای انتشار درخواست دهید.',
            'bg' => 'bg-danger',
        ],
        /* accepted */
        [
            'title' => 'آگهی ثبت شده ',
            'desc' => 'آگهی شما با موفقیت ثبت شده است و در وبسایت قرار دارد.',
            'bg' => 'bg-success text-light',
        ],
        /* Pending */
        [
            'title' => 'توجه! این یک پیش نمایش است.',
            'desc' => 'آگهی شما هنوز منتشر نشده است و پس از تایید تیم پشتیبانی ما منتشر خواهد شد. شما میتوانید با استفاده از دکمه های مربوطه که در سمت پایین وسط قرار داده شده، آگهی را ویرایش، حذف و یا برای انتشار در زمانی دیگر پیش نویس کنید.',
            'bg' => 'bg-warning',
        ],
        /* UNCOMPLETED */
        [
            'title' => 'مرحله نهایی انتشار!',
            'desc' => 'شما در مرحله نهایی انتشار هستید و با زدن دکمه انتشار آگهی جهت تایید به تیم پشتیبانی ارسال خواهد شد.',
            'bg' => 'bg-info',
        ],
        /* UNAVAILABLE */
        [
            'title' => 'آگهی منقضی شده!',
            'desc' => 'آگهی شما در حال حاضر منقضی شده است و فعال نیست!',
            'bg' => 'bg-secondary',
        ],
        /* Archive */
        [
            'title' => 'آگهی پیش نویس!',
            'desc' => 'آگهی شما پیش نویس شده است و در هر زمان امکان درخواست انتشار یا مدیریت آگهی را دارید.',
            'bg' => 'bg-primary text-light',
        ]
    ],

    'form' => [
        'attrs' => [
            'contacts' => 'اطلاعات تماس',
        ],
        'label' => [
            'price' => 'قیمت',
            'age' => [
                'min' => 'کمتر از :month ماه',
                'max' => 'بیشتر از :month ماه',
                'between' => ':min تا :max ماه'
            ],
            'location' => [
                'city' => 'شهر',
                'state' => 'منطقه',
            ],
            'contact' => [
                'add' => 'اضافه کردن به اطلاعات تماس',
                'verify' => 'لطفا کد تایید ارسال شده را وارد کنید.',
            ],
            'details' => [
                'title' => 'عنوان',
                'description' => 'توضیحات'
            ],
            'multicard' => 'دستگاه چند سیم کارت را پشتیبانی میکند.',
            'exchangeable' => 'مایل به معاوضه هستم'
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
            ],
            'contact' => [
                'verify' => 'کد تایید را وارد کنید.'
            ],
            'details' => [
                'title' => 'مثلا : گوشی سامسونگ a51 ',
                'description' => 'مثلا : دوربین  جلو  ۸ مگاپیکسل و دوربین عقب ۱۶ مگاپیکسل سلامت باتری ۸۲٪',
            ],
            'brands' => [
                'search' => 'جستجو بین برند ها...',
            ],
            'models' => [
                'search' => 'جستجو بین برند ها...',
            ],
        ],
        'warning' => [
            'nothing' => [
                'brands' => 'هیچ برندی با عنوان :brand وجود ندارد.',
                'models' => 'هیچ مدلی با عنوان :model_name وجود ندارد.',
                'cities' => 'هیچ شهری با عنوان :city_name وجود ندارد.',
            ],
            'upload' => [
                'title' => 'در صورت عدم رعایت نکات زیر آگهی رد خواهد شد.',
                'count' => 3,
                'list' => [
                    'test',
                    'sdf'
                ]
            ]
        ],
        'success' => [
            'contact' => [
                'add' => [
                    'title' => 'اطلاعات تماس جدید با موفقیت اضافه شد.',
                    'desc' => '',
                ],
                'delete' => [
                    'title' => 'اطلاعات تماس مورد نظر با موفقیت حذف شد.',
                    'desc' => '',
                ],
                'verify' => [
                    'title' => 'کد تایید برای شما ارسال شد.',
                    'desc' => ''
                ]
            ],
        ],
        'error' => [
            'active-picture' => 'لطفا یک تصویر شاخص انتخاب کنید.',
            'price' => [
                'invalid' => 'قیمت بیشتر از حد مجاز است!',
            ],
            'pictures' => [
                'max' => 'شما حداکثر میتوانید :limit تصویر را برای هر آگهی ثبت کنید.',
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
            'contact' => [
                'value' => [
                    'title' => 'حتما باید یک مقدار وارد کنید.',
                    'desc' => '',
                ],
                'duplicate' => [
                    'title' => 'این اطلاع تماس قبلا برای این آگهی ثبت شده است.',
                    'desc' => '',
                ],
                'limitDelete' => [
                    'title' => 'حتما باید حداقل یک اطلاع تماس برای آگهی داشته باشید! ',
                    'desc' => '',
                ],
                'verify' => [
                    'title' => 'کد وارد شده صحیح نمیباشد.',
                    'desc' => '',
                ]
            ],
            'rule' => [
                'title' => 'لطفا با قوانین موافقت کنید!',
                'desc' => '',
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

        'final_info' => [
            'title' => 'عنوان و توضیحات',
            'desc' => 'لطفا عنوان آگهی و توضیحات بیشتری درباره آگهی خود را وارد کنید.',
        ],
        'upload_picture' => [
            'title' => 'بارگذاری تصاویر',
            'desc' => 'لطفا عکس های گرفته شده از دستگاه خود را بارگذاری کنید.',
        ],
        'power' => [
            'title' => 'ارتقا آگهی',
            'desc' => 'بازدید و بازدهی آگهی خود را افزایش دهید',
        ],

        'btn' => [
            'continue' => 'ادامه',
        ],

    ]

];
