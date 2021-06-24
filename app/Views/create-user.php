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

    <br>
    <?= \Config\Services::validation()->listErrors(); ?>
 
    <span class="d-none alert alert-success mb-3" id="res_message"></span>
 
    <div class="row">
      <div class="col-md-9">
        <form action="<?php echo base_url('public/index.php/users/store');?>" name="user_create" id="user_create" method="post" accept-charset="utf-8">
 
          <div class="form-group">
            <label for="name">사용자이름</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="사용자 이름을 입력해 주세요">
             
          </div> 
 
          <div class="form-group">
            <label for="email">E메일</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="이메일 주소를 입력해 주세요">
             
          </div>   
 
          <div class="form-group">
           <button type="submit" id="send_form" class="btn btn-success">저장</button>
          </div>
          
        </form>
      </div>
 
    </div>
  
</div>

</body>
</html>

<script>
   if ($("#user_create").length > 0) {
      $("#user_create").validate({
      
    rules: {
      name: {
        required: true,
      },
  
      email: {
        required: true,
        maxlength: 50,
        email: true,
      },   
    },
    messages: {
        
      name: {
        required: "이름을 입력하셔야 합니다.",
      },
      email: {
        required: "Please enter valid email",
        email: "Please enter valid email",
        maxlength: "The email name should less than or equal to 50 characters",
        }, 
    },
  })
}
</script>