<?php require_once('../adminHeader.html'); ?>

<?php 
require_once('../../models/person.php');
require_once('../../models/record.php');
if($_SERVER['REQUEST_METHOD']=='GET'){
      $personId     = $_GET['personId'];
      
      $person = PersonManager::getPersonWithBorrowCount($personId);
      if ($person === false) {
        echo "<script>history.back();alert('没有数据');</script>";
        return;
      }

      $records = RecordManager::searchRecordsWithBookName($personId);
}


               
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once "../adminHead.php"; ?></head>

<body>

  <?php require_once "../adminNav.html"; ?>

  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span3">
        <div class="well sidebar-nav">
          <ul class="nav nav-list" id="admin_left_categorys">
            <li class="nav-header">成员详情</li>
            <li >id:<?php echo $person->personId;?></li>
            <li >姓名:<?php echo $person->name;?></li>
            <li >编号:<?php echo $person->sunccoNo;?></li>
            <li >类型:<?php echo $person->type==0?"普通":"管理员";?></li>
            <li >借书数:<?php echo $person->allBorrowBookCount;?></li>
            <li >未还书数:<?php echo $person->borrowBookCount;?></li>
          </ul>
        </div>
      </div>
      

      <div class="span9" id="content">
        <h3 id="store_h3">借阅记录</h3>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>书本</th>
              <th>借阅时间</th>
              <th>返还时间</th>
              <th>状态</th>
            </tr>
          </thead>
          <tbody id="store_list">
            <?php
                if (count((array)$records['records']) != 0 ){
                  foreach ($records["records"] as $record) {
                    echo "<tr>"
                        ."<td>".$record->bookName."</td>"
                        ."<td>".$record->borrowTime."</td>"
                        ."<td>".$record->remandTime."</td>"
                        ."<td>".($record->status==0?"已还":"未还")."</td>"
                        ."</tr>";
                  }
                }
                
             ?>
        </tbody>
      </table>
      <div id="pageNavId" class="span9 offset2" style="text-align: right;margin-bottom: 30px;"></div>
    </div>

    <script src="/static/js/external/pagenav1.1.min.js"></script>
    <?php
      echo "<script type=\"text/javascript\">"
                   ."pageNav.pageNavId=\"pageNavId\";"
                   ."pageNav.pre=\"上一页\";"
                   ."pageNav.next=\"下一页\";"
                   ."pageNav.url=\"/admin/book/bookManager.php?page={index}&pageSize=$pageSize\";"
                   ."pageNav.fn = function(p,pn){"
                   ."};"
                   ."pageNav.go($books[currentPage],$books[pageSum]);"
                  ."</script>";
  ?>
</div>
</div>
<?php require_once "../adminFooter.html"; ?></body>
</html>