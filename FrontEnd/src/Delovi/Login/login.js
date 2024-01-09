
const cancelBtn = document.querySelector('.login__cancel');
const loginFormWrapper = document.querySelector('.login__wrapper');

// izlazi iz login forme, preventuje default ponasanje dugmeta(preventuje reload), i manipulise display forme
function cancelLoginForm(){
    cancelBtn.addEventListener('click', e =>{
        e.preventDefault();
        loginFormWrapper.style.display ="none";
    }) 
}
cancelLoginForm();
