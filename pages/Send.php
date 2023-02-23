<?php
// 쿼리스트링 존재여부 확인
if(isset($qs['userId'])){
    $query2 = "SELECT * FROM account WHERE user_id=:userId";
    $stmt2 = $db->prepare($query2);
    $stmt2->bindParam(':userId', $qs['userId'], PDO::PARAM_STR);
    $stmt2->execute();
    $MyaccountList = $stmt2->fetchAll(PDO::FETCH_ASSOC);
  }
?>


<!-- ==== HTML ==== -->
<h1>Send</h1>

<div class="row">
    <div class="col-6">
        <h5>내 계좌(<?=count($MyaccountList)?>)</h5>
        <select class="form-select" aria-label="Default select example">
            <option selected>송금할 계좌를 선택해주세요</option>
            <?php
            for($i=0; $i<count($accountList); $i++){
            ?>
            <li onclick="handleClickUser('<?=$MyaccountList[$i]['id']?>');" class="list-group-item d-flex justify-content-between align-items-center">
                계좌번호: <?=$MyaccountList[$i]['number']?>
                <span class="badge bg-primary rounded-pill">잔액:<?=$MyaccountList[$i]['balance']?></span>
            </li>
            <?php
            }
            ?>
        </select>
        <br/>
        <h5>보낼 금액</h5>
        <div>
            <input 
                type="text" 
                class="form-control" 
                placeholder="000,000원" 
                aria-label="Username" 
                aria-describedby="basic-addon1"
            >
        </div>

        <br/>
        <h5>잔액</h5>
        <h4>1,000,000원</h4>
    </div>

    <div class="col-6">
        <h5>송금 받을 계좌</h5>
        <select class="form-select" aria-label="Default select example">
            <option selected>송금할 계좌를 선택해주세요</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
        <hr/>

        <h5>명세서</h5>
        <hr/>
        <h6>보낸 사람</h6>
        <h5>김성훈</h5>
        <br/>

        <h6>받는 사람</h6>
        <h5>정성훈</h5>
        <br/>
        
        <h6>송금 금액</h6>
        <h5>10,000원</h5>
        <br/>
        
        <h6>거래 후 잔액</h6>
        <h5>990,000원</h5>

        <hr/>
    </div>
    <button class="btn btn-primary">송금</button>
</div>
<!-- ==== JS ==== -->
<script>
    let userId;
    const queryString = window.location.search;
    if (!queryString) {
        userId = prompt("사용자 아이디를 입력해주세요")
        window.location.replace(`/send?userId=${userId}`)
    }
</script>