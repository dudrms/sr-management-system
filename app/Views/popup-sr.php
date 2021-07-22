<!doctype html>
<html lang="en">
  <head>
    <?php include 'common-lib.php';?>    
    <title>SR Management</title>
  </head>
  <body>
    <div class="container mt-1">
      <br>

      <form action="<?php echo base_url('/sr/index/y');?>" name="sr_con" id="sr_con" method="post" accept-charset="utf-8">
      <div class="row">
      <div class="col-sm-auto">
        <label for="colFormLabel" class="col-sm-auto col-form-label">FROM</label>
      </div>
      <div class="col-sm-auto">
        <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="from" id="from" value="<?php echo $con['from'] ?>">
      </div>
      <div class="col-sm-auto">
        <label for="colFormLabel" class="col-sm-auto col-form-label">TO</label>
      </div>
      <div class="col-sm-auto">
        <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="to" id="to" value="<?php echo $con['to'] ?>">
      </div>
      <div class="col-sm-auto">
      <label for="colFormLabel" class="col-sm-auto col-form-label">STATUS</label>
      </div>
      <div class="col-sm-auto">
        <select class="form-select" name="status" id="status">
          <option value="">전체</option>
          <?php if($status): ?>
              <?php foreach($status as $s): ?>
                <?php if($con['status'] == $s['code']) { ?>
                  <option selected value="<?php echo $s['code'] ?>"><?php echo $s['description'] ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $s['code'] ?>"><?php echo $s['description'] ?></option>
                <?php } ?>
          <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>

      <label for="colFormLabel" class="col-sm-auto col-form-label">MANAGER</label>
      <div class="col-sm-auto">
        <select class="form-select" name="manager" id="manager">
          <option value="">전체</option>
          <?php if($users): ?>
              <?php foreach($users as $u): ?>
                <?php if($con['manager'] == $u['name']) { ?>
                  <option selected value="<?php echo $u['name'] ?>"><?php echo $u['name'] ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $u['name'] ?>"><?php echo $u['name'] ?></option>
                <?php } ?>
          <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>

      <div class="col-sm-auto">
        <button type="submit" id="send_form" class="btn btn-info mb-2">조회</button>
      </div>
      
    </div>
    </form>

    <table class="table class=cell-border compact stripe" id="sr">
       <thead>
          <tr>
             <th width="10%">SR No.</th>
             <th width="60%">SR Name</th>
             <th>Client</th>
             <th>Manager</th>
             <th>Occur</th>
             <th>Status</th>
          </tr>
       </thead>
       <tbody>
          <?php if($sr): ?>
          <?php foreach($sr as $s): ?>
          <tr>
             <td width="10%">
                <a href="<?php echo base_url('/sr/view/'.$s['sr_id'].'/y');?>" >
                  <?php echo $s['sr_id']; ?>
             </td>
             <td width="60%"><?php if($s['manager']==$_SESSION['username']) { ?>
                  <span style="color: blue;"><?php echo $s['title'].' '; ?></span>
              <?php } else { ?> 
                  <?php echo $s['title']; ?>
              <?php } ?></td>
             <td><?php echo $s['client']; ?></td>
             <td><?php echo $s['manager']; ?></td>
             <td><?php echo substr($s['occur_date'],5,5); ?></td>
             <td><?php echo $s['status_desc']; ?></td>
          </tr>
         <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
    </table>
  </div>
 
</body>
</html>

<script>
  $(document).ready( function () {
      $('#sr').DataTable({
        stateSave: true,
        "order": [[ 0, "desc" ]]
      });
  } );

  $( function() {
    $( "#from" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( "#to" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );

</script>