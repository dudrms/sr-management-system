<?php
     if(isset($_SESSION['username'])){
        echo $_SESSION['username'];
      }
?> 님 께서 작성중입니다. 
<a href="<?php echo site_url('/login/out') ?>" onclick="return confirm('로그아웃 하시겠습니까 ?')">[logout]</a>