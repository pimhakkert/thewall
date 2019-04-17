const modalContent = document.querySelectorAll('.modalContent');

for(let i=0; i<modalContent.length; i++){
    let nodeNumber = modalContent[i];
    nodeNumber.parentNode.removeChild(nodeNumber);
}

const modalButton = document.querySelectorAll('.modalButton');
const modalButtonArray = [];

let modalBackground = document.createElement('div');
modalBackground.className = 'modalBackground';
let modal = document.createElement('div');
modal.className = 'modal';
let closeButton = document.createElement('button');
closeButton.className = 'closeButton';
closeButton.innerHTML = '&#x00D7;';

const addContent = (event) => {
    const counter = modalButtonArray.indexOf(event.target);
    console.log(counter);
    modal.appendChild(closeButton);
    modal.appendChild(modalContent[counter])    ;
    modalBackground.appendChild(modal);
    document.body.appendChild(modalBackground);
};

const closeModal = () => {
    modal.innerHTML ='';
    modalBackground.innerHTML ='';
    document.body.removeChild(modalBackground);
};

closeButton.addEventListener('click', closeModal);

for(let i=0; i<modalButton.length; i++) {
    modalButtonArray.push(modalButton[i]);
    modalButton[i].addEventListener('click', addContent);
}









