<? include $_SERVER["DOCUMENT_ROOT"]."/dev/common/login_chk.php" ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv= "Content - Type" content= "text/html; charset=utf - 8" /> 
<meta http-equiv= "Content - Script - Type" content= "text/javascript" /> 
<meta http-equiv= "X - UA - Compatible" content= "IE=edge" /> 
<link rel= "stylesheet" type= "text/css" href= "./rMateChart H5 Sample.css" /> 
 
<!-- IE7, 8 에서 차트 생성하고자 하는 경우 --> <!--[if IE]><script language="javascript" type="text/javascript" src="./rMateChartH5/JS/excanvas.js "></script><![endif]--> 
<script type="text/javascript" src="./js/jquery-2.1.0.min.js"></script>
<!-- rMateChartH5 라이브러리 라이선스 키입니다. 반드시 포함시키십시오. --> 
<script language= "javascript" type= "text/javascript" src= " ./LicenseKey/rMateChartH5License.js " ></script> 
 
<!-- rMateChartH5 에서 사용하는 스타일 --> 
<link rel=" stylesheet " type=" text/css " href=" ./rMateChartH5/Assets/Css/rMateChartH5.css "/> 
 
<!-- 실제적인 rMateChartH5 라이브러리 -->
<script language="javascript" type="text/javascript" src="./rMateChartH5/JS/rMateIntegrationH5.js"></script>

<!-- rMateChartH5 테마 js -->
<script type="text/javascript" src="../rMateChartH5/Assets/Theme/theme.js"></script>

<link rel="stylesheet" type="text/css" href="./css/w2ui-1.5.rc1.css"/>
<script type="text/javascript" src="./js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="./js/w2ui-1.5.rc1.js"></script>

<!-- IE7, 8 에서 차트 생성하고자 하는 경우 -->
<!--[if IE]><script language="javascript" type="text/javascript" src="../rMateChartH5/JS/excanvas.js"></script><![endif]-->

</head>
<body>
	
	<div class="block">
		<h2>온습도/연기 그래프</h2>
	</div>
								
	<div class="w2ui-field w2ui-span4">
		<label> 날짜 : </label>
		<div>
			<input id="chdate" type="date">
			<input type="button" id="Search" value="조회" onclick="btn_search()"/>
		</div>
	</div>
	<br>
	<div id= "chartHolder" style= "width:1000px; height:600px;" >
</body>
</html>


<script type="text/javascript">

var chartData = new Array();
var today = new Date();
var chYear = today.getFullYear();
var chMonth = today.getMonth()+1;
var chday = today.getDate();

//최대온도값
var MAX_TEMPERATURE;
//최소온도값
var MIN_TEMPERATURE;
//최대습도값
var MAX_HUMIDITY;
//최대가스값
var MAX_GAS;

if(chMonth < 10){
	chMonth = "0"+chMonth;
}

if(chday < 10){
	chday = "0"+chday;
}

var nowday = chYear+'-'+chMonth+'-'+chday;

//날짜 기본값 세팅
document.getElementById("chdate").value = nowday;

// -----------------------차트 설정 시작-----------------------

// rMate 차트 생성 준비가 완료된 상태 시 호출할 함수를 지정합니다.
var chartVars = "rMateOnLoadCallFunction=chartReadyHandler";

// rMateChart 를 생성합니다.
// 파라메터 (순서대로) 
//  1. 차트의 id ( 임의로 지정하십시오. ) 
//  2. 차트가 위치할 div 의 id (즉, 차트의 부모 div 의 id 입니다.)
//  3. 차트 생성 시 필요한 환경 변수들의 묶음인 chartVars
//  4. 차트의 가로 사이즈 (생략 가능, 생략 시 100%)
//  5. 차트의 세로 사이즈 (생략 가능, 생략 시 100%)
//rMateChartH5.create("chart1", "chartHolder", chartVars, "100%", "100%"); 

// 차트의 속성인 rMateOnLoadCallFunction 으로 설정된 함수.
// rMate 차트 준비가 완료된 경우 이 함수가 호출됩니다.
// 이 함수를 통해 차트에 레이아웃과 데이터를 삽입합니다.
// 파라메터 : id - rMateChartH5.create() 사용 시 사용자가 지정한 id 입니다.
function chartReadyHandler(id) {

	var TEMPERATURE = getCartesianLayout("Line2D","Temperature",0.5,["TEMPERATURE"]);
	var HUMIDITY = getCartesianLayout("Line2D","Humidity",0.5,["HUMIDITY"]);
	var GAS = getCartesianLayout("Line2D","Smoke",0.5,["GAS"]);


	// 슬라이드에 넣을 데이터와 레이아웃들.
	layoutSet = [TEMPERATURE, HUMIDITY, GAS];
	dataSet = [chartData, chartData, chartData];

	// 슬라이드에서 표현할 레이아웃들 삽입.
	document.getElementById(id).setSlideLayoutSet(layoutSet);

	// 슬라이드에서 표현할 데이터들 삽입.
	document.getElementById(id).setSlideDataSet(dataSet);
}

// 레이아웃을 반환하는 함수입니다.
// 파라메터 설명
// type : 차트 type
// title : 차트 Caption
// dataField : 시리즈가 표현할 실데이터의 필드명 배열
function getCartesianLayout(type, title, padding, dataField)
{

	if(title == 'Temperature'){
		startValue = 20;
		endValue = 50;
		maximum = parseInt(MAX_TEMPERATURE)+50;
		minimum = parseInt(MIN_TEMPERATURE)-50;
	}
	else if(title == 'Humidity'){
		startValue = 40;
		endValue = 70;
		maximum = parseInt(MAX_HUMIDITY)+10;
	}
	else if(title == 'Smoke'){
		startValue = 200;
		endValue = 2500;
		maximum = parseInt(MAX_GAS)+200;
	}

	var layout="<rMateChart paddingTop='30'>"
				+"<Options><Caption text='" + title +"' fontSize='30'/></Options>"
				+'<NumberFormatter id="numfmt" useThousandsSeparator="true"/>' 
				+'<DateFormatter id="dateOrgFmt" formatString="HH:NN"/>'
				+"<" + type + "Chart showDataTips='true'>"
				+"<series>";
		for(var i=0; i<dataField.length; ++i)
		{
			layout += "<" + type +"Series xField='Day' yField='" + dataField[i] + "' displayName='" + dataField[i] + "' />"
		}

		layout +="</series>"
				+'<backgroundElements>'
                           +'<GridLines/>'
                           +'<AxisMarker>'
                               +'<lines>'
                                    +'<AxisLine value="'+endValue+'" lineStyle="dashLine" label="상한치">'
                                      +'<stroke>'
                                           +'<Stroke color="#FF7171" weight="2"/>'
                                       +'</stroke>'
                                  +'</AxisLine>'
                                +'</lines>'
                               +'<ranges>'
                                  // +'<AxisRange startValue="40" endValue="50">'
                                 //     +'<fill>'
                                 //        +'<SolidColor color="#eeeeee" alpha="0.4"/>'
                                 //     +'</fill>'
                                 //   +'</AxisRange>'
                               +'</ranges>'
                          +'</AxisMarker>'
                      +'</backgroundElements>'
				+"<horizontalAxis>"
				//+	"<CategoryAxis categoryField='Day'  ticksBetweenLabels='true' formatter='{dateOrgFmt}'  padding='"+padding+"'/>"
				//+"<DateTimeAxis id='Day' displayLocalTime='true' labelUnits='minutes' dataUnits='seconds' interval='10' formatter='{dateOrgFmt}' displayName='Time' padding='"+padding+"'/>"
				//+"<DateTimeAxis  dataUnits='minutes' labelUnits='minutes' title='일일업무시간' interval='1' displayName='Date' displayLocalTime='true'/>"
				//+	"<LinearAxis maximum='00:50' minimum='24:00' interval='10'  formatter='{numfmt}'/>"
				+'<DateTimeAxis id="Day" displayLocalTime="true"  labelUnits="hours" dataUnits="minutes" interval="2" formatter="{dateOrgFmt}" displayName="Time"/>'
				+"</horizontalAxis>"
				+"<verticalAxis>"
				+	"<LinearAxis maximum='"+maximum+"' interval='1' formatter='{numfmt}'/>"
				+"</verticalAxis>"
				+"</" + type + "Chart>"
				+"</rMateChart>";
	return layout;
}


// 차트 데이터

var nowdate = chYear+""+chMonth+""+chday;

	$.ajax({		
            url:'./senser_data.php',
			dataType: 'json',
			data: { now_time: nowdate},
            success:function(data){
				if (data == "")
				{
					alert("데이터가 없습니다.");
					document.body.style.cursor = "default"; 
				}
				else{
				chartData = data;
				MAX_TEMPERATURE = data[0].MAX_TEMPERATURE;
				MIN_TEMPERATURE = data[0].MIN_TEMPERATURE;
				MAX_HUMIDITY = data[0].MAX_HUMIDITY;
				MAX_GAS = data[0].MAX_GAS;


				// rMateChart 를 생성합니다. // 파라메터 (순서대로)  //  1. 차트의 id ( 임의로 지정하십시오. )  //  2. 차트가 위치할 div 의 id (즉, 차트의 부모 div 의 id 입니다.) 
				//  3. 차트 생성 시 필요한 환경 변수들의 묶음인 chartVars //  4. 차트의 가로 사이즈 (생략 가능, 생략 시 100%) //  5. 차트의 세로 사이즈 (생략 가능, 생략 시 100%) 
				rMateChartH5.create("chart1", "chartHolder", chartVars, "100%", "100%");  
				document.body.style.cursor = "default"; 
				}
            },
			error: function () {
				// 콜백 함수
			},
			complete: function () {
			
			}
        })

// -----------------------차트 설정 끝 -----------------------

var day_now;
    $.datepicker.setDefaults({
        dateFormat: 'yy년 mm월 dd일',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        yearSuffix: 'Year'
    });

    $(function() {
        $("#datepicker1").datepicker();
    });
function btn_search(){
	document.body.style.cursor = "wait"; 

	day_now = chdate.value;
	day_now = day_now.replace(/-/gi,'');

	$.ajax({		
		url:'./senser_data.php',
		dataType: 'json',
		data: { now_time: day_now},
		success:function(data){
			if (data == "")
			{
				alert("데이터가 없습니다.");
				document.body.style.cursor = "default"; 
			}
			// rMateChart 를 생성합니다. // 파라메터 (순서대로)  //  1. 차트의 id ( 임의로 지정하십시오. )  //  2. 차트가 위치할 div 의 id (즉, 차트의 부모 div 의 id 입니다.) 
			//  3. 차트 생성 시 필요한 환경 변수들의 묶음인 chartVars //  4. 차트의 가로 사이즈 (생략 가능, 생략 시 100%) //  5. 차트의 세로 사이즈 (생략 가능, 생략 시 100%) 
			//rMateChartH5.create("chart1", "chartHolder", chartVars, "100%", "100%");  
			else{
			chartData = data;

			MAX_TEMPERATURE = data[0].MAX_TEMPERATURE;
			MIN_TEMPERATURE = data[0].MIN_TEMPERATURE;
			MAX_HUMIDITY = data[0].MAX_HUMIDITY;
			MAX_GAS = data[0].MAX_GAS;

			// rMateChart 를 생성합니다. // 파라메터 (순서대로)  //  1. 차트의 id ( 임의로 지정하십시오. )  //  2. 차트가 위치할 div 의 id (즉, 차트의 부모 div 의 id 입니다.) 
			//  3. 차트 생성 시 필요한 환경 변수들의 묶음인 chartVars //  4. 차트의 가로 사이즈 (생략 가능, 생략 시 100%) //  5. 차트의 세로 사이즈 (생략 가능, 생략 시 100%) 
			//rMateChartH5.create("chart1", "chartHolder", chartVars, "100%", "100%");  
			rMateChartH5.create("chart1", "chartHolder", chartVars, "100%", "100%");  
			document.body.style.cursor = "default"; 
			}
		},
		error: function () {
			// 콜백 함수
		},
		complete: function () {
		
		}
	})
}

</script>