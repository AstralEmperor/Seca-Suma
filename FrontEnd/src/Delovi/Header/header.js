
const loginForm = document.querySelector('.login__wrapper');
const loginBtn = document.querySelector('#login__link');

// Otvara login formu, preventuje default ponasanje dugmeta(preventuje reload), i manipulise display forme
function openLoginForm(){
    loginBtn.addEventListener('click', e => {
        e.preventDefault();
        loginForm.style.display="flex";
    })
}
openLoginForm();