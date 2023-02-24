const BACKEND_URL = 'https://jsonplaceholder.typicode.com';
let userList = [];
let storyList = [];
let feedList = []

function onLoad(){
    // 스토리 반복
    storyList.sort((a,b)=>{
        if(a.read === false){
            return -1
        }else{ 
            return 0
        }
    }).forEach(function(story){
        const readFlag = story.read === false ? 'storyItemIsRead' : '';
        const userIndex = userList.findIndex((user)=>{
            return user.userid===story.userid
        })
        const user = userList[userIndex];

        $('#storyArea').append(`
            <div class="storyItem ">
                <img 
                    class="${readFlag}" 
                    src="${user.image}" 
                    alt=""
                >
                <h4>${user.username}</h4>
            </div>
        `)
    })

    
}


/**
 * 유저조회
 * --
 */
function getUsers(){
    $.ajax({
        url: `${BACKEND_URL}/users`,
        method: 'get',
        success: (response)=>{
            userList = response
            response.forEach((user)=>{
                $('#userList').append(`
                    <li><b>${user.username}</b> ${user.email}</li>
                `);
            })

            
        }
    })
}

/**
 * 피드조회
 * --
 */
function getFeeds(){
    $.when(
        $.ajax({
            url: `${BACKEND_URL}/users`,
            method: 'get',
        }),
        $.ajax({
            url: `${BACKEND_URL}/photos`,
            method: 'get',
        }),
        $.ajax({
            url: `${BACKEND_URL}/posts`,
            method: 'get',
        }),
        $.ajax({
            url: `${BACKEND_URL}/todos`,
            method: 'get',
        }),
    ).then((users, photos, posts, todos)=>{
        userList = users[0];
        feedList = posts[0];
        photoList = photos[0];
        storyList = todos[0];

        // 스토리 반복
        storyList.sort((a,b)=>{
            if(a.completed === false){
                return -1
            }else{ 
                return 0
            }
        }).forEach((story, storyIndex)=>{
            const readFlag = story.completed === false ? 'storyItemIsRead' : '';
            const userIndex = userList.findIndex((user)=>{
                return user.id===story.userId
            })
            const user = userList[userIndex];

            $('#storyArea').append(`
                <div class="storyItem ">
                    <img 
                        class="${readFlag}" 
                        src="${photoList[storyIndex].thumbnailUrl}" 
                        alt=""
                    >
                    <h4>${user.name.length >= 10 ? `${user.name.slice(0,10)}...` : user.name}</h4>
                </div>
            `)
        })


        // 피드 반복
        feedList.forEach((feed, feedIndex)=>{
            const userIndex = userList.findIndex((user)=>{
                return user.id===feed.userId
            })
            const user = userList[userIndex];

            $('#feedArea').append(`
                <div class="feedItem">
                    <div class="feedItemHeader">
                        <div class="profileImg">
                            <img src="${photoList[feedIndex].thumbnailUrl}" alt="">
                        </div>
                        <div class="profileText">
                            <p>${user.name}</p>
                            <p>${user.email}</p>
                        </div>
                    </div>
                    <div class="feedItemImg">
                        <img src="${photoList[feedIndex].url}" alt="">
                    </div>
                    <div class="feedItemContent">
                        <div class="buttons">
                            <div class="leftBtns">
                                <button>좋아요</button>
                                <button>댓글</button>
                                <button>보내기</button>
                            </div>
                            <div class="rightBtns">
                                <button>저장</button>
                            </div>
                        </div>
                        <div class="textContent">
                            <p><b>좋아요</b></p>
                            <p><b>${feed.title}</b> ${feed.body}</p>
                            <p><a onclick="onClickComment(${feed.id})">Comments</a></p>
                        </div>
                    </div>
                </div>
            `);
        })// forEach
    })
}


// onLoad();
getUsers();
getFeeds();