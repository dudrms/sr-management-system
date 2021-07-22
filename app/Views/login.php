<!doctype html>
<html lang="en">
  <head>
    <?php include 'common-lib.php';?>    
    <title>SR Management</title>
  </head>
  <body>
  <div class="container mt-1">
    <br>
    <?= \Config\Services::validation()->listErrors(); ?>
 
    <span class="d-none alert alert-success mb-3" id="res_message"></span>

        <form action="<?php echo base_url('/login/in');?>" name="user" id="user" method="post" accept-charset="utf-8">
 
        <div class="row">
          <div class="col-sm-auto">
            <label for="formGroupExampleInput">피엠씨텍 유지보수 작업기록관리</label>
          </div> 
        </div> 
        <div class="row">
          <div class="col-sm-300">
            <input type="text" name="username" class="form-control" id="formGroupExampleInput" placeholder="사용자 이름을 입력해 주세요">
          </div> 
        </div> 

        <?php if($msg['message'] != '') { ?>
        <span><?php echo $msg['message'];?></span>
        <?php } ?>
 
        <div class="row">
          <div class="col-sm-auto">
           <button type="submit" id="send_form" class="btn btn-success">시작</button>
          </div>
        </div>

        </form>
</div>

</body>
</html>

<script>
   if ($("#user").length > 0) {
      $("#user").validate({
      
    rules: {
      username: {
        required: true,
      },   
    },
    messages: {
        
      username: {
        required: "입력이 되지 않았습니다. 다시 입력해 주세요.",
      }, 
    },
  })
}
</script>