const addCancelBtn = document.querySelector('.addNew__cancel');
const form = document.querySelector('.zarada__formShow');
const openFormBtn= document.querySelector('.zarada__addNew');
const addNewDataBtn = document.querySelector('.addNew__addBtn');
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
closeForm();

function sendForm(){
    addNewDataBtn.addEventListener('submit', e => {
        e.preventDefault();
        location.reload();
    })
}
sendForm();