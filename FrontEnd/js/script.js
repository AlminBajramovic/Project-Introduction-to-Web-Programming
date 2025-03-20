document.addEventListener("DOMContentLoaded", function () {
    const content = document.getElementById("content");
    
    function loadPage(page) {
        fetch(`views/${page}.html`)
            .then(response => response.text())
            .then(html => {
                content.innerHTML = html;
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

    const initialPage = location.hash.replace("#", "") || "home";
    loadPage(initialPage);
});
