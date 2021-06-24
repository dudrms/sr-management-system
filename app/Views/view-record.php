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

  <form action="<?php echo base_url('/record/update');?>" name="record_create" id="record_create" method="post" accept-charset="utf-8">

    <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $record['id'] ?>">

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-sm">ID</span>
      </div>
      <input type="text" id="recordid" name="recordid" class="form-control" value="<?php echo $record['id'] ?>" readonly>
      <a href="#" onclick="window.open('/sr/sr/index/y', 'PopupWin', 'width=1000,height=600');" class="btn btn-primary btn-sm">SR리스트 POPUP</a>
    </div>

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-sm">제목</span>
      </div>
      <input type="text" id="title" name="title" class="form-control" value="<?php echo $record['title'] ?>" readonly>
    </div>

    <textarea name="content" id="content"><?php echo $record['content'] ?></textarea>
    <script>CKEDITOR.replace( 'content', {
      height: 400
    });</script>
    </br>

    
    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">작성일</span>
      </div>
      <input type="text" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo $record['record_date'] ?>" name="record_date" id="record_date" readonly>
    </div>

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
       <span class="input-group-text" id="inputGroup-sizing-default">작성자</span>
      </div>
      <input type="text" name="manager" id="manager" class="form-control" value="<?php echo $record['manager'] ?>" readonly >
    </div>

    <!--<button type="submit" id="send_form" class="btn btn-success">수정</button>-->

    <a href="<?php echo site_url('/record/cancel') ?>" class="btn btn-primary">닫기</a>

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

</script>