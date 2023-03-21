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
}
.card-body{

    text-align: center;
}
@media(max-width:768px) {
    body {
        height: 100%
    }
}
</style>
    <div class="content-camera">
          <div class="row row-content">
            <div class="row-title-proxy">
<div class="container mt-3">
    <div class="row">
        <div class="col-lg-3 col-md-6 offset-md-0 offset-sm-0 col-sm-8  col-4 offset-sm-1 my-lg-0 my-2">
          <a href="/map">
            <div class="card"> <img class="card-img-top"src="js-css/img/icon/bigmap.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Bản đồ</h7>
                    
                </div>
            </div>
          </a>
        </div>
      <div class="col-lg-3 col-md-6 offset-md-0 offset-sm-0 col-sm-8  col-4 offset-sm-1 my-lg-0 my-2">
          <a href="/process/view/1">
            <div class="card"> <img class="card-img-top"src="js-css/img/icon/legal.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Pháp lý và biểu mẫu</h7>
                    
                </div>
            </div>
          </a>
        </div>

      <div class="col-lg-3 col-md-6 offset-md-0 offset-sm-1 col-sm-8 col-4 offset-sm-1 my-lg-0 my-2">
              <a href="/finance">
                <div class="card"> <img class="card-img-top" src="js-css/img/icon/finance.png">
                    <div class="card-body">
                                <h7 class="font-weight-bold">Quản lý tài chính</h7>
                        
                    </div>
                </div>
              </a>
        </div>
          <div class="col-lg-3 col-md-6 offset-md-0 offset-sm-1 col-sm-8 col-4 offset-sm-1 my-lg-0 my-2">
          <a href="/statistic">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/statistic.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Báo cáo bán hàng</h7>
                    
                </div>
            </div>
          </a>
        </div>

          <div class="col-lg-3 col-md-6 offset-md-0 offset-sm-1 col-sm-8 col-4 offset-sm-1 my-lg-0 my-2">
          <a href="/hr/plot">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/staff.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Nhân sự</h7>
                    
                </div>
            </div>
          </a>
        </div>

       
        <div class="col-lg-3 col-md-6 offset-md-0 offset-sm-1 col-sm-8 col-4 offset-sm-1 my-lg-0 my-2">
          <a href="/admin-job-list">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/jobs.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">
        Giao việc </h7>
                    
                </div>
            </div>
          </a>
        </div>
         <div class="col-lg-3 col-md-6 offset-md-0 offset-sm-1 col-sm-8 col-4 offset-sm-1 my-lg-0 my-2">
            <a href="/listevent">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/event.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Thông báo</h7>
                    
                </div>
            </div>
        </a>
        </div>
    <div class="col-lg-3 col-md-6 offset-md-0 offset-sm-1 col-sm-8 col-4 offset-sm-1 my-lg-0 my-2">
          <a href="/forum">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/
discuss.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Thảo luận</h7>
                    
                </div>
            </div>
          </a>
        </div>
         <div class="col-lg-3 col-md-6 offset-md-0 offset-sm-1 col-sm-8 col-4 offset-sm-1 my-lg-0 my-2">
          <a href="/consumer-list">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/hr.png">
                <div class="card-body">
                            <h7 class="font-weight-bold">Thông tin khách hàng</h7>
                    
                </div>
            </div>
          </a>
        </div>

    <div class="col-lg-3 col-md-6 offset-md-0 offset-sm-1 col-sm-8 col-4 offset-sm-1 my-lg-0 my-2">
          <a href="/sale/index">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/bill.webp">
                <div class="card-body">
                            <h7 class="font-weight-bold">Thông tin giao dịch</h7>
                    
                </div>
            </div>
          </a>
        </div>


         <div class="col-lg-3 col-md-6 offset-md-0 offset-sm-1 col-sm-8 col-4 offset-sm-1 my-lg-0 my-2">
            <a href="/personal-page">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/person.png">
                <div class="card-body">
                            <h7 class="font-weight-bold"> Trang cá nhân</h7>
                    
                </div>
            </div>
        </a>
        </div>

            <div class="col-lg-3 col-md-6 offset-md-0 offset-sm-1 col-sm-8 col-4 offset-sm-1 my-lg-0 my-2">

          <a href="/logoutkms">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/logout.png">
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
}, 5000);
    menu_close()
</script>
@endsection
