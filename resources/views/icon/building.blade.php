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
@media(max-width:868px) {
.font-weight-bold{
  font-size: 8px;
}

}

</style>
    <div class="content-camera">
          <div class="row row-content">
            <div class="row-title-proxy">
<div class="container mt-3">
    <div class="row">
       <!--  <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-0 col-sm-3  col-3 offset-sm-1 my-lg-0 my-2">
          <a href="/con-map">
            <div class="mycard"> <img class="card-img-top"src="js-css/img/icon/bigmap.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Bản đồ xây dựng </h7>
                    
                </div>
            </div>
          </a>
        </div>
           <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-0 col-sm-3  col-3 offset-sm-1 my-lg-0 my-2">
          <a href="contribute/list">
            <div class="mycard"> <img class="card-img-top"src="js-css/img/icon/warehouse.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Kho dữ liệu xây dựng</h7>
                    
                </div>
            </div>
          </a>

                </div> -->
                
     <!--  <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-0 col-sm-3  col-3 offset-sm-1 my-lg-0 my-2">
          <a href="#">
            <div class="mycard"> <img class="card-img-top"src="js-css/img/icon/xd.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Kiểm tra vật liệu</h7>
                    
                </div>
            </div>
          </a>
        </div>  -->
 <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-0 col-sm-3  col-3 offset-sm-1 my-lg-0 my-2">
          <a href="#">
            <div class="mycard"> <img class="card-img-top"src="js-css/img/icon/machine.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Tiến độ xây dựng </h7>
                    
                </div>
            </div>
          </a>
        </div>
         <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
          <a href="/canlender/calendar_list/18">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/event.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Lịch công ty</h7>
                    
                </div>
            </div>
          </a>
        </div>
  <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-0 col-sm-3  col-3 offset-sm-1 my-lg-0 my-2">
          <a href="contribute-task">
            <div class="mycard"> <img class="card-img-top"src="js-css/img/icon/house-xd.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Tiến độ hoàn thiện </h7>
                    
                </div>
            </div>
          </a>
        </div>
    
      <!--  <div class="col-lg-3 col-md-3 col-sm-3 col-3  my-2">
          <a href="/forum">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/
complain.webp">
                <div class="card-body">
                            <h7 class="font-weight-bold">Khiếu nại</h7>
                   
                </div>
            </div>
          </a>
        </div>
 -->
            <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-1 col-sm-3 col-3 offset-sm-1 my-lg-0 my-2">

          <a href="/">
            <div class="mycard"> <img class="card-img-top" src="js-css/img/icon/logout.png">
                <div class="card-body">
                            <h7 class="font-weight-bold"> Quay lại</h7>
                    
                </div>
            </div>
        </a>
        </div>


       
    </div>
</div></div></div></div>

<script type="text/javascript">
    menu_close()
</script>
@endsection
