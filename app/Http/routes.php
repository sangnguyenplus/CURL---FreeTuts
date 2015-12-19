<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function() {

    // Lấy số trang hiện có từ freetuts
    $pages = file_get_html('http://freetuts.net')->find('.page-numbers li a')[9]->getAttribute('href');
    $pages = explode('/', $pages)[4];

    // lấy danh sách tất cả bài viết
    $items = [];
    for ($i = 1; $pages + 1; $i++) {

        $html = file_get_html('http://freetuts.net/page/' . $i);

        foreach($html->find('.post-meta h3 a') as $index => $element) {
            $items[$i * $index]['title'] = trim($element->plaintext);
            $items[$i * $index]['content'] = htmlentities(trim(file_get_html($element->getAttribute('href'))->getElementById('show-adv')->innertext()));
        }

        foreach($html->find('.post-meta p') as $index => $element) {
            $items[$i * $index]['description'] = trim($element->plaintext);
        }

        foreach($html->find('.post-img a img') as $index => $element) {
            $items[$i * $index]['image'] = $element->getAttribute('src');
        }
    }

    // Lưu vào DB
    \App\Post::insert($items);

    return "Get all posts from Freetuts successfully!";
});
