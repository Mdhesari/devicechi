<?php

/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => false, // set false to total remove
            'titleBefore'  => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description' => 'پلتفرم مارکت پلیس برای خرید و فروش گوشی های کارکرده، برند های مختلف از جمله اپل، سامسونگ، هووآوی، شیائومی و',
            'separator'    => ' - ',
            'keywords'     => [
                'sell mobile',
                'buy mobile',
                'smartphone',
                'smartphones',
                'marketplace',
                'shop',
                'shopping',
                'فروش گوشی',
                'خرید گوشی',
                'فروشگاه دست دوم',
                'گوشی هوشمند',
                'آگهی',
                'دیوار',
                'سامانه آگهی'
            ],
            'canonical'    => false, // Set null for using Url::current(), set false to total remove
            'robots'       => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'        => "خرید و فروش موبایل کارکرده و با کیفیت", // set false to total remove
            'description' => 'پلتفرم مارکت پلیس برای خرید و فروش گوشی های کارکرده، برند های مختلف از جمله اپل، سامسونگ، هووآوی، شیائومی و',
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => false,
            'site_name'   => false,
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            //'card'        => 'summary',
            //'site'        => '@LuizVinicius73',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => 'Over 9000 Thousand!', // set false to total remove
            'description' => 'For those who helped create the Genki Dama', // set false to total remove
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
