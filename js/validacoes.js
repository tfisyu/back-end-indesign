const requireds = document.querySelectorAll('.required');
const spans = document.querySelectorAll('.span-required');

//funções úteis
function testaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
  if (strCPF == "00000000000") return false;

  for (var i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

  Soma = 0;
    for (var i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}

function maiorQue18(data) {
    const dataAtual = new Date()
    const dataMais18 = new Date(data.getUTCFullYear() + 18, data.getUTCMonth(), data.getUTCDate())

    return dataMais18 <= dataAtual
}

//lançar os erros
function setError(index){
    requireds[index].style.border = '2px solid #e63636';
    requireds[index].style.outlineColor = '#e63636';
    spans[index].style.display = 'block';
}

function removeError(index){
    requireds[index].style.border = '';
    requireds[index].style.outlineColor = '';
    spans[index].style.display = 'none';
}


export { maiorQue18, setError, removeError }
