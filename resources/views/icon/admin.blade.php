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

.h4 {
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
        <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-0 col-sm-3 col-3 offset-sm-1 my-lg-0 my-2">
          <a href="/map">
            <div class="card"> <img class="card-img-top"src="js-css/img/icon/bigmap.png">
                <div class="card-body">
                            <h4 class="font-weight-bold">Bản đồ</h4>
                    
                </div>
            </div>
          </a>
        </div>
      <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-0 col-sm-3 col-3 offset-sm-1 my-lg-0 my-2">
          <a href="/consumer-legal">
            <div class="card"> <img class="card-img-top"src="js-css/img/icon/legal.png">
                <div class="card-body">
                            <h4 class="font-weight-bold">Pháp lý và biểu mẫu</h4>
                    
                </div>
            </div>
          </a>
        </div>

        <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-1 col-sm-3col-3 offset-sm-1 my-lg-0 my-2">
          <a href="/consumer-list">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/hr.png">
                <div class="card-body">
                            <h4 class="font-weight-bold">Thông tin khách hàng</h4>
                    
                </div>
            </div>
          </a>
        </div>

    <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-1 col-sm-3col-3 offset-sm-1 my-lg-0 my-2">
          <a href="/sale/index">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/bill.webp">
                <div class="card-body">
                            <h4 class="font-weight-bold">Thông tin giao dịch</h4>
                    
                </div>
            </div>
          </a>
        </div>
          <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-1 col-sm-3col-3 offset-sm-1 my-lg-0 my-2">
          <a href="/hr/staff-list">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/staff.png">
                <div class="card-body">
                            <h4 class="font-weight-bold">Nhân sự</h4>
                    
                </div>
            </div>
          </a>
        </div>


        <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-1 col-sm-3col-3 offset-sm-1 my-lg-0 my-2">
          <a href="/job-list">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/jobs.png">
                <div class="card-body">
                            <h4 class="font-weight-bold">
        Giao việc </h4>
                    
                </div>
            </div>
          </a>
        </div>
         <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-1 col-sm-3col-3 offset-sm-1 my-lg-0 my-2">
            <a href="/listevent">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/event.png">
                <div class="card-body">
                            <h4 class="font-weight-bold">Thông báo</h4>
                    
                </div>
            </div>
        </a>
        </div>
    <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-1 col-sm-3col-3 offset-sm-1 my-lg-0 my-2">
          <a href="/forum">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/
discuss.png">
                <div class="card-body">
                            <h4 class="font-weight-bold">Thảo luận</h4>
                    
                </div>
            </div>
          </a>
        </div>
         <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-1 col-sm-3col-3 offset-sm-1 my-lg-0 my-2">
            <a href="/personal-page">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/person.png">
                <div class="card-body">
                            <h4 class="font-weight-bold"> Trang cá nhân</h4>
                    
                </div>
            </div>
        </a>
        </div>

            <div class="col-lg-3 col-md-3 offset-md-0 offset-sm-1 col-sm-3col-3 offset-sm-1 my-lg-0 my-2">

          <a href="/logoutkms">
            <div class="card"> <img class="card-img-top" src="js-css/img/icon/logout.png">
                <div class="card-body">
                            <h4 class="font-weight-bold"> Đăng xuất</h4>
                    
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
