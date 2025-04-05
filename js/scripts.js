document.addEventListener("DOMContentLoaded", function () {
    const replyContainers = document.querySelectorAll('.reply');

    replyContainers.forEach((el) => {
        const btn = el.querySelector(".view-reply");
        // const btnSpan = btn.querySelector("span");
        const btnInnerHtml = btn.innerHTML;

        const subReply = el.querySelector(".sub-reply");

        btn.addEventListener("click", () => {
            if (subReply.style.display === "block") {
                subReply.style.display = "none";

                if (btnInnerHtml === `<span>Reply</span> <i class="ri-corner-right-down-line">`) {
                    btn.innerHTML = `<span>Reply</span> <i class="ri-corner-right-down-line">`;
                } else {
                    btn.innerHTML = `<span>View Replies</span> <i class="ri-corner-right-down-line">`;
                }

            } else {
                subReply.style.display = "block";
                btn.innerHTML = `<span>Close</span> <i class="ri-corner-right-up-fill"></i>`;
            }
        });
    });
});