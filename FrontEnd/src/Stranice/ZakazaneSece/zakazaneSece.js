const izlazBtn = document.querySelector('.dodajNovi__cancel');

const dodajForma = document.querySelector('.seca__formDodajOtvori');
const editujForma = document.querySelector('.seca__formEditujOtvori');

const otvaranjeFormeBtn= document.querySelector('.seca__dodajNovu');
const otvaranjeEditFormeBtn = document.querySelector('.edituj__snimiBtn');

const dodajNovePodatkeBtn = document.querySelector('.dodajNovi__snimiBtn');

// izvrsava otvaranje forme za dodavanje nove sece, preventira reload(default behaviour)
function otvoriDodajSecuFormu(){
    otvaranjeFormeBtn.addEventListener('click', e =>{
        e.preventDefault();
        dodajForma.classList.add('seca__activeForm');
    })
}
otvoriDodajSecuFormu();

function otvoriEditSecuFormu(){
    otvaranjeEditFormeBtn.addEventListener('click', e =>{
        e.preventDefault();
        editujForma.classList.add('seca__activeForm');
    })
}
otvoriEditSecuFormu();

// izvrsava zatvaranje forme za dodavanje nove sece, preventira reload(default behaviour)
function zatvoriFormu(){
    izlazBtn.addEventListener('click', e =>{
        e.preventDefault();
        dodajForma.classList.remove('seca__activeForm');
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