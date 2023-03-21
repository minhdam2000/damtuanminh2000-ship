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

.badge {
    font-size: 35px;
  position: absolute;
  top: -10px;
  right: -10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}

.results {
    font-weight: 600
}

select {
    outline: none;
    padding: 0px 4px;
    cursor: pointer;
    background: inheritborder: 0;
    border-width: 0;
}

.mycard {
    border: 1px solid transparent!important;
    font-size: small;
    border: none;
    cursor: pointer;
    background-color: transparent !important;
}

.mycard:hover {
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
        font-size: 07rem
    }
    .
    .badge {
        font-size: 15px;
    }
}

@media(max-width:330px) {
    .results {
        font-size: 0.6rem
    }
}

@media(min-height: 700px) {
    body {
        height: 100vh
    }
}
.card-body{

    text-align: center;
}
@media(max-width:768px) {
    body {
        height: 100%
    }
     .badge {
        font-size: 15px;
    }



    
}

}

</style>
    <div class="content-camera">
          <div class="row row-content">
            <div class="row-title-proxy">
<div class="container mt-3">
    <div class="row">

      <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
              <a href="/finance">
                <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/fin.png">
                    <div class="card-body">
                                <h7 class="font-weight-bold">Quản lý tài chính</h7>
                        
                    </div>
                </div>
              </a>
        </div>

      <!--    <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
          <a href="/icon/build">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/build.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Quản lý xây dựng</h7>
                    
                </div>
            </div>
          </a>
        </div>


          <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
          <a href="/icon/sale">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/sell.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Quản lý bán hàng</h7>
                    
                </div>
            </div>
          </a>
        </div> -->
        <!--   <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
          <a href="/icon/human">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/staff.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Quản lý nhân sự</h7>
                    
                </div>
            </div>
          </a>
        </div> -->

        <!--   <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
          <a href="/hr/index">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/staff.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Quản lý nhân sự</h7>
                    
                </div>
            </div>
          </a>
        </div>
       
 -->
         

        
       <!--  <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
          <a href="/admin-job-list">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/jobs.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">
        Giao việc </h7>
                    
                </div>
            </div>
          </a>
        </div> -->

         <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
            <a href="/schedule/staff">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/jobs.png">
                <div class="card-body">
                            <h7 class="font-weight-bold"> Giao việc</h7>
                       @if($job > 0)
                     <span class="badge">{{$job}}</span>
                    @endif 
                </div>
            </div>
        </a>
        </div>
 <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
          <a href="warehouse">
            <div class="mycard"> <img class="card-img-top"src="js-css/img/icon/warehouse.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Kho dữ liệu</h7>
                      
                </div>
            </div>
          </a>

                </div>
<!--  <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
          <a href="warehouse/sreach">
            <div class="mycard"> <img class="card-img-top"src="js-css/img/icon/sreach.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Tìm kiếm</h7>
                      
                </div>
            </div>
          </a>

                </div> -->

    
 
 <!-- 
    <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
          <a href="/chatify">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/
discuss.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Tin nhắn</h7>
                      @if($mess > 0)
                     <span class="badge">{{$mess}}</span>
                    @endif
                </div>
            </div>
          </a>
        </div> -->
<!-- 
        <div class="col-lg-3 col-md-3 col-sm-3  col-3  my-2">
          <a href="/map">
            <div class="mycard"> <img class="card-img-top"src="js-css/img/icon/bigmap.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Bản đồ</h7>
                    
                </div>
            </div>
          </a>
        </div> -->

      <!--    <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
          <a href="/consumer-list">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/hr.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Thông tin khách hàng</h7>
                    
                </div>
            </div>
          </a>
        </div>

    <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
          <a href="/sale/index">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/bill.webp">
                <div class="card-body">
                            <h7 class="font-weight-bold">Thông tin giao dịch</h7>
                    
                </div>
            </div>
          </a>
        </div> -->


         <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
            <a href="/personal-page">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/person.png">
                <div class="card-body">
                            <h7 class="font-weight-bold"> Trang cá nhân</h7>
                    
                </div>
            </div>
        </a>
        </div>

<div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
            <a href="/regulation">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/intro.png">
                <div class="card-body">
                            <h7 class="font-weight-bold"> Quy định công ty</h7>
                    
                </div>
            </div>
        </a>
        </div>

    <!--     <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
            <a href="/doc">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/info.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">  Hướng dẫn sử dụng</h7>
                    
                </div>
            </div>
        </a>
        </div> -->
            <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">

          <a href="/logoutkms">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/logout.png">
                <div class="card-body">
                            <h7 class="font-weight-bold"> Đăng xuất</h7>
                    
                </div>
            </div>
        </a>
        </div>


       
    </div>
</div></div></div></div>

<script type="text/javascript">
    window.setTimeout(function () {
  window.location.reload();
}, 30000);
    menu_close()
</script>
@endsection
