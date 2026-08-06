<?php
  $includesPath = '/includes/';
  $uploadsPath = '/uploads/';
  $dashboardMenuArr = [
    ["sectionID" => 1, "sectionTitle" => "التحكم العام", "sectionIcon" => "cog",
     "menuData" => [[
         'menuID' => 'pages', 'menuTitle'=> '', 'menuIcon'=> 'copy'
        ],[
         'menuID' => 'news', 'menuTitle'=> '', 'menuIcon'=> 'comments-o'
        ],[
         'menuID' => 'slides', 'menuTitle'=> '', 'menuIcon'=> 'cubes'
        // ],[
        //  'menuID' => 'managers', 'menuTitle'=> '', 'menuIcon'=> 'users'
        // ],[
        //  'menuID' => 'councils', 'menuTitle'=> '', 'menuIcon'=> 'users'
        // ],[
        //  'menuID' => 'attachments', 'menuTitle'=> '', 'menuIcon'=> 'link'
        // ],[
        //  'menuID' => 'polls', 'menuTitle'=> '', 'menuIcon'=> 'thumbs-o-up'
        //],[
        //  'menuID' => 'mainAds', 'menuTitle'=> '', 'menuIcon'=> 'image'
        // ],[
        //  'menuID' => 'banns', 'menuTitle'=> '', 'menuIcon'=> 'image'
        // ],[
        //  'menuID' => 'announcements', 'menuTitle'=> '', 'menuIcon'=> 'television'
        // ],[
        //  'menuID' => 'rasid', 'menuTitle'=> '', 'menuIcon'=> 'newspaper-o'
        // ],[
        //  'menuID' => 'sites', 'menuTitle'=> '', 'menuIcon'=> 'internet-explorer'
        // ],[
        //  'menuID' => 'testimonial', 'menuTitle'=> '', 'menuIcon'=> 'internet-explorer'
        // ],[
        //  'menuID' => 'album', 'menuTitle'=> '', 'menuIcon'=> 'flag'
        // ],[
        //  'menuID' => 'library', 'menuTitle'=> '', 'menuIcon'=> 'book'
        ]]
    ],
    ["sectionID" => 2, "sectionTitle" => "التحكم في الجامعة",  "sectionIcon" => "cog",
     "menuData" => [[
         'menuID' => 'colleges', 'menuTitle'=> '', 'menuIcon'=> 'graduation-cap'
        ],[
         'menuID' => 'students', 'menuTitle'=> '', 'menuIcon'=> 'users'
        /*],[
         'menuID' => 'magazines', 'menuTitle'=> '', 'menuIcon'=> 'newspaper-o'
        ],[
         'menuID' => 'conferences', 'menuTitle'=> '', 'menuIcon'=> 'users'
        ],[
         'menuID' => 'graduates', 'menuTitle'=> '', 'menuIcon'=> 'graduation-cap'*/
        ]]
    ],
    ["sectionID" => 3, "sectionTitle" => "الإعدادات",  "sectionIcon" => "cog",
     "menuData" => [[
         'menuID' => 'locales', 'menuTitle'=> '', 'menuIcon'=> 'usd'
        ],[
         'menuID' => 'admins', 'menuTitle'=> '', 'menuIcon'=> 'area-chart'
        /*],[
         'menuID' => 'pharmaciesPrices', 'menuTitle'=> '', 'menuIcon'=> 'flask'*/
        ]]
    ],
  ];
  
  return array(
    'pagesHeadersPath'  	=> $includesPath.'headers',
    'testimonialPath'  	=> $includesPath.'testimonial',
    'newsPath'          	=> $includesPath.'news',
    'managersPath'          	=> $includesPath.'managers',
    'councilsPath'          	=> $includesPath.'councils',
    'albumPath'          	=> $includesPath.'album',
    
    // New By Fatima
    'sevicesHeadersPath'    => $includesPath.'services',
    'servicesPicsPath'      => $includesPath.'servicesPics',
    // ----------------------------------
    
    'sliderPath'          	=> $includesPath.'slider',
    'slidesPath'          	=> $includesPath.'slides',
    // 'slidesPath'        	=> $includesPath.'slides',
    'collegesSlidesPath'	=> $includesPath.'colleges/slides',
    'pdfPath'           	=> $includesPath.'pdf',
    'contentPath'       	=> $includesPath.'content',
    'journalsPath'      	=> $includesPath.'journals',
    'pricesPath'        	=> $includesPath.'prices',
    'bannsPath'        		=> $includesPath.'banns',
    'services'        		=> $includesPath.'services',
    'magazinesCoverPath'	=> $includesPath.'magazines/covers',
    'magazinesIssuesCoverPath'	=> $includesPath.'magazines/covers/issues',
    'magazinesTopicsPath'	=> $includesPath.'magazines/topics',
    'rasidPath'				=> $includesPath.'rasid',
    'dashboardMenuArr'  	=> $dashboardMenuArr
  );
