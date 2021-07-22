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

      <form action="<?php echo base_url('/sub');?>" name="sr_con" id="sr_con" method="post" accept-charset="utf-8">
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
      
      <h6><b><?php echo $con['yyyy_mm']; ?> SR 요약 (건)</b></h6>

      <table class="table table-sm table-bordered" id="status">
       <thead class="table-dark">
          <tr>
             <th width="25%">계 (진행+완료)</th>
             <th width="25%">진행(이월)</th>
             <th width="25%">접수</th>
             <th width="25%">완료</th>
          </tr>
       </thead>
       <tbody>
          <?php if($s1): ?>
          <?php foreach($s1 as $s): ?>
          <tr>
             <td><?php echo $s['total']; ?></td>
             <td><?php echo $s['processing']." ( ".$s['previous_month_recv']." ) "; ?></td>
             <td><?php echo $s['this_month_recv']; ?></td>
             <td><?php echo $s['this_month_complete']; ?></td>
          </tr>
         <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
      </table>

      </br>
      
      <h6><b><?php echo $con['yyyy_mm']; ?> SR 부문 별 진행현황 (건)</b></h6>
  
      <table class="table table-sm table-bordered" id="status">
       <thead class="table-dark">
          <tr>
             <th width="20%">부문</th>
             <th>접수</th>
             <th>진행</th>
             <th>완료</th>
             <th>취소</th>
             <th>지연</th>
          </tr>
       </thead>
       <tbody>
          <?php if($s2): ?>
          <?php foreach($s2 as $s): ?>

          <?php if($s['type1_desc']==""): ?>
            <tr class="table-info">
             <td width="20%"><b><?php echo "총계 [".$s['total']."] "; ?></b></td>
             <td><b><?php echo $s['step1']; ?></b></td>
             <td><b><?php echo $s['step2']; ?></b></td>
             <td><b><?php echo $s['step3']; ?></b></td>
             <td><b><?php echo $s['cancel']; ?></b></td>
             <td><b><?php echo $s['delay']; ?></b></td>
            </tr>
            <?php endif; ?>
            <?php if($s['type1_desc']!=""): ?>
            <tr>
             <td width="20%"><?php echo $s['type1_desc']; ?></td>
             <td><?php echo $s['step1']; ?></td>
             <td><?php echo $s['step2']; ?></td>
             <td><?php echo $s['step3']; ?></td>
             <td><?php echo $s['cancel']; ?></td>
             <td><?php echo $s['delay']; ?></td>
            </tr>
            <?php endif; ?> 
         <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
      </table>

      </br>
      
      <h6><b><?php echo $con['yyyy_mm']; ?> 모듈별 현황 (건)</b></h6>

      <table class="table table-sm table-bordered" id="status">
       <thead class="table-dark">
          <tr>
             <th width="20%">모듈</th>
             <th>접수</th>
             <th>진행</th>
             <th>완료</th>
             <th>취소</th>
             <th>지연</th>
             <th>계</th>
             <th>납기율</th>
             <th>신규</th>
             <th>수정</th>
          </tr>
       </thead>
       <tbody>
          <?php if($s3): ?>
          <?php foreach($s3 as $s): ?>
            <?php if($s['type1_desc']==""): ?>
            <tr class="table-info">
               <td width="20%"><b><?php echo "총계"; ?></b></td>
               <td><b><?php echo $s['step1']; ?></b></td>
               <td><b><?php echo $s['step2']; ?></b></td>
               <td><b><?php echo $s['step3']; ?></b></td>
               <td><b><?php echo $s['cancel']; ?></b></td>
               <td><b><?php echo $s['delay']; ?></b></td>
               <td><b><?php echo $s['tot']; ?></b></td>
               <td><b><?php echo $s['ratio']; ?></b></td>
               <td><b><?php echo $s['amt_new']; ?></b></td>
               <td><b><?php echo $s['amt_modify']; ?></b></td>
            </tr>
            <?php endif; ?>
            <?php if($s['type1_desc']!="" && $s['type2_desc']==""): ?>
            <tr class="table-active">
               <td width="20%"><b><?php echo "소계"; ?></b></td>
               <td><b><?php echo $s['step1']; ?></b></td>
               <td><b><?php echo $s['step2']; ?></b></td>
               <td><b><?php echo $s['step3']; ?></b></td>
               <td><b><?php echo $s['cancel']; ?></b></td>
               <td><b><?php echo $s['delay']; ?></b></td>
               <td><b><?php echo $s['tot']; ?></b></td>
               <td><b><?php echo $s['ratio']; ?></b></td>
               <td><b><?php echo $s['amt_new']; ?></b></td>
               <td><b><?php echo $s['amt_modify']; ?></b></td>
            </tr>
            <?php endif; ?>
            <?php if($s['type2_desc']!=""): ?>
            <tr>
               <td width="20%"><?php echo $s['type2_desc']; ?></td>
               <td><?php echo $s['step1']; ?></td>
               <td><?php echo $s['step2']; ?></td>
               <td><?php echo $s['step3']; ?></td>
               <td><?php echo $s['cancel']; ?></td>
               <td><?php echo $s['delay']; ?></td>
               <td><?php echo $s['tot']; ?></td>
               <td><?php echo $s['ratio']; ?></td>
               <td><?php echo $s['amt_new']; ?></td>
               <td><?php echo $s['amt_modify']; ?></td>
            </tr>
            <?php endif; ?>
         <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
      </table>
  
      </br>
      
      <h6><b><?php echo $con['yyyy_mm']; ?> 유형별 현황 (시간)</b></h6>

      <table class="table table-sm table-bordered" id="status">
       <thead class="table-dark">
          <tr>
             <th width="20%">유형</th>
             <th>기능변경</th>
             <th>기본운영</th>
             <th>신규개발</th>
             <th>업무교육</th>
             <th>업무지원</th>
             <th>업무협의</th>
             <th>자료수정</th>
             <th>장애대응</th>
			 <th>자료추출</th>
			 <th>결산작업</th>
			 <th>자체개선</th>
             <th>총계</th>
          </tr>
       </thead>
       <tbody>
          <?php if($s5s): ?>
          <?php foreach($s5s as $s): ?>
          <?php if($s['type1_desc']==""): ?>
            <tr class="table-info">
             <td width="20%"><b><?php echo "총계"; ?></b></td>
             <td><b><?php echo $s['WT01']; ?></b></td>
             <td><b><?php echo $s['WT02']; ?></b></td>
             <td><b><?php echo $s['WT03']; ?></b></td>
             <td><b><?php echo $s['WT04']; ?></b></td>
             <td><b><?php echo $s['WT05']; ?></b></td>
             <td><b><?php echo $s['WT06']; ?></b></td>
             <td><b><?php echo $s['WT07']; ?></b></td>
             <td><b><?php echo $s['WT08']; ?></b></td>
			 <td><b><?php echo $s['WT09']; ?></b></td>
			 <td><b><?php echo $s['WT10']; ?></b></td>
			 <td><b><?php echo $s['WT11']; ?></b></td>
             <td><b><?php echo $s['tot']; ?></b></td>
            </tr>
          <?php endif; ?>
          <?php if($s['type1_desc']!="" && $s['type2_desc']==""): ?>
            <tr class="table-active">
             <td width="20%"><b><?php echo "소계"; ?></b></td>
             <td><b><?php echo $s['WT01']; ?></b></td>
             <td><b><?php echo $s['WT02']; ?></b></td>
             <td><b><?php echo $s['WT03']; ?></b></td>
             <td><b><?php echo $s['WT04']; ?></b></td>
             <td><b><?php echo $s['WT05']; ?></b></td>
             <td><b><?php echo $s['WT06']; ?></b></td>
             <td><b><?php echo $s['WT07']; ?></b></td>
             <td><b><?php echo $s['WT08']; ?></b></td>
			 <td><b><?php echo $s['WT09']; ?></b></td>
			 <td><b><?php echo $s['WT10']; ?></b></td>
			 <td><b><?php echo $s['WT11']; ?></b></td>
             <td><b><?php echo $s['tot']; ?></b></td>
            </tr>
          <?php endif; ?>
          <?php if($s['type2_desc']!=""): ?>
            <tr>
             <td width="20%"><?php echo $s['type2_desc']; ?></td>
             <td><?php echo $s['WT01']; ?></td>
             <td><?php echo $s['WT02']; ?></td>
             <td><?php echo $s['WT03']; ?></td>
             <td><?php echo $s['WT04']; ?></td>
             <td><?php echo $s['WT05']; ?></td>
             <td><?php echo $s['WT06']; ?></td>
             <td><?php echo $s['WT07']; ?></td>
             <td><?php echo $s['WT08']; ?></td>
			 <td><?php echo $s['WT09']; ?></td>
			 <td><?php echo $s['WT10']; ?></td>
			 <td><?php echo $s['WT11']; ?></td>
             <td><b><?php echo $s['tot']; ?></b></td>
            </tr>
          <?php endif; ?>

         <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
      </table>
  
      </br>
      
      <h6><b><?php echo $con['yyyy_mm']; ?> 담당자별 작업현황</b></h6>

      <table class="table table-sm table-bordered" id="status">
       <thead class="table-dark">
          <tr>
             <th width="20%">담당자</th>
             <th width="20%">부문</th>
             <th>작업건수</th>
             <th>진행건수</th>
             <th>작업시간</th>
             <th>신규개발본수</th>
             <th>수정본수</th>
             <th>지연건수</th>
          </tr>
       </thead>
       <tbody>
          <?php if($s6): ?>
          <?php foreach($s6 as $s): ?>
          
          <?php if($s['manager']=="" && $s['type1_desc']==""): ?>
            <tr class="table-info">
              
             <td width="20%"><b><?php echo "총계"; ?></b></td>
             <td width="20%"></td>
             <td><b><?php echo $s['work_count']; ?></b></td>
             <td><b><?php echo $s['processing']; ?></b></td>
             <td><b><?php echo $s['work_hour']; ?></b></td>
             <td><b><?php echo $s['amt_new']; ?></b></td>
             <td><b><?php echo $s['amt_modify']; ?></b></td>
             <td><b><?php echo $s['delay']; ?></b></td>
            </tr>
          <?php endif; ?>
          <?php if($s['manager']!="" && $s['type1_desc']==""): ?>
            <tr class="table-active">
             
             <td width="20%"><b><?php echo "소계"; ?></b></td>
             <td width="20%"></td>
             <td><b><?php echo $s['work_count']; ?></b></td>
             <td><b><?php echo $s['processing']; ?></b></td>
             <td><b><?php echo $s['work_hour']; ?></b></td>
             <td><b><?php echo $s['amt_new']; ?></b></td>
             <td><b><?php echo $s['amt_modify']; ?></b></td>
             <td><b><?php echo $s['delay']; ?></b></td>
            </tr>
          <?php endif; ?>
          <?php if($s['type1_desc']!=""): ?>
            <tr>
             <td width="20%"><?php echo $s['manager']; ?></td>
             <td width="20%"><?php echo $s['type1_desc']; ?></td>
             <td><?php echo $s['work_count']; ?></td>
             <td><?php echo $s['processing']; ?></td>
             <td><?php echo $s['work_hour']; ?></td>
             <td><?php echo $s['amt_new']; ?></td>
             <td><?php echo $s['amt_modify']; ?></td>
             <td><?php echo $s['delay']; ?></td>
            </tr>
          <?php endif; ?>

         <?php endforeach; ?>
         <?php endif; ?>
       </tbody>
      </table>

      <?php if($s7): ?>
            </br>
            <div class="alert alert-dark" role="alert">
              <b>월간 주요업무 보고</b>
            </div>
        <?php foreach($s7 as $s): ?>
            <b><?php echo $s['title']." / " ?> <?php echo $s['manager']." / " ?> <?php echo $s['record_date'] ?></b>
            <textarea name="<?php echo $s['id'] ?>" id="<?php echo $s['id'] ?>"><?php echo $s['content'] ?></textarea>
            <script>CKEDITOR.replace( '<?php echo $s['id'] ?>' );</script>
            </br>
        <?php endforeach; ?>
      <?php endif; ?>
  
    </div>
  </body>
</html>