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
      <a href="<?php echo site_url('/codes/create') ?>" class="btn btn-info mb-2">신규코드</a>

     <!-- <table class="table table-sm table-hover" id="codes"> -->
     <table class="table class=cell-border compact stripe" id="codes">
       <thead>
          <tr>
             <th>code</th>
             <th>description</th>
             <th>category</th>
             <th>Action</th>
          </tr>
       </thead>
       <tbody>
          <?php if($codes): ?>
          <?php foreach($codes as $code): ?>
          <tr>
             <td><?php echo $code['code']; ?></td>
             <td><?php echo $code['description']; ?></td>
             <td><?php echo $code['category']; ?></td>
             <td>
              <a href="<?php echo base_url('/codes/edit/'.$code['code']);?>" >[Edit]</a>
              <!-- <a href="<?php echo base_url('/codes/delete/'.$code['code']);?>" onclick="return confirm('선택한 코드를 삭제하시겠습니까 ?')">[Delete]</a> -->
              </td>
          </tr>
         <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
     </table>

     </br>
     <span class="badge bg-info text-dark">Info</span> 코드 삭제를 원하시면 관리자에게 문의하십시오.
     </br>
    </div>  
  </body>
</html>

<script>
  $(document).ready( function () {
      $('#codes').DataTable({
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