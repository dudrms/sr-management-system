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
      <form action="<?php echo base_url('/record');?>" name="record_con" id="record_con" method="post" accept-charset="utf-8">
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
        <div class="col-sm-auto">
          <a href="<?php echo site_url('/record/create') ?>" class="btn btn-primary mb-2"> + 신규작성</a>
        </div>
      </div>
      </form>
      <table class="table table-striped compact" id="record">
       <thead>
          <tr>
             <th width="10%">id</th>
             <th width="60%">title</th>
             <th>occur</th>
             <th>manager</th>
          </tr>
       </thead>
       <tbody>
          <?php if($record): ?>
          <?php foreach($record as $s): ?>
          <tr>
             <td width="10%">
              <?php if($s['manager']==$_SESSION['username']) { ?>
                  <?php echo $s['id'].' '; ?>
              <?php } else { ?> 
                  <?php echo $s['id']; ?>
              <?php } ?>
             </td>
             <td width="60%"><?php if($s['manager']==$_SESSION['username']) { ?>
                  <a href="<?php echo base_url('/record/edit/'.$s['id']);?>" >
                  <span style="color: blue;"><?php echo $s['title'].' '; ?></span>
              <?php } else { ?> 
                  <a href="<?php echo base_url('/record/view/'.$s['id']);?>" >
                  <?php echo $s['title']; ?>
              <?php } ?></td>
             <td><?php echo substr($s['record_date'],5,5); ?></td>
             <td><?php echo $s['manager']; ?></td>
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
      $('#record').DataTable({
        stateSave: true,
        "order": [[ 0, "desc" ]],
		'iDisplayLength': 12,
      });
  } );

  $( function() {
    $( "#from" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( "#to" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );

</script>