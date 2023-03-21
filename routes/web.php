<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', 'HomeController@gethome');
// Route::get('/', 'CameraController@cameraList')->name('camera-list')->middleware('auth');

Route::post('edit/edit-color/','AreaController@editColor')->name('process-edit-task-file')->middleware('auth');

 Route::get('hoivan/list', 'MinhController@list')->name('home')->middleware('auth');
 Route::get('minh/fuzzy', 'FuzzyController@minh')->name('home')->middleware('auth');
 Route::get('minh/fuzzyt', 'FuzzytController@minh')->name('home')->middleware('auth');

 Route::get('/', 'SystemController@index')->name('home')->middleware('auth');

  Route::get('doc', 'SystemController@doc')->name('doc')->middleware('auth');



  Route::get('mytest', 'SystemController@mytest')->name('doc')->middleware('auth');

Route::get('/map', 'AreaController@projectList')->name('project-list')->middleware('auth');

Route::get('/draw-map/', 'AreaController@projectDrawList')->name('project-list')->middleware('auth');

Route::get('/admin-map', 'AreaController@projectAdminList')->name('project-admin-list')->middleware('auth');

Route::post('/add-project', 'AreaController@projectAdd')->name('project-add')->middleware('auth');

Route::post('/edit-project', 'AreaController@projectEdit')->name('project-edit')->middleware('auth');


Route::get('/con-map', 'AreaController@projectConList')->name('project-con-list')->middleware('auth');


 Route::get('/test', 'IconController@index')->name('icon-index')->middleware('auth');

Route::get('trans/{id}', 'AreaController@areaTrans')->name('area-list')->middleware('auth');


Route::get('/trans-type-info/{id}', 'AreaController@areaTransType')->name('area-list')->middleware('auth');


Route::get('deposit/{id}', 'AreaController@areaDeposit')->name('area-deposit')->middleware('auth');
Route::get('deposit/view/{id}', 'AreaController@depositDetail')->name('area-deposit')->middleware('auth');
Route::get('deposit-list', 'AreaController@depositList')->name('list-deposit')->middleware('auth');

Route::get('deposit-update', 'AreaController@depositUpdate')->name('list-deposit')->middleware('auth');
Route::get('deposit-remove', 'AreaController@depositRemove')->name('list-deposit')->middleware('auth');
Route::get('deposit-trans/{id}', 'AreaController@depositList')->name('list-deposit')->middleware('auth');


Route::get('lock/{id}', 'AreaController@zoneLock')->name('area-lock')->middleware('auth');
Route::get('unlock/{id}', 'AreaController@zoneUnlock')->name('area-lock')->middleware('auth');
Route::get('admin-reset/{id}', 'AreaController@zoneAdminReset')->name('area-reset')->middleware('auth');
Route::post('reset-zone', 'AreaController@zoneReset')->middleware('auth');

Route::post('update-trans', 'AreaController@TransUpdate')->middleware('auth');

Route::post('lock-zone', 'AreaController@zoneLockBySid')->middleware('auth');

Route::post('edit-zone', 'AreaController@editZone')->middleware('auth');

Route::get('zone-complete/{id}', 'AreaController@CompleteZone')->middleware('auth');

//zone_files

// Route::get('area/zone_warehouse', 'AreaController@zone_warehouse')->middleware('auth');
Route::get('/zone/merge-select-pdfs/{id}','AreaController@mergeSelectPdfs')->middleware('auth');


Route::get('/zone/merge-all-pdfs/{id}','AreaController@mergeAllPdfs')->middleware('auth');

Route::post('zone/edit-file-names/','AreaController@editFileNames')->name('contribute-edit-task-file-name')->middleware('auth');

Route::post('area/edit-files/','AreaController@editFiles')->name('process-edit-task-file')->middleware('auth');

Route::get('map/zone_warehouse/{id}', 'AreaController@zone_warehouse')->middleware('auth');

// Route::get('map/zone_warehouse', 'BuildingController@warehouse')->middleware('auth');

Route::get('zone/file-delete/{id}','AreaController@DeleteZoneFile')->name('zone_warehouse-file-delete')->middleware('auth');

Route::post('add-deposit', 'AreaController@addDeposit')->middleware('auth');


Route::get('area-list/{id}', 'AreaController@areaList')->name('area-list')->middleware('auth');

Route::get('mini-list/{id}', 'AreaController@minimapList')->name('area-list')->middleware('auth');


Route::get('mini-fix-list/{id}', 'AreaController@minimapFixList')->name('area-list')->middleware('auth');


Route::get('area-full-list/{id}', 'AreaController@areaFullList')->name('area-list')->middleware('auth');


Route::get('area-full-con-list/{id}', 'AreaController@areaFullConList')->name('area-list')->middleware('auth');

Route::get('area-information/{id}','AreaController@areaInformation')->name('area-information')->middleware('auth');

Route::get('area-fix/{id}','AreaController@areaFix')->name('area-fix')->middleware('auth');

Route::get('map-config/{id}','AreaController@areaConfig')->name('area-config')->middleware('auth');
Route::get('get-map-config/{id}','AreaController@getConfig')->middleware('auth');
Route::post('add-map-config', 'AreaController@addMapConfig')->middleware('auth');
Route::post('edit-map-config', 'AreaController@editMapConfig')->middleware('auth');

Route::post('add-area-config', 'AreaController@addAreaConfig')->middleware('auth');
Route::post('edit-area-config', 'AreaController@editAreaConfig')->middleware('auth');

Route::get('remove-area-config/{id}', 'AreaController@removeAreaConfig')->middleware('auth');


Route::get('delete-map-config/{zone_id}','AreaController@deleteMapConfig')->middleware('auth');

Route::get('area-contribute-information/{id}','AreaController@areaContributeInformation')->name('area-contribute-information')->middleware('auth');



Route::post('add-new-zone', 'AreaController@addZone')->middleware('auth');
Route::post('add-history-zone', 'AreaController@addHistoryZone')->middleware('auth');
// Route::post('update-zone/{area_id}','AreaController@updateZone')->middleware('auth');

Route::get('get-all-zone','AreaController@getAllZone')->middleware('auth');
Route::get('get-all-zone-map/{id}','AreaController@getAllZoneMap')->middleware('auth');

Route::get('get-zone/{area_id}','AreaController@getZone')->middleware('auth');
Route::get('history-contribute-zone/{zone_id}','AreaController@getHistoryZone')->middleware('auth');


Route::get('get-contribute-zone/{area_id}','AreaController@getContributeZone')->middleware('auth');


Route::get('confirm-deal/{zone_id}','AreaController@confirmDeal')->middleware('auth');

Route::get('delete-zone/{zone_id}','AreaController@deleteZone')->middleware('auth');

Route::post('update-zone-consumer','AreaController@updateZoneConsumer')->middleware('auth');

Route::post('add-new-area', 'AreaController@AddArea')->middleware('auth');
Route::get('get-area/{area_id}','AreaController@getArea')->middleware('auth');
Route::get('delete-area/{area_id}','AreaController@DeleteArea')->middleware('auth');



Route::post('add-new-minimap', 'AreaController@addMinimap')->middleware('auth');
Route::get('delete-minimap/{area_id}','AreaController@deleteMinimap')->middleware('auth');

Route::get('zone-suggest-json/{id}', 'AreaController@zoneSuggestJson');
Route::get('zone-suggest/{id}', 'AreaController@zoneSuggest');

Route::get('save-click/{id}', 'AreaController@saveClick');
Route::post('save-search','AreaController@saveSearch');

// statistic
Route::get('/audit-chart/{type}/{date}', 'StatisticController@auditChart')->name('statistic-chart')->middleware('auth');


Route::get('/audit-bar/{type}/{date}', 'StatisticController@auditBar')->name('statistic-bar')->middleware('auth');


Route::get('/statistic', 'StatisticController@getView')->name('statistic')->middleware('auth');



Route::get('/statistic/{id}', 'StatisticController@getViewById')->name('statistic')->middleware('auth');


Route::get('/audit-chart/{id}', 'StatisticController@auditChartById')->name('statistic-chart')->middleware('auth');

// finance

Route::get('/finance-audit-chart/{type}/', 'FinanceController@auditChart')->name('statistic-chart')->middleware('auth');


Route::get('/finance-audit-bar/', 'FinanceController@auditBar')->name('statistic-bar')->middleware('auth');


Route::get('/finance/statistic', 'FinanceController@getView')->name('finance-statistic')->middleware('auth');

Route::get('finance/type','FinanceController@type')->name('genlegal-form-list')->middleware('auth');

Route::get('finance/detail/{type}/{id}','FinanceController@detail')->name('finance-detail-list')->middleware('auth');

Route::get('finance/detail/sale','FinanceController@detailSale')->name('finance-detail-sale')->middleware('auth');

Route::get('finance/detail/daily','FinanceController@detailDaily')->name('finance-detail-daily')->middleware('auth');

Route::post('finance/add-type','FinanceController@addType')->middleware('auth');
Route::post('finance/edit-type','FinanceController@editType')->middleware('auth');
Route::get('finance/delete-type/{type}/{id}','FinanceController@deleteType')->middleware('auth');

Route::get('finance/delete-step/{id}','FinanceController@deleteStep')->name('genleg-list')->middleware('auth');

Route::get('finance','FinanceController@index')->name('genleg-list')->middleware('auth');
Route::get('finance/detail/{id}','FinanceController@detail')->name('genleg-list')->middleware('auth');

Route::get('finance/tax','FinanceController@tax')->name('genleg-list')->middleware('auth');


Route::post('finance/import','FinanceController@import')->name('import-list')->middleware('auth');


Route::get('finance/tax/{id}','FinanceController@taxFile')->middleware('auth');

Route::get('finance/file-delete/{id}','FinanceController@DeleteFile')->name('finance-file-delete')->middleware('auth');
Route::post('finance/edit-task-file/','FinanceController@editFile')->name('process-edit-task-file')->middleware('auth');
Route::post('finance/edit-task-file-name/','FinanceController@editFileName')->name('finance-edit-task-file-name')->middleware('auth');



Route::get('finance/human','FinanceController@human')->middleware('auth');
Route::get('finance/human-detail/{id}','FinanceController@humanDetail')->middleware('auth');
Route::get('finance/salary','FinanceController@salary')->middleware('auth');
Route::get('finance/salary-update','FinanceController@SalaryUpdate')->middleware('auth');
Route::get('finance/salary-detail/{month}/{year}','FinanceController@salaryDetail')->middleware('auth');
Route::post('finance/edit-salary','FinanceController@salaryEdit')->middleware('auth');


Route::get('finance/get-sub-as-json/{id}','FinanceController@getSubAsJson')->middleware('auth');

Route::post('finance/add','FinanceController@Add')->middleware('auth');
Route::post('finance/addsub','FinanceController@Addsub')->middleware('auth');
Route::post('finance/editsub','FinanceController@Editsub')->middleware('auth');
Route::post('finance/edit','FinanceController@Edit')->middleware('auth');
Route::post('finance/edit-tax','FinanceController@EditTax')->middleware('auth');
Route::get('finance/delete/{type}/{id}','FinanceController@Delete')->middleware('auth');

// contribute

Route::get('contribute/list','ContributeController@list')->middleware('auth');

Route::get('contribute/data/{id}','ContributeController@data')->middleware('auth');

Route::get('contribute/file-delete/{id}','ContributeController@DeleteFile')->name('contribute-file-delete')->middleware('auth');




Route::post('contribute/edit-task-file/','ContributeController@editFile')->name('process-edit-task-file')->middleware('auth');
Route::post('contribute/edit-task-file-name/','ContributeController@editFileName')->name('contribute-edit-task-file-name')->middleware('auth');

//building



Route::get('build/pin-mess/{id}', 'BuildingController@pinMess')->middleware('auth');
Route::get('build/unpin-mess/{id}', 'BuildingController@unpinMess')->middleware('auth');
Route::get('/build/con-select/{id}', 'BuildingController@conSelect')->middleware('auth');


Route::post('build/save-built-cache', 'BuildingController@saveBuiltCache')->middleware('auth');
Route::post('build/save-project-cache', 'BuildingController@saveProjectCache')->middleware('auth');

Route::get('building/warehouse/{id}', 'BuildingController@warehouse')->middleware('auth');


Route::get('building/warehouse/detail/{root_id}/{id}', 'BuildingController@warehouseDetail')->middleware('auth');
Route::post('building/warehouse/add-task-file', 'BuildingController@addFile')->middleware('auth');
Route::get('building/warehouse/file-delete-by-id/{root_id}/{id}', 'BuildingController@DeleteFileById')->middleware('auth');





Route::get('building/warehouse-job/{id}', 'BuildingController@warehouseJob')->middleware('auth');

Route::post('building/edit-file/','BuildingController@editFile')->name('process-edit-task-file')->middleware('auth');
Route::post('building/edit-file-name/','BuildingController@editFileName')->name('contribute-edit-task-file-name')->middleware('auth');

Route::get('building/file-delete/{id}','BuildingController@DeleteFile')->name('warehouse-file-delete')->middleware('auth');
Route::get('building/file-delete-only/{id}','BuildingController@DeleteFileOnly')->name('warehouse-file-delete')->middleware('auth');

Route::get('/building/merge-all-pdf/{id}','BuildingController@mergeAllPdf')->middleware('auth');


Route::get('/building/merge-all-pdf-test/{id}','BuildingController@mergeAllPdfTest')->middleware('auth');

Route::get('/building/merge-select-pdf/{id}','BuildingController@mergeSelectPdf')->middleware('auth');


Route::get('build/contractor', 'BuildingController@contractor')->middleware('auth');

Route::post('add-new-contractor','BuildingController@addNewContractor')->middleware('auth');
Route::post('edit-contractor','BuildingController@editContractor')->middleware('auth');
Route::get("contractor-delete/{id}",'BuildingController@deleteContractor')->middleware('auth');



Route::post('building/new-job','BuildingController@addNewJob')->middleware('auth');
Route::post('building/edit-job','BuildingController@editJob')->middleware('auth');
Route::get("building/delete-job/{id}",'BuildingController@deleteJob')->middleware('auth');


Route::get("building/remove_noti/{id}",'BuildingController@removeNoti')->middleware('auth');






Route::get('build/save-mess/{id}', 'BuildingController@saveMess')->middleware('auth');
Route::get('build/unsave-mess/{id}', 'BuildingController@unsaveMess')->middleware('auth');

Route::get('building/list','BuildingController@list')->middleware('auth');
Route::get('building/contract','BuildingController@contract')->middleware('auth');
Route::get('building/data/{id}','BuildingController@data')->middleware('auth');
Route::get('building/detail/{id}','BuildingController@detail')->middleware('auth');
Route::get('building/task/{preid}/{id}','BuildingController@task')->middleware('auth');




Route::get('building/task-info/{id}','BuildingController@taskInfo')->middleware('auth');

Route::get('building/processs-info/{id}','BuildingController@processInfo')->middleware('auth');



Route::get('building/delete-step/{id}','BuildingController@deleteStep')->middleware('auth');
Route::post('bullding/add-step','BuildingController@addStep')->middleware('auth');
Route::post('bullding/add-substep','BuildingController@addSubstep')->middleware('auth');

Route::get('building/get-sub-as-json/{id}','BuildingController@getSubAsJson')->middleware('auth');

Route::get('building/convertDB/{id}','BuildingController@convertDB')->middleware('auth');

Route::get('building/edit/{id}','BuildingController@edit')->middleware('auth');
Route::post('building/edit/','BuildingController@postEdit')->middleware('auth');

Route::post('building/edit-mini/','BuildingController@postEditMini')->middleware('auth');


//old building
Route::post('building/edit-task/','BuildingController@editTask')->middleware('auth');

Route::post('building/edit-task-process/','BuildingController@editProcess')->middleware('auth');

Route::post('building/edit-detail-process/','BuildingController@editDetailProcess')->middleware('auth');



Route::get('building/task-payment/{id}','BuildingController@editPayment')->middleware('auth');
Route::get('building/task-acceptance/{id}','BuildingController@editAcceptance')->middleware('auth');

Route::post('building/add-history', 'BuildingController@addHistory')->middleware('auth');
Route::post('building/edit-history', 'BuildingController@editHistory')->middleware('auth');


Route::post('building/add-contract', 'BuildingController@addContract')->middleware('auth');


Route::get('building/task-file-delete/{id}','BuildingController@deleteTaskFile')->name('contribute-file-delete')->middleware('auth');
Route::post('building/edit-task-file/','BuildingController@editTaskFile')->name('process-edit-task-file')->middleware('auth');
Route::post('building/edit-task-file-name/','BuildingController@editTaskFileName')->name('contribute-edit-task-file-name')->middleware('auth');



// warehouse
Route::get('warehouse','WarehouseController@index')->middleware('auth');
Route::get('warehouse/tool','WarehouseController@tool')->middleware('auth');
Route::get('warehouse/fuzzy/update/{id}','WarehouseController@fuzzyUpdate')->middleware('auth');


Route::get('warehouse/admin123','WarehouseController@admin')->middleware('auth');

Route::get('warehouse/list','WarehouseController@list')->middleware('auth');

Route::get('warehouse/sreach','WarehouseController@sreach')->middleware('auth');

Route::get('warehouse/data/{id}','WarehouseController@data')->middleware('auth');
Route::get('warehouse/data-img/{id}','WarehouseController@dataImg')->middleware('auth');
Route::get('warehouse/data','WarehouseController@dataAll')->middleware('auth');
Route::get('warehouse/data-img','WarehouseController@dataImgAll')->middleware('auth');

Route::get('warehouse/file-delete/{id}','WarehouseController@DeleteFile')->name('warehouse-file-delete')->middleware('auth');

Route::get('warehouse/file-delete-by-id/{id}','WarehouseController@DeleteFilebyId')->name('contribute-file-delete')->middleware('auth');

Route::post('warehouse/edit-task-file/','WarehouseController@editFile')->name('process-edit-task-file')->middleware('auth');

Route::post('warehouse/add-task-file/','WarehouseController@addFile')->name('process-edit-task-file')->middleware('auth');


Route::post('warehouse/edit-private-task-file/','WarehouseController@editPrivateFile')->name('process-edit-task-file')->middleware('auth');
Route::post('warehouse/edit-task-file-name/','WarehouseController@editFileName')->name('warehouse-edit-task-file-name')->middleware('auth');


Route::get('warehouse/content','WarehouseController@content')->middleware('auth');

Route::get('warehouse/image-list','WarehouseController@ImageList')->middleware('auth');

Route::post('warehouse/image-list','WarehouseController@ImageListInput')->middleware('auth');

Route::post('warehouse/edit-tag/','WarehouseController@editTag')->middleware('auth');




Route::get('warehouse/detail/{id}','WarehouseController@detail')->middleware('auth');

Route::get('warehouse/mess','WarehouseController@MessSearch')->middleware('auth');


//tag

Route::get('tag-group/','SystemController@tag')->middleware('auth');
Route::get('tag-group/delete/{id}','SystemController@deleteTagGroup')->middleware('auth');
Route::post('add-tag-group/','SystemController@addTagGroup')->middleware('auth');
Route::post('edit-tag-group/','SystemController@editTagGroup')->middleware('auth');



//cosumer



Route::get('consumer-alert/create', 'HumanController@ConsumerAlert')->middleware('auth');

Route::post('consumer-alert/create', 'HumanController@createAlert')->middleware('auth');
Route::post('add-consumer-alert', 'HumanController@createConsumerAlert')->middleware('auth');

Route::get('consumer-list','HumanController@getConsumer')->name('consumer-list')->middleware('auth');

Route::get('consumer-legal','HumanController@getConsumerLegal')->name('consumer-legal')->middleware('auth');

Route::get('consumer-info/{id}','HumanController@getSaleConsumerInfo')->name('consumer-indo')->middleware('auth');


Route::get('consumer-detail/{id}','HumanController@getConsumerInfo')->name('consumer-indo')->middleware('auth');


Route::get('consumer-delete/{id}','HumanController@consumerDelete')->name('consumer-indo')->middleware('auth');


Route::post('add-new-consumer','HumanController@addNewConsumer')->middleware('auth');
Route::post('edit-consumer','HumanController@EditConsumer')->middleware('auth');


Route::post('add-job','HumanController@addJobs')->middleware('auth');
Route::post('update-job','HumanController@updateJobs')->middleware('auth');

Route::post('close-job','HumanController@closeJobs')->middleware('auth');


Route::post('add-task','HumanController@addTask')->middleware('auth');
Route::post('edit-task','HumanController@editTask')->middleware('auth');
Route::get('update-task-flag/{id}','HumanController@updateTaskFlag')->middleware('auth');

Route::get('delete-job-task/{id}','HumanController@deleteJobTask')->middleware('auth');

Route::get('get-task-user-list/{id}','HumanController@getTaskUserList')->middleware('auth');

Route::post('update-task','HumanController@updateTask')->middleware('auth');


Route::post('delete-mul-consumer','HumanController@deleteConsumer')->middleware('auth');


Route::get('personal-page','HumanController@getPersonalPage')->name('personal-page')->middleware('auth');

Route::post('update-personal','HumanController@updatePersonal')->middleware('auth');



//generation

//process
Route::get('gen/process-list','GenprocessController@getProcess')->name('gen-process-list')->middleware('auth');
Route::get('gen/process-detail/{id}','GenprocessController@getProcessInfo')->name('gen-process-info')->middleware('auth');
Route::post('gen/add-new-process','GenprocessController@addNewProcess')->name('gen-process-add')->middleware('auth');
Route::post('gen/edit-process','GenprocessController@EditProcess')->name('gen-process-edit')->middleware('auth');
Route::post('gen/delete-mul-process','GenprocessController@deleteProcess')->middleware('auth');


Route::post('gen/add-new-process-step','GenprocessController@addNewProcessStep')->name('gen-process-step-add2')->middleware('auth');

Route::post('gen/add-new-process-step2','GenprocessController@addNewProcessStep2')->name('gen-process-step-add')->middleware('auth');

Route::post('gen/edit-process-step','GenprocessController@EditProcessStep')->name('gen-process-step-edit')->middleware('auth');
Route::post('gen/delete-mul-process-step','GenprocessController@deleteProcessStep')->middleware('auth');

Route::get('process/admin-file/{pid}/{sid}/{ssid}/{id}','ProcessController@getAdminFileProcess')->name('process-file')->middleware('auth');

Route::get('process/file/{index}/{id}','ProcessController@getFileProcess')->name('process-file')->middleware('auth');
Route::get('process/file-icon/{index}/{id}','ProcessController@getFileProcessIcon')->name('process-file-icon')->middleware('auth');
Route::get('process/file-delete/{index}/{id}','ProcessController@DeleteFileProcess')->name('process-file-delete')->middleware('auth');
Route::post('process/edit-task-file/','ProcessController@editProcessFile')->name('process-edit-task-file')->middleware('auth');
Route::post('process/edit-task-file-name/','ProcessController@editProcessFileName')->name('process-edit-task-file-name')->middleware('auth');


Route::get('process/project','ProcessController@project')->name('process-project')->middleware('auth');

//step
Route::get('gen/step-list','GenprocessController@getStep')->name('gen-step-list')->middleware('auth');
Route::get('gen/step-detail/{pid}/{id}','GenprocessController@getStepInfo')->name('gen-step-info')->middleware('auth');
Route::post('gen/add-new-step','GenprocessController@addNewStep')->name('gen-step-add')->middleware('auth');
Route::post('gen/edit-step','GenprocessController@EditStep')->name('gen-step-edit')->middleware('auth');
Route::post('gen/delete-mul-step','GenprocessController@deleteStep')->middleware('auth');

Route::post('gen/add-new-step-task2','GenprocessController@addNewStepTask2')->name('gen-step-task-add2')->middleware('auth');

Route::post('gen/add-new-substep-task2','GenprocessController@addNewSubstepTask2')->name('gen-step-task-add2')->middleware('auth');
Route::post('gen/add-new-step-task','GenprocessController@addNewStepTask')->name('gen-step-task-add')->middleware('auth');

Route::post('gen/edit-step-task','GenprocessController@EditStepTask')->name('gen-step-task-edit')->middleware('auth');
Route::post('gen/delete-mul-step-task','GenprocessController@deleteStepTask')->middleware('auth');


Route::post('gen/add-new-step-substep','GenprocessController@addNewStepSubstep')->name('gen-step-substep-add')->middleware('auth');
Route::post('gen/edit-step-substep','GenprocessController@EditStepSubstep')->name('gen-step-substep-edit')->middleware('auth');
Route::post('gen/delete-mul-step-substep','GenprocessController@deleteStepSubstep')->middleware('auth');


//substep
Route::get('gen/substep-list','GenprocessController@getSubstep')->name('gen-substep-list')->middleware('auth');
Route::get('gen/substep-detail/{pid}/{sid}/{id}','GenprocessController@getSubstepInfo')->name('gen-substep-info')->middleware('auth');
Route::post('gen/add-new-substep','GenprocessController@addNewSubstep')->name('gen-substep-add')->middleware('auth');
Route::post('gen/edit-substep','GenprocessController@EditSubstep')->name('gen-substep-edit')->middleware('auth');
Route::post('gen/delete-mul-substep','GenprocessController@deleteSubstep')->middleware('auth');

Route::post('gen/add-new-substep-task','GenprocessController@addNewSubstepTask')->name('gen-substep-task-add')->middleware('auth');
Route::post('gen/edit-substep-task','GenprocessController@EditSubstepTask')->name('gen-substep-task-edit')->middleware('auth');
Route::post('gen/delete-mul-substep-task','GenprocessController@deleteSubstepTask')->middleware('auth');


//task
Route::get('gen/task-list','GenprocessController@getTask')->name('gen-task-list')->middleware('auth');

Route::post('gen/add-new-task','GenprocessController@addNewTask')->name('gen-task-add')->middleware('auth');
Route::post('gen/edit-task','GenprocessController@EditTask')->name('gen-task-edit')->middleware('auth');
Route::post('gen/delete-mul-task','GenprocessController@deleteTask')->middleware('auth');


Route::get('gen/task-detail/{id}','GenprocessController@getTaskInfo')->name('gen-task-detail')->middleware('auth');

Route::post('gen/add-new-task-detail','GenprocessController@addNewTaskDetail')->name('gen-form-task-detail')->middleware('auth');

Route::post('gen/delete-mul-task-detail','GenprocessController@deleteTaskDetail')->middleware('auth');



//generation-staff

//process
Route::get('genstaff/process-list','GenstaffprocessController@getProcess')->name('genstaff-process-list')->middleware('auth');
Route::get('genstaff/process-detail/{id}','GenstaffprocessController@getProcessInfo')->name('genstaff-process-info')->middleware('auth');

Route::get('genstaff/process-lock/{id}','GenstaffprocessController@getProcessLock')->name('genstaff-process-lock')->middleware('auth');



Route::post('genstaff/add-new-process','GenstaffprocessController@addNewProcess')->name('genstaff-process-add')->middleware('auth');

Route::post('genstaff/edit-process','GenstaffprocessController@EditProcess')->name('genstaff-process-edit')->middleware('auth');
Route::post('genstaff/delete-mul-process','GenstaffprocessController@deleteProcess')->middleware('auth');

Route::post('genstaff/add-new-process-step','GenstaffprocessController@addNewProcessStep')->name('genstaff-process-step-add')->middleware('auth');



Route::post('genstaff/add-new-process-lock','GenstaffprocessController@addNewProcessLock')->name('gen-process-add-lock')->middleware('auth');
Route::post('genstaff/edit-process-lock','GenstaffprocessController@EditProcessLock')->name('gen-process-edit-lock')->middleware('auth');


Route::post('genstaff/delete-mul-process-lock','GenstaffprocessController@deleteProcessLock')->middleware('auth');


Route::post('genstaff/add-new-process-step2','GenstaffprocessController@addNewProcessStep2')->name('genstaff-process-step-add')->middleware('auth');

Route::post('genstaff/edit-process-step','GenstaffprocessController@EditProcessStep')->name('genstaff-process-step-edit')->middleware('auth');
Route::post('genstaff/delete-mul-process-step','GenstaffprocessController@deleteProcessStep')->middleware('auth');

//step
Route::get('genstaff/step-list','GenstaffprocessController@getStep')->name('genstaff-step-list')->middleware('auth');
Route::get('genstaff/step-detail/{pid}/{id}','GenstaffprocessController@getStepInfo')->name('genstaff-step-info')->middleware('auth');
Route::post('genstaff/add-new-step','GenstaffprocessController@addNewStep')->name('genstaff-step-add')->middleware('auth');
Route::post('genstaff/edit-step','GenstaffprocessController@EditStep')->name('genstaff-step-edit')->middleware('auth');
Route::post('genstaff/delete-mul-step','GenstaffprocessController@deleteStep')->middleware('auth');

Route::post('genstaff/add-new-step-task','GenstaffprocessController@addNewStepTask')->name('genstaff-step-task-add')->middleware('auth');

Route::post('genstaff/add-new-step-task2','GenstaffprocessController@addNewStepTask2')->name('genstaff-step-task-add2')->middleware('auth');

Route::post('genstaff/edit-step-task','GenstaffprocessController@EditStepTask')->name('genstaff-step-task-edit')->middleware('auth');
Route::post('genstaff/delete-mul-step-task','GenstaffprocessController@deleteStepTask')->middleware('auth');


Route::post('genstaff/add-new-step-substep','GenstaffprocessController@addNewStepSubstep')->name('genstaff-step-substep-add')->middleware('auth');
Route::post('genstaff/edit-step-substep','GenstaffprocessController@EditStepSubstep')->name('genstaff-step-substep-edit')->middleware('auth');
Route::post('genstaff/delete-mul-step-substep','GenstaffprocessController@deleteStepSubstep')->middleware('auth');



//task
Route::get('genstaff/task-list','GenstaffprocessController@getTask')->name('genstaff-task-list')->middleware('auth');

Route::post('genstaff/add-new-task','GenstaffprocessController@addNewTask')->name('genstaff-task-add')->middleware('auth');
Route::post('genstaff/edit-task','GenstaffprocessController@EditTask')->name('genstaff-task-edit')->middleware('auth');
Route::post('genstaff/delete-mul-task','GenstaffprocessController@deleteTask')->middleware('auth');



//genlegal

Route::get('legal/convertDB/{id}','LegalController@convertDB')->middleware('auth');
Route::get('legal/change-status/{id}','LegalController@changeStatus')->middleware('auth');


Route::get('legal/list','LegalController@list')->middleware('auth');

Route::get('legal/data/{id}','LegalController@data')->middleware('auth');

Route::get('regulation','LegalController@regulation')->middleware('auth');
// Route::get('minh/fuzzy','FuzzyController@fuzzy')->middleware('auth');


Route::post('edit-regulation-file/','LegalController@editRegulation')->name('process-edit-task-file')->middleware('auth');


Route::get('legal/file-delete/{id}','LegalController@DeleteFile')->name('contribute-file-delete')->middleware('auth');
Route::post('legal/edit-task-file/','LegalController@editFile')->name('process-edit-task-file')->middleware('auth');
Route::post('legal/edit-task-file-name/','LegalController@editFileName')->name('contribute-edit-task-file-name')->middleware('auth');



Route::get('/legal/merge-all-pdf/{id}','LegalController@mergeAllPdf')->middleware('auth');

Route::get('/legal/merge-select-pdf/{id}','LegalController@mergeSelectPdf')->middleware('auth');


Route::post('/legal/merge-pdf','LegalController@mergePdf')->middleware('auth');



Route::get('/legal/merge-all-pdf-test/{id}','LegalController@mergeAllPdfTest')->middleware('auth');


Route::post('/legal/merge-pdf-test','LegalController@mergePdfTest')->middleware('auth');


Route::get('/legal/process-file/{id}','LegalController@processFile')->middleware('auth');


Route::post('/legal/process-file-add','LegalController@processFileAdd')->middleware('auth');


Route::post('/legal/process-file-edit','LegalController@processFileEdit')->middleware('auth');

Route::get('/legal/process-file-delete/{id}','LegalController@processFileDelete')->middleware('auth');

//new


Route::post('/legal/add-step','LegalController@addStep')->middleware('auth');
Route::post('/legal/edit-step','LegalController@editStep')->middleware('auth');
Route::get('/legal/delete-process/{id}','LegalController@deleteProcess')->middleware('auth');


Route::post('/legal/add-substep','LegalController@addSubstep')->middleware('auth');
Route::get('/legal/get-sub-as-json/{id}','LegalController@getSubAsJson')->middleware('auth');




//form
Route::get('genlegal/form-list','GenlegalController@getForm')->name('genlegal-form-list')->middleware('auth');

Route::post('genlegal/add-new-form','GenlegalController@addNewForm')->name('genlegal-form-add')->middleware('auth');
Route::post('genlegal/edit-form','GenlegalController@EditForm')->name('genlegal-form-edit')->middleware('auth');
Route::post('genlegal/delete-mul-form','GenlegalController@deleteForm')->middleware('auth');


Route::get('genlegal/form-detail/{id}','GenlegalController@getFormInfo')->name('genlegal-form-detail')->middleware('auth');

Route::post('genlegal/add-new-form-detail','GenlegalController@addNewFormDetail')->name('genlegal-form-add-detail')->middleware('auth');

Route::post('genlegal/delete-mul-form-detail','GenlegalController@deleteFormDetail')->middleware('auth');








//system auth


Route::get('loginkms', 'UserController@loginKms')->name('loginkms');
Route::post('loginkms', 'UserController@postLoginKms');
Route::get('accountlist', 'UserController@getAccountList')->name('accountlist')->middleware('auth');
Route::get('userregister', 'UserController@getUserRegister')->name('userregister')->middleware('auth');
Route::get('createusersuccess', 'UserController@createUserSuccess')->middleware('auth');
Route::post('postuserregister', 'UserController@postUserRegister')->middleware('auth');
Route::post('selectuser', 'UserController@getSelectUser')->middleware('auth');
Route::get('getuseredit/{userid}','UserController@getUserEdit')->middleware('auth');
Route::post('postuseredit/{userid}', 'UserController@postUserEdit')->middleware('auth');
Route::post('removeadmin', 'UserController@postRemoveAdmin')->middleware('auth');
Route::post('removeuser', 'UserController@postRemoveUser')->middleware('auth');
Route::get('changepassword', 'UserController@getChangePassword')->middleware('auth');
Route::post('changepassword', 'UserController@postChangePassword')->middleware('auth');
Route::get('getlog/{userid}', 'UserController@getLog')->middleware('auth','permissionUser');

Route::get('listrole/{id}', 'UserController@getRoleList')->middleware('auth');



Route::get('admin-rs-pass/{id}', 'HrController@resetPass')->middleware('auth');



//event

Route::get('getevents/{adminid}','EventController@getEvents')->middleware('auth');
Route::get('listevent', 'EventController@getEventList')->middleware('auth');
Route::get('sale-task', 'EventController@saleTask')->middleware('auth');
Route::get('event_noti/{type}', 'EventController@Noti')->middleware('auth');

Route::get('contribute-task', 'EventController@contributeTask')->middleware('auth');

Route::get('checkevent', 'EventController@checkEvent')->middleware('auth');
Route::get('eventwatched', 'EventController@eventWatched')->middleware('auth');

//noti api
Route::get('noti/active', 'NotiController@active')->middleware('auth');
Route::get('noti/send-test', 'NotiController@sendTest')->middleware('auth');
Route::get('noti/send-tags', 'NotiController@sendTags')->middleware('auth');

Auth::routes();

Route::get('logoutkms', 'HomeController@getLogout')->middleware('auth');

Route::get('discoloration', 'ConfigController@discoloration');

Route::get('/keys/create', 'KeyController@genKey')->middleware('camMdw');
Route::post('/keys/fetch', 'KeyController@fetchKey')->middleware('userMdw');


Route::get('getauthid', 'LoginController@getAuthId');
Route::post('proxys/login', 'LoginController@apiLoginProxy');
Route::post('nvrs/login', 'LoginController@apiLoginNvr');
Route::post('users/login', 'LoginController@apiLoginUser');
Route::get('all/logout', 'LoginController@apiLogout');
Route::post('cameras/login', 'LoginController@apiLoginCamera');

Route::get('users/cameralist', 'CameraController@getListCamera') ->middleware('userMdw');


Route::get('super/create-proxy', 'SuperAdminController@createProxy')->middleware('auth');
Route::get('super/create-nvr', 'SuperAdminController@createNvr')->middleware('auth');
Route::get('super/create-crt', 'SuperAdminController@downloadCertificate')->middleware('auth');


//jobs
Route::get('job-list','HumanController@getJobs')->name('job-list')->middleware('auth');

Route::get('dept-job-list/{did}','HumanController@getDeptJobs')->name('dept-job-list')->middleware('auth');

Route::get('job-bar-admin','HumanController@getBarsAdmin')->name('job-bar-dept')->middleware('auth');
Route::get('job-bar-dept/{did}','HumanController@getBarsDept')->name('job-bar-dept')->middleware('auth');
Route::get('job-bar-staff/{sid}','HumanController@getBarStaff')->name('job-bar-staff')->middleware('auth');

Route::get('job-detail/{id}','HumanController@jobDetail')->name('job-detail')->middleware('auth');
Route::get('admin-job-list','HumanController@getAdminJobs')->name('admin-job-list')->middleware('auth');
Route::get('getjobsdetail/{id}','HumanController@jobsDetail')->name('job-detail')->middleware('auth');
Route::post('add-history-jobs', 'HumanController@addHistoryJob')->middleware('auth');
Route::get('history-jobs/{id}', 'HumanController@historyJob')->middleware('auth');

Route::get('history-jobs/{id}', 'HumanController@historyJob')->middleware('auth');

Route::get('job-comments/{id}', 'HumanController@getJobComment')->middleware('auth');

Route::post('job-comments', 'HumanController@postJobComment')->middleware('auth');

//hr

Route::get('hr/admin-department','HrController@getAdminDepartment')->name('admin-department')->middleware('auth');

Route::get('hr/remove-account/{id}','HrController@removeAccount')->name('admin-department')->middleware('auth');


Route::get('hr/admin-request-list','HrController@getRequestList')->name('admin-department')->middleware('auth');

Route::get('hr/admin-contribute','HrController@getAdminContribute')->name('admin-contribute')->middleware('auth');


Route::get('hr/admin-department-info/{id}','HrController@getAdminDepartmentInfo')->name('admin-department-info')->middleware('auth');


Route::get('hr/plot','HrController@getHrPlot')->name('hr-plot')->middleware('auth');

Route::get('hr/index','HrController@index')->name('hr-plot')->middleware('auth');

Route::get('hr/staff-info/{id}','HrController@getStaffInfo')->name('hr-staff-info')->middleware('auth');

Route::get('hr/staff-list','HrController@viewStaffByDepartment')->name('hr-staff-list')->middleware('auth');

Route::get('hr/get-staff-by-department/{id}','HrController@getStaffByDepartment')->name('get-staff-by-department')->middleware('auth');

Route::post('hr/add-new-admin-department/','HrController@addNewAdminDepartment')->name('add-new-admin-department')->middleware('auth');
Route::post('hr/edit-admin-department/','HrController@editAdminDepartment')->name('edit-admin-department')->middleware('auth');
Route::post('hr/delete-mul-admin-department/','HrController@deleteAdminDepartment')->name('delete-admin-department')->middleware('auth');

Route::get('hr/delete-department/{id}','HrController@deleteDepartment')->name('delete-admin-department')->middleware('auth');

Route::post('hr/postuserregister', 'HrController@postUserRegister')->middleware('auth');

Route::post('hr/postregister', 'HrController@postRegister');

Route::post('hr/add-user-role', 'HrController@postAddUserRole');
Route::post('hr/add-user-department', 'HrController@postAddUserDepartment');

Route::get('hr/delete-request/{id}', 'HrController@deleteRequest')->middleware('auth');


Route::get('hr/remove-add-request/{id}', 'HrController@removeAddRequest')->middleware('auth');


Route::get('hr/remove-delete-request/{id}', 'HrController@removeDeleteRequest')->middleware('auth');
Route::get('hr/remove-role/{id}/{rid}', 'HrController@removeRole')->middleware('auth');

Route::get('hr/remove-department/{id}/{did}', 'HrController@removeDepartment')->middleware('auth');



Route::get('hr/admin-confirm-delete-request/{id}', 'HrController@adminConfirmDeleteRequest')->middleware('auth');


Route::get('hr/admin-remove-delete-request/{id}', 'HrController@adminRemoveDeleteRequest')->middleware('auth');


Route::get('hr/admin-confirm-add-request/{id}', 'HrController@adminConfirmAddRequest')->middleware('auth');


Route::get('hr/admin-remove-add-request/{id}', 'HrController@adminRemoveAddRequest')->middleware('auth');

Route::post('hr/add-new-admin-contractors/','HrController@addNewAdminContractors')->name('add-new-admin-contractors')->middleware('auth');

Route::post('hr/edit-admin-contractors/','HrController@editAdminContractors')->name('edit-admin-Contractors')->middleware('auth');
Route::post('hr/delete-mul-admin-contractors/','HrController@deleteAdminContractors')->name('delete-admin-Contractors')->middleware('auth');



Route::post('hr/add-new-admin-role/','HrController@addNewAdminRole')->name('add-new-admin-role')->middleware('auth');
Route::post('hr/edit-admin-role/','HrController@editAdminRole')->name('edit-admin-role')->middleware('auth');
Route::post('hr/delete-mul-admin-role/','HrController@deleteAdminRole')->name('delete-admin-role')->middleware('auth');
Route::get('hr/delete-role/{id}','HrController@deleteRole')->name('delete-admin-department')->middleware('auth');

Route::post('hr/add-new-staff-event','HrController@addNewStaffEvent')->middleware('auth');
Route::post('hr/edit-staff-event','HrController@EditStaffEvent')->middleware('auth');

Route::post('hr/delete-mul-staff-event','HrController@deleteStaffEvent')->middleware('auth');


//process
Route::get('process/index','ProcessController@index')->name('process-index')->middleware('auth');
Route::get('process/view/{index}','ProcessController@view')->name('process-view')->middleware('auth');
Route::get('process/viewbk/{id}','ProcessController@viewbk')->name('process-view-bk')->middleware('auth');


Route::get('process/big-process-detail/{id}','ProcessController@bigProcessDetail')->name('big-process-detail')->middleware('auth');
Route::get('process/process-list','ProcessController@processList')->name('process-list')->middleware('auth');
Route::get('process/process-on-big-step-list/{id}','ProcessController@processOnBigStepList')->name('process-list')->middleware('auth');
Route::get('process/process-detail/{id}','ProcessController@processDetail')->name('process-detail')->middleware('auth');
Route::get('process/process-index-detail/{id}','ProcessController@processIndexDetail')->name('process-index-detail')->middleware('auth');
Route::get('process/step-detail/{id}','ProcessController@stepDetail')->name('step-detail')->middleware('auth');
Route::get('/process/staff-outer-task/{id}','ProcessController@staffTasks')->name('staff-outer-task')->middleware('auth');
Route::get('process/substep-detail/{id}','ProcessController@substepDetail')->name('substep-detail')->middleware('auth');


Route::post('process/add-inner-task-file/','ProcessController@addInnerTaskFile')->name('add-inner-task-file')->middleware('auth');
Route::post('process/update-inner-task','ProcessController@updateInnerTask')->name('update-inner-task')->middleware('auth');
Route::post('process/update-step-status','ProcessController@updateStepStatus')->name('update-step-status')->middleware('auth');
Route::post('process/update-final-status','ProcessController@updateFinalStatus')->name('update-final-status')->middleware('auth');

Route::post('process/update-outner-department','ProcessController@updateOutnerDepartment')->name('update-outner-department')->middleware('auth');

Route::post('process/update-inner-department','ProcessController@updateInnerDepartment')->name('update-inner-department')->middleware('auth');


Route::post('process/add-staff-task-file','ProcessController@addStaffFile')->name('add-staff-task-file')->middleware('auth');
Route::post('process/update-staff-task','ProcessController@updateStaffTask')->name('update-staff-task')->middleware('auth');


Route::get('process/legal-list/{id}/{type}','ProcessController@legalList')->name('legal-list')->middleware('auth');




Route::post('process/update-task-info','ProcessController@updateTaskInfo')->name('update-task-info')->middleware('auth');



//sale 

Route::get('sale/alert/create', 'SaleController@alert')->middleware('auth');

Route::get('sale/alert/view/{id}', 'SaleController@viewAlert')->middleware('auth');


Route::post('sale/alert/create', 'SaleController@createAlert')->middleware('auth');

Route::get('sale/remove_zone_alert/{id}', 'SaleController@removeZoneAlert')->middleware('auth');
Route::get('sale/remove_consumer_alert/{id}', 'SaleController@removeConsumerAlert')->middleware('auth');


Route::get('sale/add-zone-alert/{id}', 'SaleController@addZoneAlert')->middleware('auth');

Route::get('sale/pin-mess/{id}', 'SaleController@pinMess')->middleware('auth');
Route::get('sale/unpin-mess/{id}', 'SaleController@unpinMess')->middleware('auth');


Route::get('sale/save-mess/{id}', 'SaleController@saveMess')->middleware('auth');
Route::get('sale/unsave-mess/{id}', 'SaleController@unsaveMess')->middleware('auth');

Route::get('sale/me','SaleController@me')->name('sale-me')->middleware('auth');
Route::get('sale/con','SaleController@con')->name('sale-con')->middleware('auth');
Route::get('sale/index','SaleController@index')->name('sale-index')->middleware('auth');
Route::get('sale/view/{id}','SaleController@view')->name('sale-view')->middleware('auth');
Route::get('sale/update/{id}','SaleController@update')->name('sale-update-view')->middleware('auth');

Route::get('sale/transfer/{id}','SaleController@transfer')->name('sale-update-view')->middleware('auth');


Route::get('/sale/create-consumer/{id}','SaleController@createCustomer')->name('sale-cc')->middleware('auth');

Route::get('/sale/create-consumer-by-zone/{id}','SaleController@createCustomerByZone')->name('sale-cc')->middleware('auth');


Route::post('update-sale','SaleController@updateSale')->name('sale-update')->middleware('auth');



Route::get('sale/file/{index}/{id}','SaleController@getFileTask')->name('sale-file')->middleware('auth');
Route::get('sale/file-icon/{index}/{id}','SaleController@getFileTaskIcon')->name('sale-file-icon')->middleware('auth');
Route::get('sale/file-delete/{index}/{id}','SaleController@DeleteFileTask')->name('sale-file-delete')->middleware('auth');
Route::post('sale/edit-task-file/','SaleController@editTaskFile')->name('sale-edit-task-file')->middleware('auth');



Route::get('sale/view-by-zone/{id}','SaleController@viewByZone')->name('sale-by-view')->middleware('auth');


Route::get('sale/view-backup-zone/{id}','SaleController@viewBackupZone')->name('sale-viewBackupZone-view')->middleware('auth');


Route::get('sale/process-detail/{id}/{zone_id}','SaleController@processDetail')->name('sale-process-detail')->middleware('auth');
Route::get('sale/step-detail/{id}/{zone_id}','SaleController@stepDetail')->name('sale-step-detail')->middleware('auth');
Route::get('sale/substep-detail/{id}','SaleController@substepDetail')->name('sale-substep-detail')->middleware('auth');

Route::post('sale/add-task-file/','SaleController@addTaskFile')->name('sale-add-task-file')->middleware('auth');

Route::post('sale/add-pay-file/','SaleController@addPayFile')->name('sale-add-task-file')->middleware('auth');
Route::post('sale/pay/add/','SaleController@addPay')->name('sale-add-task-file')->middleware('auth');
Route::get('sale/pay/{index}/{id}','SaleController@getPay')->name('sale-pay')->middleware('auth');

Route::get('sale/pay-delete/{id}','SaleController@deletePay')->name('sale-pay')->middleware('auth');

Route::get('sale/pay-end/{id}','SaleController@endPay')->name('sale-pay')->middleware('auth');


Route::post('sale/gap/add/','SaleController@addGap')->name('sale-add-task-gap')->middleware('auth');
Route::get('sale/gap/{index}','SaleController@getGap')->name('sale-gap')->middleware('auth');

Route::get('sale/gap-delete/{id}','SaleController@deleteGap')->name('sale-gap2')->middleware('auth');


Route::post('zone-comments', 'SaleController@postZoneComment')->middleware('auth');

//personal

Route::get('personal/job','PersonalController@job')->name('personal-job')->middleware('auth');



//system
Route::get('system/department-list','SystemController@DepartmentList')->name('department-list')->middleware('auth');


Route::get('system/zone-position-list','SystemController@getZonePosition')->name('zone-pos-list')->middleware('auth');

Route::get('system/staff-list','SystemController@staffList')->name('staff-list')->middleware('auth');



Route::get('system/shedule-staff/{id}','SystemController@sheduleStaffList')->name('staff-list')->middleware('auth');

Route::get('system/staff-edit-list/{id}','SystemController@staffEditList')->name('staff-edit-list')->middleware('auth');

Route::get('system/staff-depart/{did}','SystemController@staffDepart')->name('staff-list')->middleware('auth');

Route::get('system/staff-edit-list/{did}/{id}','SystemController@staffDepartList')->name('staff-edit-list')->middleware('auth');


Route::get('system/word-test','SystemController@wordEdit')->name('word-edit')->middleware('auth');


Route::get('/storage/{file_path}', 'FileController')->where(['file_name' => '.*']);


Route::get('config/admin','SystemController@getAdminConfig')->name('genlegal-form-list')->middleware('auth');


Route::get('config/staff','SystemController@getConfig')->name('genlegal-form-list')->middleware('auth');

Route::post('add-config/','SystemController@addNewConfig')->name('genlegal-form-list')->middleware('auth');

Route::post('edit-config/','SystemController@editConfig')->name('genlegal-form-list')->middleware('auth');

Route::post('edit-config-value/','SystemController@editConfigValue')->name('genlegal-form-list')->middleware('auth');


Route::post('delete-mul-config/','SystemController@deleteConfig')->name('genlegal-form-list')->middleware('auth');




//forum

Route::get('/discuss', function () {
    return view('discuss');
});



Route::get('/forum',[
    'uses' => 'ForumsController@index',
    'as' => 'forum'
]);

Route::post('/discussions/reply/{id}',[
    'uses' => 'DiscussionsController@reply',
    'as' => 'discussions.reply'
]);

Route::get('/discussion/{id}',[
    'uses' => 'DiscussionsController@show',
    'as' => 'discussion'
]);


Route::get('/discussion/file/{id}',[
    'uses' => 'DiscussionsController@getFile',
    'as' => 'discussion.file'
]);

Route::get('/discussion/file-icon/{id}',[
    'uses' => 'DiscussionsController@getFileIcon',
    'as' => 'discussion.fileIcon'
]);

Route::post('/discussions/edit-submit',[
    'uses' => 'DiscussionsController@editDiscuss',
    'as' => 'discussions.editsubmit'
]);


Route::post('/discussions/edit-file',[
    'uses' => 'DiscussionsController@editDiscussFile',
    'as' => 'discussions.editsubmit'
]);

Route::get('/discussions/delete-file/{id}',[
    'uses' => 'DiscussionsController@DeleteFileDiscuss',
    'as' => 'discussions.editsubmit'
]);

Route::get('/channel/{id}',[
    'uses' => 'ForumsController@channel',
    'as' => 'channel'
]);



Route::group(['middleware'=>'auth'], function(){
    
    Route::resource('channels', 'ChannelsController');




    Route::get('/channels/destroy/{id}',[
        'uses' => 'ChannelsController@destroy',
        'as'  => 'channels.destroy'
    ]);
    
    Route::get('/channels/edit/{id}', [
        'uses' => 'ChannelsController@edit',
        'as' => 'channels.edit'
    ]);
    
    Route::post('/channels/update/{id}',[
        'uses' => 'ChannelsController@update',
        'as' => 'channels.update'
    ]);

    Route::get('/discussions/create',[
        'uses' => 'DiscussionsController@create',
        'as' => 'discussions.create'
    ]);
    

    Route::get('/discussions/delete/{id}',[
        'uses' => 'DiscussionsController@delete',
        'as' => 'discussions.create'
    ]);
    

    Route::post('/discussions/store',[
        'uses' => 'DiscussionsController@store',
        'as' => 'discussion.store'
    ]);


    Route::get('/discussions/like-detail/{id}',[
        'uses' => 'DiscussionsController@likeDetail',
        'as' => 'discussion.like-detail'
    ]);


    Route::get('/reply/like/{id}',[
        'uses' => 'RepliesController@like',
        'as' => 'reply.like'
    ]);

    Route::get('/reply/unlike/{id}',[
        'uses' => 'RepliesController@unlike',
        'as' => 'reply.unlike'
    ]);

      Route::get('/reply/delete/{id}',[
        'uses' => 'RepliesController@replyDelete',
        'as' => 'reply.delete'
    ]);
});


//icon
Route::get('icon/build','SystemController@IconBuild')->name('icon-build')->middleware('auth');


Route::get('icon/finance','SystemController@IconFinance')->name('icon-finance')->middleware('auth');

Route::get('icon/finance-line','SystemController@IconFinanceLine')->name('icon-finance')->middleware('auth');


Route::get('icon/human','SystemController@IconHuman')->name('icon-human')->middleware('auth');


Route::get('icon/legal','SystemController@IconLegal')->name('icon-legal')->middleware('auth');


Route::get('icon/report','SystemController@IconReport')->name('icon-report')->middleware('auth');


Route::get('icon/sale','SystemController@IconSale')->name('icon-sale')->middleware('auth');


    Route::get('/messages/create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
  Route::get('/messages', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('/messages/create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);


    Route::get('/messages/tran/{id}/{type}', ['as' => 'messages.tran', 'uses' => 'MessagesController@tran']);


    Route::get('/messages/edit/{id}', ['as' => 'messages.create', 'uses' => 'MessagesController@edit']);


    Route::get('/messages/delete/{id}', ['as' => 'messages.create', 'uses' => 'MessagesController@delete']);


    Route::post('/messages', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::post('/messages/edit', ['as' => 'messages.edit', 'uses' => 'MessagesController@editSubmit']);

    Route::get('/messages/{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);

    // Route::get('/messages/file/{id}', ['as' => 'messages.file', 'uses' => 'MessagesController@getFileIcon']);
    // Route::put('/messages/{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);

    // Route::post('/messages/add-file', ['as' => 'messages.add-file', 'uses' => 'MessagesController@addFile']);
    // Route::post('/messages/edit-avatar', ['as' => 'messages.add-file', 'uses' => 'MessagesController@editAvatar']);

    Route::post('/messages/add-user', ['as' => 'messages.add-user', 'uses' => 'MessagesController@addUser']);


//public

Route::get('public-map/{id}', 'AreaController@publicMap')->name('public-map');


Route::get('public-map/{id}/{zid}', 'AreaController@publicMapShare')->name('public-map');


Route::get('get-all-public/{id}','AreaController@getAllPublic');


Route::get('register','UserController@staffRegister');


Route::get('consumer-projects/', 'AreaController@cProject')->name('cproject')->middleware('auth');

Route::get('consumer-map/{id}', 'AreaController@cMap')->name('cmap')->middleware('auth');

//shedule

Route::get('schedule/dept/{id}','ScheduleController@dept')->name('gen-schedule-dept')->middleware('auth');

Route::get('schedule/index','ScheduleController@test')->name('gen-schedule-test')->middleware('auth');

Route::get('schedule/test','ScheduleController@test')->name('gen-schedule-test')->middleware('auth');


Route::get('schedule/staff','ScheduleController@staff')->name('gen-schedule-test')->middleware('auth');


Route::get('schedule/done/{id}','ScheduleController@done')->name('gen-schedule-done')->middleware('auth');

Route::get('schedule/drop/{id}','ScheduleController@drop')->name('gen-schedule-drop')->middleware('auth');

Route::get('schedule/detail/{id}','ScheduleController@detail')->name('gen-schedule-detail')->middleware('auth');


Route::get('schedule/get-subshedule-as-json/{id}','ScheduleController@getSubscheduleAsJson')->name('gen-schedule-getSubscheduleAsJson')->middleware('auth');

Route::get('schedule/get-subshedule-for-staff-as-json/{id}','ScheduleController@getSubscheduleForStaffAsJson')->middleware('auth');

Route::get('schedule-list','ScheduleController@index')->name('gen-schedule-info')->middleware('auth');
Route::get('schedule-list/{id}','ScheduleController@index')->name('gen-schedule-info')->middleware('auth');
Route::post('add-new-schedule','ScheduleController@addNew')->name('gen-schedule-add')->middleware('auth');
Route::post('add-new-build-schedule','ScheduleController@addNewBuild')->name('gen-schedule-add')->middleware('auth');

Route::post('add-new-schedule-for-staff','ScheduleController@addNewStaff')->name('gen-schedule-add')->middleware('auth');

Route::get('edit-schedule/{id}','ScheduleController@getEdit')->name('gen-schedule-edit')->middleware('auth');

Route::post('edit-build-schedule','ScheduleController@editBuild')->name('gen-schedule-edit')->middleware('auth');

Route::post('edit-schedule','ScheduleController@edit')->name('gen-schedule-edit')->middleware('auth');

Route::post('close-schedule','ScheduleController@close')->name('gen-schedule-close')->middleware('auth');

Route::post('delete-mul-schedule','ScheduleController@delete')->middleware('auth');

Route::get('schedule/file/{index}/','ScheduleController@getFile')->name('schedule-file')->middleware('auth');
Route::get('schedule/file-delete/{id}','ScheduleController@DeleteFileProcess')->name('schedule-file-delete')->middleware('auth');
Route::post('schedule/add-file/','ScheduleController@addFile')->name('process-edit-task-file')->middleware('auth');
Route::post('schedule/edit-file-name/','ScheduleController@editFileName')->name('schedule-edit-task-file-name')->middleware('auth');

Route::get('schedule/staff-select/{id}','SystemController@sheduleStaffSelect')->name('schedule-edit-task-file-name')->middleware('auth');

Route::get('schedule/dept-select/{id}/{sid}','SystemController@sheduleDeptSelect')->name('schedule-edit-dept-file-name')->middleware('auth');


Route::get('file/staff-select/{id}','SystemController@fileStaffSelect')->name('schedule-edit-task-file-name')->middleware('auth');

Route::get('file/dept-select/{id}','SystemController@fileDeptSelect')->name('schedule-edit-dept-file-name')->middleware('auth');

Route::get('schedule/get-token/{id}','ScheduleController@getToken')->name('gen-schedule-token')->middleware('auth');

Route::get('create-thread/{id}','ScheduleController@createThread')->name('gen-schedule-edit')->middleware('auth');
Route::post('create-thread','ScheduleController@postCreateThread')->name('gen-schedule-edit')->middleware('auth');


Route::get('add-thread/{id}','ScheduleController@addThread')->name('gen-schedule-edit')->middleware('auth');
Route::post('add-thread','ScheduleController@postAddThread')->name('gen-schedule-edit')->middleware('auth');


Route::get('leave-thread/{id}','ScheduleController@leaveThread')->name('gen-schedule-edit')->middleware('auth');

Route::get('kick-thread/{id}/{uid}','ScheduleController@kickThread')->name('gen-schedule-edit')->middleware('auth');



Route::get('thread-staff-select/{id}','SystemController@getThreadStaff')->name('thread-schedule-staff')->middleware('auth');

//schedule-mess
Route::get('thread/pin-mess/{id}', 'SchedulemessController@pinMessThread')->middleware('auth');
Route::get('thread/unpin-mess/{id}', 'SchedulemessController@unpinMessThread')->middleware('auth');


Route::get('schedule/pin-mess/{id}', 'SchedulemessController@pinMess')->middleware('auth');
Route::get('schedule/unpin-mess/{id}', 'SchedulemessController@unpinMess')->middleware('auth');
Route::get('schedule/delete-mess/{id}', 'SchedulemessController@deleteMess')->middleware('auth');

Route::post('schedule/mess-save-db', 'SchedulemessController@messSaveDB')->middleware('auth');


Route::post('schedule/mess-save-sub-db', 'SchedulemessController@messSaveSubDB')->middleware('auth');

Route::get('schedule/pin-sub-mess/{id}', 'SchedulemessController@pinSubMess')->middleware('auth');
Route::get('schedule/delete-sub-mess/{id}', 'SchedulemessController@deleteSubMess')->middleware('auth');


Route::get('schedule/get-mess/{sid}/{id}', 'SchedulemessController@getMess')->middleware('auth');


Route::get('schedule/get-sub-mess/{mid}/{id}', 'SchedulemessController@getSubMess')->middleware('auth');

Route::get('schedule/load-sub-mess/{id}', 'SchedulemessController@loadSubMess')->middleware('auth');

Route::post('schedule/upload', 'SchedulemessController@upload')->middleware('auth');
Route::post('schedule/sub-upload', 'SchedulemessController@subUpload')->middleware('auth');

//schedule-geust
Route::post('schedule/guest-sub-upload', 'SchedulegeustController@subUpload');

Route::post('schedule/guest-mess-save-sub-db', 'SchedulegeustController@messSaveSubDB');
Route::get('schedule/guest-get-sub-mess/{mid}/{id}', 'SchedulegeustController@getSubMess');

Route::get('schedule/guest-load-sub-mess/{id}', 'SchedulegeustController@loadSubMess');

Route::get('schedule/guest-detail/{token}','SchedulegeustController@detail')->name('gen-geust-schedule-detail');
Route::get('schedule/guest-login','SchedulegeustController@login')->name('gen-geust-schedule-detail');


Route::get('schedule/load-guest/{id}', 'SchedulegeustController@loadGuest');

Route::get('schedule/guest/get-mess/{sid}/{id}', 'SchedulegeustController@getMess');
Route::post('schedule/guest/mess-save-db', 'SchedulegeustController@messSaveDB');

Route::post('schedule/guest/add-file/','SchedulegeustController@addFile')->name('process-guest-task-file');


Route::post('schedule/guest/upload', 'SchedulegeustController@upload');


//new-finance

 Route::get('newfinance/new-finance', 'NewFinanceController@newfinance')->name('home')->middleware('auth');
 Route::post('add-new-finance','NewFinanceController@addNewFinance')->middleware('auth');
 Route::post('edit-finance','NewFinanceController@editfinance')->middleware('auth');
 Route::get('delete-finance/{id}','NewFinanceController@financeDelete')->middleware('auth');
Route::post('newfinance/import','NewFinanceController@import')->name('import-list')->middleware('auth');
Route::get('sql-finance','NewFinanceController@sqlfinance')->middleware('auth');
Route::get('test-finance','NewFinanceController@testfinance')->middleware('auth');



//VIP
    Route::post('vip/tag','VipController@qlviptag   ')->name('vip-import')->middleware('auth');
    Route::post('delete-ql-vip/','VipController@deleteqlvip')->name('genlegal-form-list')->middleware('auth');
    Route::post('vip/vipimport','VipController@vipimport')->name('vip-import')->middleware('auth');
    Route::get('vip/vip-file-delete/{id}','VipController@DeleteVipFile')->name('contribute-file-delete')->middleware('auth');
    Route::get('vip/vip-file-delete-tag/{id}','VipController@DeleteVipFileTag')->name('contribute-file-delete')->middleware('auth');
    Route::post('vip/edit-vip-event','VipController@EditVipEvent')->middleware('auth');
    Route::post('vip/edit-vip-event-tag','VipController@EditVipEventTag')->middleware('auth');
    Route::post('vip/add-new-vip-event','VipController@addNewVipEvent')->middleware('auth');
    Route::post('vip/add-new-vip-event-tag','VipController@addNewVipEventTag')->middleware('auth');
    Route::post('vip/delete-khach-hang','VipController@deleteDanhSach')->middleware('auth');
    Route::get('vip/detail', 'VipController@detail')->name('home')->middleware('auth');
   Route::get('vip/detail/{id}','VipController@detail')->name('vip-detail')->middleware('auth');
   Route::get('vip/eventtag/{id}','VipController@eventtag')->name('vip-eventtag')->middleware('auth');
   Route::get('delete-vip/{id}','VipController@vipDelete')->middleware('auth');
  Route::post('edit-Vip','VipController@editvip')->middleware('auth');
  Route::get('vip/vip-tag-delete/{id}','VipController@DeleteVipTag')->name('contribute-file-delete')->middleware('auth');
  Route::get('vip/event', 'VipController@event')->name('home')->middleware('auth');
  Route::post('add-name-vip','VipController@addNameVip')->middleware('auth');
  Route::post('add-tag-vip-tag','VipController@addTagVipTag')->middleware('auth');
  Route::post('update-vip-tag','VipController@updateVipTag')->middleware('auth');
//hr
  
//calender


Route::get('fullcalendar/{id}','CalenderController@index')->middleware('auth');
Route::post('fullcalendar/create','CalenderController@store')->middleware('auth');
Route::post('fullcalendar/update','CalenderController@update')->middleware('auth');
Route::post('fullcalendar/delete','CalenderController@destroy')->middleware('auth');
Route::get('fullcalendar/get/{id}','CalenderController@get')->middleware('auth');
Route::get('fullcalendar/weather/{id}/{tid}','CalenderController@weather')->middleware('auth');


Route::get('fullcalendar/convert/{value}/{date}','CalenderController@convert')->middleware('auth');




 Route::post('add-calenderct','CalenderctController@addNamecalenderct')->middleware('auth');
 Route::post('update-canlender','CalenderctController@updateCompany')->middleware('auth');

 Route::post('edit-canlender','CalenderctController@EditCanlenderEvent')->middleware('auth');
 Route::post('canlender/add-new-canlender-event','CalenderctController@addNewCanlenderEvent')->middleware('auth');
 
 Route::get('canlender/calendar_list/{id}','CalenderctController@calendar')->name('canlender-detail')->middleware('auth');
 Route::get('canlender/delete/{id}','CalenderctController@DeleteCompanyName')->name('contribute-file-delete')->middleware('auth');
 Route::get('canlender/delete-list/{id}','CalenderctController@DeleteCompanyList')->name('contribute-file-delete')->middleware('auth');
Route::get('company/canlender/{id}','CalenderctController@CompanyName')->name('company-canlender')->middleware('auth');
Route::get('calendar/event/{calendar_id}','CalenderctController@CalendarEvent')->middleware('auth');

Route::post('calendar/event/drag-update','CalenderctController@DragEvent')->middleware('auth');

Route::get('calenderct/event', 'CalenderctController@company')->name('home')->middleware('auth');
;
  
  
Route::get('schedule/calendar','CalenderController@schedule')->middleware('auth');
Route::get('building/calendar','CalenderController@building')->middleware('auth');



Route::get('vip/calendar/{id}','CalenderController@vipschedule')->middleware('auth');
Route::get('user/calendar','CalenderController@UserSchedule')->middleware('auth');

Route::get('viptag/calendar/{tag_id}','CalenderController@viptagschedule')->middleware('auth');


// Route::get('sendbasicemail','MailController@basic_email');
// Route::get('sendhtmlemail','MailController@html_email');
// Route::get('sendattachmentemail','MailController@attachment_email');
