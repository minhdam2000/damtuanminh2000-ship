@extends('../layouts/index')
@section('content')
<style type="text/css">
  @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
  .modal-body{
    padding :1rem;
  }
  .model-right{ 
height:auto;
  }
  .row {
margin-left: 20px;
}
      .label-info{
            background-color: red!important;

        }
        
        .bootstrap-tagsinput{
          width: 100%;
        }
        .label {
            color: white;
            position: inherit;
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,
            border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    pointer-events: all;
        }
        .GoogleContent iframe{

    width: 100%;
    min-height: 400px;
      }
      .row-title-proxy{
            margin-left: 0px;
      }
</style>
<style type="text/css">
  table.dataTable>thead .sorting,table.dataTable>thead .sorting_asc,table.dataTable>thead .sorting_desc,table.dataTable>thead .sorting_asc_disabled,table.dataTable>thead .sorting_desc_disabled{cursor:pointer;position:relative}table.dataTable>thead .sorting:before,table.dataTable>thead .sorting:after,table.dataTable>thead .sorting_asc:before,table.dataTable>thead .sorting_asc:after,table.dataTable>thead .sorting_desc:before,table.dataTable>thead .sorting_desc:after,table.dataTable>thead .sorting_asc_disabled:before,table.dataTable>thead .sorting_asc_disabled:after,table.dataTable>thead .sorting_desc_disabled:before,table.dataTable>thead .sorting_desc_disabled:after{position:absolute;bottom:.9em;display:block;opacity:.3}table.dataTable>thead .sorting:before,table.dataTable>thead .sorting_asc:before,table.dataTable>thead .sorting_desc:before,table.dataTable>thead .sorting_asc_disabled:before,table.dataTable>thead .sorting_desc_disabled:before{right:1em;content:"↑"}table.dataTable>thead .sorting:after,table.dataTable>thead .sorting_asc:after,table.dataTable>thead .sorting_desc:after,table.dataTable>thead .sorting_asc_disabled:after,table.dataTable>thead .sorting_desc_disabled:after{right:.5em;content:"↓"}table.dataTable>thead .sorting_asc:before,table.dataTable>thead .sorting_desc:after{opacity:1}table.dataTable>thead .sorting_asc_disabled:before,table.dataTable>thead .sorting_desc_disabled:after{opacity:0}div.dataTables_scrollHead table.dataTable{margin-bottom:0 !important}div.dataTables_scrollBody>table{border-top:none;margin-top:0 !important;margin-bottom:0 !important}div.dataTables_scrollBody>table>thead .sorting:before,div.dataTables_scrollBody>table>thead .sorting_asc:before,div.dataTables_scrollBody>table>thead .sorting_desc:before,div.dataTables_scrollBody>table>thead .sorting:after,div.dataTables_scrollBody>table>thead .sorting_asc:after,div.dataTables_scrollBody>table>thead .sorting_desc:after{display:none}div.dataTables_scrollBody>table>tbody tr:first-child th,div.dataTables_scrollBody>table>tbody tr:first-child td{border-top:none}div.dataTables_scrollFoot>.dataTables_scrollFootInner{box-sizing:content-box}div.dataTables_scrollFoot>.dataTables_scrollFootInner>table{margin-top:0 !important;border-top:none}@media screen and (max-width: 767px){div.dataTables_wrapper div.dataTables_length,div.dataTables_wrapper div.dataTables_filter,div.dataTables_wrapper div.dataTables_info,div.dataTables_wrapper div.dataTables_paginate{text-align:center}div.dataTables_wrapper div.dataTables_paginate ul.pagination{justify-content:center !important}}table.dataTable.table-sm>thead>tr>th:not(.sorting_disabled){padding-right:20px}table.dataTable.table-sm .sorting:before,table.dataTable.table-sm .sorting_asc:before,table.dataTable.table-sm .sorting_desc:before{top:5px;right:.85em}table.dataTable.table-sm .sorting:after,table.dataTable.table-sm .sorting_asc:after,table.dataTable.table-sm .sorting_desc:after{top:5px}table.table-bordered.dataTable{border-right-width:0}table.table-bordered.dataTable th,table.table-bordered.dataTable td{border-left-width:0}table.table-bordered.dataTable th:last-child,table.table-bordered.dataTable th:last-child,table.table-bordered.dataTable td:last-child,table.table-bordered.dataTable td:last-child{border-right-width:1px}table.table-bordered.dataTable tbody th,table.table-bordered.dataTable tbody td{border-bottom-width:0}div.dataTables_scrollHead table.table-bordered{border-bottom-width:0}div.table-responsive>div.dataTables_wrapper>div.row{margin:0}div.table-responsive>div.dataTables_wrapper>div.row>div[class^=col-]:first-child{padding-left:0}div.table-responsive>div.dataTables_wrapper>div.row>div[class^=col-]:last-child{padding-right:0}</style>


 <link rel="stylesheet" href="/js/taginputs/bootstrap-tagsinput.css"  />

    <script src="/js/taginputs/bootstrap.min.js" ></script>
    <script src="/js/taginputs/bootstrap-tagsinput.js"></script>
    <script src="/js/taginputs/bootstrap-tagsinput-angular.min.js"></script>
<div class="content-camera">
	<div class="header-content">
            <div class="header-content-left">
                <h6></h6>
            </div>
            <div class="header-content-right" style="display: inline;">
                <a href="/"><h6 class="display-inline link-active"><i class="fa fa-home"></i>  </h6></a>
                <h6 class="display-inline">Chi tiết hạng mục tài chính</h6>
            </div>
        </div>




        <div class="session">
            @if(Session::has('notification'))
              <input hidden="" notifi="{{Session::get('notification')}}" value="1" id="notice_success">
            @endif
            @if(Session::has('warning'))
              <input hidden="" notifi="{{Session::get('warning')}}" value="1" id="notice_warning">
            @endif
        </div>
        <div class="row row-content">
      <div class="row-title-proxy">
      <ul class="nav nav-tabs" id="tabs" role="tablist">
     
     <li class="nav-item margin_center">
          <a id="tab0" class="nav-link active color-a"  data-toggle="tab"  role="tab" href="#content0">Dự liệu</a>
      </li>
    <!--  <li class="nav-item margin_center">
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab"  role="tab" href="#content1">Dự liệu Excel</a>
      </li>  -->

       <!--  <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab0" class="nav-link active color-a"  data-toggle="tab"  role="tab" href="#content0">Dự liệu trực tuyến</a>
          <a id="tab1" class="nav-link active color-a"  data-toggle="tab"  role="tab" href="#content1">Dự liệu Excel</a>
      </li> 
 -->
    </ul>  
        
    <br>
            <div class="tab-content" style="width:100%">
    <div id="content1" class="tab-pane">
      <iframe src="https://drive.google.com/embeddedfolderview?id=1huAnA-_nlLd5rD2UbrBncEzMqIWtsLD5" width="100%" height="945"></iframe>
    </div>
    <div id="content0" class="tab-pane  in active">


      <a  class="btn btn-model" target="_blank" href="https://docs.google.com/spreadsheets/d/14htovFys8K7j1wemYvlZ-050TeGDWIIe/edit?usp=sharing&ouid=116810335533823028590&rtpof=true&sd=true">Chi tiêt thu chi</a>
      <!--   <button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-stepa">Thêm hạng mục</button>
    <br>
    <div class="form-inline">
    <form action="/newfinance/import" method="POST" enctype="multipart/form-data" id="inputform">
    {{ csrf_field() }}
    <input style="display: none" id="inputfile" onchange="uploadsubmit()" type="file" name="user_file" class="hidden" accept=".xlsx, .xls, .csv, .ods">
    <button onclick="openfileupload('')" class=" form-control " style="background-color: red;color: white" type="button">Nhập dữ liệu từ Excel</button>
    <button type="button" class="btn btn-model" data-toggle="modal" data-target="#new-url1"> Tìm kiếm</button> 
</form>
</div>-->
    
            <div class="row-title-proxy" style="display: none;">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="title-list-proxy"><i class="fa fa-list" aria-hidden="true"></i> &nbsp;Danh sách khách hàng</div>
                      
                      <div class="proxy-add" id="tai" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại</button></div>
                     
<!-- 
                      <div class="search-input proxy-add" title="Serach">
                        <input type="text" class="textbox" id="search-input" placeholder="Search">
                        <input title="Search" value="" type="button" class="button">
                      </div> -->

<!-- Modal content-->
              <div class="modal fade modol-text" id="new-url1"  role="dialog">
                <div class="modal-dialog model-right" style="width: 50%; ">
                  <div class="modal-content">
                    <div class="modal-header">
                       <label>Tìm kiếm </label>
                    </div>
                    <div class="notification"></div>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="modal-body">
                  <table class="table-edit table-model"  style="margin-left: -13%;"  >

                    <tbody class="table-edit">
                      <div class="modal-body1">

                      <tr>
                        <td class="cam-properties"><h5>Số Tiền</h5></td>
                        <td></td>
                      </tr>
                      <tr>
                          <td class="cam-properties">Từ </td>
                                <td>
                        <input id="search-input-unit-price1_display" type="text" data-role=""  value="" class="form-control tags" onblur="formatForId('search-input-unit-price1')" placeholder="Không giới hạn">
                        <input style="display:none" type="number" id="search-input-unit-price1"  value=-1 >
                         
                        </td>   
                        <tr>    
                        <td class="cam-properties"> Đến </td>
                                <td>
                        <input id="search-input-unit-price2_display" type="text" data-role=""  value="" class="form-control tags" placeholder="Không giới hạn"  onblur="formatForId('search-input-unit-price2')">
                        <input style="display:none" type="number" id="search-input-unit-price2"  value=-1 >
                        
                        </td>
                      </tr>
                      </tr>
                    
                    
                      

                      <tr>
                        <td class="cam-properties"><h5>Ngày Tháng</h5></td>
                        <td></td>
                      </tr>
                      <tr>
                          <td class="cam-properties">Từ </td>
                            <td> <input type="date" class="input-edit modol-text form-control" name="start" id="date1" required=""></td>
                                
                          
                        <tr>    
                        <td class="cam-properties"> Đến </td>
                                <td> <input type="date" class="input-edit modol-text form-control" name="end" id="date2"></td>
                      </tr>
                      </tr>

                     
                          <td class="cam-properties">Nội Dung </td>
                                <td>
                        <input id="search-input" type="text" data-role="" name="" value="" class="form-control tags" placeholder="Search"> 
                        </td>        
                      </tr>
                       
                       <tr>
                          <td class="cam-properties">Mục Tiêu</td>
                                <td>
                        <input id="search-input1" type="text" data-role="" name="tags" value="" class="form-control tags" placeholder="Search"> 
                        </td>        
                      </tr>

                      <tr>
                          <td class="cam-properties">Tag</td>
                                <td>
                        <input id="search-input3" type="text" data-role="" name="tags" value="" class="form-control tags" placeholder="Search"> 
                        </td>        
                      </tr>
                      
                      <tr>
                          <td class="cam-properties">Ghi Chú</td>
                                <td>
                        <input id="search-input2" type="text" data-role="" name="tags" value="" class="form-control tags" placeholder="Search"> 
                        </td>        
                      </tr>

                      

                      <tr>
                                <td class="cam-properties">Loại</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "search-type">
                                  <option value="-1"> Thu </option>
                                  <option value="Trống"> Chi  </option>
                                </select></td>

                            </tr>
                            </div>
                            <tr>
                              <td></td>
                              <td >
                                
                                <button class="btn btn-model" id ="search-input-btn" data-dismiss="modal">Tìm kiếm </button>
                                <button type="button" class="btn btn-model" data-dismiss="modal">Thoát </button>
                                    
                              </td>
                          </tr>
                    </tbody>
                  </table>
                </div>
                  </div>
                </div>
              </div>  



                      
    
      <!-- <div class="search-input proxy-add" style="width :32%;" title="Serach">
                      <label>Nội Dung1</label>
                        <input type="text" class="textbox" id="search-input" placeholder="Search">
                      </div> -->

                     <!--  <div class="search-input proxy-add" style="width :32%;" title="Serach">
                      <label>Mục Tiêu</label>
                        <input type="text" class="textbox" id="search-input1" placeholder="Search">
                      </div>
 -->
                      <!-- <div class="search-input proxy-add" style="width :33%;" title="Serach">
                      <label>Loại</label>
                       <select class="textbox" style="width :95%;" id="search-type">
                         <option value="-1">Thu</option>
                         <option value="Trống">Chi</option>
                       </select>
                      </div> -->
                      
                     <!--  <div class="search-input proxy-add" style="width :49%;" title="Serach">
                      <label> Tags</label>
                        <input type="text" class="textbox" id="search-input3" placeholder="Search">
                      </div> -->


  
<!-- <div class="search-input proxy-add" style="width :49%;" title="Serach">
                      <label> Ghi Chú 1</label>
                        <input type="text" class="textbox" id="search-input2" placeholder="Search">
                      </div>

                      <div class="search-input proxy-add" style="width :49%;" title="Serach">
                      <label>Số Tiền</label>
                      <label>Từ </label>
                          <input type="text" class="textbox" id="search-input-unit-price1_display"   onblur="formatForId('search-input-unit-price1')" placeholder="0.00">
                      <span>. (VND)</span>
                           <input value="-1" style="display:none" type="number" id="search-input-unit-price1" name="inner_tax">   
                    
                      <label>Đến </label>

                      <input type="text" class="textbox" id="search-input-unit-price2_display"   onblur="formatForId('search-input-unit-price2')" placeholder="Không giới hạn">
                           <input value="-1" style="display:none" type="number" id="search-input-unit-price2" name="inner_tax">  
                      <span>. (VND)</span>
                    
                      </div>
   -->
  <!-- <div class="search-input proxy-add" style="width :49%;" title="Serach">
                      <label>Ngày Tháng 1</label>
                      <label>Từ </label>
                          
                      <input type="date" class="textbox" id="date1"  >
                    
                      <label>Đến </label>

                      <input type="date" class="textbox" id="date2"  >
                           
                      <span>. </span>
                    
                      </div>
                      <div class="proxy-add"  title="Serach">
  

              </div>
 -->
                <div class="active-view" id ="cv">
                  <table id="camera-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            <th>Nội Dung</th>
                            <th>Mục Tiêu</th>
                            <th>số tiền </th>
                            <th>loại</th>
                            <th>ghi chú</th>
                            <th>ngày</th>
                            <th>tags</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($finances as $finance)
                            <tr class="color-add">

                              <td><span  id="content{{$finance->id}}">{{$finance->content}}</span></td>

                                <td> <span  id="target{{$finance->id}}">{{$finance->target}}</span>
                           
                                </td>
                                <td><span style="display: none"  id="amount{{$finance->id}}">{{$finance->amount}}</span> {{number_format(floatval($finance->amount), 0, ",", ".") }} VNĐ
                                </td>

                                <td><span style="display:none"   id="type{{$finance->id}}">{{$finance->type}}</span> 
                                  @if($finance->type == 0)
                                    Thu
                                  @else
                                    Chi
                                  @endif 
                                </td>
                                <td>
                                <span  id="note{{$finance->id}}">{{$finance->note}}</span> 
                              </td>
                              <td>
                                <span id="date{{$finance->id}}">{{$finance->date}}</span>
                                </td> 
                             <td><span style="display: none"  id="tag{{$finance->id}}"> {{$finance->tags}}</span>
                            
                                <span class="mytags">

                                  <?php
                                     $tagArr = explode(",", $finance->tags);
                                     $display_tag="";
                                    if($tagArr[0]!=""){
                                      foreach ($tagArr as $single_tag) {
                                      $display_tag =   $display_tag.$single_tag;

                                        foreach($tag_groups_arr as $example_tag){
                                          if(strpos($example_tag,";".trim($single_tag)) > -1
                                          ||  strpos($example_tag,trim($single_tag).";") > -1){
                                            $display_tag = $display_tag."(".$example_tag.")";
                                            break;
                                          }
                                        }

                                        $display_tag = $display_tag.",";
                                      }
                                    }
                                    $display_tag = substr($display_tag, 0, -1);
                                  ?>
                                  {{$display_tag}}
                                </span>
                              </td>
                              <td>

                                <button style="color: white"  type="button" onclick="updateInfo('{{$finance->id}}')" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/notepad.png"></span></button>

                              

                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>



                      <div class=" row-title-proxy" style="margin-left: 0px;  ">
                        <div class="proxy-add" style="display : none;" id="tai1" title="Refresh"><button type="button" class="camera-button" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Tải lại </button></div>
                       <table class="table table-responsive w-100" id="camera-table-old" style="display : none;">
                        <thead>
                        <tr class="thead">
                            <th>Nội Dung </th>
                            <th>Mục Tiêu</th>
                            <th>số tiền </th>
                            <th>loại</th>
                            <th>ghi chú</th>
                            <th>ngày</th>
                            <th>tags</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody class="">
                          @foreach($finances as $finance)
                            <tr class="">

                              <td><span  id="content{{$finance->id}}">{{$finance->content}}</span></td>

                                <td> <span  id="target{{$finance->id}}">{{$finance->target}}</span>
                           
                                </td>
                                <td><span style="display: none"  id="amount{{$finance->id}}">{{$finance->amount}}</span> {{number_format(floatval($finance->amount), 0, ",", ".") }} VNĐ
                                </td>

                                <td><span style="display:none"   id="type{{$finance->id}}">{{$finance->type}}</span> 
                                  @if($finance->type == 0)
                                    Thu
                                  @else
                                    Chi
                                  @endif 
                                </td>
                                <td>
                                <span  id="note{{$finance->id}}">{{$finance->note}}</span> 
                              </td>
                              <td>
                                <span id="date{{$finance->id}}">{{$finance->date}}</span>
                                </td> 
                             <td><span style="display: none"  id="tag{{$finance->id}}"> {{$finance->tags}}</span>
                            
                                <span class="">

                                  <?php
                                     $tagArr = explode(",", $finance->tags);
                                     $display_tag="";
                                    if($tagArr[0]!=""){
                                      foreach ($tagArr as $single_tag) {
                                      $display_tag =   $display_tag.$single_tag;

                                        foreach($tag_groups_arr as $example_tag){
                                          if(strpos($example_tag,";".trim($single_tag)) > -1
                                          ||  strpos($example_tag,trim($single_tag).";") > -1){
                                            $display_tag = $display_tag."(".$example_tag.")";
                                            break;
                                          }
                                        }

                                        $display_tag = $display_tag.",";
                                      }
                                    }
                                    $display_tag = substr($display_tag, 0, -1);
                                  ?>
                                  {{$display_tag}}
                                </span>
                              </td>
                              <td>

                                <button style="color: white"  type="button" onclick="updateInfo('{{$finance->id}}')" class="btn btn-del Disable"><span class="preview"><img src="/js-css/img/icon/notepad.png"></span></button>

                              

                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                 
                    </div>
<!-- Modal -->
<div class="modal fade modol-text" id="new-stepa" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm hạng mục </label>
              </div>
              <div class="notification"></div>
              <form action="add-new-finance" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Nội Dung </td>
                                <td><input type="" value="" name="content" class="input-edit modol-text" id="content" required=""></td>
                            </tr>

                          <tr>
                                <td class="cam-properties">Mục Tiêu </td>
                                <td><input type="" class="input-edit modol-text form-control" name="target" id="target" required=""></td>
                            </tr>


                            <tr>
                                <td class="cam-properties">số tiền</td>
                                <td>
                               <input type="" value="" id="NewAmount2_display" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('NewAmount2')">
                              <input value="0" style="display:none" type="number" id="NewAmount2" name="amount"> 
                            </td>
                                
                            </tr>

                            <tr>
                                <td class="cam-properties">loại</td>
                                <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "">
                                  <option value="0"> Thu </option>
                                  <option value="1">Chi</option>
                                </select></td>
                            </tr>
                      <tr>
                                <td class="cam-properties">ghi chú </td>
                                <td><input type="" value="" name="note" class="input-edit modol-text" id="note" required=""></td>
                            </tr>


                            <tr>
                                <td class="cam-properties">Ngày </td>
                                <td><input type="date" class="input-edit modol-text form-control" name="date" id="date" required=""></td>
                            </tr>
                               <tr>
                                <td class="cam-properties">Tags: </td>
                                <td>
             <input id="newTag" type="text" data-role="tagsinput" name="tags" value="" class="form-control tags">
                           
                          </tr>
                           <tr>
                                <td class="cam-properties"> </td>
                                <td>
                                   <a target="_blank" href="/tag-group" class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Quản lý tags &nbsp;&nbsp; </a>
                                </td>
                              </tr>                  
                            <tr>
                                <td></td>
                                <td>
                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>
                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div></div></div></div></div></div>

      </div>
      <div id="snackbar"><i class="fa fa-check" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Notifition</h6>
      </div>
      <div id="snackbar-warning"><i class="fa fa-exclamation-triangle" style="font-size: 1.5em;"></i>&nbsp;<h6 class="display-inline"> Warning</h6>
      </div>


       <!-- Modal content-->
       <div class="modal fade modol-text" id="EditInfoModal" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Chỉnh sửa thông tin</label>
              </div>
              <div class="notification"></div>
              <form action="edit-finance" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId">
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Nội dung </td>
                                <td><input type="" value="" name="content" class="input-edit modol-text" id="editcontent" required=""></td>

                            </tr>

                           <tr>
                                <td class="cam-properties"> Mục tiêu </td>
                                <td><input value="" type="" class="input-edit modol-text form-control" name="target" id="edittarget" required=""></td>
                            </tr>


                            <tr>
                                <td class="cam-properties">Số tiền </td>

                                <td>
                               <input type="" value="" id="NewAmountf-display" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('NewAmount')">
                              <input value="0" style="display:none" type="number" id="NewAmount" name="amount"> 
                            </td>
                            </tr>

                            <tr>
                                <td class="cam-properties">Loại</td>
                                <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "edittype">
                                  <option value="0"> Thu </option>
                                  <option value="1">Chi</option>
                                </select></td>
                            </tr>
                      <tr>
                                <td class="cam-properties"> ghi chú</td>
                                <td><input type="" value="" name="note" class="input-edit modol-text" id="editnote" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Ngày </td>
                                <td><input value="" type="date" class="input-edit modol-text form-control" name="date" id="editdate" required=""></td>
                            </tr>
                               <tr>
                                <td class="cam-properties">Tags: </td>
                                <td>
                                <input id="editTag" type="text" data-role="tagsinput" name="tag" value="" class="form-control tags">
                                </td>

                                 <tr>
                                <td class="cam-properties"> </td>
                                <td>
                                   <a target="_blank" href="/tag-group" class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Quản lý tags &nbsp;&nbsp; </a>
                                </td>
                              </tr>

                          </tr>

                            <tr>
                                <td></td>
                                <td>

                                  <button class="btn btn-model" id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>

                                  <button type="button" class="btn btn-model" id="device-removea"><a id="financeDelete">&nbsp; &nbsp; Xóa&nbsp; &nbsp;</a></button>
                                  
                                  <button style="display: none;" id="remove-credential" type="button">
                                    <a id="EditDelete" href=""></a>
                                  </button>


                                  <button type="button" class="btn btn-model" data-dismiss="modal">Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div> 

<script type="text/javascript">
    $(document).ready(function() {
      if($("#notice_warning").val() == 1){
        notifiWarning($("#notice_warning").attr("notifi"));
      }
      if($("#notice_success").val() == 1){
        notifiSuccess($("#notice_success").attr("notifi"));
      }
  });
</script>
<script src="/js-css/js/bootstrap-select.min.js"></script>
<script src="/js-css/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  function updateInfo(id){
          document.getElementById("EditId").value = id

          document.getElementById("editcontent").value = document.getElementById("content"+id).innerHTML

          document.getElementById("edittarget").value = document.getElementById("target"+id).innerHTML


          document.getElementById("NewAmountf-display").value = document.getElementById("amount"+id).innerHTML

        document.getElementById("edittype").value = document.getElementById("type"+id).innerHTML

          document.getElementById("editnote").value = document.getElementById("note"+id).innerHTML

          document.getElementById("editdate").value = document.getElementById("date"+id).innerHTML

  $("#editTag").tagsinput('removeAll');
var rawhtml = $("#tag"+id).html();
     if (rawhtml.length > 1){
     rawhtml = rawhtml.split(',');
     for (var i = 0; i < rawhtml.length;i++){
    $('#editTag').tagsinput('add', rawhtml[i]);
    }
  }
  document.getElementById("EditDelete").href = "/delete-finance/" + id 
        
        $("#EditInfoModal").modal()
}
function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }

    // $("#search-input").on("keyup", function() {
    //   var value = $(this).val().toLowerCase();
    //   $("#camera-table tbody tr").filter(function() {
    //     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //   });
    // });


function uploadsubmit(){ 
      swal({
        title: "",
        text: " Bạn có chắc chắc tệp tin tải lên phù hợp ? ",
        type: "info",
        showCancelButton: true,
        confirmButtonText: "Có",
        cancelButtonText: "Không",
        closeOnConfirm: false,
        closeOnCancel: false,
        reverseButtons: true },
        function(isConfirm){
          if (isConfirm)
          {
      document.getElementById("inputform").submit();
            swal.close();
          }
          else {
            swal.close();
          }
        });

    }
</script> 
<!-- DataTables -->
  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>
  <script type="text/javascript">
    
    $('#camera-table').DataTable({

    "drawCallback": function( settings ) { 
      $('.mytags').each(function(){
     var rawhtml = $(this).html();
     if (rawhtml.length > 1 && rawhtml.includes("bootstrap-tagsinput") == false){
     rawhtml = rawhtml.split(',');

     html = '<div class="bootstrap-tagsinput">'
     for (var i = 0; i < rawhtml.length;i++){
      html = html + '<span class="tag label label-info" style="display: inline-block;">'+rawhtml[i]+'</span>'
    }
    html = html + "</div>"
      $(this).html(html)
     }
 });

     $('.mygrouptags').each(function(){
     var rawhtml = $(this).html();
     if (rawhtml.length > 1 && rawhtml.includes("bootstrap-tagsinput") == false){
     rawhtml = rawhtml.split(',');

     html = '<div class="bootstrap-tagsinput">'
     for (var i = 0; i < rawhtml.length;i++){
      html = html + '<span class="tag label label-info" style="display: inline-block;">'+rawhtml[i]+'</span>'
    }
    html = html + "</div>"
      $(this).html(html)
     }
     
 });
    }
});
   
function formatForId(id){
    var value = document.getElementById(id+"_display").value
    value = parseFloat(value.replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    console.log(value)
    console.log(value.replace(/,/g, ""))
    if (isNaN(parseInt(value))){
    if(id.includes("1")){
    document.getElementById(id+"_display").value = 0
    }else{
    document.getElementById(id+"_display").value = "Không giới hạn"

    }
    document.getElementById(id).value = -1 
    }else{
    document.getElementById(id+"_display").value = value
    
    document.getElementById(id).value = value.replace(/,/g, "") 
  }
}

  </script>
  <script>
  function confirm_remove() {
          var remove = document.getElementById('device-removea');
          remove.addEventListener('click', function(e){
              swal({
                  title: "",
                  text: " Bạn có muốn xóa file không? ",
                  type: "info",
                  showCancelButton: true,
                  confirmButtonText: "Yes",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false,
                  reverseButtons: true },
                  function(isConfirm){
                  if (isConfirm)
                  {
                    loading_nomal()
                    document.getElementById("EditDelete").click();
                    swal.close();
                  }
                  else {
                    swal.close();
                  }
                });
            });
        }
        confirm_remove();

        function removeFile(id) {
    console.log("Okoekqr");
              swal({
                  title: "",
                  text: " Bạn có muốn xóa tệp này không?1 ",
                  type: "info",
                  showCancelButton: true,
                  confirmButtonText: "Yes",
                  cancelButtonText: "No",
                  closeOnConfirm: false,
                  closeOnCancel: false,
                  reverseButtons: true },
                  function(isConfirm){
                  if (isConfirm)
                  {
                    loading_nomal()
                    location.href  = "/building/delete-job/"+id
                    swal.close();
                  }
                  else {
                    swal.close();
                  }
                });
           }
</script>
<script type="text/javascript">
    $("#search-input-btn").on("click", function() {

      // getZone()

      var value = $("#search-input").val().toLowerCase();
      var targetValue = $("#search-input1").val().toLowerCase();
      var typeValue = $("#search-input2").val().toLowerCase();
      var noteValue = $("#search-input3").val().toLowerCase();
      var tagsValue = $("#search-type").val().toLowerCase();
    
   
     
        priceUnitMin = $("#search-input-unit-price1").val()
        priceUnitMax = $("#search-input-unit-price2").val()

        document.getElementById("camera-table-old").style.display="block"
        document.getElementById("camera-table-old").classList.add("d-md-table");
        document.getElementById("camera-table").style.display="none"
        document.getElementById("tai1").style.display="block"
        document.getElementById("cv").style.display="none"
        document.getElementById("tai").style.display="none"
      $("#camera-table-old tbody tr").filter(function() {
        
        var content =  ($(this)[0].childNodes[1].innerHTML)
        // console.log(priceUnitMax)
        // console.log(priceUnitMin)
        var target =  ($(this)[0].childNodes[3].innerHTML)
        var unit_price =  parseInt(($(this)[0].childNodes[5].childNodes[1].nodeValue).replaceAll(',', ''))

        var type =  ($(this)[0].childNodes[7].innerText)
        var note =  ($(this)[0].childNodes[9].innerText)
      var date =  ($(this)[0].childNodes[11].innerText)
      var tags =  ($(this)[0].childNodes[13].innerText)
        $(this).toggle(
          (content.toLowerCase().indexOf(value) > -1 ||
          target.toLowerCase().indexOf(value) > -1||
          note.toLowerCase().indexOf(value) > -1||
          tags.toLowerCase().indexOf(value) > -1
          || (typeValue == -1))
          && (unit_price < priceUnitMax  || priceUnitMax == -1)
          && (unit_price > priceUnitMin || priceUnitMin == -1)


          )

      });
      

      });

 $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });

// document.getElementById("close-menu-btn").onclick = function() {getZone()};

function ToggleNext(){
  $("#new-url1").slideToggle();
  
}
     $('.nav-link').click(function(event){
        $('.tab-pane').removeClass('active');
        $("#"+this.href.split("#")[1]).addClass('active');

    });

</script>
@endsection

