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

      <form action="<?php echo base_url('/srdownload');?>" name="sr_con" id="sr_con" method="post" accept-charset="utf-8">
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
          <div class="col-sm-auto">
            <label for="colFormLabel" class="col-sm-auto col-form-label">MANAGER</label>
          </div>
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

      <table class="table table-striped compact" id="sr">
       <thead>
          <tr>
             <th>SR No.</th>
             <th>SR Name</th>
             <th>SR Content</th>
             <th>Manager</th>
             <th>Occur</th>
             <th>Status</th>
             <th>type1_desc</th>
             <th>type2_desc</th>
             <th>type3_desc</th>
          </tr>
       </thead>
       <tbody>
          <?php if($sr): ?>
          <?php foreach($sr as $s): ?>
          <tr>
             <td><?php echo $s['sr_id']; ?></td>
             <td><?php echo $s['title']; ?></td>
             <td><?php echo $s['ctx']; ?></td>
             <td><?php echo $s['manager']; ?></td>
             <td><?php echo substr($s['occur_date'],5,5); ?></td>
             <td><?php echo $s['status_desc']; ?></td>
             <td><?php echo $s['type1_desc']; ?></td>
             <td><?php echo $s['type2_desc']; ?></td>
             <td><?php echo $s['type3_desc']; ?></td>
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
        "order": [[ 0, "desc" ]],
        'iDisplayLength': 12,
        dom: 'Blfrtip',
        buttons: [{
            extend: 'csv',
            text: 'Excel',
            charset: 'utf-8',
            extension: '.csv',
            fieldSeparator: ',',
            fieldBoundary: '',
            filename: 'export',
            bom: true
        }]
      });
  } );

  $( function() {
    $( "#from" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( "#to" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );

</script>