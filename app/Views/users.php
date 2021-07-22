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
      <a href="<?php echo site_url('/users/create') ?>" class="btn btn-info mb-2">신규사용자</a>

      <!-- <table class="table table-sm table-hover" id="users"> -->
      <table class="table class=cell-border compact stripe" id="users">
       <thead>
          <tr>
             <th>Id</th>
             <th>Name</th>
             <th>Email</th>
             <th>Action</th>
          </tr>
       </thead>
       <tbody>
          <?php if($users): ?>
          <?php foreach($users as $user): ?>
          <tr>
             <td><?php echo $user['id']; ?></td>
             <td><?php echo $user['name']; ?></td>
             <td><?php echo $user['email']; ?></td>
             <td>
              <a href="<?php echo base_url('/users/edit/'.$user['id']);?>" >[Edit]</a>
              <!-- <a href="<?php echo base_url('/users/delete/'.$user['id']);?>" onclick="return confirm('선택한 사용자를 삭제하시겠습니까 ?')">[Delete]</a> -->
              </td>
          </tr>
         <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
      </table>

     <br>
     <span class="badge bg-info text-dark">Info</span> 사용자 삭제를 원하시면 관리자에게 문의하십시오.
     <br>
    </div>  
  </body>
</html>

<script>

  $(document).ready( function () {
      $('#users').DataTable({
        stateSave: true,
        "order": [[ 0, "asc" ]],
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
</script>