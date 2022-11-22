<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    ''                      => ['HomeController', 'index',],
    'manga/show'            => ['MangaController', 'showOne', ['id']],
    'manga/delete'          => ['MangaController', 'delete'],
    'manga/fav'             => ['MangaController' , 'fav'],
    'showcase'              => ['MangaController', 'showcase',],
    'manga/list'            => ['MangaController', 'list', ['category']],
    'manga/add'             => ['MangaController', 'add'],
];
