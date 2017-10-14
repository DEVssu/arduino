<? include $_SERVER["DOCUMENT_ROOT"]."/dev/common/login_chk.php" ?>

<!DOCTYPE html>
<html>
<head>
<title>rMate HTML5 Grid</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="rMateGrid for HTML5, Riamore Soft 2016">
<meta name="keywords" content="HTML5,Grid,JavaScript,CSS,Ajax,Graph,rMateGrid">

<link href="./Samples/Web/style.css" rel="stylesheet">
<link href="./Samples/Web/jQuery/jquery.mCustomScrollbar.css" rel="stylesheet">

<script type="text/javascript" src="./Samples/Web/JS/sample_info.js"></script>
<!-- jQuery -->
<script src="./Samples/Web/jQuery/jquery-1.12.4.min.js"></script>
<script src="./Samples/Web/jQuery/jquery-ui.js"></script>
<script src="./Samples/Web/jQuery/jquery.mCustomScrollbar.js"></script>
<script src="./Samples/Web/jQuery/jquery.mousewheel.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){

	// 그리드 샘플 리스트 만들기
	createList();
	// 좌측 서브 메뉴 크기 조절
	leftMenuResize();
	// 크롬일경우에 로컬에서 문제가 발생하여 팝업 메시지 띄움

	// 탭 메뉴 이벤트 추가
	$("#tabs").tabs({
		activate: function(event, ui) {
			var active = $("#tabs").tabs("option", "active");
			if (active == 0) {
				if (opened1)
					$("#tabs-1-img").attr("src", "./Samples/Web/Images/minus.png");
				else
					$("#tabs-1-img").attr("src", "./Samples/Web/Images/plus.png");
				if (opened2)
					$("#tabs-2-img").attr("src", "./Samples/Web/Images/minus_01.png");
				else
					$("#tabs-2-img").attr("src", "./Samples/Web/Images/plus_01.png");
			} else {
				if (opened1)
					$("#tabs-1-img").attr("src", "./Samples/Web/Images/minus_01.png");
				else
					$("#tabs-1-img").attr("src", "./Samples/Web/Images/plus_01.png");
				if (opened2)
					$("#tabs-2-img").attr("src", "./Samples/Web/Images/minus.png");
				else
					$("#tabs-2-img").attr("src", "./Samples/Web/Images/plus.png");
			}
		}
	});

	// Accordion_1 메뉴이벤트 추가
	$("#menu_accordion_1 > li > div").click(function() {
		if (false == $(this).next().is(':visible')) {
			$('#menu_accordion_1 ul').slideUp(300);
			$(".menu_accordion_1_active").removeClass("menu_accordion_1_active");
		}
		$(this).next().slideToggle(300);
		if ($(this).hasClass("menu_accordion_1_active")) {
			$(".menu_accordion_1_active").removeClass("menu_accordion_1_active");
		} else {
			$(".menu_accordion_1_active").removeClass("menu_accordion_1_active");
			$(this).removeClass("menu_accordion_1");
			$(this).addClass("menu_accordion_1_active");
		}
	});

	// Accordion_2 메뉴 이벤트 추가
	$("#menu_accordion_2 > li > div").click(function() {
		if (false == $(this).next().is(':visible')) {
			$('#menu_accordion_2 ul').slideUp(300);
			$(".menu_accordion_2_active").removeClass("menu_accordion_2_active");
		}
		$(this).next().slideToggle(300);
		if ($(this).hasClass("menu_accordion_2_active")) {
			$(".menu_accordion_2_active").removeClass("menu_accordion_2_active");
		} else {
			$(".menu_accordion_2_active").removeClass("menu_accordion_2_active");
			$(this).removeClass("menu_accordion_2");
			$(this).addClass("menu_accordion_2_active");
		}
	});

	// sub 메뉴 클릭 시 클래스 추가
	$("#menu_accordion_1 > li > ul > li").click(function() {
		$(".menu_accordion_depth_1_active").removeClass("menu_accordion_depth_1_active ");
		$(this).addClass("menu_accordion_depth_1_active ");
	});

	// sub 메뉴 클릭 시 클래스 추가
	$("#menu_accordion_2 > li > ul > li").click(function() {
		$(".menu_accordion_depth_1_active").removeClass("menu_accordion_depth_1_active ");
		$(this).addClass("menu_accordion_depth_1_active ");
	});

	// 메뉴 오픈
	//$('#menu_accordion_1 ul').show();
	// Tab 1 메뉴 전체 보기
	var opened1 = false;
	$("#tabs_1_open").click(function(event) {
		$("#tabs").tabs({active: 0});
		if (opened1) {
			$("#tabs-1-img").attr("src", "./Samples/Web/Images/plus.png");
			$('#menu_accordion_1 li:has(ul)').children("#menu_accordion_1 > li > ul").slideUp();
			opened1 = false;
		} else {
			$("#tabs-1-img").attr("src", "./Samples/Web/Images/minus.png");
			$('#menu_accordion_1 li:has(ul)').children("#menu_accordion_1 > li > ul").slideDown();
			opened1 = true;
		}
		if (opened2)
			$("#tabs-2-img").attr("src", "./Samples/Web/Images/minus_01.png");
		else
			$("#tabs-2-img").attr("src", "./Samples/Web/Images/plus_01.png");
		
		event.preventDefault();
	});
	var opened2 = false;
	$("#tabs_2_open").click(function(event) {
		$("#tabs").tabs({active: 1});
		if (opened2) {
			$("#tabs-2-img").attr("src", "./Samples/Web/Images/plus.png");
			$('#menu_accordion_2 li:has(ul)').children("#menu_accordion_2 > li > ul").slideUp();
			opened2 = false;
		} else {
			$("#tabs-2-img").attr("src", "./Samples/Web/Images/minus.png");
			$('#menu_accordion_2 li:has(ul)').children("#menu_accordion_2 > li > ul").slideDown();
			opened2 = true;
		}
		if (opened1)
			$("#tabs-1-img").attr("src", "./Samples/Web/Images/minus_01.png");
		else
			$("#tabs-1-img").attr("src", "./Samples/Web/Images/plus_01.png");
		event.preventDefault();
	});

	// 스크롤 CSS 적용
	$(".menu_depth_2_wrap").mCustomScrollbar({ theme: "light-2" });

	// 윈도우 리사이즈 시 좌측 메뉴 높이 동적으로 변경함.
	$(".menu_depth_2_wrap").height($(window).height() - $("#title").outerHeight(false) - $("#manual").outerHeight(false) - $("#tabs").outerHeight(false) - 15 - 15 - 7 - 1);

	// 윈도우 리사이즈 시 좌측메뉴 스크롤 반영
	$(window).resize(function() {
		leftMenuResize();
	});
})

// 좌측 메뉴 높이 리사이즈
function leftMenuResize() {
	$(".menu_depth_2_wrap").height($(window).height() - $("#title").outerHeight(false) - $("#manual").outerHeight(false) - $("#tabs").outerHeight(false) - 15 - 15 - 7 - 1);
}

// 샘플 리스트 생성
function createList() {
	for (var n = 1; 3 > n; n++) {
		var types;
		if (n == 1)
			types = default_types_1
		else
			types = default_types_2

		var menuAccordion = _$("menu_accordion_"+n);
		for (var i = 0; i < types.length; i++) {
			var accMenuLi = _C("li"), accDiv = _C("div"), accUl = _C("ul");

			for (var j = 0; j < types[i].c.length; j++ ) {
				var accSubLi = _C("li"), accAnchor = _C("a"), liMenu = types[i].c[j];
				accAnchor.innerHTML = liMenu.n;
				accAnchor.href = "/dev/"+liMenu.u+".php";
				accAnchor.target = "sampleFrame";
				accSubLi.appendChild(accAnchor);
				accUl.appendChild(accSubLi);
			}

			accDiv.setAttribute("class", "menu_depth_2_accordion");
			accDiv.innerHTML = types[i].n;
			accMenuLi.appendChild(accDiv);
			accMenuLi.appendChild(accUl);

			menuAccordion.appendChild(accMenuLi);
		}
	}
}

// 해당 id의 엘리먼트 가져오기
function _$(id){
	return document.getElementById(id);
}

function _C(elem) {
	return document.createElement(elem);
}

function getAPI() {
	var popupWindow = window.open("http://www.upcsinfor.com/", "_blank");
	if (popupWindow)
		popupWindow.focus();
}

function logout() {
	//var popupWindow = window.open("../../Docs/rMateGridH5_3.5_사용설명서.pdf", "_blank");
	//if (popupWindow)
	//	popupWindow.focus();
	var popupWindow = window.open("/dev/logout.php", "_top")
}

function goOverView() {
	//parent.sampleFrame.location.href = "./Overview.html";
	//parent.sampleFrame.location.href = "/dev/commute.php";
}



</script>
</head>
<body>
	<div id="wrap">
		<div id="menu">
			<div id="title">
				<div id="title_kor" onClick="goOverView()">UPC&S</div>
				<!--<div id="title_sub"><?echo $user_name;?>님 환영합니다.</div>-->
				<div id="title_sub"><?echo @$_SESSION['USER_NAME'];?>님 환영합니다.</div>
				
			</div>
			<div id="manual">
				<div id="manual_buttons">
				<span class="button_manual" onclick="getAPI();">회사홈페이지</span>
				<span class="button_manual" onclick="logout();">로그아웃</span>
				</div>
			</div>
			<div id="menu_content">
				<div id="tabs" class="menu_depth_1_selector">
					<ul class="menu_depth_1_List">
						<li><div class="menu_depth_1"><a href="#tabs-1">메뉴</a><a href="#tabs_1_open" id="tabs_1_open"><img id="tabs-1-img" src="./Samples/Web/Images/plus.png"></a></div></li>
					</ul>
					<div id="tabs-1" class="menu_depth_2_wrap">
						<ul id="menu_accordion_1">
						</ul>
					</div>
					<div id="tabs-2" class="menu_depth_2_wrap">
						<ul id="menu_accordion_2">
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br><br>
</body>
</html>