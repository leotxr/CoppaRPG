//FUNCAO MOSTRAR CLASSES

const { padStart } = require("lodash");

function getRaca( valor ){
  
}


//FUNCOES DE CALCULO DE ATRIBUTOS

function getMod( valor ) {
    
  if ( valor == '' ) {
      return '';
  } else if ( valor == 10 || valor == 11 ) {
      return '0';
  } else if ( valor > 9 ) {
      return '+' + Math.floor( ( valor - 10 ) / 2 );
  } else if ( valor < 10 ) {
      return Math.ceil( ( valor - 10 ) / 2 );
  }

}

/*
function getCusto( valor ) {

  if ( valor == '' || valor == 8 ) {
      return 0;
  } else if ( valor == 18 ) {
      return 16;
  } else if ( valor < 8 ) {
      return ( 8 - valor ) * -1
  } else if ( valor < 14 ) {
      return valor - 8;
  } else if ( valor < 18 ) {
      return 5 + ( valor - 13 ) * 2;
  }

}
*/

function calcularCusto( field ) {

  /*
  SERIA UTILIZADO UM LIMITADOR COM VALOR ATE 18, MAS COMO O JOGADOR PODERA UPAR O PERSONAGEM
  RETIREI O LIMITADOR.

    if ( field.value != '' && ( field.value * 1 < 1 ) ) {
      field.value = 1;
  } else if ( field.value != '' && ( field.value * 1 > 30 ) ) {
      field.value = 30;
  }
  */

  var str = document.getElementById( 'txtStr' ).value;
  var dex = document.getElementById( 'txtDex' ).value;
  var con = document.getElementById( 'txtCon' ).value;
  var int = document.getElementById( 'txtInt' ).value;
  var wiz = document.getElementById( 'txtWiz' ).value;
  var cha = document.getElementById( 'txtCha' ).value;

  document.getElementById( 'modstr' ).innerHTML = getMod( str );
  document.getElementById( 'moddex' ).innerHTML = getMod( dex );
  document.getElementById( 'modcon' ).innerHTML = getMod( con );
  document.getElementById( 'modint' ).innerHTML = getMod( int );
  document.getElementById( 'modwiz' ).innerHTML = getMod( wiz );
  document.getElementById( 'modcha' ).innerHTML = getMod( cha );

  var msgAlerta = '';

  /*

  if ( msgAlerta == '' ) {

      var contResultadoFinal = 0;

      contResultadoFinal += getCusto( str );
      contResultadoFinal += getCusto( des );
      contResultadoFinal += getCusto( con );
      contResultadoFinal += getCusto( int );
      contResultadoFinal += getCusto( wis );
      contResultadoFinal += getCusto( car );

      document.getElementById( 'lblResultado' ).innerHTML = contResultadoFinal;

  } else {
      alert( msgAlerta );
  }
*/
}

/*
function verificarSoNumero( field ) {
  var er = /[^0-9-]/;
  if ( er.test ( field.value ) ) {
      field.focus();
      alert( 'Este campo só aceita números.' );
      field.value = '';
  }
}
*/
function verificarSoNumero(){

    var txtStr = document.querySelector("#txtStr").value;
    var txtDex = document.querySelector("#txtDex").value;

    var modstr = parseInt(txtStr) + parseInt(txtDex);

    document.querySelector("#modstr").innerHTML = modstr;

}
