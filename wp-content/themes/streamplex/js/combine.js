var agent = navigator.userAgent.toLowerCase();
ToolTip.IS_MSIE = (document.all && !window.opera) ? true : false;
ToolTip.IS_OPERA = (window.opera) ? true : false;
ToolTip.IS_NS4 = (window.layers) ? true : false;
ToolTip.IS_SAFARI = (agent.indexOf('safari') > - 1);
ToolTip.IS_DOM1 = (document.getElementById) ? true : false;
ToolTip.ALLOW_DELAY = (ToolTip.IS_MSIE == false || parseFloat(agent.substring(agent.indexOf('msie ') + 5)) >= 6);

ToolTip.current = null; 

ToolTip.OFFSET_X = 10;
ToolTip.OFFSET_Y = 20;
ToolTip.CLASS_NAME = '';
ToolTip.WIDTH = 0;
ToolTip.HEIGHT = 0;
ToolTip.BG_COLOR = '#fff';
ToolTip.FG_COLOR = '#000';
ToolTip.BORDER_STYLE = 'solid';
ToolTip.BORDER_WIDTH = '1';
ToolTip.BORDER_COLOR = '#000';
ToolTip.Z_INDEX = 1;
ToolTip.PADDING = 2;
ToolTip.TIME_DELAY = 100;
ToolTip.FADE_IN = 0;


ToolTip.tags = new Array('a', 'input', 'img');


ToolTip.add = function(element, htmlORtip, params)
{
 
 element.oldMouseOver = element.onmouseover;
 element.oldMouseOut = element.onmouseout;
 var toolTip = new ToolTip(element, htmlORtip, params);
 
 element.onmouseover = function(e)
 {
 toolTip.show();
 if(this.oldMouseOver) this.oldMouseOver(e);
 };
 element.onmouseout = function(e)
 {
 toolTip.hide();
 if(this.oldMouseOut) this.oldMouseOut(e);
 };
}


ToolTip.initByID = function()
{
 var element = document.getElementById("some_id"); 
 if(element) 
 ToolTip.add(element, "please add description", "width=300; height=200; bgColor=#0FF; fgColor=#F00; borderColor=#DDD; ");

 
 var element2 = document.getElementById("domAdd_id"); 
 if(element2) 
 {
 element2.onmouseover = function() { this.style.color = '#F00'; }; 
 element2.onmouseout = function() { this.style.color = ''; }; 
 
 var table = document.createElement('table'); table.style.position = 'absolute'; table.border = 1; table.style.backgroundColor = '#EEE';
 var tBody = document.createElement('tBody'); table.appendChild(tBody); table.style.width = '200px';
 var tr = document.createElement('tr'); tBody.appendChild(tr);
 var td = document.createElement('td'); td.colSpan = 2; td.appendChild(document.createTextNode('This is a table created by the DOM')); tr.appendChild(td);
 var tr = document.createElement('tr'); tBody.appendChild(tr);
 var td = document.createElement('td'); td.appendChild(document.createTextNode('row 2, cell 1')); tr.appendChild(td);
 var td = document.createElement('td'); td.appendChild(document.createTextNode('row 2, cell 2')); tr.appendChild(td);
 var tr = document.createElement('tr'); tBody.appendChild(tr);
 var td = document.createElement('td'); td.colSpan = 2; td.appendChild(document.createTextNode('It has three rows, this one has a colspan of 2')); tr.appendChild(td);
 ToolTip.add(element2, table, 'width=200 height=100');
 }
}


ToolTip.initByTitle = function()
{
 var elements, startHTML, startParams, startHTML2, startParams2, html, params;
 
 for(var n = 0; n < ToolTip.tags.length; n++)
 {
 elements = document.getElementsByTagName(ToolTip.tags[n]);
 
 for(var x = 0; x < elements.length; x++)
 {
 if(elements[x].title != null && elements[x].title != '' && elements[x].title != 'undefined')
 {
 
 var title = elements[x].title; html = ''; params = null;
 startHTML = startHTML2 = title.indexOf('html');
 if(startHTML > -1)
 while(startHTML2 < title.length && title.charAt(startHTML2) != '=' && title.charAt(startHTML2) != ':')
 startHTML2++;
 
 startParams = startParams2 = title.indexOf('params');
 if(startParams > -1)
 while(startParams2 < title.length && title.charAt(startParams2) != '=' && title.charAt(startParams2) != ':')
 startParams2++;
 
 if(startHTML > -1 && startParams > -1)
 {
 html = (startHTML < startParams) ? title.substring(startHTML2 + 1, startParams) : title.substr(startHTML2 + 1);
 params = (startParams < startHTML) ? title.substring(startParams2 + 1, startHTML) : title.substr(startParams2 + 1);
 }
 else if(startHTML > -1)
 html = title.substr(startHTML2 + 1);
 else if(startParams > -1)
 {
 params = title.substr(startParams2 + 1);
 html = (startParams > 0) ? title.substr(0, startParams) : '';
 }
 else html = title;

 ToolTip.add(elements[x], html, params);
 elements[x].removeAttribute('title'); 
 }
 }
 }
}


ToolTip.refresh = function(element, html, params)
{
 var toolTip = new ToolTip(element, html, params);
 toolTip.show();
 if(element.onmouseout)
 {
 var oldOut = element.onmouseout.toString();
 var oldFunction = new Function('e', oldOut.substring(oldOut.indexOf('{') + 1, oldOut.indexOf('}') - 1));
 element.onmouseout = function(e) { toolTip.hide(); oldFunction(e); element.onmouseout = oldFunction; };
 }
 else element.onmouseout = function(e) { toolTip.hide(); element.onmouseout = null; };
}


ToolTip.create = function(element, html, params)
{
 var toolTip = new ToolTip(element, html, params);
 toolTip.show();
 
 
 var oldOver = element.onmouseover.toString();
 var start = oldOver.indexOf('ToolTip.create');
 var brackets = 0;
 for(var n = start; n < oldOver.length; n++)
 {
 if(oldOver.charAt(n) == '(')
 brackets++;
 else if(oldOver.charAt(n) == ')' && --brackets == 0)
 {
 element.oldMouseOver1 = new Function('e', oldOver.substring(oldOver.indexOf('{') + 1, start));
 element.oldMouseOver2 = new Function('e', oldOver.substring(n + 1, oldOver.lastIndexOf('}') - 1));
 element.onmouseover = function(e) 
 {
 element.oldMouseOver1(e);
 toolTip.show();
 element.oldMouseOver2(e);
 }
 break;
 }
 }
 
 if(element.onmouseout)
 {
 element.oldMouseOut = element.onmouseout;
 element.onmouseout = function(e) { toolTip.hide(); if(this.oldMouseOut) this.oldMouseOut(e); };
 }
 else element.onmouseout = function(e) { toolTip.hide(); };
}

function ToolTip(element, htmlORtip, params)
{
 var ref = this;
 
 var paramObj = parseParams(params); 
 var offsetX = (paramObj.offsetX != null) ? parseInt(paramObj.offsetX) : ToolTip.OFFSET_X;
 var offsetY = (paramObj.offsetY != null) ? parseInt(paramObj.offsetY) : ToolTip.OFFSET_Y;
 var timeDelay = (paramObj.timeDelay != null) ? parseInt(paramObj.timeDelay) : ToolTip.TIME_DELAY;
 var fadeIn = (paramObj.fadeIn != null) ? parseInt(paramObj.fadeIn) : ToolTip.FADE_IN;
 var className = (paramObj.className != null) ? paramObj.className : ToolTip.CLASS_NAME;
 var width = (paramObj.width != null) ? parseInt(paramObj.width) : ToolTip.WIDTH;
 var height = (paramObj.height != null) ? parseInt(paramObj.height) : ToolTip.HEIGHT;
 var bgColor = (paramObj.bgColor != null) ? paramObj.bgColor : ToolTip.BG_COLOR;
 var fgColor = (paramObj.fgColor != null) ? paramObj.fgColor : ToolTip.FG_COLOR;
 var borderStyle = (paramObj.borderStyle != null) ? paramObj.borderStyle : ToolTip.BORDER_STYLE;
 var borderWidth = (paramObj.borderWidth != null) ? parseInt(paramObj.borderWidth) : ToolTip.BORDER_WIDTH;
 var borderColor = (paramObj.borderColor != null) ? paramObj.borderColor : ToolTip.BORDER_COLOR;
 var zIndex = (paramObj.zIndex != null) ? paramObj.zIndex : ToolTip.Z_INDEX;
 var padding = (paramObj.padding != null) ? parseInt(paramObj.padding) : ToolTip.PADDING;
 
 

 if(typeof(htmlORtip) == 'string')
 {
 var toolTip = document.createElement('span');
 if(width > 0) toolTip.style.width = width+'px';
 if(height > 0) toolTip.style.height = height+'px';
 if(className != '') toolTip.className = className;
 toolTip.style.borderStyle = borderStyle;
 toolTip.style.borderWidth = borderWidth+'px';
 toolTip.style.borderColor = borderColor;
 toolTip.style.backgroundColor = bgColor;
 toolTip.style.color = fgColor;
 toolTip.style.zIndex = zIndex;
 toolTip.style.padding = padding+'px '+padding+'px '+padding+'px '+padding+'px';
 toolTip.style.opacity = opacity;
 
 toolTip.innerHTML = htmlORtip.replace(/\\"/g, '"');
 }
 else if(typeof(htmlORtip) == 'object') 
 toolTip = htmlORtip;
 toolTip.style.position = 'absolute';
 
 
 var doc = (document.compatMode && document.compatMode != 'BackCompat') ? document.documentElement : document.body;

 var timerID, opacity = 0, smoothness = 20; 
 var hideTimerID, safariHideDelay = 50; 
 this.show = function()
 {
 if(ToolTip.IS_SAFARI && hideTimerID)
 {
 window.clearTimeout(hideTimerID);
 hideTimerID = null;
 }

 if(timerID == null)
 {
 if(ToolTip.current != null && ToolTip.current != ref) 
 ToolTip.current.hide();
 
 document.onmousemove = (ToolTip.IS_MSIE) ? trackIE : trackGECKO;
 if(timeDelay > 0 && ToolTip.ALLOW_DELAY)
 timerID = window.setTimeout(show, timeDelay);
 else show();
 }
 
 function show() 
 {
 timerID = null;
 ToolTip.current = ref;
 document.body.appendChild(toolTip);
 if(fadeIn > 0 && ToolTip.ALLOW_DELAY)
 fade();
 }
 function fade() 
 {
 
 opacity = (opacity < 100) ? (opacity + 100 / smoothness) : 99;
 if(opacity > 99) opacity = 99;
 toolTip.style['opacity'] = opacity / 100;
 toolTip.style['-moz-opacity'] = opacity / 100;
 toolTip.style['filter'] = 'alpha(opacity='+opacity+')';
 
 if(opacity < 99)
 window.setTimeout(fade, fadeIn / smoothness);
 }
 }
 this.hide = function()
 {
 if(ToolTip.IS_SAFARI && hideTimerID == null) 
 hideTimerID = window.setTimeout(hide, safariHideDelay);
 else hide();
 function hide()
 { 
 if(timerID)
 {
 window.clearTimeout(timerID);
 timerID = null;
 }
 document.onmousemove = null;
 if(toolTip.parentNode == document.body)
 document.body.removeChild(toolTip);
 ToolTip.current = null;
 }
 }
 
 var scrollX, scrollY, innerW, innerH, maxX, maxY, x, y;
 function trackIE()
 {
 scrollX = doc.scrollLeft;
 scrollY = doc.scrollTop;
 innerW = doc.clientWidth;
 innerH = doc.clientHeight;
 maxX = scrollX + innerW;
 maxY = scrollY + innerH;
 x = window.event.clientX + scrollX + offsetX;
 y = window.event.clientY + scrollY + offsetY;
 
 move();
 }
 function trackGECKO(e)
 {
 scrollX = window.pageXOffset;
 scrollY = window.pageYOffset;
 innerW = window.innerWidth;
 innerH = window.innerHeight;
 maxX = scrollX + innerW;
 maxY = scrollY + innerH;
 x = e.pageX + offsetX;
 y = e.pageY + offsetY;
 move();
 }
 
 function move()
 {
 toolTip.style.left = (x + width + 2*padding < maxX ? x : x - width - 2*offsetX - 2*padding)+'px';
 toolTip.style.top = (y + height + 2*padding < maxY ? y : y - height - 2*offsetY - 2*padding)+'px';
 }
 
 
 
 function parseParams(str)
 {
 var paramObj = new Object();
 if(str == null) return paramObj;
 
 var index = 0;
 var token;
 for(var n = 0; n < str.length; n++)
 {
 switch(str.charAt(n))
 {
 case ';':
 case ',':
 case ':': 
 case '=': 
 case ' ':
 case '"': 
 case "'": 
 if(index < n)
 {
 if(token)
 {
 paramObj[token] = str.substr(index, n - index);
 token = null;
 }
 else token = str.substr(index, n - index);
 }
 index = n + 1;
 break;
 default: break;
 }
 }
 if(index < str.length && token != null)
 paramObj[token] = str.substr(index, n - index);
 return paramObj;
 }
}
function mainmenu(){
jQuery("#nav a").removeAttr("title");
jQuery("#nav ul ").css({display: "none"}); // Opera Fix
jQuery("#nav li").hover(function(){
		jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).show(200);
		},function(){
		jQuery(this).find('ul:first').css({visibility: "hidden"});
		});
}

 
 
 jQuery(document).ready(function(){					
	mainmenu();
});
(function($) {

 $.fn.jFlow = function(options) {
 var opts = $.extend({}, $.fn.jFlow.defaults, options);
 var randNum = Math.floor(Math.random()*11);
 var jFC = opts.controller;
 var jFS = opts.slideWrapper;
 var jSel = opts.selectedWrapper;

 var cur = 0;
 var timer;
 var maxi = $(jFC).length;
 
 var slide = function (dur, i) {
 $(opts.slides).children().css({
 overflow:"hidden"
 });
 $(opts.slides + " iframe").hide().addClass("temp_hide");
 $(opts.slides).animate({
 marginLeft: "-" + (i * $(opts.slides).find(":first-child").width() + "px")
 },
 opts.duration*(dur),
 opts.easing,
 function(){
 $(opts.slides).children().css({
 overflow:"hidden"
 });
 $(".temp_hide").show();
 }
 );
 
 }
 $(this).find(jFC).each(function(i){
 $(this).click(function(){
 dotimer();
 if ($(opts.slides).is(":not(:animated)")) {
 $(jFC).removeClass(jSel);
 $(this).addClass(jSel);
 var dur = Math.abs(cur-i);
 slide(dur,i);
 cur = i;
 }
 });
 }); 
 
 $(opts.slides).before('<div id="'+jFS.substring(1, jFS.length)+'"></div>').appendTo(jFS);
 
 $(opts.slides).find("div").each(function(){
 $(this).before('<div class="jFlowSlideContainer"></div>').appendTo($(this).prev());
 });
 
 
 $(jFC).eq(cur).addClass(jSel);
 
 var resize = function (x){
 $(jFS).css({
 position:"relative",
 width: opts.width,
 height: opts.height,
 overflow: "hidden"
 });
 
 $(opts.slides).css({
 position:"relative",
 width: $(jFS).width()*$(jFC).length+"px",
 height: $(jFS).height()+"px",
 overflow: "hidden"
 });
 
 $(opts.slides).children().css({
 position:"relative",
 width: $(jFS).width()+"px",
 height: $(jFS).height()+"px",
 "float":"left",
 overflow:"hidden"
 });
 
 $(opts.slides).css({
 marginLeft: "-" + (cur * $(opts.slides).find(":eq(0)").width() + "px")
 });
 }
 
 
 resize();

 
 $(window).resize(function(){
 resize(); 
 });
 
 $(opts.prev).click(function(){
 dotimer();
 doprev();
 
 });
 
 $(opts.next).click(function(){
 dotimer();
 donext();
 
 });
 
 var doprev = function (x){
 if ($(opts.slides).is(":not(:animated)")) {
 var dur = 1;
 if (cur > 0)
 cur--;
 else {
 cur = maxi -1;
 dur = cur;
 }
 $(jFC).removeClass(jSel);
 slide(dur,cur);
 $(jFC).eq(cur).addClass(jSel);
 }
 }
 
 var donext = function (x){
 if ($(opts.slides).is(":not(:animated)")) {
 var dur = 1;
 if (cur < maxi - 1)
 cur++;
 else {
 cur = 0;
 dur = maxi -1;
 }
 $(jFC).removeClass(jSel);
 
 slide(dur, cur);
 
 $(jFC).eq(cur).addClass(jSel);
 }
 }
 
 $(".pause").click(function(){
 dopause();
 });
 
 $(".resume").click(function(){
 doresume();
 });
 
 var dotimer = function (x){
 if((opts.auto) == true) {
 if(timer != null) 
 clearInterval(timer);
 
 timer = setInterval(function() {
 donext();
 }, 5000);
 }
 }

 var dopause = function (x){
 if(timer != null)
 clearInterval(timer);
 timer = setInterval(function() {
 donext();
 }, 500000);
 
 }
 
 dotimer();
 
 var doresume = function (x){
 if(timer != null)
 clearInterval(timer);
 timer = setInterval(function() {
 donext();
 }, 5000);
 }
 
 dotimer();
 };
 
 $.fn.jFlow.defaults = {
 controller: ".jFlowControl", 
 slideWrapper : "#jFlowSlide", 
 selectedWrapper: "jFlowSelected", 
 auto: false,
 easing: "swing",
 duration: 400,
 width: "100%",
 prev: ".jFlowPrev", 
 next: ".jFlowNext" 
 };
 
})(jQuery);