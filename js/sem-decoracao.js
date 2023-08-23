const decoration = document.querySelector('.decoracoes-andamento');
const finish = document.querySelector('.finalizadas');
const finished = document.querySelector('.finished');
const decorationt = document.querySelector('.sem-decoracoes');
const decorationnt = document.querySelector('.no-decoracoes');
const titulo = document.querySelector('.titulo-decoracoes');

titulo.addEventListener('click', function tira(){
    decoration.remove();
    decorationt.classList.remove('hidden');
})

finish.addEventListener('click', function tiraoutro(){
    finished.remove();
    decorationnt.classList.remove('hidden');
})