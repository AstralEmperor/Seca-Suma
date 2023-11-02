const addCancelBtn = document.querySelector('.addNew__cancel');
const form = document.querySelector('.zarada__formShow');
const openFormBtn= document.querySelector('.zarada__addNew');

function openForm(){
    openFormBtn.addEventListener('click', e =>{
        e.preventDefault();
        form.classList.add('zarada__activeForm');
    })
}
openForm();

function closeForm(){
    addCancelBtn.addEventListener('click', e =>{
        e.preventDefault();
        form.classList.remove('zarada__activeForm');
    })
}
openForm();

function closeFormOnStart(){
    window.addEventListener('load', () => {
        form.classList.remove('zarada__activeForm');
    })
}
closeFormOnStart();