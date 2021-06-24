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
        <form action="<?php echo base_url('/codes/update');?>" name="edit-code" id="edit-code" method="post" accept-charset="utf-8">
 
          <input type="hidden" name="code" class="form-control" id="code" value="<?php echo $code['code'] ?>">
 
          <div class="form-group">
            <label for="formGroupExampleInput">description</label>
            <input type="text" name="description" class="form-control" id="description" placeholder="Please enter name" value="<?php echo $code['description'] ?>">
             
          </div> 
 
          <div class="form-group">
            <label for="email">category</label>
            <input type="text" name="category" class="form-control" id="category" placeholder="Please enter email id" value="<?php echo $code['category'] ?>">
             
          </div>   
 
          <div class="form-group">
           <button type="submit" id="send_form" class="btn btn-success">Submit</button>
          </div>
          
        </form>
      </div>
 
    </div>
  
</div>

</body>
</html>

<script>
   if ($("#edit-code").length > 0) {
      $("#edit-code").validate({
      
    rules: {
      description: {
        required: true,
      },
  
      category: {
        required: true,
      }, 
    },
    messages: {
        
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