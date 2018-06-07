function toggleFunction() { //comments button toggle function
    var myBtn = document.getElementById('toggleButton');
    if (myBtn.innerHTML === 'Hide comments') {
        myBtn.innerHTML = 'Show comments';            
    }
    else if (myBtn.innerHTML === 'Show comments') {
        myBtn.innerHTML = 'Hide comments';            
    }

    var comments = document.getElementsByClassName("comment-wrapper");
    //console.log(comments);
    for (var i = 0; i < comments.length; i++) {
        comments[i].classList.toggle('commentStyle');
    }
    var lines = document.getElementsByClassName("comment-line");
    //console.log(lines);
    for (var i = 0; i < lines.length; i++) {
        lines[i].classList.toggle('commentStyle');
    }

}

function deleteFunction(post_id) {
    confirm('Do you really want to delete this post?');
    //console.log("delete-post.php?post_id="+post_id);
    document.location.href="delete-post.php?post_id="+post_id;
}

