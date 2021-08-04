
var frutas = [];
var inputidgeral = 0;


function verificarbotao(){
  var opt = document.getElementById('statusatendimento1');
  var opt2 = document.getElementById('statusatendimento2');
  var agendamento = document.getElementById('agendamento');
  var retornoligacao = document.getElementById('retornoligacao');

  if(opt.checked == true){
    agendamento.style.display = 'block';
    retornoligacao.style.display = 'none';
  }else if (opt2.checked == true) {
    retornoligacao.style.display = 'block';
    agendamento.style.display = 'none';
  }else {
    agendamento.style.display = 'none';
    retornoligacao.style.display = 'none';
  }
}


function salvar(){
  var opt1 = document.getElementById('statusatendimento1');
  var opt2 = document.getElementById('statusatendimento2');
  var opt3 = document.getElementById('statusatendimento3');
  var opt4 = document.getElementById('statusatendimento4');
  var opt5 = document.getElementById('statusatendimento5');
  var opt6 = document.getElementById('statusatendimento6');
  var text = document.getElementById('obs');
  var date = document.getElementById('date');

  var radio1 = document.getElementById('customRadio1');
  var radio2 = document.getElementById('customRadio2');
  var radio3 = document.getElementById('customRadio3');

  var checarbotao = document.getElementsByClassName("checarbotao");
  var botaoclicado = false;
  if(checarbotao.length > 0){


    for (var i = 0; i < checarbotao.length; i++) {
      if(checarbotao[i].checked){
          botaoclicado = true;
      }
    }
  }


  var radio4 = document.getElementById('clientetelefone1');
  var radio5 = document.getElementById('clientetelefone2');
  var radio6 = document.getElementById('clientetelefone3');


  var botao = document.getElementById('botao');

  if( (obs.value != "") && ((opt2.checked == true) || (opt3.checked == true) || (opt4.checked == true) || (opt5.checked == true) || (opt6.checked == true)) ){
    botao.disabled = false;
  }else if (opt1.checked == true && obs.value != "" && botaoclicado == true && (radio4.checked == true || radio5.checked == true || radio6.checked == true) && date.value != "") {
    botao.disabled = false;
  }else{
    botao.disabled = true;
  }
}


function checardia(){
  var date = document.getElementById('date').value;
  ano = date.slice(0,4);
  mes = date.slice(5,7);
  dia = date.slice(8,10);
  var day = new Date(ano, mes, dia).getDay();

  if(mes==02){ //fevereiro //com 28 dias o domingo fica com numero 0 então não tenho que mudar, já com 29 dias o domingo fica com numero 1
  }else if (mes==01 || mes==03 || mes==05 || mes==07 || mes==08 || mes==10 || mes==12) { //mes 31 dias o domingo fica como numero 3, então tenho que colocar para 0
    day = day + 4;
    if((day)>6){
      day = day -7;
    }
  }else{ //mes 30 dias o domingo fica como numero 2, então tenho que colocar para 0
    day = day + 5;
    if((day)>6){
      day = day -7;
    }
  }
  document.getElementById("salasemana").value = salasemana[day];
  carregarelemento(day);
  salvar();
}


function carregarelemento(dia){
  labelsalavendas = document.getElementById("labelsalavendas");


  if(salasemana[dia] == 1){
    labelsalavendas.innerHTML = "Sala Agendamento: Capim Dourado Shopping";
  }else if (salasemana[dia] == 2) {
    labelsalavendas.innerHTML = "Sala Agendamento: Resort Five Senses";
  }else if (salasemana[dia] == 7) {
    labelsalavendas.innerHTML = "Sala Agendamento: JRC Engenharia";
  }else{
    labelsalavendas.innerHTML = "Sala Agendamento:";
  }




  geral = document.getElementById("geral");
  var x = geral.childElementCount;

  for(var i=0;i<x;i++){
    geral.removeChild(geral.childNodes[0]);
  }

  horas = horariosemana[dia];
  numerodehoras = horas.length
  if(numerodehoras % 5 != 0){
    numerodehoras = Math.trunc(numerodehoras/5);
  }else if (numerodehoras != 1) {
      numerodehoras = (numerodehoras/5);
  }
  if(numerodehoras == 1){
    criarelemento(horas);
  }else{
    primeiro = 0;
    ultimo = 5;
    for(i=0;i<numerodehoras;i++){
      criarelemento(horas.slice(primeiro,ultimo));
      primeiro = primeiro + 6;
      ultimo = ultimo + 6;
    }
  }
}


function criarelemento(horario){
  inputidgeral ++;
  let inputid = "inputid"+inputidgeral;
  var div = document.createElement("div");
  div.setAttribute("class","custom-control custom-radio");

  var input = document.createElement("input");
  input.setAttribute("onclick","salvar()");
  input.setAttribute("type","radio");
  input.setAttribute("name","horario");
  input.setAttribute("value",horario);
  input.setAttribute("class","custom-control-input checarbotao");
  input.setAttribute("id",inputid);

  var label = document.createElement("label");
  label.setAttribute("class","custom-control-label");
  label.setAttribute("for",inputid);
  var textnode = document.createTextNode(horario);
  label.appendChild(textnode);

  document.getElementById("geral").appendChild(div);
  div.appendChild(input);
  div.appendChild(label);
}
