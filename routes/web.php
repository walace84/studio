<?php



// rota do site
Route::get('/', 'SiteController@index')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// cliente inativo
Route::get('/inativos', 'HomeController@inativo')->name('inativo');
// aniversário
Route::get('/birthday', 'HomeController@birthday')->name('birthday');

// adiciona um cliente na sessão
Route::get('/userSession/{id}', 'HomeController@addSession')->name('UserSession');
// destroi a sessão
Route::get('/desconect', 'HomeController@desconect')->name('desconect');



//== Rota do carrinho ==//
Route::middleware(['auth'])->prefix('cart')->namespace('Admin')->group(function(){
 // Carrinho
Route::get('/', 'CartController@index')->name('cart');
// adicona um item ao carrinho
Route::post('add', 'CartController@addCart')->name('addProd');
// remove do carrinho
Route::delete('remove', 'CartController@remove')->name('remove');
// fechar venda
Route::post('closeOrder', 'CartController@closeOrder')->name('closeOrder');

// pontos do cliente
Route::get('/points', 'CartController@points')->name('points');
// deletar pontos do cliente
Route::get('/delete', 'CartController@deletePoints')->name('delete');
// lista clientes
Route::get('/list', 'CartController@list')->name('list');
// lista produtos
Route::get('/listprod', 'CartController@listProd')->name('listprod');
// desconto
Route::post('/discount/{id}', 'CartController@discount')->name('discount');
   
});


Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function(){
    Route::resource('client', 'ClientUserController');
    Route::resource('product', 'ProductController');

    Route::post('search', 'ClientUserController@search')->name('search');
    Route::post('busca', 'CartController@search')->name('busca');
    // agenda 1
    Route::post('shedule', 'ShedulesController@search')->name('shedules');
    Route::post('searchClients', 'ShedulesController@searchClient')->name('searchClients');
    // agenda 2
    Route::post('sheduletwo', 'Shedules2Controller@search')->name('shedulestwo');
    Route::post('searchclient', 'Shedules2Controller@searchClient')->name('searchclient');   

    // relatório do dia
    Route::get('report', 'ReportController@index')->name('report');
    // relatóri mensal
    Route::get('monthly', 'ReportController@monthly')->name('monthly');
     // relatóri diario
     Route::post('daily', 'ReportController@daily')->name('daily');
});

Route::post('/month', 'Admin\ReportController@search')->name('month');


 // agendamento
Route::group(['middleware' => ['auth']], function () {
    Route::get('/shedule', 'Admin\ShedulesController@index')->name('shedule');
    Route::post('/store', 'Admin\ShedulesController@store')->name('store');
    Route::get('/show/{id}', 'Admin\ShedulesController@show')->name('show');
    Route::get('/edit/{id}', 'Admin\ShedulesController@edit')->name('edit');
    Route::post('/update/{id}', 'Admin\ShedulesController@update')->name('update');
    Route::get('/delete/{id}', 'Admin\ShedulesController@delete')->name('deleta');
    Route::get('/listclient', 'Admin\ShedulesController@list')->name('listclient');

 
});

Route::get('/sheduletwo', 'Admin\Shedules2Controller@index')->name('shedule2');
Route::post('/storetwo', 'Admin\Shedules2Controller@store')->name('store2');
Route::get('/showtwo/{id}', 'Admin\Shedules2Controller@show')->name('show2');
Route::get('/edittwo/{id}', 'Admin\Shedules2Controller@edit')->name('edit2');
Route::post('/updatetwo/{id}', 'Admin\Shedules2Controller@update')->name('update2');
Route::get('/deletetwo/{id}', 'Admin\Shedules2Controller@delete')->name('deleta2');

Route::get('/listtwo', 'Admin\Shedules2Controller@list')->name('listtwo');