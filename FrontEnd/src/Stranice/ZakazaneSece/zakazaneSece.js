const izlazBtn = document.querySelector('.dodajNovi__cancel');
const forma = document.querySelector('.zarada__formShow');
const otvaranjeFormeBtn= document.querySelector('.zarada__addNew');
const dodajNovePodatkeBtn = document.querySelector('.dodajNovi__addBtn');

// izvrsava otvaranje forme za dodavanje nove sece, preventira reload(default behaviour)
function otvoriFormu(){
    otvaranjeFormeBtn.addEventListener('click', e =>{
        e.preventDefault();
        forma.classList.add('zarada__activeForm');
    })
}
otvoriFormu();

// izvrsava zatvaranje forme za dodavanje nove sece, preventira reload(default behaviour)
function zatvoriFormu(){
    izlazBtn.addEventListener('click', e =>{
        e.preventDefault();
        forma.classList.remove('zarada__activeForm');
    })
}
zatvoriFormu();

// izvrsava slanje forme za dodavanje nove sece, preventira reload(default behaviour)
function posaljiFormu(){
    dodajNovePodatkeBtn.addEventListener('submit', e => {
        e.preventDefault();
        location.reload();
    })
}
posaljiFormu();