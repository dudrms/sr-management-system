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
    </div>

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-sm">SR제목</span>
      </div>
      <input type="text" id="title" name="title" class="form-control" value="<?php echo $sr['title'] ?>" readonly>
    </div>

    <textarea name="content" id="content"><?php echo $sr['content'] ?></textarea>
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
      <input type="text" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo $sr['occur_date'] ?>" name="occur_date" id="occur_date" readonly>

      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">완료요구일</span>
      </div>
      <input type="text" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo $sr['require_date'] ?>" name="require_date" id="require_date" readonly>

      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">완료일</span>
      </div>
      <input type="text" class="form-control" placeholder="YYYY-MM-DD" value="<?php echo $sr['complete_date'] ?>" name="complete_date" id="complete_date" readonly>

      <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">진행상태</label>
      </div>
      <select class="form-select" name="status" id="status" readonly>
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
      <input type="text" name="client_dept" id="client_dept" class="form-control" placeholder="요청부서명 입력" value="<?php echo $sr['client_dept'] ?>" readonly>

      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">요청자</span>
      </div>
      <input type="text" name="client" id="client" class="form-control" placeholder="요청자 성명 입력" value="<?php echo $sr['client'] ?>" readonly>

      <div class="input-group-prepend">
       <span class="input-group-text" id="inputGroup-sizing-default">작업자</span>
      </div>
      <input type="text" name="manager" id="manager" class="form-control" value="<?php echo $sr['manager'] ?>" readonly >
    </div>

    <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">작업시간</span>
      </div>
      <input type="text" name="work_hour" id="work_hour" class="form-control" placeholder="시간 숫자로입력" value="<?php echo $sr['work_hour'] ?>" readonly>

      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">신규본수</span>
      </div>
      <input type="text" name="amt_new" id="amt_new" class="form-control" placeholder="수량 숫자로입력" value="<?php echo $sr['amt_new'] ?>" readonly>

      <div class="input-group-prepend">
       <span class="input-group-text" id="inputGroup-sizing-default">수정본수</span>
      </div>
      <input type="text" name="amt_modify" id="amt_modify" class="form-control" placeholder="수량 숫자로입력" value="<?php echo $sr['amt_modify'] ?>" readonly>
    </div>
    <!--<button type="submit" id="send_form" class="btn btn-success">수정</button>-->

    <a href="<?php echo site_url('/sr/cancel') ?>" class="btn btn-primary">닫기</a>

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

</script>