<?php 
require_once ('conectar.php');
//conectar();
$conexion= conectar();

//DECLARAMOS VARIABLES
$serie="777";
$mes="7";
$dia="30";

$intervalo=0;

//echo temperatura_diaria($serie,$intervalo,$mes,$dia);


function temperatura_diaria($serie,$intervalo,$mes,$dia){

global $conexion;
$ano=date("Y");

		$consulta="SELECT UNIX_TIMESTAMP(fecha), temperatura FROM datos WHERE year(`fecha`) = '$ano' AND month(`fecha`) = '$mes' AND day(`fecha`) = '$dia' AND `serie` = '$serie'";
		
		$resultado=mysqli_query($conexion,$consulta);

		while ($row=mysqli_fetch_array($resultado)) 
		{
			echo "[";
			echo $row[0]*1000;
			echo ",";
			echo $row[1];
			echo "],";

			for ($x=0; $x <$intervalo ; $x++) 
			{ 
				$row=mysqli_fetch_array($resultado);
			}

		}

    mysqli_close($conexion);
}
//echo temperatura_diaria($serie,$intervalo,$mes,$dia);


function humedad_diaria($serie,$intervalo,$mes,$dia){

global $conexion;
$ano=date("Y");

        $consulta="SELECT UNIX_TIMESTAMP(fecha), humedad FROM datos WHERE year(`fecha`) = '2021' AND month(`fecha`) = '7' AND day(`fecha`) = '29' AND `serie` = '777' ORDER BY `UNIX_TIMESTAMP(fecha)` DESC";
        
        $resultado=mysqli_query($conexion,$consulta);

        while ($row=mysqli_fetch_array($resultado)) 
        {
            echo "[";
            echo $row[0]*1000;
            echo ",";
            echo $row[1];
            echo "],";

            for ($x=0; $x <$intervalo ; $x++) 
            { 
                $row=mysqli_fetch_array($resultado);
            }

        }

    mysqli_close($conexion);
}

//echo humedad_diaria($serie,$intervalo,$mes,$dia);




//**********************************************************************************
//****************************** ULTIMA TEMP ***************************************
//**********************************************************************************

function ultimaTemp(){

global $conexion;


       $ultimaTemp="SELECT `temperatura` FROM `datos` ORDER BY `id` DESC LIMIT 1;";
        
        $resultado=mysqli_query($conexion,$ultimaTemp);
        //echo $resultado;

       while ($row=mysqli_fetch_array($resultado)) 
        {
            //echo "[";
            //$valor=floatval($row[0]);
            echo $row[0];
            //echo $valor;
            //echo "]";

            //for ($x=0; $x <$intervalo ; $x++) 
            //{ 
              //  $row=mysqli_fetch_array($resultado);
            //}
return $row[0];
        }

    //mysqli_close($conexion);
 }   
 $ultimatemp= ultimaTemp();
//echo ultimaTemp()+$dia2;
echo "<br>";
//echo ultimaTemp();
echo "<br>";
 //$float=number_format(ultimaTemp(),2);
//echo $float;


//**********************************************************************************
//************************** FIN ULTIMA TEMP ***************************************
//**********************************************************************************


function ultimaHume(){

global $conexion;


       $ultimaHum="SELECT `humedad` FROM `datos` ORDER BY `id` DESC LIMIT 1;";
        
        $resultado=mysqli_query($conexion,$ultimaHum);
        //echo $resultado;

       while ($row=mysqli_fetch_array($resultado)) 
        {
            //echo "[";
            //$valor=floatval($row[0]);
            //echo $row[0];
            //echo $valor;
            //echo "]";

            //for ($x=0; $x <$intervalo ; $x++) 
            //{ 
              //  $row=mysqli_fetch_array($resultado);
            //}
            return $row[0];
        }

    mysqli_close($conexion);
 } 

 $ultimahume=ultimaHume();
 //echo ultimaTemp()+$dia2;
echo "<br>";
echo ultimaHume();
echo "<br>";
 //$float=number_format(ultimaTemp(),2);
//echo $float;




?>

<div id="container" style="width: 100%; height: 300px;">

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<div id="container"></div><p class="highcharts-description">

<script type="text/javascript">
    const timezone = new Date().getTimezoneOffset()

    Highcharts.setOptions({
        global: {
            timezoneOffset: timezone
        }
    });


    //Highcharts.setOptions({ global: { useUTC: false } }); 
	Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'TEMPERATURA DIARIA'
    },
    subtitle: {
        text: ''
    },
    credits: {
        enabled: false
    },
    xAxis: {
        
    	type:"datetime" ,
        //categories: []
    },
    yAxis: {
        title: {
            text: 'Temperature (°C)'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: true
        }
    },
    series: [{
        name: 'Temp',
        data: [<?php temperatura_diaria($serie,$intervalo,$mes,$dia);?>]  
    }, 
    //{ name: 'Hum', data: [?php humedad_diaria($serie,$intervalo,$mes,$dia);?>] }
    ]});

</script>
</div>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <figure class="highcharts-figure">
                    <p class="highcharts-description">
       INFORMARCION ACTUALIZADA DE TEMPERATURA Y HUMEDAD
        </p>
        </figure>


             <div id="container-speed" class="chart-container" style="width: 30%; height: 200px"></div>
             <div id="container-rpm" class="chart-container" style="width: 30%; height: 200px"></div>


<script type="text/javascript">
var gaugeOptions = {
    chart: {
        type: 'solidgauge'
    },

    title: null,

    pane: {
        center: ['50%', '85%'],
        size: '140%',
        startAngle: -90,
        endAngle: 90,
        background: {
            backgroundColor:
                Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
            innerRadius: '60%',
            outerRadius: '100%',
            shape: 'arc'
        }
    },

    exporting: {
        enabled: false
    },

    tooltip: {
        enabled: false
    },

    // the value axis
    yAxis: {
        stops: [
            [0.1, '#55BF3B'], // green
            [0.5, '#DDDF0D'], // yellow
            [0.9, '#DF5353'] // red
        ],
        lineWidth: 0,
        tickWidth: 0,
        minorTickInterval: null,
        tickAmount: 2,
        title: {
            y: -70
        },
        labels: {
            y: 16
        }
    },

    plotOptions: {
        solidgauge: {
            dataLabels: {
                y: 5,
                borderWidth: 0,
                useHTML: true
            }
        }
    }
};

// The speed gauge
var chartSpeed = Highcharts.chart('container-speed', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: -15,
        max: 60,
        title: {
            text: 'TEMPERATURA'
        }
    },

    credits: {
        enabled: false
    },

    series: [{
        name: 'Speed',
        data: [<?PHP echo $ultimatemp ?>],
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">{y}</span><br/>' +
                '<span style="font-size:12px;opacity:0.4">°C</span>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: ' °C'
        }
    }]

}));

var chartRpm = Highcharts.chart('container-rpm', Highcharts.merge(gaugeOptions, {
    yAxis: {
        min: 0,
        max: 100,
        title: {
            text: '%'
        }
    },credits: {
        enabled: false},

    series: [{
        name: 'HUMEDAD',
        data: [<?PHP echo $ultimahume ?>],
        dataLabels: {
            format:
                '<div style="text-align:center">' +
                '<span style="font-size:25px">{y:.1f}</span><br/>' +
                '<span style="font-size:12px;opacity:0.4">' +
                '%' +
                '</span>' +
                '</div>'
        },
        tooltip: {
            valueSuffix: ' HUMEDAD'
        }
    }]

}));

// Bring life to the dials
setInterval(function () {
    // Speed
    var point,
        newVal,
        inc;

    //if (chartSpeed) {
        point = chartSpeed.series[1].points[1];
        inc =  100;
        newVal = point.y + inc;

        //if (newVal < 0 || newVal > 200) {
          //  newVal = point.y - inc;
        //}

        point.update(newVal);
    //}

    // RPM
    if (chartRpm) {
        point = chartRpm.series[0].points[0];
        inc = Math.random() - 0.5;
        newVal = point.y + inc;

        if (newVal < 0 || newVal > 5) {
            newVal = point.y - inc;
        }

        point.update(newVal);
    }
}, 2000);


</script>


