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
        <form action="<?php echo base_url('/codes/store');?>" name="code_create" id="code_create" method="post" accept-charset="utf-8">
 
          <div class="form-group">
            <label for="code">코드</label>
            <input type="text" name="code" class="form-control" id="code" placeholder="코드를 입력해 주세요">
             
          </div> 
 
          <div class="form-group">
            <label for="description">코드설명</label>
            <input type="text" name="description" class="form-control" id="description" placeholder="코드설명을 입력해 주세요">
             
          </div>

          <div class="form-group">
            <label for="category">카테고리</label>
            <input type="text" name="category" class="form-control" id="category" placeholder="카테고리를 입력해 주세요">
             
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
   if ($("#code_create").length > 0) {
      $("#code_create").validate({
      
    rules: {
      code: {
        required: true,
      },
  
      description: {
        required: true,
      },

      category: {
        required: true,
      },   
    },
    messages: {
        
      code: {
        required: "Please enter",
      },
      description: {
        required: "Please enter",
      }, 
      category: {
        required: "Please enter",
      },

    },
  })
}
</script>