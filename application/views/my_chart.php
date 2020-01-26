<!-- <?php 

	$conexion=mysqli_connect('localhost','root','','basededatoslocal');

 ?> -->

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Proyecto Integrador | Banda Transportadora</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="http://code.highcharts.com/highcharts.js"></script>
       
       <script type="text/javascript">
       
 

$(document).ready(function() {


var todo = <?php echo $todo; ?>;

            
var data = [];
            
            for (paso = 0; paso < todo.length; paso++) {
                 
                

                data.push([ (new Date(todo[paso].y).getMinutes())  ,  parseInt(todo[paso].x)  ]);
                 };
                 console.log(data)

     setx(data[(data.length)-1].x);
    sety(data[(data.length)-1].y);


var ultimox;
var ultimoy;

Highcharts.setOptions({
    global: {
        useUTC: false
    }
});

$('#tiempoReal').highcharts({
    chart: {
        type: 'spline',
        animation: Highcharts.svg, 
        marginRight: 10,
        events: {
            load: function() {

                // set up the updating of the chart each second
                var google = this.series[0];     
                 setInterval(function() {
                    $.ajax({
                        url: "index.php/ChartController/ulti",
                        type:"get",
                        dataType: "json",
                        
                        error: function() {
                            alert('Something is wrong');
                        },
                        success:function(data){
                            
                            var x=parseInt(data[0].x);
                            var y=(new Date(data[0].y).getMinutes());
                           
                            if((getx()!=x)&&(gety()!=y)){
         
                                google.addPoint([x, y], true, true);
                                setx(x);
                                sety(y);
                            }


                        }
                    });
                  
               
                }, 2000);
               
            }
        }
    },
    title: {
        text: 'Grafica Datos Sensores'
    },
    subtitle:{
        text: 'Tiempo Real'
    },
    
    
    tooltip: {
        formatter: function() { // formato del "tooltip"
        return '<b>'+ this.series.name +'</b><br/>'+
        Highcharts.numberFormat(this.y, 2) +'<br/>'+
        Highcharts.numberFormat(this.x, 2);
}
    },
    legend: {
        enabled: false
    },
    exporting: {
        enabled: false
    },
    series: [{name: '(Valor,Tiempo)',data:data }]





});





function getx(){return ultimox;}
function gety(){return ultimoy;}
function setx(x){ultimox=x;}
function sety(y){ultimoy=y;}


});


function imprimir()
        {
            if (window.print) window.print()
            else alert("puede utilizar Crtl+p");
        }

</script>
    </head>
    <body>
       
    <nav class="navbar navbar-light" style="background-color: #FF5733; ">
        
        <h1 class="text-white h1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;Banda Transportadora</h1>
    </nav>
<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
             </br>
             </br>
              <h4 class="text-dark h4">Dashboard</h4> 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://github.com/Dorival96/Proyecto_Plataformas_Web.git">
              <h4 class="text-dark h4">Repositorio Git</h4>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:imprimir();">
              <h4 class="text-dark h4">PDF</h4>
            </a>
          </li>
          
        </ul>

     
       
      </div>
    </nav>


    <main role="main" class="col-md-5 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        
       
      </div>

      <div id="tiempoReal" style="height: 400px; margin: 0 auto;">
    
    </div>

      <div class="table-responsive">
        <table id="testTable" class="table table-striped table-sm">
        <tr>
			<td>id</td>
			<td>datos</td>
			<td>tiempo</td>
		</tr>
    <?php 
		$sql="SELECT * from Medidas";
		$result=mysqli_query($conexion,$sql);

		while($mostrar=mysqli_fetch_array($result)){
		 ?>
     
     <tr>
			<td><?php echo $mostrar['id'] ?></td>
			<td><?php echo $mostrar['x'] ?></td>
			<td><?php echo $mostrar['y'] ?></td>
		</tr>
    <?php 
	}
	 ?>
        </table>
       

      </div>
    </main>
  </div>
</div>
</div>
<div class="card-footer text-muted d-none d-md-block bg-dark">
    2020 &copy; Daniel Moina - Christopher Molina -Jonathan Pujos - Mario Suin - Jefferson Yanqui
  </div>
        
   
</body>
</html>