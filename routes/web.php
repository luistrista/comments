<?php
Route::get('/', ['uses' => 'commentController@comments', 'as' => 'commentList']);
Route::get('/commentlist', ['uses' => 'commentController@commentlistView', 'as' => 'commentListView']);
Route::post('/newcomment/{idCommentParent}', ['uses' => 'commentController@commentNew', 'as' => 'commentNew', 'middleware' => ['xss']]);
