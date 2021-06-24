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

      <form action="<?php echo base_url('/main');?>" name="sr_con" id="sr_con" method="post" accept-charset="utf-8">
        <div class="row">
          <div class="col-sm-auto">
            <label for="colFormLabel" class="col-sm-auto col-form-label">기준년월 : </label>
          </div>
          <div class="col-sm-auto">
            <input type="text" class="form-control" placeholder="YYYYMM" name="yyyymm" id="yyyymm" value="<?php echo $con['yyyymm'] ?>">
          </div>
          <div class="col-sm-auto">
            <button type="submit" id="send_form" class="btn btn-info mb-2">조회</button>
          </div>
        </div>
      </form>

      </br>
      
      <h6><b><?php echo substr($con['yyyy_mm'],0,4); ?> 월별 완료현황 (건)</b></h6>

      <table class="table table-sm table-bordered" id="status">
        <thead class="table-dark">
          <tr>
            <th width="10%">연월</th>
            <th>1월</th>
            <th>2월</th>
            <th>3월</th>
            <th>4월</th>
            <th>5월</th>
            <th>6월</th>
            <th>7월</th>
            <th>8월</th>
            <th>9월</th>
            <th>10월</th>
            <th>11월</th>
            <th>12월</th>
          </tr>
        </thead>
        <tbody>
          <?php if($s2s): ?>
          <?php foreach($s2s as $s): ?>
          <tr>
            <td width="10%"><?php echo $s['yyyy']; ?></td>
            <td><?php echo $s['m1']; ?></td>
            <td><?php echo $s['m2']; ?></td>
            <td><?php echo $s['m3']; ?></td>
            <td><?php echo $s['m4']; ?></td>
            <td><?php echo $s['m5']; ?></td>
            <td><?php echo $s['m6']; ?></td>
            <td><?php echo $s['m7']; ?></td>
            <td><?php echo $s['m8']; ?></td>
            <td><?php echo $s['m9']; ?></td>
            <td><?php echo $s['m10']; ?></td>
            <td><?php echo $s['m11']; ?></td>
            <td><?php echo $s['m12']; ?></td>
          </tr>
          <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    
      <div class="chartjs-wrapper">
        <canvas id="chartjs-1" class="chartjs" width="undefined" height="50vw"></canvas>
      </div>

      </br>
      
      <h6><b> 7일 이내 완료되어야 할 SR </b></h6>

      <table class="table table-sm table-bordered" id="status">
        <thead class="table-dark">
            <tr>
              <th width="10%">SRID</th>
              <th>SR명</th>
              <th>상태</th>
              <th>완료요청일</th>
              <th>담당자</th>
            </tr>
        </thead>
        <tbody>
            <?php if($s6s): ?>
            <?php foreach($s6s as $s): ?>

              <tr>
              <td width="10%"><?php if($s['manager']==$_SESSION['username']) { ?>
                  <a href="<?php echo base_url('/sr/edit/'.$s['sr_id']);?>" >
                    <?php echo $s['sr_id'].' '; ?>
                <?php } else { ?> 
                  <a href="<?php echo base_url('/sr/view/'.$s['sr_id']);?>" >
                    <?php echo $s['sr_id']; ?>
                <?php } ?></td>
              
              <td><?php echo $s['title']; ?></td>
              <td><?php echo $s['status_desc']; ?></td>
              <td><?php echo $s['require_date']; ?></td>
              <td><?php echo $s['manager']; ?></td>
              </tr>

          <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>

      </br>
      
      <h6><b><?php echo substr($con['yyyy_mm'],0,4); ?> 진행요약 (건)</b></h6>

      <table class="table table-sm table-bordered" id="status">
        <thead class="table-dark">
            <tr>
              <th width="20%">연월</th>
              <th>이월</th>
              <th>접수</th>
              <th>처리중</th>
              <th>완료</th>
            </tr>
        </thead>
        <tbody>
            <?php if($s1s): ?>
            <?php foreach($s1s as $s): ?>

            <?php if($s['yyyy']==""): ?>
              <tr class="bg-info">
                <td width="20%"><b><?php echo "총계"; ?></b></td>
              <td><b><?php echo $s['previous_year_recv']; ?></b></td>
              <td><b><?php echo $s['this_year_recv']; ?></b></td>
              <td><b><?php echo $s['processing']; ?></b></td>
              <td><b><?php echo $s['this_year_complete']; ?></b></td>
              </tr>
            <?php endif; ?>

            <?php if($s['yyyy']!=""): ?>
              <tr>
                <td width="20%"><?php echo $s['yyyy']; ?></td>
              <td><?php echo $s['previous_year_recv']; ?></td>
              <td><?php echo $s['this_year_recv']; ?></td>
              <td><?php echo $s['processing']; ?></td>
              <td><?php echo $s['this_year_complete']; ?></td>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    
      </br>

      <span class="badge bg-info text-dark">Info 1</span> [완료]는 조회년도에 완료된 건입니다. 전년도실적이 조회되는 경우는 [이월완료]된 건입니다.

    </div>
  </body>
</html>

<script>
      var cd = <?php 
                   if($s3s) {
                     echo '['; 
                     foreach($s3s as $s): 
                     echo $s['count'].","; 
                     endforeach; 
                     echo ']'; 
                   } else { 
                     echo '[0,0,0,0,0,0,0,0,0,0,0,0]';  
                   };
                  ?>

      var cdp = <?php 
                   if($s4s) {
                     echo '['; 
                     foreach($s4s as $s): 
                     echo $s['count'].","; 
                     endforeach; 
                     echo ']'; 
                   } else { 
                     echo '[0,0,0,0,0,0,0,0,0,0,0,0]';  
                   };
                  ?>

      var cd2 = <?php 
                   if($s5s) {
                     echo '['; 
                     foreach($s5s as $s): 
                     echo $s['count'].","; 
                     endforeach; 
                     echo ']'; 
                   } else { 
                     echo '[0]';  
                   };
                  ?>

      var cd3 = <?php 
                   if($s5s) {
                   echo '['; 
                   foreach($s5s as $s): 
                   echo "'".$s['type1_desc']."'".","; 
                   endforeach; 
                   echo ']'; 
                 } else {
                    echo '[0]';  
                 }
                ?>

      new Chart(document.getElementById("chartjs-1"),
        {"type":"line"
        ,"data":{"labels":["1월","2월","3월","4월","5월","6월","7월","8월","9월","10월","11월","12월"]
                ,"datasets":[
                {"label":"월별 SR건수","data":cd ,"fill":false ,"borderWidth":2, "borderColor":"blue"},
                {"label":"전년도 월별 SR건수","data":cdp ,"fill":false ,"borderWidth":1, "borderColor":"green"}
                ]
                }
        ,"options":{"scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}}
        });

      new Chart(document.getElementById("chartjs-2"),
        {"type":"bar"
        ,"data":{"labels":cd3
                ,"datasets":[{"label":"연간 모듈별 SR건수","data":cd2 }]}
        });
</script>