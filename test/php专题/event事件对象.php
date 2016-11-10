<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/10
 * Time: 10:57
 */


/*事件对象 的获取很简单,很久前我们就知道IE中事件对象是作为全局对象( window.event )存在的,Firefox中则是做为句柄( handler )的第一个参数传入内的。所以一行代码就可以搞定

代码如下:
var evt = window.event || arguments[0];
下面分三种添加事件的方式讨论,你也许会看到以前没有看到过的获取方式。
1,第一种添加事件的方式,直接在html的属性中写JS代码
代码如下:
<div onclick="alert(4);">Div1 Element</div>

大概这是上世纪90年代的写法,那时候直接把js代码写在网页中很普遍,也许那时候的js并不太重要,只是用来做做验证或一些花哨的效果而已。如何在这种添加事件方式下获取到事件对象?IE中很简单,因为event是作为全局对象的,所以直接使用event即可,如下

代码如下:
<div onclick="alert(window.event.type);">Div1 Element</div>
点击该Div后,IE中会弹出'click'字符的信息框。说明事件对象获取到了,如果在 Opera/Safari/Chrome 中也测试了,会发现效果和IE一样,说明 Opera/Safari/Chrome 中也支持IE方式( window.event )获取事件对象。
Firefox中会报错,提示:window.event is undefined,说明Firefox不支持IE方式获取事件对象而是以句柄的第一个参数传入的,文章开头意见提到了。
上面的用 window.event 来获取事件对象,其实window可以省略的,就像使用alert而不是window.alert一样。如
代码如下:
<div onclick="alert(event.type);">Div1 Element</div>
在 IE/Opera/Safari/Chrome 中测试,和刚刚不会有什么区别。在Firefox中再测,会有个惊喜,你会发现居然弹出的是"click"信息框,而不是"undefined"。
两次测试区别仅仅一个用window.event.type,一个用event.type。这个问题下面详细讨论。
下面用句柄第一个参数来获取事件对象,可以把onclick属性的值想象成一个匿名函数,onclick属性值的字符串实际上都是这个匿名函数内的js代码。
既然这样,我们就可以通过Function的一个属性argumengs获取到该匿名函数的第一个参数,而该参数就是事件对象。如
代码如下:

<div onclick="alert(arguments[0].type);">Div1 Element</div>

IE中会报错,提示:arguments.0.type为空或不是对象
Firefox/Opera/Safari/Chrome 中会弹出"click"内容的信息框,说明他们都支持事件对象作为句柄第一个参数传入。从侧面也说明了 Opera/Safari/Chrome 不仅支持W3C标准方式获取事件对象,同时也兼容了IE方式获取事件对象。
既然知道onclick对应的是一个匿名函数,我们不妨把该匿名函数打印出来看看,只需以下代码
代码如下:
<div onclick="alert(arguments.callee);">Div1 Element</div>
在各浏览器中点击该Div,结果如下:
IE6/7/8 :

function onclick(){ alert(arguments.callee);}

IE9 :

 function onclick(event){ alert(arguments.callee);}

Firefox / Safari :

function onclick(event) { alert(arguments.callee);}

Chrome :

function onclick(evt) { alert(arguments.callee);}

Opera :

 function anonymous(event) {alert(arguments.callee);}

观察这些函数发现:

IE6/7/8没有定义参数

IE9/Firefox/Safari/Opera 定义了参数event

Chrome定义了参数evt。

现在回到上面遗留的问题,如下

代码如下:

<div onclick="alert(window.event.type);">Div1 Element</div>

<div onclick="alert(event.type);">Div1 Element</div>

这两个div的区别仅window.event.type和event.type。分别点击后,后者在Firefox中不弹出"undefined",而是"click",是因为Firefox中匿名函数定义了参数event,该参数刚好与IE的全局对象event同名,从而误以为Firefox也支持IE方式获取事件对象。

同样的道理,Chrome中定义的参数是evt,那么在Chrome中还可以通过以下方式获取事件对象,如下

代码如下:

<div onclick="alert(evt);">Div1 Element</div>

2,第二种添加事件的方式,定义一个函数,赋值给html元素的onXXX属性

代码如下:

<script type="text/javascript">

function clk(){}

</script>

<div onclick="clk()">Div2 Element</div>

先定义函数clk,然后赋值给onclick属性,这种方式也应该属于上世纪90年代的流行写法。比第一种方式好的是它把业务逻辑代码都封装在一个函数里了,使HTML代码与JS代码稍微有点儿分离,不至于第一种那么紧密耦合。

如何在这种方式(clk函数内)中获取事件对象?IE中使用全局对象event仍然没问题,如:

代码如下:

<script type="text/javascript">

function clk(){alert(window.event);}

</script>

<div onclick="clk()">Div2 Element</div>

点击Div后,除Firefox外,IE/Opera/Safari/Chrome都能正常获取事件对象。上面已经提到了 Opera/Safari/Chrome 兼容IE方式(window.event)获取事件对象,而唯独Firefox不支持。从而Firefox中只能通过参数传入了。试着这么写

代码如下:

<script type="text/javascript">

function clk(){alert(event);}

</script>

<div onclick="clk()">Div2 Element</div>

因为在Firefox中匿名函数是具有event参数的,而clk()是在匿名函数之内的,打印出匿名函数便知

代码如下:

<script type="text/javascript">

function clk(){alert(arguments.callee.caller);}

</script>

<div onclick="clk()">Div2 Element</div>

点击该Div,Firefox弹出信息框内容如下

代码如下:

function onclick(event) {

    clk();

}

回到clk中的alert(event),既然匿名函数的event传入了,那么在该闭包中clk是可以获取到event的,事实上点击后Firefox会报错:event is not defined。猜测该匿名函数的闭包和function clk(){alert(event);}不是同一个闭包环境。这种方式不行,则只能通过显示的参数传入了,如

代码如下:

<script type="text/javascript">

function clk(e){alert(e);}

</script>

<div onclick="clk(arguments[0])">Div2 Element</div>

点击Div,在Firefox中正确弹出了事件对象,支持参数传入的浏览器都可以,如Opera/Safari/Chrome。

把以上代码中的arguments[0]改成event,那么所有浏览器都支持。

把以上代码中的arguments[0]改成window.event,那么将只有Firefox不支持。

把以上代码中的arguments[0]改成evt,那么将只有Chrome支持。

思考下为什么?

    3,第三种添加事件方式,使用element.onXXX方式

代码如下:

<div id="d3">Div3 Element</div>

<script type="text/javascript">

var d3 = document.getElementById('d3');

d3.onclick = function(){ }

</script>

这种方式也比较早期,但好处是可以将JS与HTML完全分离,但前提是需要给HTML元素提供一个额外的id属性(或其它能获取该元素对象的方式)。

这种方式添加事件IE6/7/8只支持window.event不支持参数传入,Firefox只支持参数传入不支持其它方式。IE9/Opera/Safari/Chrome 两种方式都支持。

4,第四种添加事件方式,使用addEventListener或IE专有的attachEvent

代码如下:

<div id="d4">Div4 Element</div>

<script type="text/javascript">

var d4 = document.getElementById('d4');

function clk(){alert(4)}

if(d4.addEventListener){

    d4.addEventListener('click',clk,false);

}

if(d4.attachEvent){

    d4.attachEvent('onclick',clk);

}

</script>

这是目前推荐的方式,较前两种方式功能更为强大,可以为元素添加多个句柄(或称响应函数),支持事件冒泡或捕获,前三种方式默认都是冒泡。当然IE6/7/8仍然没有遵循标准而使用了自己专有的attachEvent,且不支持事件捕获。IE9 中已经支持addEventListener了。

先用window.event测试,如

代码如下:

<script type="text/javascript">

var d4 = document.getElementById('d4');

function clk(){alert(window.event)}

if(d4.addEventListener){

    d4.addEventListener('click',clk,false);

}

if(d4.attachEvent){

    d4.attachEvent('onclick',clk);

}

</script>

点击Div[id=d4],IE/Opera/Safari/Chrome都正确的弹出了事件对象信息框,Firefox弹出的是"undefined",预料之中,因为Firefox不支持window.event作为事件对象。

再换成句柄的第一个参数测试,如

代码如下:

<script type="text/javascript">

var d4 = document.getElementById('d4');

function clk(e){alert(e)}

if(d4.addEventListener){

    d4.addEventListener('click',clk,false);

}

if(d4.attachEvent){

    d4.attachEvent('onclick',clk);

}

</script>

测试之前,猜测一下什么结果,可能有人会觉得IE中应该弹出undefined,其它浏览器都是事件对象。事实上所有浏览器弹出的信息框显示都是事件对象。

总结下:

1,IE6/7/8支持通过window.event获取对象,通过attachEvent方式添加事件时也支持事件对象作为句柄第一个参数传入

2,Firefox只支持事件对象作为句柄第一个参数传入

3,IE9/Opera/Safari/Chrome两种方式都支持 */