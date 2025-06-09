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
    $.blockUI({ message: '<h3>Logging in...</h3>' }); 
    $.ajax({
      url: Constants.PROJECT_BASE_URL + "auth/login",
      type: "POST",
      data: JSON.stringify(entity),
      contentType: "application/json",
      dataType: "json",
      success: function (result) {
        $.unblockUI();  
        localStorage.setItem("user_token", result.data.token);
        window.location.replace("index.html");  
      },
      error: function (XMLHttpRequest) {
        $.unblockUI(); 
        toastr.error(XMLHttpRequest.responseText || 'Login error');
      },
    });
  },

  register: function (entity) {
  $.blockUI({ message: '<h3>Registering...</h3>' }); 
  $.ajax({
    url: Constants.PROJECT_BASE_URL + "auth/register",
    type: "POST",
    data: JSON.stringify(entity),
    contentType: "application/json",
    dataType: "json",
    success: function (result) {
      $.unblockUI();
      toastr.success("Registration successful. You can now log in.");
      window.location.hash = "#login";  
    },
    error: function (XMLHttpRequest) {
      $.unblockUI(); 
      toastr.error(XMLHttpRequest.responseText || 'Registration error');
    },
  });
},


  logout: function () {
    localStorage.clear();
    window.location.replace("index.html#login");
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
