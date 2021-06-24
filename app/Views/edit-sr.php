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

  <form action="<?php echo base_url('/sr/update');?>" name="sr_create" id="sr_create" method="post" accept-charset="utf-8">

    <input type="hidden" name="sr_id" class="form-control" id="sr_id" value="<?php echo $sr['sr_id'] ?>">

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-sm">SR ID</span>
      </div>
      <input type="text" id="srid" name="srid" class="form-control" value="<?php echo $sr['sr_id'] ?>" readonly>
      <a href="#" onclick="window.open('/sr/sr/index/y', 'PopupWin', 'width=1000,height=600');" class="btn btn-primary btn-sm">SR리스트 POPUP</a>
      <a href="#" onclick="window.open('/sr/sr/refer1', 'PopupWin', 'width=1000,height=700');" class="btn btn-info btn-sm">일상운영내용</a>
    </div>

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-sm">SR제목</span>
      </div>
      <input type="text" id="title" name="title" class="form-control" value="<?php echo $sr['title'] ?>">
    </div>

    <textarea name="content"><?php echo $sr['content'] ?></textarea>
    <script>CKEDITOR.replace( 'content' , {
      height: 350
    });</script>
    </br>

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <label class="input-group-text" for="type1">부문</label>
      </div>

      <select class="form-select" name="type1" id="type1">
        <option value="">선택</option>
        <?php if($type1): ?>
            <?php foreach($type1 as $t1): ?>
              <?php if($sr['type1'] == $t1['code']) { ?>
                <option selected value="<?php echo $t1['code'] ?>"><?php echo $t1['description'] ?></option>
                <?php } else { ?>
                <option value="<?php echo $t1['code'] ?>"><?php echo $t1['description'] ?></option>
              <?php } ?>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>

      <div class="input-group-prepend">
        <label class="input-group-text" for="type2">모듈</label>
      </div>

      <select class="form-select" name="type2" id="type2">
        <option value="">선택</option>
        <?php if($type2): ?>
            <?php foreach($type2 as $t2): ?>
              <?php if($sr['type2'] == $t2['code']) { ?>
                <option selected value="<?php echo $t2['code'] ?>"><?php echo $t2['description'] ?></option>
                <?php } else { ?>
                <option value="<?php echo $t2['code'] ?>"><?php echo $t2['description'] ?></option>
              <?php } ?>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>

      <div class="input-group-prepend">
        <label class="input-group-text" for="type3">작업유형</label>
      </div>

      <select class="form-select" name="type3" id="type3">
        <option value="">선택</option>
        <?php if($type3): ?>
            <?php foreach($type3 as $t3): ?>
              <?php if($sr['type3'] == $t3['code']) { ?>
                <option selected value="<?php echo $t3['code'] ?>"><?php echo $t3['description'] ?></option>
                <?php } else { ?>
                <option value="<?php echo $t3['code'] ?>"><?php echo $t3['description'] ?></option>
              <?php } ?>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>

    </div>

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">요청일</span>
      </div>
      <input type="text" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo $sr['occur_date'] ?>" name="occur_date" id="occur_date">

      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">완료요구일</span>
      </div>
      <input type="text" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo $sr['require_date'] ?>" name="require_date" id="require_date">

      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">완료일</span>
      </div>
      <input type="text" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo $sr['complete_date'] ?>" name="complete_date" id="complete_date">

      <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">진행상태</label>
      </div>
      <select class="form-select" name="status" id="status">
        <option value="">선택</option>
        <?php if($status): ?>
            <?php foreach($status as $s): ?>
              <?php if($sr['status'] == $s['code']) { ?>
                <option selected value="<?php echo $s['code'] ?>"><?php echo $s['description'] ?></option>
                <?php } else { ?>
                <option value="<?php echo $s['code'] ?>"><?php echo $s['description'] ?></option>
              <?php } ?>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>
    </div>

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">요청부서</span>
      </div>
      <input type="text" name="client_dept" id="client_dept" class="form-control" placeholder="요청부서명 입력" value="<?php echo $sr['client_dept'] ?>">

      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">요청자</span>
      </div>
      <input type="text" name="client" id="client" class="form-control" placeholder="요청자 성명 입력" value="<?php echo $sr['client'] ?>">

      <div class="input-group-prepend">
       <span class="input-group-text" id="inputGroup-sizing-default">작업자</span>
      </div>
      <input type="text" name="manager" id="manager" class="form-control" value="<?php echo $sr['manager'] ?>" readonly >
    </div>

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">작업시간</span>
      </div>
      <input type="text" name="work_hour" id="work_hour" class="form-control" placeholder="시간 숫자로입력" value="<?php echo $sr['work_hour'] ?>">

      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">신규본수</span>
      </div>
      <input type="text" name="amt_new" id="amt_new" class="form-control" placeholder="수량 숫자로입력" value="<?php echo $sr['amt_new'] ?>">

      <div class="input-group-prepend">
       <span class="input-group-text" id="inputGroup-sizing-default">수정본수</span>
      </div>
      <input type="text" name="amt_modify" id="amt_modify" class="form-control" placeholder="수량 숫자로입력" value="<?php echo $sr['amt_modify'] ?>">
    </div>

    <button type="submit" id="send_form" class="btn btn-success">수정</button>
    <a href="<?php echo site_url('/sr/cancel') ?>" class="btn btn-primary">취소</a>

  </form>

</div>


</body>
</html>

<script>
$('input[type="text"]').keydown(function() {
  if (event.keyCode === 13) {
    event.preventDefault();
  };
});

$( function() {
    $( "#occur_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( "#require_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( "#complete_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
});

$(document).ready(function(){ 
  $("#sr_create").submit(function(event){
    var title = document.getElementById('title').value;
    var type1 = document.getElementById('type1').value;
    var type2 = document.getElementById('type2').value;
    var type3 = document.getElementById('type3').value;
    var status = document.getElementById('status').value;
    var client_dept = document.getElementById('client_dept').value;
    var client = document.getElementById('client').value;
    var occur_date = document.getElementById('occur_date').value;
    var require_date = document.getElementById('require_date').value;

    var complete_date = document.getElementById('complete_date').value;
    var work_hour = document.getElementById('work_hour').value;
    var amt_new = document.getElementById('amt_new').value;
    var amt_modify = document.getElementById('amt_modify').value;

    if (title=='') {alert ('SR명을 입력해야 합니다.'); return false;}
    if (type1=='') {alert ('부문을 입력해야 합니다.'); return false;}
    if (type2=='') {alert ('모듈을 입력해야 합니다.'); return false;}
    if (type3=='') {alert ('작업유형을 입력해야 합니다.'); return false;}
    if (status=='') {alert ('진행상태를 입력해야 합니다.'); return false;}
    if (client_dept=='') {alert ('요청부서명을 입력해야 합니다.'); return false;}
    if (client=='') {alert ('요청자명을 입력해야 합니다.'); return false;}
    if (occur_date=='') {alert ('요청일을 입력해야 합니다.'); return false;}
    if (require_date=='') {alert ('완료요구일을 입력해야 합니다.'); return false;}

    if (occur_date.length>0 && occur_date.length<10) {alert ('요청일은 YYYY-MM-DD로 입력해야 합니다. 예시 2020-01-01'); return false;}
    if (require_date.length>0 && require_date.length<10) {alert ('완료요구일은 YYYY-MM-DD로 입력해야 합니다. 예시 2020-01-01'); return false;}
    if (complete_date.length>0 && complete_date.length<10) {alert ('완료일은 YYYY-MM-DD로 입력해야 합니다. 예시 2020-01-01'); return false;}

    if (complete_date.length==0 && status=='ST10' ) {alert ('완료상태가 아닙니다. 상태를 수정하세요.'); return false;}
    if (complete_date.length==10 && status=='ST01' ) {alert ('완료상태가 되어야 합니다. 상태를 수정하세요.'); return false;}
    if (complete_date.length==10 && status=='ST05' ) {alert ('완료상태가 되어야 합니다. 상태를 수정하세요.'); return false;}
    if (complete_date.length==0 && status=='ST99' ) {alert ('취소 시 완료일자를 입력해야 합니다. 예시 2020-01-01'); return false;}
    if (complete_date.length==10 && status=='ST10' && work_hour==0 ) {alert ('작업시간 입력되어야 합니다.'); return false;}

    return true;
  });
});
</script>