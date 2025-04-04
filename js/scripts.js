const replyContainer = document.querySelectorAll(".reply");

replyContainer.forEach((reply) => {
    const viewReplies = reply.querySelector(".reply__footer .view-reply");
    const subReplies = reply.querySelector(".sub-reply");
    const viewRepliesInnerHtml = viewReplies.innerHTML;

    viewReplies.addEventListener("click", () => {
        console.log("Clicked");
        if (subReplies.style.display === "block") {
            subReplies.style.display = "none";
            if (viewRepliesInnerHtml === "Reply") {
                viewReplies.innerHTML = "Reply";
            } else {
                viewReplies.innerHTML = "View Replies";
            }
        } else {
            subReplies.style.display = "block";
            viewReplies.innerHTML = "Close";
        }
    });
});

