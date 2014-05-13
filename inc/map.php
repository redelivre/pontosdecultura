<script>

// stores the device context of the canvas we use to draw the outlines
// initialized in pontosdecultura_map_Init, used in pontosdecultura_map_Hover and pontosdecultura_map_Leave
var hdc;

// shorthand func
function byId(e){return document.getElementById(e);}

// takes a string that contains coords eg - "227,307,261,309, 339,354, 328,371, 240,331"
// draws a line from each co-ord pair to the next - assumes starting point needs to be repeated as ending point.
function drawPoly(coOrdStr)
{
    var mCoords = coOrdStr.split(',');
    var i, n;
    n = mCoords.length;

    hdc.beginPath();
    hdc.moveTo(mCoords[0], mCoords[1]);
    for (i=2; i<n; i+=2)
    {
        hdc.lineTo(mCoords[i], mCoords[i+1]);
    }
    hdc.lineTo(mCoords[0], mCoords[1]);
    hdc.stroke();
    hdc.fill();
}

function drawRect(coOrdStr)
{
    var mCoords = coOrdStr.split(',');
    var top, left, bot, right;
    left = mCoords[0];
    top = mCoords[1];
    right = mCoords[2];
    bot = mCoords[3];
    hdc.strokeRect(left,top,right-left,bot-top);
    hdc.fill();
}

function pontosdecultura_map_Hover(element)
{
    var hoveredElement = element;
    var coordStr = element.getAttribute('coords');
    var areaType = element.getAttribute('shape');

    switch (areaType)
    {
        case 'polygon':
        case 'poly':
            drawPoly(coordStr);
            break;

        case 'rect':
            drawRect(coordStr);
    }
}

function pontosdecultura_map_Leave()
{
    var canvas = byId('pontosdecultura_map_Canvas');
    hdc.clearRect(0, 0, canvas.width, canvas.height);
}

function pontosdecultura_map_Init()
{
    // get the target image
    var img = byId('mapaBrasil');

    var x,y, w,h;

    // get it's position and width+height
    var pos = jQuery('#mapaBrasil').position();
    //x = img.offsetLeft;
    x = pos.left;
    //y = img.offsetTop;
    y = pos.top;
    w = img.clientWidth;
    h = img.clientHeight;

    // move the canvas, so it's contained by the same parent as the image
    var imgParent = img.parentNode;
    var can = byId('pontosdecultura_map_Canvas');
    imgParent.appendChild(can);

    // place the canvas in front of the image
    can.style.zIndex = 1;

    // position it over the image
    can.style.left = x+'px';
    can.style.top = y+'px';

    // make same size as the image
    can.setAttribute('width', w+'px');
    can.setAttribute('height', h+'px');

    // get it's context
    hdc = can.getContext('2d');

    // set the 'default' values for the colour/width of fill/stroke operations
    hdc.fillStyle = 'red';
    hdc.strokeStyle = 'red';
    hdc.lineWidth = 2;
}
jQuery( document ).ready(function () {
	pontosdecultura_map_Init();
});
</script>

	<canvas id='pontosdecultura_map_Canvas' style="pointer-events: none;position: absolute;" ></canvas>
	
	<img id="mapaBrasil" alt="mapa Brasil" src="<?php echo get_template_directory_uri() . '/images/mapa_brasil.png'; ?>"
		style="width: 533px; height: 485px;" usemap="#mapa_brasil">
	<br>
	<map id="mapa_brasil" name="mapa_brasil">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="110,18,117,40,129,42,139,55,142,77,148,82,153,74,162,79,169,66,180,67,181,57,170,37,232,32,230,16,170,14,162,5,156,15,143,18,135,23"
			href="roraima.html" alt="RORAIMA">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="52,93,54,77,47,72,48,64,57,60,50,58,50,51,73,46,77,43,81,54,92,60,107,57,122,44,131,46,138,58,139,75,140,82,148,85,155,78,163,81,172,68,181,68,181,78,192,89,200,90,204,93,185,147,190,155,186,172,156,173,141,171,134,163,123,165,101,183,93,180,84,186,4,155,10,145,12,136,17,131,47,120"
			href="amazonas.html" alt="AMAZONAS">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="207,46,218,46,216,39,230,39,231,49,243,56,261,85,291,96,278,86,280,73,287,73,297,73,305,73,306,76,333,83,328,109,303,132,308,141,301,152,295,157,298,168,283,187,208,183,199,172,193,158,188,151,208,96,201,89,193,88,184,74,184,59,188,52"
			href="para.html" alt="PAR&Aacute;">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="295.1999969482422,49,277.1999969482422,68,269.1999969482422,74,265.1999969482422,82,263.1999969482422,82,262.1999969482422,82,260.1999969482422,81,258.1999969482422,78,257.1999969482422,76,256.1999969482422,72,252.1999969482422,71,252.1999969482422,64,251.1999969482422,59,247.1999969482422,57,247.1999969482422,54,245.1999969482422,52,242.1999969482422,52,230.1999969482422,45,230.1999969482422,44,229.1999969482422,42,230.1999969482422,41,232.1999969482422,39,239.1999969482422,44,243.1999969482422,43,245.1999969482422,42,254.1999969482422,43,256.1999969482422,40,262.1999969482422,27,268.1999969482422,21,269.1999969482422,16,274.1999969482422,19,273.1999969482422,26,276.1999969482422,33,279.1999969482422,41,287.1999969482422,47"
			href="amapa.html" alt="AMAP&Aacute;">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="309,130,326,113,338,82,440,80,440,98,439,102,377,100,384,105,376,117,370,138,372,149,360,149,344,158,340,173,340,180,337,194,325,178,331,167,319,161,319,137"
			href="maranhao.html" alt="MARANH&Atilde;O">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="6,156,88,190,73,199,65,204,57,201,47,204,39,202,42,184,34,192,22,192,19,185,15,182,3,170"
			href="acre.html" alt="ACRE">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="89,190,80,196,80,205,100,205,114,218,125,221,138,228,149,233,160,232,172,217,170,205,156,199,152,192,153,175,142,173,135,166,125,167,103,184,94,184"
			href="rondonia.html" alt="ROND&Ocirc;NIA">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="160,238,173,217,173,205,158,197,155,190,156,176,188,175,192,161,203,182,234,185,282,189,277,210,279,221,274,245,249,280,228,278,212,274,198,282,188,266,166,264"
			href="matograsso.html" alt="MATO GROSSO">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="280,219,286,191,299,170,298,159,312,134,316,158,327,169,323,178,333,195,328,205,332,223,320,228,301,224,294,226"
			href="tocantins.html" alt="TOCANTINS">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="340,192,344,162,373,152,378,145,375,141,374,135,376,123,385,104,394,105,390,115,395,149,400,152,399,156,399,166,379,182,363,180,363,191,350,197"
			href="piaiu.html" alt="PIAU&Iacute;">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="403,155,396,129,396,105,405,103,430,119,440,126,430,143,425,151,425,159,421,163"
			href="ceara.html" alt="CEAR&Aacute;">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="447,127,447,119,530,120,529,143,468,140,452,144,449,150,441,148,443,142,433,146,430,146,440,132"
			href="rn.html" alt="RIO GRANDE DO NORTE">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="425,160,428,150,437,148,442,153,452,153,464,149,473,146,511,147,510,160,466,159,446,164"
			href="paraiba.html" alt="PARA&Iacute;BA">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="395,176,403,168,403,158,418,164,425,162,445,165,465,161,513,164,513,176,464,176,456,175,447,181,439,178,418,173,404,179"
			href="pernambuco.html" alt="PERNAMBUCO">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="434,182,435,178,446,182,457,178,467,179,464,183,519,183,519,191,518,195,454,192,445,189"
			href="alagoas.html" alt="ALAGOAS">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="432,185,434,192,429,199,437,208,441,206,498,208,497,198,450,199,452,196,438,186"
			href="sergipe.html%20%20alt=" sergipe="">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="336,197,346,204,364,197,366,184,376,186,392,178,401,184,420,177,429,184,430,193,426,200,430,208,439,211,427,226,424,222,420,230,421,248,418,272,411,290,404,282,404,271,408,265,407,260,394,258,384,252,373,245,365,245,367,239,356,239,343,247,338,249,338,241,335,239,332,205"
			href="bahia.html" alt="BAHIA">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();'
coords="313,288,290,292,278,298,273,300,261,293,252,288,253,277,262,266,272,250,283,223,297,228,309,228,321,231,329,227,334,245,331,246,325,237,300,237,298,269,318,269,320,277,321,286"
			href="goiania.html" alt="GOI&Aacute;S">
		<area shape="rect"
		onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();'
		coords="302,240,329,268" href="df.html"
			alt="DISTRITO FEDERAL">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="331,251,341,253,362,240,361,247,369,246,382,254,393,261,404,262,406,265,400,275,399,278,403,284,391,308,380,321,378,330,357,332,335,344,328,334,332,331,325,327,320,308,313,310,301,311,299,308,287,308,278,308,280,302,294,292,321,289,324,277,324,273,331,269"
			href="mg.html" alt="MINAS GERAIS">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="383,322,404,287,411,289,411,302,411,304,511,304,510,317,407,318,402,318,395,324"
			href="es.html" alt="ESP&Iacute;RITO SANTO">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="353,340,378,331,382,324,394,326,395,335,489,338,489,352,358,349"
			href="rj.html" alt="RIO DE JANEIRO">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="194,288,212,278,242,284,251,291,274,303,274,307,266,322,253,339,243,342,235,361,231,354,226,360,218,343,217,339,193,336,192,317,192,306"
			href="matogrossosul.html" alt="MATO GROSSO DO SUL">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="260,336,278,313,296,312,307,315,318,310,324,327,326,332,329,345,340,346,348,342,349,348,341,356,329,363,320,369,310,376,305,371,305,366,299,367,292,348,280,346,266,342"
			href="sp.html" alt="S&Atilde;O PAULO">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="234,377,241,352,252,343,265,343,281,349,289,350,295,367,301,366,304,379,304,381,295,383,291,380,279,384,271,389,244,387"
			href="javascript:map_estados_click(-24.443079714330477,-50.51726517442131,6,'pr')" alt="PARAN&Aacute;">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="242,396,242,386,269,390,286,384,295,386,303,383,303,395,410,393,408,410,309,410,303,410,289,421,287,419,289,416,281,410,271,402,261,398"
			href="sc.html" alt="SANTA CATARINA">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="196,434,216,412,241,398,263,402,273,409,280,416,284,416,282,420,283,422,286,424,289,426,282,441,270,451,263,453,261,462,247,475,245,472,248,465,240,454,223,443,214,447,215,441,208,436"
			href="rgs.html" alt="RIO GRANDE DO SUL">
		<area shape="default" nohref="nohref" alt="">
	</map>
