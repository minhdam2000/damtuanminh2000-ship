@extends('../layouts/index')
@section('content')

 
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700" rel="stylesheet" />
    <link href="js/search/css/main.css" rel="stylesheet" />

    <div class="s013">
            <form action="warehouse/image-list" method="POST">
        <fieldset>
          <legend>TÌM KIẾM TỪ KHO DỮ LIỆU</legend>
        </fieldset>
        <div class="inner-form">
          <div class="left">
            <div class="input-wrap first">
              <div class="input-field first">
                <label>Tìm kiếm kho dữ liệu</label>
                <input class="form-control"  type="hidden" name="_token" value="{{csrf_token()}}">  
                <input name="tags" type="text" placeholder="ví dụ: Xuân An, Hòa Bình, ..." />
              </div>
            </div>
            <div class="input-wrap second">
              <div class="input-field second">
                <label>Loại</label>
                <div class="input-select">
                  <select name="type" data-trigger="" name="choices-single-defaul">
                    <option value="1" placeholder="">Hình ảnh</option>
                    <option value="2">Văn bản</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <button class="btn-search" type="submit">TÌM KIẾM</button>
        </div>
      </form>
    </div>
    <script src="js/search/js/extention/choices.js"></script>
    <script>
      const choices = new Choices('[data-trigger]',
      {
        searchEnabled: false,
        itemSelectText: '',
      });

    </script>

@endsection

