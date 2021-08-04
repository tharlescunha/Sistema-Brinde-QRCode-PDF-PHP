var inicio = 0;
var fim = 1;
function checarletradigitada(){
  checarhorariodigitado = document.getElementsByClassName("checarhorariodigitado");
  for (var i = 0; i < checarhorariodigitado[0].value.length; i++) {
    var letra = checarhorariodigitado[0].value.slice(inicio,fim);
    console.log(letra);
    if((letra == ';')||(letra == ':')||(letra == '0')||(letra == '1')||(letra == '2')||(letra == '3')||(letra == '4')||(letra == '5')||(letra == '6')||(letra == '7')||(letra == '8')||(letra == '9')){
      console.log("ok: "+letra);
    }else{
      console.log("letra invalida: "+letra);
    }
    inicio++;
    fim++;
  }
  inicio = 0;
  fim = 1;
}
