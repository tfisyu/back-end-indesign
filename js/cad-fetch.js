import { maiorQue18, setError, removeError } from "./validacoes.js";


const formulario = document.querySelector('#cadastro-container');
const requireds = document.querySelectorAll('.required');
const emailRegex = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;

formulario.addEventListener('submit', async (e) => {
    const dataRecebida = new Date(requireds[3].value);
    e.preventDefault();
    
    if(requireds[0].value.length < 2){
        setError(0);
    }else if(requireds[1].value.length < 11){
        removeError(0);
        setError(1);
    }else if(!emailRegex.test(requireds[2].value)){
        removeError(1);
        setError(2);
    }else if(!maiorQue18(dataRecebida)){
        removeError(2);
        setError(3);
    }else if(requireds[4].value.length < 9){
        removeError(3);
        setError(4);
    }else if(requireds[5].value.length < 8){
        removeError(4);
        setError(5);
    }else if(requireds[5].value != requireds[6].value){
        removeError(4);
        setError(6);
    }else{
        removeError(6);
        const dadosForm = new FormData(formulario);
        dadosForm.append('add', 1);
    
        const dados = await fetch('cadastrar.php', {
            method: 'POST',
            body: dadosForm,
        });
    
        const resposta = await dados.json();
    
        if(resposta['erro']){
            document.querySelector('.alerta-user').innerHTML = resposta['msg'];
        }else{
            document.querySelector('.alerta-user').innerHTML = resposta['msg'];
            formulario.reset();
        }
    }
});