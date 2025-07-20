function registerUser() {
    const username = document.getElementById('register-username').value;
    const email = document.getElementById('register-email').value;
    const password = document.getElementById('register-password').value;

    if (localStorage.getItem(email)) {
        showMessage("Este correo ya está registrado.", "error");
        return false;
    }

    const user = {
        username: username,
        email: email,
        password: password
    };

    localStorage.setItem(email, JSON.stringify(user));
    showMessage("Usuario registrado correctamente.", "success");
    showLogin();
    return false;
}

function loginUser() {
    const email = document.getElementById('login-email').value;
    const password = document.getElementById('login-password').value;

    const userData = localStorage.getItem(email);

    if (!userData) {
        showMessage("El correo no está registrado.", "error");
        return false;
    }

    const user = JSON.parse(userData);

    if (user.password !== password) {
        showMessage("Contraseña incorrecta.", "error");
        return false;
    }

    showMessage("¡Inicio de sesión exitoso! Bienvenido, " + user.username, "success");
    setTimeout(() => {
        window.location.href = "main.html"; 
    }, 1500);
    return false;


}
function showMessage(message, type = 'success') {
    const box = document.getElementById('message-box');
    box.textContent = message;
    box.className = type === 'success' ? 'success' : 'error';
    box.classList.remove('hidden');

    setTimeout(() => {
        box.classList.add('hidden');
    }, 3000);
}

/*<!- JS PARA CAMBIO DE FORMULARIO -->*/    
function showRegister() {
    document.getElementById('login-form').style.display = 'none';
    document.getElementById('register-form').style.display = 'block';
}
function showLogin() {
    document.getElementById('register-form').style.display = 'none';
    document.getElementById('login-form').style.display = 'block';
}
    