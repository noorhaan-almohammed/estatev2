document.addEventListener('DOMContentLoaded', () => {
    const sign_in_btn = document.querySelector("#sign_in_btn");
    const sign_up_btn = document.querySelector("#sign_up_btn");
    const container = document.querySelector(".contener");

    if (sign_up_btn && sign_in_btn && container) {
        sign_up_btn.addEventListener("click", function () {
            container.classList.add("sign_up_mode");
        });

        sign_in_btn.addEventListener("click", function () {
            container.classList.remove("sign_up_mode");
        });
    } else {
        console.error("One or more elements (#sign_in_btn, #sign_up_btn, .contener) are not found in the DOM.");
    }
});
