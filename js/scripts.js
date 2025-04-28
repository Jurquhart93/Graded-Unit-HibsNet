document.addEventListener("DOMContentLoaded", function () {

    const hamburger = document.querySelector('.hamburger');
    const icon = document.querySelector('#hamburger-icon');
    const navLinks = document.querySelector('.nav__links');

    hamburger.addEventListener("click", () => {
        // Toggle nav visibility
        navLinks.classList.toggle("nav-open");

        // Toggle icon
        icon.classList.toggle("ri-menu-line");
        icon.classList.toggle("ri-close-large-line");
    });





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

    let openWarningButtons = document.querySelectorAll("[data-open-warning-box]");

    openWarningButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const warningBox = button.nextElementSibling;
            warningBox.showModal();
            console.log("Open clicked");
        });
    });

    let closeWarningBoxes = document.querySelectorAll("[data-close-warning-box]");

    closeWarningBoxes.forEach((closeButton) => {
        closeButton.addEventListener("click", () => {
            const warningBox = closeButton.closest("dialog");
            warningBox.close();
        });
    });

    const observer = new MutationObserver((mutations, obs) => {
        const editors = document.querySelectorAll('.ql-editor');
        if (editors.length > 0) {
            editors.forEach(el => {
                el.style.height = 'auto'; // or whatever fixed height you want
            });

            // Stop observing once we've made the change
            obs.disconnect();
        }
    });

    // Watch the entire body for added elements
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    const becomeMember = document.getElementById("become-a-member");

    if (becomeMember) {
        becomeMember.addEventListener("click", () => {
            window.open("https://buy.stripe.com/test_00gg0Beee9mVfEk8ww", "_blank");
        });
    }
});


