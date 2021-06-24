<!doctype html>
<html lang="en">
  <head>
    <?php include 'common-lib.php';?>    
    <title>SR Management</title>
  </head>
  <body>
    <div class="container mt-1">
      <?php include 'navbar.php';?>
  </br>

  <form action="<?php echo base_url('/record/store');?>" name="record_create" id="record_create" method="post" accept-charset="utf-8">

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-sm">제목</span>
      </div>
      <input type="text" id="title" name="title" class="form-control" placeholder="내용을 간략하게 작성하세요">
      <a href="#" onclick="window.open('/sr/sr/index/y', 'PopupWin', 'width=1000,height=600');" class="btn btn-primary btn-sm">SR리스트 POPUP</a>
    </div>

    <textarea name="content"></textarea>
    <script>CKEDITOR.replace( 'content' , {
      height: 350
    });</script>
    </br>

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend" id="inputGroup-sizing-default">
        <span class="input-group-text" >작성일</span>
      </div>
      <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="record_date" id="record_date">
    </div>

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="inputGroup-sizing-default">작성자</span>
      </div>
      <input type="text" name="manager" id="manager" class="form-control" value="<?php echo $_SESSION['username'] ?>" readonly >
    </div>


    <button type="submit" id="send_form" class="btn btn-success">등록</button>
    <a href="<?php echo site_url('/record') ?>" class="btn btn-primary">취소</a>

  </form>

</div>

</body>
</html>

<script>
$('input[type="text"]').keydown(function() {
  if (event.keyCode === 13) {
    event.preventDefault();
  };
});

$( function() {
    $( "#record_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
});

$(document).ready(function(){ 
  $("#record_create").submit(function(event){
    var title = document.getElementById('title').value;
    var record_date = document.getElementById('record_date').value;

    if (title=='') {alert ('제목을 입력해야 합니다.'); return false;}
    if (record_date=='') {alert ('요청일은 입력해야 합니다.'); return false;}

    return true;
  });
});

</script>