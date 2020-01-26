function imprimir()
{
 if (window.print) window.print()
 else alert("puede utilizar Crtl+p");
}
$('dwsensores').on('click',requestDescargar);  
function requestDescargar()
{
  tabletoExcel('sensores','Sensores');
}