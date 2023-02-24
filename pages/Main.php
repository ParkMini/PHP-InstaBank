<div class="d-grid gap-2 col-6 mx-auto">
    <br/>
    <h3>업무를 선택하세요.</h3>
  <button class="btn btn-primary" type="button" onclick="onClickButton('send');">입금/송금</button>
  <button class="btn btn-primary" type="button" onclick="onClickButton('find');">출금</button>
  <button class="btn btn-primary" type="button" onclick="onClickButton('sort');">통장정리</button>
</div>

<script>
function onClickButton(link='/'){
    window.location.href=link
}
</script>