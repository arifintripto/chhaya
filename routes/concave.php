<?php
//-------------------------------------------------------------------------
/* Start Module Routes */


Route::get('concave/module','ModuleController@index');
Route::get('concave/module/create','ModuleController@getCreate');
Route::get('concave/module/rebuild/{any}','ModuleController@getRebuild');
Route::get('concave/module/build/{any}','ModuleController@getBuild');
Route::get('concave/module/config/{any}','ModuleController@getConfig');
Route::get('concave/module/sql/{any}','ModuleController@getSql');
Route::get('concave/module/table/{any}','ModuleController@getTable');
Route::get('concave/module/form/{any}','ModuleController@getForm');
Route::get('concave/module/formdesign/{any}','ModuleController@getFormdesign');
Route::get('concave/module/subform/{any}','ModuleController@getSubform');
Route::get('concave/module/subformremove/{any}','ModuleController@getSubformremove');
Route::get('concave/module/sub/{any}','ModuleController@getSub');
Route::get('concave/module/removesub','ModuleController@getRemovesub');
Route::get('concave/module/permission/{any}','ModuleController@getPermission');
Route::get('concave/module/source/{any}','ModuleController@getSource');
Route::get('concave/module/combotable','ModuleController@getCombotable');
Route::get('concave/module/combotablefield','ModuleController@getCombotablefield');
Route::get('concave/module/editform/{any?}','ModuleController@getEditform');
Route::get('concave/module/destroy/{any?}','ModuleController@getDestroy');
Route::get('concave/module/conn/{any?}','ModuleController@getConn');
Route::get('concave/module/code/{any?}','ModuleController@getCode');
Route::get('concave/module/duplicate/{any?}','ModuleController@getDuplicate');

/* POST METHODE */
Route::post('concave/module/create','ModuleController@postCreate');
Route::post('concave/module/saveconfig/{any}','ModuleController@postSaveconfig');
Route::post('concave/module/savesetting/{any}','ModuleController@postSavesetting');
Route::post('concave/module/savesql/{any}','ModuleController@postSavesql');
Route::post('concave/module/savetable/{any}','ModuleController@postSavetable');
Route::post('concave/module/saveform/{any}','ModuleController@postSaveForm');
Route::post('concave/module/savesubform/{any}','ModuleController@postSavesubform');
Route::post('concave/module/formdesign/{any}','ModuleController@postFormdesign');
Route::post('concave/module/savepermission/{any}','ModuleController@postSavePermission');
Route::post('concave/module/savesub/{any}','ModuleController@postSaveSub');
Route::post('concave/module/dobuild/{any}','ModuleController@postDobuild');
Route::post('concave/module/source/{any}','ModuleController@postSource');
Route::post('concave/module/install','ModuleController@postInstall');
Route::post('concave/module/package','ModuleController@postPackage');
Route::post('concave/module/dopackage','ModuleController@postDopackage');
Route::post('concave/module/saveformfield/{any?}','ModuleController@postSaveformfield');
Route::post('concave/module/conn/{any?}','ModuleController@postConn');
Route::post('concave/module/code/{any?}','ModuleController@postCode');
Route::post('concave/module/duplicate/{any?}','ModuleController@postDuplicate');



/* End  Module Routes */
//-------------------------------------------------------------------------

/* Start  Code Routes */
Route::get('concave/code','CodeController@index');
Route::get('concave/code/edit','CodeController@getEdit');
Route::post('concave/code/source','CodeController@PostSource');
Route::post('concave/code/save','CodeController@PostSave');

Route::get('concave/config/email','ConfigController@getEmail');
Route::get('concave/config/security','ConfigController@getSecurity');
Route::post('concave/code/source/:any','ConfigController@postSource');
/* End  Code Routes */

//-------------------------------------------------------------------------
/* Start  Config Routes */
Route::get('concave/config','ConfigController@getIndex');
Route::get('concave/config/email','ConfigController@getEmail');
Route::get('concave/config/security','ConfigController@getSecurity');
Route::get('concave/config/translation','ConfigController@getTranslation');
Route::get('concave/config/log','ConfigController@getLog');
Route::get('concave/config/clearlog','ConfigController@getClearlog');
Route::get('concave/config/addtranslation','ConfigController@getAddtranslation');
Route::get('concave/config/removetranslation/{any}','ConfigController@getRemovetranslation');
// POST METHOD
Route::post('concave/config/save','ConfigController@postSave');
Route::post('concave/config/email','ConfigController@postEmail');
Route::post('concave/config/login','ConfigController@postLogin');
Route::post('concave/config/email','ConfigController@postEmail');
Route::post('concave/config/addtranslation','ConfigController@postAddtranslation');
Route::post('concave/config/savetranslation','ConfigController@postSavetranslation');
/* End  Config Routes */

//-------------------------------------------------------------------------
/* Start  Menu Routes */
Route::get('concave/menu/','MenuController@getIndex');
Route::get('concave/menu/index/{any?}','MenuController@getIndex');
Route::get('concave/menu/destroy/{any?}','MenuController@getDestroy');
Route::get('concave/menu/icon','MenuController@getIcons');

Route::post('concave/menu/save','MenuController@postSave');
Route::post('concave/menu/saveorder','MenuController@postSaveorder');
/* End  Config Routes */

//-------------------------------------------------------------------------
/* Start  Tables Routes */
Route::get('concave/tables','TablesController@index');
Route::get('concave/tables/tableconfig/{any}','TablesController@getTableconfig');
Route::get('concave/tables/mysqleditor','TablesController@getMysqleditor');
Route::get('concave/tables/tableconfig','TablesController@getTableconfig');
Route::get('concave/tables/tablefieldedit/{any}','TablesController@getTablefieldedit');
Route::get('concave/tables/tablefieldremove/{id?}/{id2?}','TablesController@getTablefieldremove');
// POST METHOD
Route::post('concave/tables/tableremove','TablesController@postTableremove');
Route::post('concave/tables/tableinfo/{any}','TablesController@postTableinfo');
Route::post('concave/tables/mysqleditor','TablesController@postMysqleditor');
Route::post('concave/tables/tablefieldsave/{any?}','TablesController@postTablefieldsave');
Route::post('concave/tables/tables','TablesController@postTables');
/* End  Tables Routes */


//-------------------------------------------------------------------------
/* Start Logs Routes */
// -- Get Method --
Route::resource('concave/rac','RacController');
Route::get('concave/rac/show/{any}','RacController@getShow');
Route::get('concave/rac/update/{any?}','RacController@getUpdate');
Route::get('concave/rac/comboselect','RacController@getComboselect');
Route::get('concave/rac/download','RacController@getDownload');
Route::get('concave/rac/search','RacController@getSearch');

// -- Post Method --
Route::post('concave/rac/save','RacController@postSave');
Route::post('concave/rac/filter','RacController@postFilter');
Route::post('concave/rac/delete/{any?}','RacController@postDelete');
/* End  Tables Routes */

Route::resource('concave/form','FormController');
Route::resource('concave/server','ServerController');