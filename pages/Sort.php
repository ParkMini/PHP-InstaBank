<!-- ===== PHP ===== -->
<?php
$query = "SELECT * FROM user";
$stmt = $db->prepare($query);
$stmt->execute();
$userList = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 쿼리스트링 존재여부 확인
if(isset($qs['userId'])){
  $query2 = "SELECT * FROM account WHERE user_id=:userId";
  $stmt2 = $db->prepare($query2);
  $stmt2->bindParam(':userId', $qs['userId'], PDO::PARAM_STR);
  $stmt2->execute();
  $accountList = $stmt2->fetchAll(PDO::FETCH_ASSOC);
}


?>

<!-- ===== HTML ===== -->
<h1>Sort</h1>
<div class="container">
  <div class="row">
    <!-- === 유저목록 === -->
    <div class="col-3" >
        <ul class="list-group">
            <?php
            for($i=0; $i<count($userList); $i++){
            ?>
            <li onclick="handleClickUser('<?=$userList[$i]['id']?>');" class="list-group-item d-flex justify-content-between align-items-center">
                <?=$userList[$i]['name']?>
                <span class="badge bg-primary rounded-pill">계좌 1개</span>
            </li>
            <?php
            }
            ?>
        </ul>
    </div>

    <!-- === 계좌목록 === -->
    <div class="col-3" >
      <h4>계좌수: <?=count($accountList)?></h4>
      <ul class="list-group">
            <?php
            for($i=0; $i<count($accountList); $i++){
            ?>
            <li onclick="handleClickUser('<?=$accountList[$i]['id']?>');" class="list-group-item d-flex justify-content-between align-items-center">
                계좌번호: <?=$accountList[$i]['number']?>
                <span class="badge bg-primary rounded-pill">잔액:<?=$accountList[$i]['balance']?></span>
            </li>
            <?php
            }
            ?>
        </ul>
    </div>

    <!-- === 송금이력 === -->
    <div class="col-6" >
      Column
    </div>
  </div>
</div>

<!-- ===== Script ===== -->
<script>
function handleClickUser(id){
  window.location.href = `/sort?userId=${id}`;
}
</script>