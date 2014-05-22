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
	if (typeof hdc != 'undefined')
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
}

function drawRect(coOrdStr)
{
	if (typeof hdc != 'undefined')
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
    if (typeof hdc != 'undefined')
	{
    	hdc.clearRect(0, 0, canvas.width, canvas.height);
	}
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
	
	<img id="mapaBrasil" class="map-brasil" alt="mapa Brasil" src="<?php echo get_template_directory_uri() . '/images/mapa_brasil.png'; ?>"
		style="width: 533px; height: 485px;" usemap="#mapa_brasil">
	<br>
	<map id="mapa_brasil" name="mapa_brasil">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="181,67,176,67,170,67,167,68,165,71,165,77,163,79,161,77,157,75,153,75,151,76,151,79,148,81,147,83,145,84,144,83,138,75,139,56,137,53,134,52,134,50,132,45,131,44,130,43,130,41,128,40,126,40,122,42,119,41,117,39,116,37,116,35,117,29,118,27,117,25,116,23,112,22,110,19,110,17,116,20,124,23,128,23,135,26,137,22,141,20,148,18,151,15,157,16,159,15,160,13,161,10,160,8,162,6,169,11,167,16,172,23,171,28,168,35,170,43,176,52,181,58,182,65"
			href="javascript:map_estados_click(1.9780917659769406, -60.022839074218716, 6, 'rr');" alt="RORAIMA">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="52,93,54,77,47,72,48,64,57,60,50,58,50,51,73,46,77,43,81,54,92,60,107,57,122,44,131,46,138,58,139,75,140,82,148,85,155,78,163,81,172,68,181,68,181,78,192,89,200,90,204,93,185,147,190,155,186,172,156,173,141,171,134,163,123,165,101,183,93,180,84,186,4,155,10,145,12,136,17,131,47,120"
			href="javascript:map_estados_click(-2.9362446361557346, -63.189648156249966, 6, 'am');" alt="AMAZONAS">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="207,46,218,46,216,39,230,39,231,49,243,56,261,85,291,96,278,86,280,73,287,73,297,73,305,73,306,76,333,83,328,109,303,132,308,141,301,152,295,157,298,168,283,187,208,183,199,172,193,158,188,151,208,96,201,89,193,88,184,74,184,59,188,52"
			href="javascript:map_estados_click(-3.4915906071701035, -49.0430364202263, 5, 'pa');" alt="PAR&Aacute;">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="295.1999969482422,49,277.1999969482422,68,269.1999969482422,74,265.1999969482422,82,263.1999969482422,82,262.1999969482422,82,260.1999969482422,81,258.1999969482422,78,257.1999969482422,76,256.1999969482422,72,252.1999969482422,71,252.1999969482422,64,251.1999969482422,59,247.1999969482422,57,247.1999969482422,54,245.1999969482422,52,242.1999969482422,52,230.1999969482422,45,230.1999969482422,44,229.1999969482422,42,230.1999969482422,41,232.1999969482422,39,239.1999969482422,44,243.1999969482422,43,245.1999969482422,42,254.1999969482422,43,256.1999969482422,40,262.1999969482422,27,268.1999969482422,21,269.1999969482422,16,274.1999969482422,19,273.1999969482422,26,276.1999969482422,33,279.1999969482422,41,287.1999969482422,47"
			href="javascript:map_estados_click(2.042922656988901, -50.1636418889763, 6, 'ap');" alt="AMAP&Aacute;">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="304.0833282470703,133,327.0833282470703,108,330.0833282470703,104,332.0833282470703,98,334.0833282470703,92,335.0833282470703,86,338.0833282470703,85,347.0833282470703,88,355.0833282470703,95,352.0833282470703,110,367.0833282470703,100,373.0833282470703,100,380.0833282470703,105,385.0833282470703,103,379.0833282470703,112,377.0833282470703,117,375.0833282470703,120,374.0833282470703,123,375.0833282470703,130,372.0833282470703,135,371.0833282470703,139,375.0833282470703,146,374.0833282470703,150,370.0833282470703,153,361.0833282470703,152,352.0833282470703,158,347.0833282470703,160,345.0833282470703,160,345.0833282470703,161,342.0833282470703,167,339.0833282470703,173,338.0833282470703,183,341.0833282470703,189,339.0833282470703,193,337.0833282470703,195,335.0833282470703,194,331.0833282470703,192,328.0833282470703,188,329.0833282470703,183,326.0833282470703,182,322.0833282470703,178,330.0833282470703,168,330.0833282470703,164,327.0833282470703,164,325.0833282470703,167,316.0833282470703,160,318.0833282470703,158,316.0833282470703,156,317.0833282470703,153,317.0833282470703,141,319.0833282470703,138,317.0833282470703,135,310.0833282470703,132,308.0833282470703,133"
			href="javascript:map_estados_click(-5.014819924963368, -43.93811078515628, 6, 'ma');" alt="MARANH&Atilde;O">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="6,156,88,190,73,199,65,204,57,201,47,204,39,202,42,184,34,192,22,192,19,185,15,182,3,170"
			href="javascript:map_estados_click(-8.981814864398771, -70.17420626171871, 7, 'ac');" alt="ACRE">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="89,190,80,196,80,205,100,205,114,218,125,221,138,228,149,233,160,232,172,217,170,205,156,199,152,192,153,175,142,173,135,166,125,167,103,184,94,184"
			href="javascript:map_estados_click(-10.227506519855961, -60.967663292968716, 6, 'ro');" alt="ROND&Ocirc;NIA">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="160,238,173,217,173,205,158,197,155,190,156,176,188,175,192,161,203,182,234,185,282,189,277,210,279,221,274,245,249,280,228,278,212,274,198,282,188,266,166,264"
			href="javascript:map_estados_click(-13.79899613053151, -54.66457553124998, 6, 'mt');" alt="MATO GROSSO">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="280,219,286,191,299,170,298,159,312,134,316,158,327,169,323,178,333,195,328,205,332,223,320,228,301,224,294,226"
			href="javascript:map_estados_click(-9.3125876115149, -47.74574840234379, 6, 'to');" alt="TOCANTINS">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="340,192,344,162,373,152,378,145,375,141,374,135,376,123,385,104,394,105,390,115,395,149,400,152,399,156,399,166,379,182,363,180,363,191,350,197"
			href="javascript:map_estados_click(-6.744557263267556, -41.52111859765628, 6, 'pi');" alt="PIAU&Iacute;">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="403,155,396,129,396,105,405,103,430,119,440,126,430,143,425,151,425,159,421,163"
			href="javascript:map_estados_click(-5.709926219210012, -37.1228704046013, 6, 'ce');" alt="CEAR&Aacute;">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="440.76666259765625,130,444.76666259765625,128,452.76666259765625,132,458.76666259765625,132,465.76666259765625,136,466.76666259765625,143,469.76666259765625,150,464.76666259765625,146,462.76666259765625,147,459.76666259765625,149,456.76666259765625,149,453.76666259765625,146,450.76666259765625,146,450.76666259765625,151,448.76666259765625,153,444.76666259765625,151,439.76666259765625,152,439.76666259765625,149,440.76666259765625,146,442.76666259765625,143,438.76666259765625,144,434.76666259765625,145,430.76666259765625,148,426.76666259765625,145,428.76666259765625,142,432.76666259765625,137,433.76666259765625,135,432.76666259765625,132,436.76666259765625,130,439.76666259765625,129"
			href="javascript:map_estados_click(-5.338126455015082, -35.8374700139763, 7, 'rn');" alt="RIO GRANDE DO NORTE">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="427,145,430,147,438,143,440,142,441,143,441,145,440,147,438,148,438,151,440,151,441,151,442,151,445,150,447,154,451,152,450,145,453,145,455,148,459,148,461,146,465,146,467,147,470,149,470,154,469,156,469,160,466,160,463,157,461,159,461,161,459,162,457,162,456,163,451,163,450,165,448,166,444,166,441,165,442,162,445,158,437,158,436,161,435,162,433,163,431,163,428,162,427,161,424,162,425,158,424,156,424,155,424,153,425,152,425,146,426,145,427,144"
			href="javascript:map_estados_click(-7.235434335980407, -36.50124156640629, 8, 'pb');" alt="PARA&Iacute;BA">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="400,158,415,158,417,163,418,164,420,164,422,161,427,161,429,163,431,163,434,163,435,162,436,160,437,159,444,158,443,161,442,163,442,165,443,167,446,165,449,165,450,163,456,163,456,162,459,162,464,157,465,158,465,159,466,160,468,160,470,162,470,173,469,175,468,176,467,176,465,176,464,177,461,177,459,175,457,177,456,177,456,178,455,178,454,179,452,180,451,180,451,181,450,182,444,182,443,181,440,179,439,178,438,177,437,177,435,176,434,177,434,178,433,179,432,180,431,181,430,180,430,177,429,177,428,176,427,175,423,175,422,173,421,172,419,172,418,171,414,171,413,172,412,173,410,174,407,175,407,176,404,179,403,180,402,180,402,181,399,181,398,180,397,178,396,176,395,175,393,175,392,174,391,173,394,172,395,171,396,171,397,170,398,168,399,168,400,168,400,166,400,162,399,159,399,158"
			href="javascript:map_estados_click(-8.083170249100542, -37.37280936944505, 7, 'pe');" alt="PERNAMBUCO">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="434,182,435,178,446,182,457,178,467,179,464,183,519,183,519,191,518,195,454,192,445,189"
			href="javascript:map_estados_click(-9.577380852874896, -36.36940562890629, 8, 'al');" alt="ALAGOAS">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="432,185,434,192,429,199,437,208,441,206,498,208,497,198,450,199,452,196,438,186"
			href="javascript:map_estados_click(-10.536252353462848, -36.90224254296879, 8, 'se');" alt="Sergipe">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="336,197,346,204,364,197,366,184,376,186,392,178,401,184,420,177,429,184,430,193,426,200,430,208,439,211,427,226,424,222,420,230,421,248,418,272,411,290,404,282,404,271,408,265,407,260,394,258,384,252,373,245,365,245,367,239,356,239,343,247,338,249,338,241,335,239,332,205"
			href="javascript:map_estados_click(-13.93843295148234, -39.94545543359379, 6, 'ba');" alt="BAHIA">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();'
coords="313,288,290,292,278,298,273,300,261,293,252,288,253,277,262,266,272,250,283,223,297,228,309,228,321,231,329,227,334,245,331,246,325,237,300,237,298,269,318,269,320,277,321,286"
			href="javascript:map_estados_click(-16.489545110135776, -49.10255992578129, 6, 'go');" alt="GOI&Aacute;S">
		<area shape="rect"
		onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();'
		coords="302,240,329,268" href="javascript:map_estados_click(-15.827322694625742, -47.5434026311638, 9, 'df');"
			alt="DISTRITO FEDERAL">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="331,251,341,253,362,240,361,247,369,246,382,254,393,261,404,262,406,265,400,275,399,278,403,284,391,308,380,321,378,330,357,332,335,344,328,334,332,331,325,327,320,308,313,310,301,311,299,308,287,308,278,308,280,302,294,292,321,289,324,277,324,273,331,269"
			href="javascript:map_estados_click(-18.307672760467163, -42.95021617578129, 6, 'mg');" alt="MINAS GERAIS">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="383,322,404,287,411,289,411,302,411,304,511,304,510,317,407,318,402,318,395,324"
			href="javascript:map_estados_click(-17.47126983928056, -39.36318004296879, 6, 'es');" alt="ESP&Iacute;RITO SANTO">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="353,340,378,331,382,324,394,326,395,335,489,338,489,352,358,349"
			href="javascript:map_estados_click(-21.488927749959952, -42.14272105859379, 7, 'rj');" alt="RIO DE JANEIRO">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="194,288,212,278,242,284,251,291,274,303,274,307,266,322,253,339,243,342,235,361,231,354,226,360,218,343,217,339,193,336,192,317,192,306"
			href="javascript:map_estados_click(-20.49223599374924, -53.60988803124998, 6, 'ms');" alt="MATO GROSSO DO SUL">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="260,336,278,313,296,312,307,315,318,310,324,327,326,332,329,345,340,346,348,342,349,348,341,356,329,363,320,369,310,376,305,371,305,366,299,367,292,348,280,346,266,342"
			href="javascript:map_estados_click(-22.139955704130976, -46.86428256249998, 6, 'sp');" alt="S&Atilde;O PAULO">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="234,377,241,352,252,343,265,343,281,349,289,350,295,367,301,366,304,379,304,381,295,383,291,380,279,384,271,389,244,387"
			href="javascript:map_estados_click(-24.443079714330477,-50.51726517442131,6,'pr');" alt="PARAN&Aacute;">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="242,396,242,386,269,390,286,384,295,386,303,383,303,395,410,393,408,410,309,410,303,410,289,421,287,419,289,416,281,410,271,402,261,398"
			href="javascript:map_estados_click(-27.657612362418984, -50.24807162499998, 7, 'sc');" alt="SANTA CATARINA">
		<area shape="poly"
		
onmouseover='pontosdecultura_map_Hover(this);' onmouseout='pontosdecultura_map_Leave();' 
coords="196,434,216,412,241,398,263,402,273,409,280,416,284,416,282,420,283,422,286,424,289,426,282,441,270,451,263,453,261,462,247,475,245,472,248,465,240,454,223,443,214,447,215,441,208,436"
			href="javascript:map_estados_click(-30.27174883870184, -50.79738803124998, 6, 'rs');" alt="RIO GRANDE DO SUL">
	</map>
