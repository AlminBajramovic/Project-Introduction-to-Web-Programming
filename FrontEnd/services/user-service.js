var UserService = {
  init: function () {
    var token = localStorage.getItem("user_token");
    if (token && token !== undefined) {
      window.location.replace("index.html");  
    }
    $("#loginForm").validate({
      submitHandler: function (form) {
        var entity = Object.fromEntries(new FormData(form).entries());
        UserService.login(entity);
      },
    });
  },

  login: function (entity) {
    $.ajax({
      url: Constants.PROJECT_BASE_URL + "auth/login",
      type: "POST",
      data: JSON.stringify(entity),
      contentType: "application/json",
      dataType: "json",
      success: function (result) {
        localStorage.setItem("user_token", result.data.token);
        window.location.replace("index.html");  
      },
      error: function (XMLHttpRequest) {
        alert(XMLHttpRequest.responseText || 'Login error');
      },
    });
  },

  logout: function () {
    localStorage.clear();
    window.location.replace("login.html");
  },

  checkRoleAndShowUI: function() {
    const token = localStorage.getItem("user_token");
    if (!token) return;
    const payload = Utils.parseJwt(token);
    const role = payload?.user?.role;
    if(role === 'admin') {
      document.querySelectorAll('.admin-only').forEach(el => el.style.display = 'inline-block');
    } else {
      document.querySelectorAll('.admin-only').forEach(el => el.style.display = 'none');
    }
  }
};
