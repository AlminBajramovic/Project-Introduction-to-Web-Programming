function parseJwt(token) {
    if (!token) return null;
    try {
        const base64Url = token.split('.')[1];
        const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        const jsonPayload = decodeURIComponent(
            atob(base64).split('').map(c => {
                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join('')
        );
        return JSON.parse(jsonPayload);
    } catch(e) {
        console.error("Invalid JWT token", e);
        return null;
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const content = document.getElementById("spapp");
    
    function loadPage(page) {
        fetch(`views/${page}.html`)
            .then(response => response.text())
            .then(html => {
                content.innerHTML = html;
                attachEventListeners(); 
                if (typeof UserService !== "undefined" && typeof UserService.checkRoleAndShowUI === "function") {
                    UserService.checkRoleAndShowUI();
                }
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
