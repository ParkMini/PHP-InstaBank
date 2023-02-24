<!-- ===== PHP ===== -->
<?php 
$pageTitle = "댓글";
?>

<!-- ===== HTML ===== -->
<div id="commentModal" onclick="onDisableModal()">
    <div id="commentModalContent">
        <h3><?=$pageTitle?></h3>
        <ul id="commentList">
        </ul>
    </div>
</div>


<!-- ===== Script ===== -->
<script>
/**
 * onClickComment
 * --
 */
function onClickComment(feedId){
    $('#commentModal').css('display', 'flex')
    $.ajax({
        url: `${BACKEND_URL}/comments?postId=${feedId}`,
        method: 'get',
        success:(data)=>{
            
            data.forEach(comment => {
                $('#commentList').append(`
                    <li>
                        <b>${comment.email}</b> ${comment.name}</br>
                        ${comment.body}
                    </li>
                `)
            })
        }
    })
}

/**
 * onDisableModal
 * --
 */
function onDisableModal(){
    $('#commentModal').css('display', 'none')
}

</script>