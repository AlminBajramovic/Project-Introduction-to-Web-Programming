document.addEventListener("DOMContentLoaded", function () {
    const content = document.getElementById("content");
    
    function loadPage(page) {
        fetch(`views/${page}.html`)
            .then(response => response.text())
            .then(html => {
                content.innerHTML = html;
                attachEventListeners(); 
            })
            .catch(error => console.error("Error loading page:", error));
    }

    window.navigateTo = function (page) {
        history.pushState({ page }, "", `#${page}`);
        loadPage(page);
    };

    window.addEventListener("popstate", function (event) {
        if (event.state && event.state.page) {
            loadPage(event.state.page);
        }
    });

    function attachEventListeners() {
        document.querySelectorAll("[data-nav]").forEach(button => {
            button.addEventListener("click", function () {
                navigateTo(this.getAttribute("data-nav"));
            });
        });

        document.querySelectorAll(".product-img").forEach(img => {
            img.addEventListener("click", function () {
                const modalImage = document.getElementById("modalImage");
                if (modalImage) {
                    modalImage.src = this.src;
                    var modal = new bootstrap.Modal(document.getElementById("imageModal"));
                    modal.show();
                }
            });
        });

        const goBackButton = document.querySelector(".go-back");
        if (goBackButton) {
            goBackButton.addEventListener("click", function () {
                history.back();
            });
        }
    }

    const initialPage = location.hash.replace("#", "") || "home";
    loadPage(initialPage);
});