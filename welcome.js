
const naslovDobrodosli = document.querySelector('.naslov__dobrodosli');

function timerZaNaslov(){
    window.addEventListener('load', ()=>{
        setTimeout(()=>{
            naslovDobrodosli.style.visibility='hidden';
        },5000);
    },{once:true})
}
timerZaNaslov();