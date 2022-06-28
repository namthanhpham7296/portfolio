<?php

return [
    'LIST_STATUS' => [
        ['id' => 0, 'name' => "Đã khóa"],
        ['id' => 1, 'name' => "Hoạt động"],
    ],
    'LIST_GRADE' => [
        ['id' => 0, 'name' => "Đã khóa"],
        ['id' => 1, 'name' => "Hoạt động"],
    ],
   'LIST_MOTEL_DETAIL_MENU' => [
        ['id' => 1, 'name' => "General Information", 'page' => 'general', 'cls_icon' => "far fa-home" ],
        ['id' => 2, 'name' => "Blocks", 'page' => 'block', 'cls_icon' => "fas fa-th" ],
        ['id' => 3, 'name' => "Floors", 'page' => 'floor', 'cls_icon' => "fab fa-buffer" ],
        ['id' => 4, 'name' => "Rooms", 'page' => 'room', 'cls_icon' => "fas fa-door-open" ],
        ['id' => 5, 'name' => "Introduction", 'page' => 'introduction', 'cls_icon' => "fas fa-folder-tree" ],
        ['id' => 6, 'name' => "Settings", 'page' => 'setting', 'cls_icon' => "fas fa-cog" ],
        ['id' => 7, 'name' => "Histories", 'page' => 'history', 'cls_icon' => "fas fa-history" ],
    ], 'LIST_PAGE' => [
        ['page' => "home", 'controller' => "HomeController"],
        ['page' => "course", 'controller' => "CourseController"],
        ['page' => "pricing", 'controller' => "PricingController"],
        ['page' => "teacher", 'controller' => "TeacherController"],
        ['page' => "blog", 'controller' => "BlogController"],
        ['page' => "about", 'controller' => "AboutController"],

    ],'LIST_PRODUCT_SORT_BY' => [
        ['value' => "name-asc", 'name' => "Name (A - Z)"],
        ['value' => "name-desc", 'name' => "Name (Z - A)"],
        ['value' => "price-asc", 'name' => "Price (Low > High)"],
        ['value' => "price-desc", 'name' => "Price (High > Low)"],

    ],
];


