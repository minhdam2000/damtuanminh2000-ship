@extends('../layouts/index')
@section('content')
<style type="text/css">
  @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
}



.results {
    font-weight: 600
}

select {
    border: none;
    outline: none;
    padding: 0px 4px;
    cursor: pointer;
    background: inherit
}

.card {
    font-size: small;
    border: none;
    cursor: pointer
}

.card:hover {
    transform: scale(1.08);
    transition: all 0.4s ease-in-out
}

.card-img-top {
    /*background-color: #fdf8f4;*/
    height: 100%;
    object-fit: contain;
    padding-top: 10px
}

.card-body {
    padding: 0.5rem;
    padding-top: 0.7rem;
    padding-right: 0.2rem
}

.fa-heart {
    font-size: 1.2rem
}

.h7 {
    margin: 0
}

.btn {
    padding-top: 0
}

.btn:hover {
    color: #fdaa4b
}

div.text-muted {
    font-size: 0.9rem
}

@media(max-width:372px) {
    .results {
        font-size: 0.9rem
    }
}

@media(max-width:330px) {
    .results {
        font-size: 0.85rem
    }
}

@media(min-height: 700px) {
    body {
        height: 100vh
    }
    .chart{
      min-height: 400px;
    }
}
.card-body{

    text-align: center;
}
@media(max-width:768px) {
    body {
        height: 100%
    }
}

  .list-group-item{
    background-color:transparent!important;
    text-align: left;
  }
  .fananci-element {
  list-style-type: none;
  width: 100%;
  display: table;
  table-layout: fixed;
}

.fananci-list {
  display: table-cell;
  width: 30%;
  font-size: 20px;
}


@media (max-width: 500px) {
.fananci-list {
  font-size: 10px;
}

}

</style>
<hr><br><hr>
 <div class="row-title-proxy">
         <ul class="nav nav-tabs" id="tabs" role="tablist">
      <li class="nav-item margin_center">
          <a id="tab2" class="nav-link color-a active" 
          data-toggle="tab" role="tab" href="#content0">Tổng quan</a>
      </li>


       <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content1"> Chi tiết tài sản</a>
      </li>
     <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content2"> Chi tiết thu</a>
      </li>

       <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content3"> Chi tiết chi</a>
      </li>

       <li class="nav-item margin_center">
          <a id="tab3" class="nav-link color-a" 
          data-toggle="tab" role="tab" href="#content4"> Chi tiết công nợ</a>
      </li>
      </ul>
  </div>
   <div class="tab-content">

          <div id="content0" class="tab-pane  in active">
            <hr>
            <div class="row">
                <div class="col-md-6 col-12 col-sm-12"> 
     <div class=" card-custom">
                                         <div class="card-header" data-toggle="collapse">
                                        <h3 class="card-title">
   Tổng tài sản: {{number_format(floatval($fin_asset) +floatval($total_buy) , 0, ",", ".") }}  VND + Diện tích: {{$total_acreage}}   m<sup>2</sup></h3>
</div>
                                    
                                      <div style="text-align: left;" class="card-body collapse show"  id="target1" >


<!--                       @foreach($input as $row)
         <li class="submenu list-group-item"><h3><i class="fa fa-money" aria-hidden="true"></i> <a href="finance/detail/1/{{$row->type_id}}"> {{$row->type_name}} ( {{number_format(floatval($row->amount)  , 0, ",", ".") }} VND)</a></h3>
         </li>
         @endforeach

           <li class="submenu list-group-item"><a><h3><i class="fa fa-money" aria-hidden="true"></i><a href="finance/detail/sale"> Tiền bán hàng ( {{number_format(floatval($total_buy) , 0, ",", ".") }}  VND)</a></h3><hr>
          
         </li> -->
<!-- <div class="chartBtn"></div> -->
<canvas class="chart" height = "400" style="max-height: 500px" id="log3"></canvas>


</div></div></div>

             <div class="col-md-6 col-12 col-sm-12"> 
     <div class=" card-custom">
                                         <div class="card-header" data-toggle="collapse" >
                                        <h3 class="card-title">
   Tổng thu: {{number_format(floatval($fin_input) , 0, ",", ".") }}  VND</h3>
</div>
                                    
                                      <div style="text-align: left;" class="card-body collapse show"  id="target1" >


<!--                       @foreach($input as $row)
         <li class="submenu list-group-item"><h3><i class="fa fa-money" aria-hidden="true"></i> <a href="finance/detail/1/{{$row->type_id}}"> {{$row->type_name}} ( {{number_format(floatval($row->amount)  , 0, ",", ".") }} VND)</a></h3>
         </li>
         @endforeach

           <li class="submenu list-group-item"><a><h3><i class="fa fa-money" aria-hidden="true"></i><a href="finance/detail/sale"> Tiền bán hàng ( {{number_format(floatval($total_buy) , 0, ",", ".") }}  VND)</a></h3><hr>
          
         </li> -->
<!-- <div class="chartBtn"></div> -->
<canvas class="chart" height = "400" style="max-height: 500px" id="log1"></canvas>


</div></div></div>

    <div class="col-md-6 col-12 col-sm-12"> 
     <div class=" card-custom">
                                         <div class="card-header" data-toggle="collapse" >
                                        <h3 class="card-title">
   Tổng chi chi 
{{number_format(floatval($fin_output) , 0, ",", ".") }}  VND</h3>
</div>
                                    
                                      <div style="text-align: left;" class="card-body collapse show"  id="target2" >

                   <!--    @foreach($output as $row)
         <li class="submenu list-group-item"><h3><i class="fa fa-money" aria-hidden="true"></i> <a href="finance/detail/2/{{$row->type_id}}"> {{$row->type_name}} ( {{number_format(floatval($row->amount)  , 0, ",", ".") }}  VND)</a></h3>
         </li>
         @endforeach -->

        <!--   <li class="submenu list-group-item"><h3><i class="fa fa-money" aria-hidden="true"></i><a href="finance/detail/daily"> Chi phí hoạt động ({{number_format(floatval($daily) , 0, ",", ".") }}  VND)</a> </h3>
          
         </li> -->
<!-- 
          <li class="submenu list-group-item"></li> -->

<!-- <div class="chartBtn"></div> -->
<canvas class="chart" height = "400"  style="max-height: 500px" id="log2"></canvas>

</div></div></div>
<div class="col-md-6 col-12 col-sm-12"> 
     <div class=" card-custom">
                                         <div class="card-header" data-toggle="collapse" >
                                        <h3 class="card-title">
   Tổng công nợ
{{number_format(floatval($fin_dept) , 0, ",", ".") }}  VND</h3>
</div>
                                    
                                      <div style="text-align: left;" class="card-body collapse show"  id="target2" >

                   <!--    @foreach($output as $row)
         <li class="submenu list-group-item"><h3><i class="fa fa-money" aria-hidden="true"></i> <a href="finance/detail/2/{{$row->type_id}}"> {{$row->type_name}} ( {{number_format(floatval($row->amount)  , 0, ",", ".") }}  VND)</a></h3>
         </li>
         @endforeach -->

        <!--   <li class="submenu list-group-item"><h3><i class="fa fa-money" aria-hidden="true"></i><a href="finance/detail/daily"> Chi phí hoạt động ({{number_format(floatval($daily) , 0, ",", ".") }}  VND)</a> </h3>
          
         </li> -->
<!-- 
          <li class="submenu list-group-item"></li> -->

<!-- <div class="chartBtn"></div> -->
<canvas class="chart" height = "400"  style="max-height: 500px" id="log4"></canvas>

</div></div></div>

  <div class="col-md-12 col-12 col-sm-12"> 
    <br><hr><br>
     <div class=" card-custom">
                                         <div class="card-header" >
                                        <h3 class="card-title">
   Chênh lệch Thu - Chi: {{number_format(floatval($fin_input) +floatval($total_buy) - floatval($fin_output) , 0, ",", ".") }}  VND </h3>
</div>
      <div   id="barCon"  class="col-md-6 col-sm-12 col-12">

    <canvas   id="barChart"  height = "400"  style="min-height: 500px;width: 100%;"></canvas>
 </div>

          </div>
</div></div></div>
<div class="form-inline">  <div class="col-5 col-md-3">
  <label for="example-datetime-local-input" class="col-2 col-md-1 col-form-label">Từ </label>

    <input class="form-control" type="date" name="dt1" id="min" value="">
  </div>  <div class="col-5 col-md-3">
  <label for="example-datetime-local-input" class="col-2 col-md-1 col-form-label">Đến </label>

    <input class="form-control" type="date" name="dt2" id="max" value="">


</div>
</div>

            <div id="content1" class="tab-pane  fade">



       <hr>
        <div class="proxy-add" title="New Edge"><button type="button" class=" form-control " style="background-color: red;color: white" data-toggle="modal" data-target="#AddInfoModal2">Thêm hạng mục</button></div>

     

  <div class="proxy-add" title="Refresh"><button  type="button"  class=" form-control " style="background-color: red;color: white" onclick="location.reload();"> Tải lại</button></div>
  <br><hr>

    <table id="asset-table" class="nvr-table">
    <thead>
    <tr class="thead">
        
        <!-- <th> Người đăng</th> -->
        <th> Tiêu đề</th>
        <!-- <th> Nội dung </th> -->
        <th> Loại</th>
        <th> Số tiền </th>
        <th> Ngày </th>
        <th></th>
        <!-- <th></th> -->
      </tr>
    </thead>
    <tbody class="tbody">
      @foreach($asset_details as $info)
        <tr class="color-add">
          
          <td><a style="display: none" id="uname{{$info->id}}"> {{$info->uname}}</a><a id="aname{{$info->id}}"> {{$info->title}}</a><a style="display: none"  id="ades{{$info->id}}" > {{$info->description}}</a>
          <td>
      
            <a id="atype{{$info->id}}" style="display: none"> {{$info->type}}</a>
            <a id="atypename{{$info->id}}"> {{$info->name}}</a>


            <a id="anum{{$info->id}}" style="display: none"> {{$info->amount}}</a>
          </td>
          <td><a id="anumdisplay{{$info->id}}"> {{number_format(floatval($info->amount), 0, ",", ".") }}  VND</a></td>

          <td><a id="adate{{$info->id}}">{{$info->date}}</a></td>
         
           <td>


            <button style="color: white"  type="button" onclick="editAssetDetail('{{$info->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button>

        </tr>
      @endforeach
    </tbody>
  </table>

<!--   <hr>
  <h3>Thống kê thu theo tháng</h3>
  <hr>
 -->
    <!-- <canvas  height="500"   id="barChart1"></canvas> -->
    </div>

            <div id="content4" class="tab-pane  fade">



        <div class="proxy-add" title="New Edge"><button type="button" class=" form-control " style="background-color: red;color: white" data-toggle="modal" data-target="#AddInfoModal3">Thêm hạng mục</button></div>

     

  <div class="proxy-add" title="Refresh"><button  type="button"  class=" form-control " style="background-color: red;color: white" onclick="location.reload();"> Tải lại</button></div>
  <br><hr>

    <table id="dept-table" class="nvr-table">
    <thead>
    <tr class="thead">
        
        <!-- <th> Người đăng</th> -->
        <th> Tiêu đề</th>
        <!-- <th> Nội dung </th> -->
        <th> Loại</th>
        <th> Số tiền </th>
        <th> Ngày </th>
        <th></th>
        <!-- <th></th> -->
      </tr>
    </thead>
    <tbody class="tbody">
      @foreach($dept_details as $info)
        <tr class="color-add">
          
          <td><a style="display: none"  id="uname{{$info->id}}"> {{$info->uname}}</a><a id="dname{{$info->id}}"> {{$info->title}}</a><a style="display: none"  id="ddes{{$info->id}}" > {{$info->description}}</a></td>
          <td>
      
            <a id="dtype{{$info->id}}" style="display: none"> {{$info->type}}</a>
            <a id="dtypename{{$info->id}}"> {{$info->name}}</a>


            <a id="dnum{{$info->id}}" style="display: none"> {{$info->amount}}</a>
          </td>
          <td><a id="dnumdisplay{{$info->id}}"> {{number_format(floatval($info->amount), 0, ",", ".") }}  VND</a></td>

          <td><a id="ddate{{$info->id}}">{{$info->date}}</a></td>
         
           <td>


            <button style="color: white"  type="button" onclick="editDeptDetail('{{$info->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button>

        </tr>
      @endforeach
    </tbody>
  </table>

<!--   <hr>
  <h3>Thống kê thu theo tháng</h3>
  <hr>
 -->
    <!-- <canvas  height="500"   id="barChart1"></canvas> -->
    </div>


            <div id="content2" class="tab-pane  fade">


       <hr>
        <div class="proxy-add" title="New Edge"><button type="button" class=" form-control " style="background-color: red;color: white" data-toggle="modal" data-target="#AddInfoModal">Thêm hạng mục</button></div>

     

  <div class="proxy-add" title="Refresh"><button  type="button"  class=" form-control " style="background-color: red;color: white" onclick="location.reload();"> Tải lại</button></div>
  <br><hr>

    <table id="input-table" class="nvr-table">
    <thead>
    <tr class="thead">
        
        <!-- <th> Người đăng</th> -->
        <th> Tiêu đề</th>
        <!-- <th> Nội dung </th> -->
        <th> Loại</th>
        <th> Số tiền </th>
        <th> Ngày </th>
        <th></th>
        <!-- <th></th> -->
      </tr>
    </thead>
    <tbody class="tbody">
      @foreach($input_details as $info)
        <tr class="color-add">
          
          <td><a style="display: none"  id="uname{{$info->id}}"> {{$info->uname}}</a><a id="iname{{$info->id}}"> {{$info->title}}</a><a style="display: none"  id="ides{{$info->id}}" > {{$info->description}}</a></td>
          <td>
      
            <a id="itype{{$info->id}}" style="display: none"> {{$info->type}}</a>
            <a id="itypename{{$info->id}}"> {{$info->name}}</a>


            <a id="inum{{$info->id}}" style="display: none"> {{$info->amount}}</a>
          </td>
          <td><a id="inumdisplay{{$info->id}}"> {{number_format(floatval($info->amount), 0, ",", ".") }}  VND</a></td>

          <td><a id="idate{{$info->id}}">{{$info->date}}</a></td>
         
           <td>


            <button style="color: white"  type="button" onclick="editInputDetail('{{$info->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button>

        </tr>
      @endforeach
    </tbody>
  </table>

<!--   <hr>
  <h3>Thống kê thu theo tháng</h3>
  <hr>
 -->
    <!-- <canvas  height="500"   id="barChart1"></canvas> -->
    </div>

            <div id="content3" class="tab-pane  fade">


                   <div class="proxy-add" title="New Edge"><button type="button" class=" form-control " style="background-color: red;color: white" data-toggle="modal" data-target="#AddInfoModal1">Thêm hạng mục</button></div>

     
                  
                      <div class="proxy-add" title="Refresh"><button  type="button"  class=" form-control " style="background-color: red;color: white" onclick="location.reload();"> Tải lại</button></div>
                      <hr><br>

                        <table id="output-table" class="nvr-table">
                        <thead>
                        <tr class="thead">
                            
                            <!-- <th> Người đăng</th> -->
                            <th> Tiêu đề</th>
                            <!-- <th> Nội dung </th> -->
                            <th> Loại</th>
                            <th> Số tiền </th>
                            <th> Ngày </th>
                            <th></th>
                            <!-- <th></th> -->
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @foreach($output_details as $info)
                            <tr class="color-add">
                               <td><a style="display: none"  id="uname{{$info->id}}"> {{$info->uname}}</a><a id="oname{{$info->id}}"> {{$info->title}}</a>  <a style="display: none"  id="odes{{$info->id}}" > {{$info->description}}</a></td>
                        <td>
                                <a id="otype{{$info->id}}" style="display: none"> {{$info->type}}</a>
                                <a id="otypename{{$info->id}}" > {{$info->name}}</a>


                              </td>
                              <td>

                                <a id="onum{{$info->id}}" style="display: none"> {{$info->amount}}</a>
                                <a id="onumdisplay{{$info->id}}"> {{number_format(floatval($info->amount), 0, ",", ".") }}  VND</a></td>
  <td><a id="odate{{$info->id}}">{{$info->date}}</a></td>
                             
                             
                               <td>


                                <button style="color: white"  type="button" onclick="editOutputDetail('{{$info->id}}')" class="btn btn-del Disable"><i class="fa fa-pencil-square-o" aria-hidden="true" style="font-size: 1.2rem;"></i></button>

                            </tr>
                          @endforeach
                        </tbody>
                      </table>

<!--   <hr>
  <h3>Thống kê chi theo tháng</h3>
  <hr>

    <canvas  height="500"   id="barChart2"></canvas>
 -->
    </div>

</div>
</div></div>

 
<div class="modal fade modol-text" id="AddInfoModal" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Thêm hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/add" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="table_type" value="0" >
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                <td><span id="modelType">Hạng mục thu</span></td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="name" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Mô tả</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="des" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "">

                                @foreach($input_type as $info)
                                  <option value="<?=$info->id?>"><?=$info->name?></option>
                                @endforeach
                                </select></td>

                            </tr>

                            <tr>
                                <td class="cam-properties">Số tiền</td>
                                <td>
                               <input type="" value="" id="NewAmountDisplay" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('NewAmount')">
                              <input value="0" style="display:none" type="number" id="NewAmount" name="amount"> 
                            </td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Ngày</td>
                                <td>
                                <input type="date" class="input-edit modol-text form-control" name="date" id="" required="">
                              </td>
                            </tr>

                           
                            <tr>
                                <td></td>
                                <td>
                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;float:left;margin-right: 5%;"  id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>

                                   

                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;"  class="btn btn-model" data-dismiss="modal"> Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>

<div class="modal fade modol-text" id="AddInfoModal1" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>
                  Thêm hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/add" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="table_type" value="1" >
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                <td><span id="modelType">Hạng mục thu</span></td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="name" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Mô tả</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="des" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "">

                                @foreach($output_type as $info)
                                  <option value="<?=$info->id?>"><?=$info->name?></option>
                                @endforeach
                                </select></td>

                            </tr>

                            <tr>
                                <td class="cam-properties">Số tiền</td>
                                <td>
                               <input type="" value="" id="NewAmount1Display" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('NewAmount1')">
                              <input value="0" style="display:none" type="number" id="NewAmount1" name="amount"> 
                            </td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Ngày</td>
                                <td>
                                <input type="date" class="input-edit modol-text form-control" name="date" id="" required="">
                              </td>
                            </tr>

                           
                            <tr>
                                <td></td>
                                <td>
                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;float:left;margin-right: 5%;"  id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>

                                   

                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;" class="btn btn-model" data-dismiss="modal"> Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>


 <div class="modal fade modol-text" id="EditInfoModal" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Sửa hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/edit" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId">
                  <input type="hidden" name="table_type" value="0" >
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                <td><span id="modelType">Hạng mục thu</span></td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text" id="EditName"  name="name" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Mô tả</td>
                                <td>
                                <input class="input-edit modol-text" id="EditDes"  name="des" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "EditType">

                                @foreach($input_type as $info)
                                  <option value="<?=$info->id?>"><?=$info->name?></option>
                                @endforeach
                                </select></td>

                            </tr>

                            <tr>
                                <td class="cam-properties">Số tiền</td>
                                <td>
                               <input type="" value="" id="EditAmountDisplay" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('EditAmount')">
                              <input value="0" style="display:none" type="number" id="EditAmount" name="amount"> 
                            </td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Ngày</td>
                                <td>
                                <input type="date" class="input-edit modol-text form-control" name="date" id="Editdate" required="">
                              </td>
                            </tr>

                           
                            <tr>
                                <td></td>
                                <td>
                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;float:left;margin-right: 5%;"  id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>

                                     <button  class=" form-control " style="background-color: red;color: white;width:fit-content;float:left;margin-right: 5%;"><a id="deleteButton"> &nbsp;&nbsp; Xóa &nbsp;&nbsp; </a></button>

                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;" class="btn btn-model" data-dismiss="modal"> Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>

 <div class="modal fade modol-text" id="EditInfoModal1" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Sửa hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/edit" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId1">
                  <input type="hidden" name="table_type" value="2" >
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                <td><span id="modelType">Hạng mục chi</span></td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text" id="EditName1"  name="name" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Mô tả</td>
                                <td>
                                <input class="input-edit modol-text" id="EditDes1"  name="des" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "EditType1">

                                @foreach($output_type as $info)
                                  <option value="<?=$info->id?>"><?=$info->name?></option>
                                @endforeach
                                </select></td>

                            </tr>

                           <tr>
                                <td class="cam-properties">Số tiền</td>
                                <td>
                               <input type="" value="" id="EditAmount1Display" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('EditAmount1')">
                              <input value="0" style="display:none" type="number" id="EditAmount1" name="amount"> 
                            </td>
                            </tr>
                              <tr>
                                <td class="cam-properties">Ngày</td>
                                <td>
                                <input type="date" class="input-edit modol-text form-control" name="date" id="Editdate1" required="">
                              </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;float:left;margin-right: 5%;"  id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>

                                     <button  class=" form-control " style="background-color: red;color: white;width:fit-content;float:left;margin-right: 5%;"><a id="deleteButton1"> &nbsp;&nbsp; Xóa &nbsp;&nbsp;</a> </button>

                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;" class="btn btn-model" data-dismiss="modal"> Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>


<div class="modal fade modol-text" id="AddInfoModal2" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>
                  Thêm hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/add" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="table_type" value="2" >
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                <td><span id="modelType">Tài sản</span></td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="name" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Mô tả</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="des" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "">

                                @foreach($asset_type as $info)
                                  <option value="<?=$info->id?>"><?=$info->name?></option>
                                @endforeach
                                </select></td>

                            </tr>

                            <tr>
                                <td class="cam-properties">Số tiền</td>
                                <td>
                               <input type="" value="" id="NewAmount2Display" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('NewAmount2')">
                              <input value="0" style="display:none" type="number" id="NewAmount2" name="amount"> 
                            </td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Ngày</td>
                                <td>
                                <input type="date" class="input-edit modol-text form-control" name="date" id="" required="">
                              </td>
                            </tr>

                           
                            <tr>
                                <td></td>
                                <td>
                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;float:left;margin-right: 5%;"  id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>

                                   

                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;" class="btn btn-model" data-dismiss="modal"> Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>


 <div class="modal fade modol-text" id="EditInfoModal2" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Sửa hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/edit" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId2">
                  <input type="hidden" name="table_type" value="2" >
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                <td><span id="modelType">Tài sản</span></td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text" id="EditName2"  name="name" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Mô tả</td>
                                <td>
                                <input class="input-edit modol-text" id="EditDes2"  name="des" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "EditType2">

                                @foreach($asset_type as $info)
                                  <option value="<?=$info->id?>"><?=$info->name?></option>
                                @endforeach
                                </select></td>

                            </tr>

                            <tr>
                                <td class="cam-properties">Số tiền</td>
                                <td>
                               <input type="" value="" id="EditAmount2Display" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('EditAmount2')">
                              <input value="0" style="display:none" type="number" id="EditAmount2" name="amount"> 
                            </td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Ngày</td>
                                <td>
                                <input type="date" class="input-edit modol-text form-control" name="date" id="Editdate2" required="">
                              </td>
                            </tr>

                           
                            <tr>
                                <td></td>
                                <td>
                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;float:left;margin-right: 5%;"  id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>

                                     <button  class=" form-control " style="background-color: red;color: white;width:fit-content;float:left;margin-right: 5%;"><a id="deleteButton2"> &nbsp;&nbsp; Xóa &nbsp;&nbsp; </a></button>

                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;" class="btn btn-model" data-dismiss="modal"> Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>


      <div class="modal fade modol-text" id="AddInfoModal3" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>
                  Thêm hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/add" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="table_type" value="3" >
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                <td><span id="modelType">Công nợ</span></td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="name" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Mô tả</td>
                                <td>
                                <input class="input-edit modol-text" id=""  name="des" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "">

                                @foreach($dept_type as $info)
                                  <option value="<?=$info->id?>"><?=$info->name?></option>
                                @endforeach
                                </select></td>

                            </tr>

                            <tr>
                                <td class="cam-properties">Số tiền</td>
                                <td>
                               <input type="" value="" id="NewAmount3Display" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('NewAmount3')">
                              <input value="0" style="display:none" type="number" id="NewAmount3" name="amount"> 
                            </td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Ngày</td>
                                <td>
                                <input type="date" class="input-edit modol-text form-control" name="date" id="" required="">
                              </td>
                            </tr>

                           
                            <tr>
                                <td></td>
                                <td>
                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;float:left;margin-right: 5%;"  id="nvr-add"> &nbsp;&nbsp; Thêm &nbsp;&nbsp; </button>

                                   

                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;" class="btn btn-model" data-dismiss="modal"> Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>


 <div class="modal fade modol-text" id="EditInfoModal3" role="dialog">
          <div class="modal-dialog model-right">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                  <label>Sửa hạng mục</label>
              </div>
              <div class="notification"></div>
              <form action="finance/edit" method="POST">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" value="" id="EditId3">
                  <input type="hidden" name="table_type" value="3" >
                  <div class="modal-body">
                    <table class="table-edit table-model">
                        <tbody class="table-edit">
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                <td><span id="modelType">Công nợ</span></td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Tên hạng mục</td>
                                <td>
                                <input class="input-edit modol-text" id="EditName3"  name="name" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Mô tả</td>
                                <td>
                                <input class="input-edit modol-text" id="EditDes3"  name="des" required=""></td>
                            </tr>
                            <tr>
                                <td class="cam-properties">Loại hạng mục</td>
                                 <td><select value="" class="custom-select select-profile  browser-default"  data-live-search="true"  name="type" id= "EditType3">

                                @foreach($dept_type as $info)
                                  <option value="<?=$info->id?>"><?=$info->name?></option>
                                @endforeach
                                </select></td>

                            </tr>

                            <tr>
                                <td class="cam-properties">Số tiền</td>
                                <td>
                               <input type="" value="" id="EditAmount3Display" name="" class="input-edit create-user modol-text" required="" onblur="formatForId('EditAmount3')">
                              <input value="0" style="display:none" type="number" id="EditAmount3" name="amount"> 
                            </td>
                            </tr>

                              <tr>
                                <td class="cam-properties">Ngày</td>
                                <td>
                                <input type="date" class="input-edit modol-text form-control" name="date" id="Editdate3" required="">
                              </td>
                            </tr>

                           
                            <tr>
                                <td></td>
                                <td>
                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;float:left;margin-right: 5%;"  id="nvr-add"> &nbsp;&nbsp; Sửa &nbsp;&nbsp; </button>

                                     <button  class=" form-control " style="background-color: red;color: white;width:fit-content;float:left;margin-right: 5%;"><a id="deleteButton3"> &nbsp;&nbsp; Xóa &nbsp;&nbsp; </a></button>

                                  <button class=" form-control " style="background-color: red;color: white;width:fit-content;" class="btn btn-model" data-dismiss="modal"> Thoát </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
              </form>
            </div>
          </div>
      </div>

</div></div>

<script type="text/javascript">

    menu_close()
</script>

 <script type="text/javascript">


  function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
};

     function switchChart(){
      var check = 
        document.getElementById("log1").style.display;
        if (check == "none"){

        document.getElementById("log1").style.display = "block";

        document.getElementById("log2").style.display = "block";

        }else{

        document.getElementById("log1").style.display = "none";

        document.getElementById("log2").style.display = "none";

        }
     }

     function auditChart(){
      

            var colors = ["#0074D9", "#FF4136", "#2ECC40", "#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]
            /* 3 donut charts */
            console.log("width")
            console.log(window.innerWidth )
            if (window.innerWidth >800 ){
            var size = window.innerWidth/125;

        document.getElementById("log1").style.display = "block";

        document.getElementById("log2").style.display = "block";

        // document.getElementsByClassName("chartBtn")[0].innerHTML = '';

        // document.getElementsByClassName("chartBtn")[1].innerHTML = '';
           }else{
            var size = window.innerWidth/25;
            // $('.collapse').removeClass('show');

        document.getElementById("log1").style.display = "none";

        document.getElementById("log2").style.display = "none";

        // document.getElementsByClassName("chartBtn")[0].innerHTML = '<button onclick = "switchChart()"  class="btn btn-model" id="camera-add">&nbsp;&nbsp; Biểu đồ &nbsp;&nbsp;</button>';

        // document.getElementsByClassName("chartBtn")[1].innerHTML = '<button onclick = "switchChart()" class="btn btn-model" id="camera-add">&nbsp;&nbsp; Biểu đồ &nbsp;&nbsp;</button>';
        switchChart()
           }

           var donutOptions = {
              responsive: false,
              cutoutPercentage: 55,
              legend: {
                position: 'bottom', padding: 5, labels: {
                  pointStyle: 'circle', usePointStyle: true,fontSize:size
                }
              },
            responsive: true,
            maintainAspectRatio: false,

            };
      let methods = []
            let labels = []
            let labels2 = []
            
            @foreach($asset as $row)
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                labels.push("{{$row->type_name}}: " +formatMoney({{floatval($row->amount)}}) + "VND");
                labels2.push("{{$row->type_name}}");
                methods.push(parseFloat("{{floatval($row->amount)}}"))

            @endforeach


   labels.push("Bất động sản " +formatMoney({{floatval($total_acreage*10000000)}}) + " VND");
                labels2.push("Bất động sản");
                methods.push(parseFloat("{{floatval($total_acreage*10000000)}}"))

            console.log(methods, labels)


            var chDonutDataMethod = {
              labels: labels,
              datasets: [
                {
                  backgroundColor: colors,
                  borderWidth: 0,
                  data: methods
                }
              ]
            };
            var chDonutMethod = document.getElementById("log3");
            if (chDonutMethod) {
              logChart1 = new Chart(chDonutMethod, {
                type: 'pie',
                data: chDonutDataMethod,
                options: donutOptions
              });
              Chart.defaults.global.defaultFontColor = 'black';
            }


            methods = []
            labels = []
            labels2 = []
            
            @foreach($dept as $row)
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                labels.push("{{$row->type_name}}: " +formatMoney({{floatval($row->amount)}}) + "VND");
                labels2.push("{{$row->type_name}}");
                methods.push(parseFloat("{{floatval($row->amount)}}"))

            @endforeach


  
            console.log(methods, labels)


            var chDonutDataMethod = {
              labels: labels,
              datasets: [
                {
                  backgroundColor: colors,
                  borderWidth: 0,
                  data: methods
                }
              ]
            };
            var chDonutMethod = document.getElementById("log4");
            if (chDonutMethod) {
              logChart1 = new Chart(chDonutMethod, {
                type: 'pie',
                data: chDonutDataMethod,
                options: donutOptions
              });
              Chart.defaults.global.defaultFontColor = 'black';
            }


            methods = []
            labels = []
            labels2 = []
            
            @foreach($input as $row)
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                labels.push("{{$row->type_name}}: " +formatMoney({{floatval($row->amount)}}) + "VND");
                labels2.push("{{$row->type_name}}");
                methods.push(parseFloat("{{floatval($row->amount)}}"))

            @endforeach


   labels.push("Tiền bán BDS " +formatMoney({{floatval($total_buy)}}) + " VND");
                labels2.push("Tiền bán BDS");
                methods.push(parseFloat("{{floatval($total_buy)}}"))

            console.log(methods, labels)


            var chDonutDataMethod = {
              labels: labels,
              datasets: [
                {
                  backgroundColor: colors,
                  borderWidth: 0,
                  data: methods
                }
              ]
            };
            var chDonutMethod = document.getElementById("log1");
            if (chDonutMethod) {
              logChart1 = new Chart(chDonutMethod, {
                type: 'pie',
                data: chDonutDataMethod,
                options: donutOptions
              });
              Chart.defaults.global.defaultFontColor = 'black';
            }
            // donnut
            methods = []
            labels = []
            labels2 = []
             
            @foreach($output as $row)
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                labels.push("{{$row->type_name}}: " +formatMoney({{floatval($row->amount)}}) + " VND");
                labels2.push("{{$row->type_name}}");
                methods.push(parseFloat("{{floatval($row->amount)}}"))

            @endforeach

            var daily = parseFloat("{{$daily}}")

            labels.push("Chi phí hàng tháng : " +formatMoney(daily) + " VND");
            methods.push(daily)
            labels2.push("Chi phí hàng tháng  : " );
        
           
          

            console.log(methods, labels)
         
            var chDonutDataPort = {
              labels: labels,
              datasets: [
                {
                  backgroundColor: colors,
                  borderWidth: 0,
                  data: methods
                }
              ]
            };
            var chDonutPort = document.getElementById("log2");
            if (chDonutPort) {
              logChart2  = new Chart(chDonutPort, {
                type: 'pie',
                data: chDonutDataPort,
                options: donutOptions
              });
              Chart.defaults.global.defaultFontColor = 'black';
            }
              
            }
     auditChart()
  function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
};

  function Bars(){

            if (window.innerWidth <800 ){
            var size = 15;

          }else{

            var size = 20;
          }
        // $('#barChart').remove();
        // $('#barCon').append('<canvas  height="500" + id="barChart"><canvas>');
       
             $.ajax({
            type: "GET",
            url: "/icon/finance-line",
            success: function (response) {
                response = JSON.parse(response)
              console.log(response)

              time = response[0];
              done = response[1];
              dept = response[2]

var options = {
    responsive: true,
   tooltips: {
     callbacks: {
            label: (tooltipItem, data) => {
              // data for manipulation
              return formatMoney(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]) + "VND";
            },
          },

      mode: 'index'
   },
    stacked: false,
};

            var ctx = document.getElementById("barChart");
            var myChart = new Chart(ctx, {
              type: 'line',
              data: {
                labels: time,
                datasets: [{
                  label: 'Khoản thu dự kiến',
                 data : done,
                borderColor: 'red'
                },
                {
                  label: 'Khoảng thu thực',
                  data: dept,
                borderColor: 'blue'
                }
                ]
              },
              options: options
            });
            Chart.defaults.global.defaultFontColor = '#dcf3ff';

         



        }

          });
     }
        // Bars();

  </script>
<script type="text/javascript">
  $("#search-input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#camera-table tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
$("#search-input-step").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#step-table tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    function checkAll() {
      if($('#select-all').is(':checked') == true){
        $('.check-box').prop('checked', true);
      }
      else{
        $('.check-box').prop('checked', false);
      }
    }
</script>


<script>
   $("input").keypress(function(e) {
    //Enter key
    if (e.which == 13) {
      return false;
    }
  });
   
  function confirm_remove() {
          var remove = document.getElementById('device-remove');
          remove.addEventListener('click', function(e){
              swal({
                  title: "",
                  text: " bạn có chắc muốn xóa? ",
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
                    document.getElementById("remove-credential").click();
                    swal.close();
                  }
                  else {
                    swal.close();
                  }
                });
            });
        

         var remove = document.getElementById('step-remove');
          remove.addEventListener('click', function(e){
              swal({
                  title: "",
                  text: " bạn có chắc muốn xóa? ",
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
                    document.getElementById("remove-step").click();
                    swal.close();
                  }
                  else {
                    swal.close();
                  }
                });
            });
        }

        confirm_remove();

function editInputDetail(id){
  document.getElementById("EditId").value = id
  document.getElementById("EditName").value = document.getElementById("iname"+id).innerHTML
  document.getElementById("EditType").value = parseInt(document.getElementById("itype"+id).innerHTML)
  document.getElementById("Editdate").value = (document.getElementById("idate"+id).innerHTML)
  document.getElementById("EditDes").value = document.getElementById("ides"+id).innerHTML
  document.getElementById("EditAmountDisplay").value = document.getElementById("inum"+id).innerHTML
  formatForId("EditAmount")

  document.getElementById("deleteButton").href = "finance/delete/0/"+id


$("#EditInfoModal").modal()

}

function editAssetDetail(id){
  document.getElementById("EditId2").value = id
  document.getElementById("EditName2").value = document.getElementById("aname"+id).innerHTML
  document.getElementById("EditType2").value = parseInt(document.getElementById("atype"+id).innerHTML)
  document.getElementById("Editdate2").value = (document.getElementById("adate"+id).innerHTML)
  document.getElementById("EditDes2").value = document.getElementById("ades"+id).innerHTML
  document.getElementById("EditAmount2Display").value = document.getElementById("anum"+id).innerHTML
  formatForId("EditAmount2")

  document.getElementById("deleteButton2").href = "finance/delete/2/"+id


$("#EditInfoModal2").modal()

}

function editDeptetail(id){
  document.getElementById("EditId3").value = id
  document.getElementById("EditName3").value = document.getElementById("dname"+id).innerHTML
  document.getElementById("EditType3").value = parseInt(document.getElementById("dtype"+id).innerHTML)
  document.getElementById("Editdate3").value = (document.getElementById("ddate"+id).innerHTML)
  document.getElementById("EditDes3").value = document.getElementById("ddes"+id).innerHTML
  document.getElementById("EditAmount3Display").value = document.getElementById("dnum"+id).innerHTML
  formatForId("EditAmount3")

  document.getElementById("deleteButton3").href = "finance/delete/3/"+id


$("#EditInfoModal3").modal()

}

function editOutputDetail(id){



  document.getElementById("EditId1").value = id
  document.getElementById("EditName1").value = document.getElementById("oname"+id).innerHTML
  // document.getElementById("EditType1").value = document.getElementById("otype"+id).innerHTML

  console.log(document.getElementById("otype"+id).innerHTML)
            $("#EditType1").val(parseInt(document.getElementById("otype"+id).innerHTML)
);
  document.getElementById("EditDes1").value = document.getElementById("odes"+id).innerHTML
  document.getElementById("EditAmount1Display").value = document.getElementById("onum"+id).innerHTML
  console.log(document.getElementById("odate"+id).innerHTML)
  document.getElementById("Editdate1").value = (document.getElementById("odate"+id).innerHTML)
  formatForId("EditAmount1")
  document.getElementById("deleteButton1").href = "finance/delete/1/"+id


$("#EditInfoModal1").modal()

}

function showInfo(id,type){
  console.log(document.getElementById("des"+id).innerHTML)
  document.getElementById("InfoContent").innerHTML = '<div>'+document.getElementById("des"+id).innerHTML+'</div><div>'+document.getElementById("legal"+id).innerHTML+'</div>'


  html = ""
  if (document.getElementById("urlfull"+id).innerHTML != " ")
    html = html + "<img style='width: 100%;' src= '"+document.getElementById("urlfull"+id).innerHTML +"'><hr>"


  if (document.getElementById("urlnonfull"+id).innerHTML  != " ")
    html = html + "<img style='width: 100%;' src= '"+ document.getElementById("urlnonfull"+id).innerHTML +"'><hr>"

  console.log(html)
  document.getElementById("proInfoContent").innerHTML = html

        $("#infomation").modal()
}


    function openfileupload(id){
            document.getElementById("inputfile"+id).click();
    }

function formatForId(id){
    var value = document.getElementById(id+"Display").value
    value = parseFloat(value.replace(/,/g, ""))
                    .toFixed(0)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    console.log(value)
    console.log(value.replace(/,/g, ""))
    document.getElementById(id+"Display").value = value
    
    document.getElementById(id).value = value.replace(/,/g, "") 
}
</script>


  <script src="js-css/datatables/jquery.dataTables.js"></script>
  <script src="js-css/datatables/dataTables.bootstrap4.js"></script>

  <script>

     $(document).ready(function(){
    $('.nav-link').click(function(event){
        //remove all pre-existing active classes
        $('.tab-pane').removeClass('active');
        $("#"+this.href.split("#")[1]).addClass('active');

        //add the active class to the link we clicked
        // $(this).addClass('active');

        // event.preventDefault();
    });
});

    $('#input-table').DataTable();
    $('#output-table').DataTable();
    $('#dept-table').DataTable();
    $('#asset-table').DataTable();
var minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min =  document.getElementById("min").value
        var max = document.getElementById("max").value
        var date = data[3];
        if (
            ( min === "" && max === "" ) ||
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);
 

//  $.fn.dataTable.ext.search.push(
//     function( settings, data, dataIndex ) {
//         var min = parseInt( $('#min').val(), 10 );
//         var max = parseInt( $('#max').val(), 10 );
//         var age = parseFloat( data[3] ) || 0; // use data for the age column
 
//         if ( ( isNaN( min ) && isNaN( max ) ) ||
//              ( isNaN( min ) && age <= max ) ||
//              ( min <= age   && isNaN( max ) ) ||
//              ( min <= age   && age <= max ) )
//         {
//             return true;
//         }
//         return false;
//     }
// );
$(document).ready(function() {
    // Create date inputs
    minDate = document.getElementById("min").value
    minDate = document.getElementById("max").value
 
    // DataTables initialisation
    var table = $('#input-table').DataTable();
 
    var table2 = $('#output-table').DataTable();
    var table3 = $('#asset-table').DataTable();
    var table4 = $('#dept-table').DataTable();
 
    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
        table2.draw();
        table3.draw();
        table4.draw();
    });
});


    function openfileupload(){
            document.getElementById("inputfile").click();
    }

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
  $(document).ready(function() {
          if($("#notice_success").val() == 1){
            notifiSuccess($("#notice_success").attr("notifi"));
          }
          if($("#notice_warning").val() == 1){
            notifiWarning($("#notice_warning").attr("notifi"));
          }
        });
        
  </script>
<script type="text/javascript">
    
       function Bars(){

            if (window.innerWidth <800 ){
            var size = 15;

          }else{

            var size = 20;
          }
       
             $.ajax({
            type: "GET",
            url: "/finance-audit-bar",
            success: function (response) {
              // reponse = JSON.parse(response)
              console.log(response[0])

  methods = []
            labels = []
          var i = 0;
          var left = 0;
          var right = 0;
           for (i = 0;i < response[0].length;i++){
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                labels.push(response[0][i].new_date);
                methods.push(response[0][i].data)
            }


            var ctx = document.getElementById("barChart1");
            var myChart = new Chart(ctx, {
              type: 'horizontalBar',
              data: {
                labels: labels,
                datasets: [
                {
                  label: 'Số tiền',
                  data: methods,
                backgroundColor: '#dc3545',
                  borderWidth: 1
                }
                ]
              },
              options: {
    maintainAspectRatio: false,
                responsive: true,
                scales: {
                  xAxes: [{
            stacked: true,
                     scaleLabel: {
                        display: true,
                        labelString: ''
                      },
                    ticks: {
                      maxRotation: 90,
                      minRotation: 0,
                fontSize: size,

    callback: function(value, index, values) {
            return formatMoney(value) + "VND";
    }
                    }
                  }],
                  yAxes: [{
            stacked: true,
                    ticks: {
                      beginAtZero: false,
                fontSize: size
                    }
                  }]
                }
              }
            });
  methods = []
            labels = []
    for (i = 0;i < response[0].length;i++){
                // labels.push(value.type_name +": " +formatMoney(value.amount) + "VND (" +Number(value.percent).toFixed(2)*100+"%)");
                labels.push(response[1][i].new_date);
                methods.push(response[1][i].data)
            }

            var ctx = document.getElementById("barChart2");
            var myChart = new Chart(ctx, {
              type: 'horizontalBar',
              data: {
                labels: labels,
                datasets: [
                {
                  label: 'Số tiền ',
                  data: methods,
                backgroundColor: 'blue',
                  borderWidth: 1
                }
                ]
              },
              options: {
    maintainAspectRatio: false,
                responsive: true,
                scales: {
                  xAxes: [{
            stacked: true,
                     scaleLabel: {
                        display: true,
                        labelString: '',


                      },
                    ticks: {
                      maxRotation: 90,
                      minRotation: 0,
                fontSize: size,

    callback: function(value, index, values) {
            return formatMoney(value) + "VND";
    }
                    }
                  }],
                  yAxes: [{
            stacked: true,
                    ticks: {
                      beginAtZero: false,
                fontSize: size
                    }
                  }]
                }
              }
            });

 
            Chart.defaults.global.defaultFontColor = '#dcf3ff';

          



        }

          });
     }
        // Bars();

</script>

@endsection
