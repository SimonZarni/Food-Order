document.getElementById('togglePassword').addEventListener('click', function() {
    var passwordInput = document.getElementById('password');
    var icon = this.querySelector('i');
  
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('ti-eye');
        icon.classList.add('ti-eye-off');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('ti-eye-off');
        icon.classList.add('ti-eye');
    }
  });
  
  document.getElementById('toggleConPassword').addEventListener('click', function() {
    var passwordInput = document.getElementById('con_password');
    var icon = this.querySelector('i');
  
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('ti-eye');
        icon.classList.add('ti-eye-off');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('ti-eye-off');
        icon.classList.add('ti-eye');
    }
  });