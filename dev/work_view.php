<? include $_SERVER["DOCUMENT_ROOT"]."/dev/common/login_chk.php" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head> 
<meta http-equiv= "Content - Type" content= "text/html; charset=utf - 8" /> 
<meta http-equiv= "Content - Script - Type" content= "text/javascript" /> 
<meta http-equiv= "X - UA - Compatible" content= "IE=edge" /> 
<link rel= "stylesheet" type= "text/css" href= "./rMateChart H5 Sample.css" /> 
 
<!-- IE7, 8 에서 차트 생성하고자 하는 경우 --> <!--[if IE]><script language="javascript" type="text/javascript" src="./rMateChartH5/JS/excanvas.js "></script><![endif]--> 
<!-- rMateChartH5 라이브러리 라이선스 키입니다. 반드시 포함시키십시오. --> 
<script language= "javascript" type= "text/javascript" src= " ./LicenseKey/rMateChartH5License.js " ></script> 
 
<!-- rMateChartH5 에서 사용하는 스타일 --> 
<link rel=" stylesheet " type=" text/css " href=" ./rMateChartH5/Assets/Css/rMateChartH5.css "/> 
 
<!-- 실제적인 rMateChartH5 라이브러리 --> 
<script language= "javascript" type= "text/javascript" src= " ./rMateChartH5/JS/rMateChartH5.js " ></script> 

<link rel="stylesheet" type="text/css" href="./css/w2ui-1.5.rc1.css"/>
<script type="text/javascript" src="./js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="./js/w2ui-1.5.rc1.js"></script>
 
</head> 
	<body>

		<div class="block">
			<h2>일일업무시간</h2>
		</div>
		
								
		<div class="w2ui-field w2ui-span4">
			<label> 날짜 : </label>
			<div>
				<input id="chyyyy" style="width: 80px;">
				<input id="chmm" style="width: 60px;">
			</div>

			<label> 사용자명 : </label>
			<div>
				<input id="user_info" type="user">
				<input type="button" id="Search" value="조회" onClick="btn_Search()"/>
			</div>

		</div>
		<br>

		<div id= "chartHolder" style= "width:1000px; height:600px;" >

	</body> 


</html>

<script type= "text/javascript" > 

//화면 오픈시 조회
	$.ajax({		
            url:'./work_user.php',
			dataType: 'json',
            success:function(data){

				//사용자명
				var vRow = [];
				for(var i=0; i<data.length; i++){
					vRow[i] = data[i].CD_NM;
				}

				//년도
				var today = new Date();
				var dd = today.getDate();
				var mm = today.getMonth()+1;
				var yyyy = today.getFullYear();

				var yRow = [];
					yRow[0] = (yyyy-1)+"";
					yRow[1] = (yyyy)+"";
					yRow[2] = (yyyy+1)+"";
				//월
				var xRow = [];
				for(var i=1; i<13; i++){
					
					if (i < 10)
					{
						xRow[i-1] = "0"+i;
					}else{
						xRow[i-1] = i+"";
					}
				}

				var people = vRow;
				var cyear = yRow;
				var cmonth = xRow;
				//문자열 형태가 아니면 안만들어짐..
				people.sort();
				cyear.sort();
				cmonth.sort();
				$('input[type=user]').w2field('list', { items: people });
				$('input[id=chyyyy]').w2field('list', { items: cyear, selected: yyyy});
				$('input[id=chmm]').w2field('list', { items: cmonth, selected: mm });

            },
			error: function () {
				// 콜백 함수
			},
			complete: function () {
			
			}
        })
 
// -----------------------차트 설정 시작----------------------- 
 
// rMate 차트 생성 준비가 완료된 상태 시 호출할 함수를 지정합니다. <4.1 chartVars 설정하기 참고>
var chartVars = "rMateOnLoadCallFunction=chartReadyHandler";  

// 차트의 속성인 rMateOnLoadCallFunction 으로 설정된 함수. // rMate 차트 준비가 완료된 경우 이 함수가 호출됩니다. // 이 함수를 통해 차트에 레이아웃과 데이터를 삽입합니다. // 파라메터 : id - rMateChartH5.create() 사용 시 사용자가 지정한 id 입니다. 
function chartReadyHandler(id) { 
	document.getElementById(id).setLayout(layoutStr);  
	document.getElementById(id).setData(chartData); 
} 
 
// IE 7,8은 SeriesClip을 지원하지 않음
var effect = compIE() ? "SeriesClip" : "SeriesInterpolate";
var lcolor = 'blue';
// 스트링 형식으로 레이아웃 정의.
var layoutStr = '<rMateChart backgroundColor="#FFFFFF"  borderThickness="1" borderStyle="none">'
     +'<Options>'
          +'<Caption text="업무시간" />'
            +'<SubCaption text="( h )" textAlign="right" />'
         +'<Legend />'
     +'</Options>'
     +'<NumberFormatter id="numFmt" precision="0"/>'
       +'<Column2DChart showDataTips="true" dataTipDisplayMode="axis" paddingTop="0">'
         +'<horizontalAxis>'
               +'<CategoryAxis categoryField="Day"/>'
          +'</horizontalAxis>'
          +'<verticalAxis>'
             +"<DateTimeAxis dataUnits='minutes' labelUnits='minutes' title='일일업무시간' interval='1' displayName='Date' displayLocalTime='true'/>"
         +'</verticalAxis>'
            +'<series>'
               +'<Column2DSeries yField="WORK_TIME" displayName="업무시간">'
					+'<stroke>'
						+'<Stroke color="' + lcolor + '" weight="10"/>'
					+'</stroke>'
                  +'<showDataEffect>'
                       + '<' + effect + ' duration="1000"/>'
                 +'</showDataEffect>'
              +'</Column2DSeries>'
            +'</series>'
          +'<annotationElements>'
               +'<CrossRangeZoomer enableZooming="false" horizontalLabelFormatter="{numFmt}" horizontalStrokeEnable="false"/>'
           +'</annotationElements>'
      +'</Column2DChart>'
 +'</rMateChart>';

// IE 판별
function compIE(){
  var agent = navigator.userAgent;
    if(agent.indexOf("MSIE 7.0") > -1 || agent.indexOf("MSIE 8.0") > - 1 || agent.indexOf("Trident 4.0") > -1)
     return false;
 
   if(document.documentMode && document.documentMode <= 5)
      return false;
 
   return true;
}
 
/**
 * rMateChartH5 3.0에서 제공하고 있는 테마기능을 사용하시려면 아래 내용을 설정하여 주십시오.
 * 테마 기능을 사용하지 않으시려면 아래 내용은 삭제 혹은 주석처리 하셔도 됩니다.
 *
 * -- rMateChartH5.themes에 등록되어있는 테마 목록 --
 * - simple
 * - cyber
 * - modern
 * - lovely
 * - pastel
 * - old
 * -------------------------------------------------
 *
 * rMateChartH5.themes 변수는 theme.js에서 정의하고 있습니다.
 */
rMateChartH5.registerTheme(rMateChartH5.themes);
 
/**
 * 샘플 내의 테마 버튼 클릭 시 호출되는 함수입니다.
 * 접근하는 차트 객체의 테마를 변경합니다.
 * 파라메터로 넘어오는 값
 * - simple
 * - cyber
 * - modern
 * - lovely
 * - pastel
 * - old
 * - default
 *
 * default : 테마를 적용하기 전 기본 형태를 출력합니다.
 * old : rMateChartH5 2.5 이하 버전의 형태를 출력합니다.
 */

var today = new Date();
var chYear = today.getFullYear();
var chMonth = today.getMonth()+1;
var chUser;
var chartData = new Array();


function rMateChartH5ChangeTheme(theme){
 document.getElementById("chart1").setTheme(theme);
}

// 차트 데이터
if(chMonth < 10){
	chMonth = '0'+chMonth;
}
	$.ajax({		
			url:'./work_data.php',
			dataType: 'json',
			data: { month: chMonth, year: chYear, user: 'x'},
			success:function(data){
				chartData = data;
				// rMateChart 를 생성합니다. // 파라메터 (순서대로)  //  1. 차트의 id ( 임의로 지정하십시오. )  //  2. 차트가 위치할 div 의 id (즉, 차트의 부모 div 의 id 입니다.) 
				//  3. 차트 생성 시 필요한 환경 변수들의 묶음인 chartVars //  4. 차트의 가로 사이즈 (생략 가능, 생략 시 100%) //  5. 차트의 세로 사이즈 (생략 가능, 생략 시 100%) 
				rMateChartH5.create("chart1", "chartHolder", chartVars, "100%", "100%");  
				document.body.style.cursor = "default"; 
			},
			error: function () {
				// 콜백 함수
			},
			complete: function () {
			
			}
		})

// -----------------------차트 설정 끝 -----------------------

//조회버튼 이벤트
function btn_Search(){

	chYear  = chyyyy.value;  
	chMonth = chmm.value;
	chUser  = user_info.value;

	document.body.style.cursor = "wait"; 
	$.ajax({		
            url:'./work_data.php',
			dataType: 'json',
			data: { month: chMonth, year: chYear, user: chUser},
            success:function(data){
				chartData = data;
				// rMateChart 를 생성합니다. // 파라메터 (순서대로)  //  1. 차트의 id ( 임의로 지정하십시오. )  //  2. 차트가 위치할 div 의 id (즉, 차트의 부모 div 의 id 입니다.) 
				//  3. 차트 생성 시 필요한 환경 변수들의 묶음인 chartVars //  4. 차트의 가로 사이즈 (생략 가능, 생략 시 100%) //  5. 차트의 세로 사이즈 (생략 가능, 생략 시 100%) 
				chart1.setData(chartData); 
				document.body.style.cursor = "default"; 
            },
			error: function () {
				// 콜백 함수
			},
			complete: function () {
			
			}
        })
 }

</script> 