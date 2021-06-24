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

  <form action="<?php echo base_url('/sr/store');?>" name="sr_create" id="sr_create" method="post" accept-charset="utf-8">
    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-sm">SR제목</span>
      </div>
      <input type="text" id="title" name="title" class="form-control" placeholder="요청내용을 간략하게 작성하세요">
      <a href="#" onclick="window.open('/sr/sr/index/y', 'PopupWin', 'width=1000,height=800');" class="btn btn-primary btn-sm">SR리스트 POPUP</a>
      <a href="#" onclick="window.open('/sr/sr/refer1', 'PopupWin', 'width=1000,height=800');" class="btn btn-info btn-sm">일상운영내용</a>
    </div>

    <textarea name="content">[요청사항]<br/><br/><br/>[발생원인]<br/><br/><br/>[조치사항]<br/></textarea>
    <script>CKEDITOR.replace( 'content' , {
      height: 350
    });</script>
    </br>

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <label class="input-group-text" for="type1">부문</label>
      </div>
      <select class="form-select" name="type1" id="type1">
        <option selected value="">선택</option>
        <?php if($type1): ?>
            <?php foreach($type1 as $t1): ?>
              <option value="<?php echo $t1['code']; ?>"><?php echo $t1['description']; ?></option>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>
      <div class="input-group-prepend">
        <label class="input-group-text" for="type2">모듈</label>
      </div>
      <select class="form-select" name="type2" id="type2">
        <option selected value="">선택</option>
        <?php if($type2): ?>
            <?php foreach($type2 as $t2): ?>
              <option value="<?php echo $t2['code']; ?>"><?php echo $t2['description']; ?></option>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>
      <div class="input-group-prepend">
        <label class="input-group-text" for="type3">작업유형</label>
      </div>
      <select class="form-select" name="type3" id="type3">
        <option selected value="">선택</option>
        <?php if($type3): ?>
            <?php foreach($type3 as $t3): ?>
              <option value="<?php echo $t3['code']; ?>"><?php echo $t3['description']; ?></option>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>
    </div>

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend" id="inputGroup-sizing-default">
        <span class="input-group-text" >요청일</span>
      </div>
      <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="occur_date" id="occur_date">

      <div class="input-group-prepend" id="inputGroup-sizing-default">
        <span class="input-group-text" >완료요구일</span>
      </div>
      <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="require_date" id="require_date">

      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">완료일</span>
      </div>
      <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="complete_date" id="complete_date">

      <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">진행상태</label>
      </div>
      <select class="form-select" name="status" id="status">
        <option selected value="">선택</option>
        <?php if($status): ?>
            <?php foreach($status as $s): ?>
              <option value="<?php echo $s['code']; ?>"><?php echo $s['description']; ?></option>
        <?php endforeach; ?>
        <?php endif; ?>
      </select>
    </div>

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">요청부서</span>
      </div>
      <input type="text" name="client_dept" id="client_dept" class="form-control" placeholder="요청부서명 입력">

      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">요청자</span>
      </div>
      <input type="text" name="client" id="client" class="form-control" placeholder="요청자 성명 입력">

      <div class="input-group-prepend">
       <span class="input-group-text" id="inputGroup-sizing-default">작업자</span>
      </div>
      <input type="text" name="manager" id="manager" class="form-control" value="<?php echo $_SESSION['username'] ?>" readonly >
    </div>

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">작업시간</span>
      </div>
      <input type="text" name="work_hour" id="work_hour" class="form-control" placeholder="시간 숫자로입력">

      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">신규본수</span>
      </div>
      <input type="text" name="amt_new" id="amt_new" class="form-control" placeholder="수량 숫자로입력">

      <div class="input-group-prepend">
       <span class="input-group-text" id="inputGroup-sizing-default">수정본수</span>
      </div>
      <input type="text" name="amt_modify" id="amt_modify" class="form-control" placeholder="수량 숫자로입력">
    </div>
    

    <button type="submit" id="send_form" class="btn btn-success">등록</button>
    <a href="<?php echo site_url('/sr') ?>" class="btn btn-primary">취소</a>

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
    if (occur_date=='') {alert ('요청일은 입력해야 합니다.'); return false;}
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