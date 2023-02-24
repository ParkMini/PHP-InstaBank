<!-- ===== PHP ===== -->
<?php
if(isset($qs['userId'])){
    $query2 = "SELECT * FROM account WHERE user_id=:userId";
    $stmt2 = $db->prepare($query2);
    $stmt2->bindParam(':userId', $qs['userId'], PDO::PARAM_STR);
    $stmt2->execute();
    $myAccountList = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    $query = "SELECT * FROM account WHERE user_id<>:userId";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':userId', $qs['userId'], PDO::PARAM_STR);
    $stmt->execute();
    $otherAccountList = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$myAccCount = isset($myAccountList) ?count($myAccountList) : 0;
$otherAccCount = isset($otherAccountList) ?count($otherAccountList) : 0;

?>

<!-- ===== HTML ===== -->
<h1>Send</h1>

<div class="row">
    <div class="col-6">
        <h5>내 계좌(<?=$myAccCount?>)</h5>
        <select 
            id="myAccount"
            class="form-select" 
            aria-label="Default select example"
        >
            <option selected>송금할 계좌를 선택해주세요</option>
            <?php
            if(isset($myAccountList)){
                for($i=0; $i<count($myAccountList); $i++){
                ?>
                    <option 
                        value="<?=$myAccountList[$i]['id']?>"
                        data-balance="<?=$myAccountList[$i]['balance']?>"
                    >
                        <?=$myAccountList[$i]['number']?>
                    </option>
                <?php
                }
            }
            ?>
        </select>
        <br/>
        <h5>보낼 금액</h5>
        <div>
            <input 
                id="price"
                type="text" 
                class="form-control" 
                placeholder="000,000원" 
                aria-label="Username" 
                aria-describedby="basic-addon1"
            >
        </div>

        <br/>
        <h5>잔액</h5>
        <h4 id="balance">-원</h4>
    </div>

    <div class="col-6">
        <h5>송금 받을 계좌(<?=$otherAccCount?>)</h5>
        <select class="form-select" aria-label="Default select example">
            <option selected>송금할 계좌를 선택해주세요</option>
            <?php
            if(isset($otherAccountList)){
            for($i=0; $i<count($otherAccountList); $i++){
            ?>
                <option value="<?=$otherAccountList[$i]['id']?>">
                    <?=$otherAccountList[$i]['number']?>
                </option>
            <?php
            }
            }
            ?>
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
    <button class="btn btn-primary" onclick="handleSend();">송금</button>
</div>

<!-- ===== JS ===== -->
<script>
    let userId;
    let currentAccount = {
        id: null,
        balance: null,
    };

    const queryString = window.location.search;
    console.log('queryString',queryString);
    if(!queryString){
        userId = prompt("사용자 아이디를 입력해주세요");
        window.location.replace(`/send?userId=${userId}`);
    }

    /**
     * 
     */
    $('#myAccount').on('change', function(){
        const id = $(this).val();
        const balance = $(this).find("option:selected").data('balance');
        currentAccount = {
            id, balance
        }
        $('#balance').html(balance)
    })

    /**
     * 송금함수
     * --
     */
    function handleSend(){
        const {id, balance} = currentAccount;
        const price = $('#price').val();
        if(!id){
            alert('계좌를 선택해주세요.');
            return;
        }

        if(!price){
            alert('송금 금액을 입력해주세요.');
            return;
        }

        if(balance < price){
            alert('잔액이 부족합니다');
            return;
        }

        const newData = {
            toId: '',
            fromId: '',
            sendPrice: 0
        }

        $.ajax({
            method:'post',
            url: '/account/history',
            data: newData,
            dataType: 'json',
            success: (response) => {
                console.log("res : " + response);
                alert('송금되었습니다.')
            },
            error: (err) => {
                console.log("error : " + err);
            }
        })

    }
</script>