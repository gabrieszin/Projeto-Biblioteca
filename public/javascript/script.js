$(document.body).ready(function() {
  $("#cpfAluno").mask("000.000.000-00");
  $("#cepAluno").mask("00000-000");
  $("#celularAluno").mask("(00) 90000-0000")
  // cpfUnico
});

function removeSpace(element){
  const selectElement = document.querySelector("#" + element);
  const noSpace = (selectElement.value).replace(/( )+/g, '');
  document.getElementById(element).value = noSpace;
}

function verificarQualidadeSenha(idInput){
  let parameters = {
    count : false,
    letters : false,
    numbers : false,
    special : false
  }

  let strengthBar = document.querySelector("#strength-bar");
  let msg = document.querySelector("#msg");

  let password = document.querySelector("#"+idInput).value;
  // console.log(password);

  if(password == ""){
    msg.textContent = "";
  }

  parameters.letters = (/[A-Za-z]+/.test(password))?true:false;
  parameters.numbers = (/[0-9]+/.test(password))?true:false;
  parameters.special = (/[!\"$%&/()=?@~`\\.\';:+=^*_-]+/.test(password))?true:false;
  parameters.count = (password.length > 7)?true:false;

  let barLength = Object.values(parameters).filter(value=>value);

  // console.log(Object.values(parameters), barLength);

  strengthBar.innerHTML = "";
  for( let i in barLength){
    let span = document.createElement("span");
    span.classList.add("strength");
    strengthBar.appendChild(span);
  }

  let spanRef = document.getElementsByClassName("strength");
    for( let i = 0; i < spanRef.length; i++){
      switch(spanRef.length - 1){
        case 0:
          msg.textContent = "Senha muito fraca";
          msg.style.color = "#FF0000";
          // camposAlunoPreenchidosCorretamente[1].senha = false;
          // camposProfessorPreenchidoCorretamente.senha = false;
          break;
        case 1:
          msg.textContent = "Senha fraca";
          msg.style.color = "#FF0000";
          // camposAlunoPreenchidosCorretamente[1].senha = false;
          // camposProfessorPreenchidoCorretamente.senha = false;
          break;
        case 2:
          msg.textContent = "Boa senha";
          msg.style.color = "#0C6FFF";
          // camposAlunoPreenchidosCorretamente[1].senha = true;
          // camposProfessorPreenchidoCorretamente.senha = true;
          break;
        case 3:
          msg.textContent = "Excelente senha";
          msg.style.color= "#469536";
          // camposAlunoPreenchidosCorretamente[1].senha = true;
          // camposProfessorPreenchidoCorretamente.senha = true;
          break;
      }    
    } 
}

function controleSenha(condicao, idInputSenha){
  let inputSenha = document.querySelector(idInputSenha);  
  let btnControleSenha = document.querySelector('#btn-controle-senha');
  let iconControleSenha = document.querySelector('#icon-controle-senha');

  if(condicao == 'mostrar'){
    inputSenha.setAttribute('type', 'text');
    let atributosEsconderSenha = "controleSenha('esconder','" + idInputSenha + "')";
    btnControleSenha.setAttribute('onclick', atributosEsconderSenha);
    iconControleSenha.setAttribute('class', 'bi bi-eye-slash-fill');
  }else{
    inputSenha.setAttribute('type', 'password');
    let atributosMostrarSenha = "controleSenha('mostrar','" + idInputSenha + "')";
    btnControleSenha.setAttribute('onclick', atributosMostrarSenha);
    iconControleSenha.setAttribute('class', 'bi bi-eye-fill');
  }

  inputSenha.focus();
}

function cpf(cpf, idInput){
  // console.log(cpf);
  cpf = cpf.replace(/\D/g, '');

  if(cpf == ""){
    limpaFeedbackPreenchimento(idInput);
  }

  switch (cpf){
    case '00000000000':
      // resultado = false
      // break;
    case '11111111111':
      // resultado = false
      // break;
    case '22222222222':
      // resultado = false
      // break;
    case '33333333333':
      // resultado = false
      // break;
    case '44444444444':
      // resultado = false
      // break;
    case '55555555555':
      // resultado = false
      // break;
    case '66666666666':
      // resultado = false
      // break;
    case '77777777777':
      // resultado = false
      // break;
    case '88888888888':
      // resultado = false
      // break;
    case '99999999999':
      resultado = false
      break;
    default: 
      if(cpf.toString().length != 11 || /^(\d)\1{10}$/.test(cpf)) return false;
      var resultado = true;
      [9,10].forEach(function(j){
          var soma = 0, r;
          cpf.split(/(?=)/).splice(0,j).forEach(function(e, i){
              soma += parseInt(e) * ((j+2)-(i+1));
          });
          r = soma % 11;
          r = (r <2)?0:11-r;
          if(r != cpf.substring(j, j+1)) resultado = false;
      });
  }

  if(resultado == true){
    preenchimentoCorreto(idInput, '');
    // camposAlunoPreenchidosCorretamente[0].cpf = true;
  }else{
    preenchimentoIncorreto(idInput, 'CPF inválido');
    // camposAlunoPreenchidosCorretamente[0].cpf = false;
  }
  return resultado;
}

function alerta(v){
  alert(v);
}

function limpa_formulário_cep() {
  //Limpa valores do formulário de cep.
  document.getElementById('rua').value=("");
  document.getElementById('bairro').value=("");
  document.getElementById('cidade').value=("");
  document.getElementById('uf').value=("");
}

function meu_callback(conteudo) {
  if (!("erro" in conteudo)) {
    //Atualiza os campos com os valores.
    document.getElementById('rua').value=(conteudo.logradouro);
    document.getElementById('bairro').value=(conteudo.bairro);
    document.getElementById('cidade').value=(conteudo.localidade);
    document.getElementById('uf').value=(conteudo.uf);
  } //end if.
  else {
    //CEP não Encontrado.
    limpa_formulário_cep();
    // alert("CEP não encontrado.");
    preenchimentoIncorreto('cepAluno', 'CEP inválido');
    // camposAlunoPreenchidosCorretamente[2].cep = false;
  }
}

function verificaCEP(idInput){
  valor = document.querySelector('#' + idInput).value;

  if(valor == ""){
    limpaFeedbackPreenchimento(idInput);
  }

  //Nova variável "cep" somente com dígitos.
  var cep = valor.replace(/\D/g, '');

  //Verifica se campo cep possui valor informado.
  if (cep != "") {

      //Expressão regular para validar o CEP.
      var validacep = /^[0-9]{8}$/;

      //Valida o formato do CEP.
      if(validacep.test(cep)) {

          //Preenche os campos com "..." enquanto consulta webservice.
          document.getElementById('rua').value="...";
          document.getElementById('bairro').value="...";
          document.getElementById('cidade').value="...";
          document.getElementById('uf').value="...";

          //Cria um elemento javascript.
          var script = document.createElement('script');

          //Sincroniza com o callback.
          script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

          //Insere script no documento e carrega o conteúdo.
          document.body.appendChild(script);
          resultado = true;
      } //end if.
      else {
          //cep é inválido.
          limpa_formulário_cep();
          // alert("Formato de CEP inválido.");
          resultado = false;
      }
  } //end if.
  else {
      //cep sem valor, limpa formulário.
      limpa_formulário_cep();
      resultado = false;
  }

  if(resultado == false){
    preenchimentoIncorreto(idInput, 'CEP inválido');
    // camposAlunoPreenchidosCorretamente[2].cep = false;
  }else{
    preenchimentoCorreto(idInput, '');
    // camposAlunoPreenchidosCorretamente[2].cep = true;
  }

}

function preenchimentoIncorreto(idInput, mensagem){
  limpaFeedbackPreenchimento(idInput);
  let inputIncorreto = document.querySelector("#"+idInput);
  // console.log(inputIncorreto);
  let feedbackInputIncorreto = document.querySelector("#feedback-"+idInput);
  // console.log(feedbackInputIncorreto);
  inputIncorreto.setAttribute('class','form-control is-invalid');
  feedbackInputIncorreto.setAttribute('class','invalid-feedback');
  feedbackInputIncorreto.textContent = mensagem;
}

function limpaFeedbackPreenchimento(idInput){
  let inputParaLimpar = document.querySelector("#"+idInput);
  // console.log(inputParaLimpar);
  let feedbackInputParaLimpar = document.querySelector("#feedback-"+idInput);
  // console.log(feedbackInputParaLimpar);
  inputParaLimpar.setAttribute('class','form-control');
  feedbackInputParaLimpar.setAttribute('class','');
  feedbackInputParaLimpar.textContent = '';
}

function preenchimentoCorreto(idInput, mensagem){
  limpaFeedbackPreenchimento(idInput);
  let inputCorreto = document.querySelector("#"+idInput);
  // console.log(idInput);
  let feedbackInputCorreto = document.querySelector("#feedback-"+idInput);

  inputCorreto.setAttribute('class','form-control is-valid');
  feedbackInputCorreto.setAttribute('class','valid-feedback');
  feedbackInputCorreto.textContent = mensagem;
}

function zeroEsquerda(quantidadeZeros, valor){
  let zeros;

  for(let i = 0; i < quantidadeZeros; i++){
    zeros == null ? zeros = "0" : zeros = zeros + "0";
  }
  return (zeros + valor).slice(-quantidadeZeros);
}

data = new Date();
let dataHojeFormato = (data.getFullYear() + "-" + zeroEsquerda(2, parseInt((data.getMonth())+1)) + "-" + zeroEsquerda(2, data.getDate()));

function alteraData(idElemento){
  let dataMinima = document.querySelector("#"+idElemento);
  dataMinima.setAttribute('max', dataHojeFormato);
  dataMinima.setAttribute('value', dataHojeFormato);
}

function dataMin(idElemento){
  // console.log(idElemento);
  let dataHoje = document.querySelector("#"+idElemento);
  // console.log(dataHojeFormato);
  dataHoje.setAttribute('min', dataHojeFormato);
}

function adicionarCampo(numero, idBtn, classElemento){
  let elementos = document.querySelectorAll('.' + classElemento);
  let btnControleElemento = document.querySelector('#' + idBtn);
  // console.log(elementos.length);
  numero--;

  if(numero > 1){
    for(let i = 0; i < elementos.length; i++){
      elementos[numero].style.display = 'block';
    }
    btnControleElemento.setAttribute('onclick', "adicionarCampo( " + (numero+2) + ", this.id, '" + classElemento + "')");
  }else{
    elementos[numero].style.display = 'block';
    btnControleElemento.setAttribute('onclick', "adicionarCampo( " + (numero+2) + ", this.id, '" + classElemento + "')");
  }

  if(numero == ((elementos.length)-1)){
    btnControleElemento.style.display = 'none';
  }

}

function confirmaExclusao(id, tipo){
  if(tipo == "aluno"){
    Swal.fire({
      icon: 'warning',
      title: 'Tem certeza que você quer apagar o registro?',
      text: 'ID do registro: ' + id,
      showDenyButton: true,
      showCancelButton: true,
      showConfirmButton: false,
      denyButtonText: '<form action="../controller/alunos.php" method="POST" class="d-inline"><button class="btn-none" type="submit" id="apagar-registro-estudante" name="apagar-registro-estudante" value='+id+'>Apagar</button></form>'
      }).then((result) => {
          if (result.isConfirmed) {
              Swal.fire('Saved!', '', 'success')
          } else if (result.isDenied) {
          }
    })
  }else if(tipo == "titulo"){
    Swal.fire({
      icon: 'warning',
      title: 'Tem certeza que você quer apagar o registro?',
      text: 'ID do registro: ' + id,
      showDenyButton: true,
      showCancelButton: true,
      showConfirmButton: false,
      denyButtonText: '<form action="../controller/titulos.php" method="POST" class="d-inline"><button class="btn-none" type="submit" id="apagar-registro-titulo" name="apagar-registro-titulo" value='+id+'>Apagar</button></form>'
      }).then((result) => {
          if (result.isConfirmed) {
              Swal.fire('Saved!', '', 'success')
          } else if (result.isDenied) {
          }
    })
  }else if(tipo == "locacao"){
    Swal.fire({
      icon: 'warning',
      title: 'Tem certeza que você quer apagar o registro?',
      text: 'ID do registro: ' + id,
      showDenyButton: true,
      showCancelButton: true,
      showConfirmButton: false,
      denyButtonText: '<form action="../controller/locacoes.php" method="POST" class="d-inline"><button class="btn-none" type="submit" id="apagar-registro-locacao" name="apagar-registro-locacao" value='+id+'>Apagar</button></form>'
      }).then((result) => {
          if (result.isConfirmed) {
              Swal.fire('Saved!', '', 'success')
          } else if (result.isDenied) {
          }
    })
  }
}

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})