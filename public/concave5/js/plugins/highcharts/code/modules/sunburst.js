/*
 Highcharts JS v7.2.0 (2019-09-03)

 (c) 2016-2019 Highsoft AS
 Authors: Jon Arild Nygard

 License: www.highcharts.com/license
*/
(function(a){"object"===typeof module&&module.exports?(a["default"]=a,module.exports=a):"function"===typeof define&&define.amd?define("highcharts/modules/sunburst",["highcharts"],function(w){a(w);a.Highcharts=w;return a}):a("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(a){function w(c,m,a,l){c.hasOwnProperty(m)||(c[m]=l.apply(null,a))}a=a?a._modules:{};w(a,"mixins/draw-point.js",[],function(){var c=function(c){var a=this,l=a.graphic,h=c.animatableAttribs,m=c.onComplete,H=c.css,x=c.renderer;
if(a.shouldDraw())l||(a.graphic=l=x[c.shapeType](c.shapeArgs).add(c.group)),l.css(H).attr(c.attribs).animate(h,c.isNew?!1:void 0,m);else if(l){var D=function(){a.graphic=l=l.destroy();"function"===typeof m&&m()};Object.keys(h).length?l.animate(h,void 0,function(){D()}):D()}};return function(a){(a.attribs=a.attribs||{})["class"]=this.getClassName();c.call(this,a)}});w(a,"mixins/tree-series.js",[a["parts/Globals.js"],a["parts/Utilities.js"]],function(c,a){var m=a.isArray,l=a.isNumber,h=a.isObject,z=
c.extend,H=c.merge,x=c.pick;return{getColor:function(a,r){var l=r.index,h=r.mapOptionsToLevel,D=r.parentColor,m=r.parentColorIndex,z=r.series,C=r.colors,M=r.siblings,q=z.points,y=z.chart.options.chart,t;if(a){q=q[a.i];a=h[a.level]||{};if(h=q&&a.colorByPoint){var f=q.index%(C?C.length:y.colorCount);var g=C&&C[f]}if(!z.chart.styledMode){C=q&&q.options.color;y=a&&a.color;if(t=D)t=(t=a&&a.colorVariation)&&"brightness"===t.key?c.color(D).brighten(l/M*t.to).get():D;t=x(C,y,g,t,z.color)}var k=x(q&&q.options.colorIndex,
a&&a.colorIndex,f,m,r.colorIndex)}return{color:t,colorIndex:k}},getLevelOptions:function(a){var c=null;if(h(a)){c={};var I=l(a.from)?a.from:1;var x=a.levels;var A={};var F=h(a.defaults)?a.defaults:{};m(x)&&(A=x.reduce(function(a,c){if(h(c)&&l(c.level)){var r=H({},c);var m="boolean"===typeof r.levelIsConstant?r.levelIsConstant:F.levelIsConstant;delete r.levelIsConstant;delete r.level;c=c.level+(m?0:I-1);h(a[c])?z(a[c],r):a[c]=r}return a},{}));x=l(a.to)?a.to:1;for(a=0;a<=x;a++)c[a]=H({},F,h(A[a])?A[a]:
{})}return c},setTreeValues:function L(a,c){var h=c.before,l=c.idRoot,r=c.mapIdToNode[l],m=c.points[a.i],I=m&&m.options||{},q=0,y=[];z(a,{levelDynamic:a.level-(("boolean"===typeof c.levelIsConstant?c.levelIsConstant:1)?0:r.level),name:x(m&&m.name,""),visible:l===a.id||("boolean"===typeof c.visible?c.visible:!1)});"function"===typeof h&&(a=h(a,c));a.children.forEach(function(h,f){var g=z({},c);z(g,{index:f,siblings:a.children.length,visible:a.visible});h=L(h,g);y.push(h);h.visible&&(q+=h.val)});a.visible=
0<q||a.visible;h=x(I.value,q);z(a,{children:y,childrenTotal:q,isLeaf:a.visible&&!q,val:h});return a},updateRootId:function(a){if(h(a)){var c=h(a.options)?a.options:{};c=x(a.rootNode,c.rootId,"");h(a.userOptions)&&(a.userOptions.rootId=c);a.rootNode=c}return c}}});w(a,"modules/treemap.src.js",[a["parts/Globals.js"],a["mixins/tree-series.js"],a["mixins/draw-point.js"],a["parts/Utilities.js"]],function(a,m,w,l){var c=l.defined,z=l.isArray,H=l.isNumber,x=l.isObject,D=l.isString,r=l.objectEach;l=a.seriesType;
var I=a.seriesTypes,L=a.addEvent,A=a.merge,F=a.extend,N=a.error,C=a.noop,M=a.fireEvent,q=m.getColor,y=m.getLevelOptions,t=a.pick,f=a.Series,g=a.stableSort,k=a.Color,v=function(b,d,e){e=e||this;r(b,function(a,n){d.call(e,a,n,b)})},E=function(b,d,e){e=e||this;b=d.call(e,b);!1!==b&&E(b,d,e)},p=m.updateRootId;l("treemap","scatter",{allowTraversingTree:!1,animationLimit:250,showInLegend:!1,marker:!1,colorByPoint:!1,dataLabels:{defer:!1,enabled:!0,formatter:function(){var b=this&&this.point?this.point:
{};return D(b.name)?b.name:""},inside:!0,verticalAlign:"middle"},tooltip:{headerFormat:"",pointFormat:"<b>{point.name}</b>: {point.value}<br/>"},ignoreHiddenPoint:!0,layoutAlgorithm:"sliceAndDice",layoutStartingDirection:"vertical",alternateStartingDirection:!1,levelIsConstant:!0,drillUpButton:{position:{align:"right",x:-10,y:10}},traverseUpButton:{position:{align:"right",x:-10,y:10}},borderColor:"#e6e6e6",borderWidth:1,colorKey:"colorValue",opacity:.15,states:{hover:{borderColor:"#999999",brightness:I.heatmap?
0:.1,halo:!1,opacity:.75,shadow:!1}}},{pointArrayMap:["value"],directTouch:!0,optionalAxis:"colorAxis",getSymbol:C,parallelArrays:["x","y","value","colorValue"],colorKey:"colorValue",trackerGroups:["group","dataLabelsGroup"],getListOfParents:function(b,d){b=z(b)?b:[];var e=z(d)?d:[];d=b.reduce(function(b,d,e){d=t(d.parent,"");void 0===b[d]&&(b[d]=[]);b[d].push(e);return b},{"":[]});v(d,function(b,d,a){""!==d&&-1===e.indexOf(d)&&(b.forEach(function(b){a[""].push(b)}),delete a[d])});return d},getTree:function(){var b=
this.data.map(function(b){return b.id});b=this.getListOfParents(this.data,b);this.nodeMap=[];return this.buildNode("",-1,0,b,null)},hasData:function(){return!!this.processedXData.length},init:function(b,d){var e=a.colorMapSeriesMixin;e&&(this.colorAttribs=e.colorAttribs);L(this,"setOptions",function(b){b=b.userOptions;c(b.allowDrillToNode)&&!c(b.allowTraversingTree)&&(b.allowTraversingTree=b.allowDrillToNode,delete b.allowDrillToNode);c(b.drillUpButton)&&!c(b.traverseUpButton)&&(b.traverseUpButton=
b.drillUpButton,delete b.drillUpButton)});f.prototype.init.call(this,b,d);this.options.allowTraversingTree&&L(this,"click",this.onClickDrillToNode)},buildNode:function(b,d,e,a,n){var f=this,u=[],c=f.points[d],g=0,J;(a[b]||[]).forEach(function(d){J=f.buildNode(f.points[d].id,d,e+1,a,b);g=Math.max(J.height+1,g);u.push(J)});d={id:b,i:d,children:u,height:g,level:e,parent:n,visible:!1};f.nodeMap[d.id]=d;c&&(c.node=d);return d},setTreeValues:function(b){var d=this,e=d.options,a=d.nodeMap[d.rootNode];e=
"boolean"===typeof e.levelIsConstant?e.levelIsConstant:!0;var n=0,f=[],c=d.points[b.i];b.children.forEach(function(b){b=d.setTreeValues(b);f.push(b);b.ignore||(n+=b.val)});g(f,function(b,d){return b.sortIndex-d.sortIndex});var G=t(c&&c.options.value,n);c&&(c.value=G);F(b,{children:f,childrenTotal:n,ignore:!(t(c&&c.visible,!0)&&0<G),isLeaf:b.visible&&!n,levelDynamic:b.level-(e?0:a.level),name:t(c&&c.name,""),sortIndex:t(c&&c.sortIndex,-G),val:G});return b},calculateChildrenAreas:function(b,d){var e=
this,a=e.options,f=e.mapOptionsToLevel[b.level+1],c=t(e[f&&f.layoutAlgorithm]&&f.layoutAlgorithm,a.layoutAlgorithm),g=a.alternateStartingDirection,G=[];b=b.children.filter(function(b){return!b.ignore});f&&f.layoutStartingDirection&&(d.direction="vertical"===f.layoutStartingDirection?0:1);G=e[c](d,b);b.forEach(function(b,a){a=G[a];b.values=A(a,{val:b.childrenTotal,direction:g?1-d.direction:d.direction});b.pointValues=A(a,{x:a.x/e.axisRatio,width:a.width/e.axisRatio});b.children.length&&e.calculateChildrenAreas(b,
b.values)})},setPointValues:function(){var b=this,d=b.xAxis,e=b.yAxis;b.points.forEach(function(a){var f=a.node,c=f.pointValues,u=0;b.chart.styledMode||(u=(b.pointAttribs(a)["stroke-width"]||0)%2/2);if(c&&f.visible){f=Math.round(d.translate(c.x,0,0,0,1))-u;var g=Math.round(d.translate(c.x+c.width,0,0,0,1))-u;var k=Math.round(e.translate(c.y,0,0,0,1))-u;c=Math.round(e.translate(c.y+c.height,0,0,0,1))-u;a.shapeArgs={x:Math.min(f,g),y:Math.min(k,c),width:Math.abs(g-f),height:Math.abs(c-k)};a.plotX=a.shapeArgs.x+
a.shapeArgs.width/2;a.plotY=a.shapeArgs.y+a.shapeArgs.height/2}else delete a.plotX,delete a.plotY})},setColorRecursive:function(b,d,a,f,c){var e=this,n=e&&e.chart;n=n&&n.options&&n.options.colors;if(b){var u=q(b,{colors:n,index:f,mapOptionsToLevel:e.mapOptionsToLevel,parentColor:d,parentColorIndex:a,series:e,siblings:c});if(d=e.points[b.i])d.color=u.color,d.colorIndex=u.colorIndex;(b.children||[]).forEach(function(d,a){e.setColorRecursive(d,u.color,u.colorIndex,a,b.children.length)})}},algorithmGroup:function(b,
d,a,f){this.height=b;this.width=d;this.plot=f;this.startDirection=this.direction=a;this.lH=this.nH=this.lW=this.nW=this.total=0;this.elArr=[];this.lP={total:0,lH:0,nH:0,lW:0,nW:0,nR:0,lR:0,aspectRatio:function(b,d){return Math.max(b/d,d/b)}};this.addElement=function(b){this.lP.total=this.elArr[this.elArr.length-1];this.total+=b;0===this.direction?(this.lW=this.nW,this.lP.lH=this.lP.total/this.lW,this.lP.lR=this.lP.aspectRatio(this.lW,this.lP.lH),this.nW=this.total/this.height,this.lP.nH=this.lP.total/
this.nW,this.lP.nR=this.lP.aspectRatio(this.nW,this.lP.nH)):(this.lH=this.nH,this.lP.lW=this.lP.total/this.lH,this.lP.lR=this.lP.aspectRatio(this.lP.lW,this.lH),this.nH=this.total/this.width,this.lP.nW=this.lP.total/this.nH,this.lP.nR=this.lP.aspectRatio(this.lP.nW,this.nH));this.elArr.push(b)};this.reset=function(){this.lW=this.nW=0;this.elArr=[];this.total=0}},algorithmCalcPoints:function(b,d,e,f){var c,u,g,k,h=e.lW,J=e.lH,p=e.plot,l=0,m=e.elArr.length-1;if(d)h=e.nW,J=e.nH;else var K=e.elArr[e.elArr.length-
1];e.elArr.forEach(function(b){if(d||l<m)0===e.direction?(c=p.x,u=p.y,g=h,k=b/g):(c=p.x,u=p.y,k=J,g=b/k),f.push({x:c,y:u,width:g,height:a.correctFloat(k)}),0===e.direction?p.y+=k:p.x+=g;l+=1});e.reset();0===e.direction?e.width-=h:e.height-=J;p.y=p.parent.y+(p.parent.height-e.height);p.x=p.parent.x+(p.parent.width-e.width);b&&(e.direction=1-e.direction);d||e.addElement(K)},algorithmLowAspectRatio:function(b,d,a){var e=[],f=this,c,g={x:d.x,y:d.y,parent:d},k=0,p=a.length-1,h=new this.algorithmGroup(d.height,
d.width,d.direction,g);a.forEach(function(a){c=a.val/d.val*d.height*d.width;h.addElement(c);h.lP.nR>h.lP.lR&&f.algorithmCalcPoints(b,!1,h,e,g);k===p&&f.algorithmCalcPoints(b,!0,h,e,g);k+=1});return e},algorithmFill:function(b,d,a){var e=[],f,c=d.direction,g=d.x,k=d.y,p=d.width,h=d.height,l,m,v,K;a.forEach(function(a){f=a.val/d.val*d.height*d.width;l=g;m=k;0===c?(K=h,v=f/K,p-=v,g+=v):(v=p,K=f/v,h-=K,k+=K);e.push({x:l,y:m,width:v,height:K});b&&(c=1-c)});return e},strip:function(b,d){return this.algorithmLowAspectRatio(!1,
b,d)},squarified:function(b,d){return this.algorithmLowAspectRatio(!0,b,d)},sliceAndDice:function(b,d){return this.algorithmFill(!0,b,d)},stripes:function(b,d){return this.algorithmFill(!1,b,d)},translate:function(){var b=this,d=b.options,a=p(b);f.prototype.translate.call(b);var c=b.tree=b.getTree();var n=b.nodeMap[a];b.renderTraverseUpButton(a);b.mapOptionsToLevel=y({from:n.level+1,levels:d.levels,to:c.height,defaults:{levelIsConstant:b.options.levelIsConstant,colorByPoint:d.colorByPoint}});""===
a||n&&n.children.length||(b.setRootNode("",!1),a=b.rootNode,n=b.nodeMap[a]);E(b.nodeMap[b.rootNode],function(a){var d=!1,e=a.parent;a.visible=!0;if(e||""===e)d=b.nodeMap[e];return d});E(b.nodeMap[b.rootNode].children,function(b){var a=!1;b.forEach(function(b){b.visible=!0;b.children.length&&(a=(a||[]).concat(b.children))});return a});b.setTreeValues(c);b.axisRatio=b.xAxis.len/b.yAxis.len;b.nodeMap[""].pointValues=a={x:0,y:0,width:100,height:100};b.nodeMap[""].values=a=A(a,{width:a.width*b.axisRatio,
direction:"vertical"===d.layoutStartingDirection?0:1,val:c.val});b.calculateChildrenAreas(c,a);b.colorAxis||d.colorByPoint||b.setColorRecursive(b.tree);d.allowTraversingTree&&(d=n.pointValues,b.xAxis.setExtremes(d.x,d.x+d.width,!1),b.yAxis.setExtremes(d.y,d.y+d.height,!1),b.xAxis.setScale(),b.yAxis.setScale());b.setPointValues()},drawDataLabels:function(){var b=this,a=b.mapOptionsToLevel,e,c;b.points.filter(function(b){return b.node.visible}).forEach(function(d){c=a[d.node.level];e={style:{}};d.node.isLeaf||
(e.enabled=!1);c&&c.dataLabels&&(e=A(e,c.dataLabels),b._hasPointLabels=!0);d.shapeArgs&&(e.style.width=d.shapeArgs.width,d.dataLabel&&d.dataLabel.css({width:d.shapeArgs.width+"px"}));d.dlOptions=A(e,d.options.dataLabels)});f.prototype.drawDataLabels.call(this)},alignDataLabel:function(b,a,e){var d=e.style;!c(d.textOverflow)&&a.text&&a.getBBox().width>a.text.textWidth&&a.css({textOverflow:"ellipsis",width:d.width+="px"});I.column.prototype.alignDataLabel.apply(this,arguments);b.dataLabel&&b.dataLabel.attr({zIndex:(b.node.zIndex||
0)+1})},pointAttribs:function(b,a){var d=x(this.mapOptionsToLevel)?this.mapOptionsToLevel:{},f=b&&d[b.node.level]||{};d=this.options;var c=a&&d.states[a]||{},g=b&&b.getClassName()||"";b={stroke:b&&b.borderColor||f.borderColor||c.borderColor||d.borderColor,"stroke-width":t(b&&b.borderWidth,f.borderWidth,c.borderWidth,d.borderWidth),dashstyle:b&&b.borderDashStyle||f.borderDashStyle||c.borderDashStyle||d.borderDashStyle,fill:b&&b.color||this.color};-1!==g.indexOf("highcharts-above-level")?(b.fill="none",
b["stroke-width"]=0):-1!==g.indexOf("highcharts-internal-node-interactive")?(a=t(c.opacity,d.opacity),b.fill=k(b.fill).setOpacity(a).get(),b.cursor="pointer"):-1!==g.indexOf("highcharts-internal-node")?b.fill="none":a&&(b.fill=k(b.fill).brighten(c.brightness).get());return b},drawPoints:function(){var b=this,a=b.chart,e=a.renderer,f=a.styledMode,c=b.options,g=f?{}:c.shadow,k=c.borderRadius,p=a.pointCount<c.animationLimit,h=c.allowTraversingTree;b.points.forEach(function(a){var d=a.node.levelDynamic,
n={},u={},l={},m="level-group-"+d,v=!!a.graphic,E=p&&v,t=a.shapeArgs;a.shouldDraw()&&(k&&(u.r=k),A(!0,E?n:u,v?t:{},f?{}:b.pointAttribs(a,a.selected&&"select")),b.colorAttribs&&f&&F(l,b.colorAttribs(a)),b[m]||(b[m]=e.g(m).attr({zIndex:1E3-d}).add(b.group)));a.draw({animatableAttribs:n,attribs:u,css:l,group:b[m],renderer:e,shadow:g,shapeArgs:t,shapeType:"rect"});h&&a.graphic&&(a.drillId=c.interactByLeaf?b.drillToByLeaf(a):b.drillToByGroup(a))})},onClickDrillToNode:function(b){var a=(b=b.point)&&b.drillId;
D(a)&&(b.setState(""),this.setRootNode(a,!0,{trigger:"click"}))},drillToByGroup:function(b){var a=!1;1!==b.node.level-this.nodeMap[this.rootNode].level||b.node.isLeaf||(a=b.id);return a},drillToByLeaf:function(b){var a=!1;if(b.node.parent!==this.rootNode&&b.node.isLeaf)for(b=b.node;!a;)b=this.nodeMap[b.parent],b.parent===this.rootNode&&(a=b.id);return a},drillUp:function(){var b=this.nodeMap[this.rootNode];b&&D(b.parent)&&this.setRootNode(b.parent,!0,{trigger:"traverseUpButton"})},drillToNode:function(b,
a){N("WARNING: treemap.drillToNode has been renamed to treemap.setRootNode, and will be removed in the next major version.");this.setRootNode(b,a)},setRootNode:function(b,a,f){b=F({newRootId:b,previousRootId:this.rootNode,redraw:t(a,!0),series:this},f);M(this,"setRootNode",b,function(b){var a=b.series;a.idPreviousRoot=b.previousRootId;a.rootNode=b.newRootId;a.isDirty=!0;b.redraw&&a.chart.redraw()})},renderTraverseUpButton:function(b){var a=this,f=a.options.traverseUpButton,c=t(f.text,a.nodeMap[b].name,
"< Back");if(""===b)a.drillUpButton&&(a.drillUpButton=a.drillUpButton.destroy());else if(this.drillUpButton)this.drillUpButton.placed=!1,this.drillUpButton.attr({text:c}).align();else{var g=(b=f.theme)&&b.states;this.drillUpButton=this.chart.renderer.button(c,null,null,function(){a.drillUp()},b,g&&g.hover,g&&g.select).addClass("highcharts-drillup-button").attr({align:f.position.align,zIndex:7}).add().align(f.position,!1,f.relativeTo||"plotBox")}},buildKDTree:C,drawLegendSymbol:a.LegendSymbolMixin.drawRectangle,
getExtremes:function(){f.prototype.getExtremes.call(this,this.colorValueData);this.valueMin=this.dataMin;this.valueMax=this.dataMax;f.prototype.getExtremes.call(this)},getExtremesFromAll:!0,bindAxes:function(){var b={endOnTick:!1,gridLineWidth:0,lineWidth:0,min:0,dataMin:0,minPadding:0,max:100,dataMax:100,maxPadding:0,startOnTick:!1,title:null,tickPositions:[]};f.prototype.bindAxes.call(this);a.extend(this.yAxis.options,b);a.extend(this.xAxis.options,b)},setState:function(b){this.options.inactiveOtherPoints=
!0;f.prototype.setState.call(this,b,!1);this.options.inactiveOtherPoints=!1},utils:{recursive:E}},{draw:w,getClassName:function(){var b=a.Point.prototype.getClassName.call(this),d=this.series,f=d.options;this.node.level<=d.nodeMap[d.rootNode].level?b+=" highcharts-above-level":this.node.isLeaf||t(f.interactByLeaf,!f.allowTraversingTree)?this.node.isLeaf||(b+=" highcharts-internal-node"):b+=" highcharts-internal-node-interactive";return b},isValid:function(){return this.id||H(this.value)},setState:function(b){a.Point.prototype.setState.call(this,
b);this.graphic&&this.graphic.attr({zIndex:"hover"===b?1:0})},setVisible:I.pie.prototype.pointClass.prototype.setVisible,shouldDraw:function(){return H(this.plotY)&&null!==this.y}})});w(a,"modules/sunburst.src.js",[a["parts/Globals.js"],a["parts/Utilities.js"],a["mixins/draw-point.js"],a["mixins/tree-series.js"]],function(a,m,w,l){var c=m.isNumber,z=m.isObject,H=m.isString;m=a.CenteredSeriesMixin;var x=a.Series,D=a.extend,r=m.getCenter,I=l.getColor,L=l.getLevelOptions,A=m.getStartAndEndRadians,F=
a.merge,N=180/Math.PI;m=a.seriesType;var C=l.setTreeValues,M=l.updateRootId,q=function(a,g){var f=[];if(c(a)&&c(g)&&a<=g)for(;a<=g;a++)f.push(a);return f},y=function(a,g){g=z(g)?g:{};var f=0,l;if(z(a)){var h=F({},a);a=c(g.from)?g.from:0;var p=c(g.to)?g.to:0;var b=q(a,p);a=Object.keys(h).filter(function(a){return-1===b.indexOf(+a)});var d=l=c(g.diffRadius)?g.diffRadius:0;b.forEach(function(b){b=h[b];var a=b.levelSize.unit,c=b.levelSize.value;"weight"===a?f+=c:"percentage"===a?(b.levelSize={unit:"pixels",
value:c/100*d},l-=b.levelSize.value):"pixels"===a&&(l-=c)});b.forEach(function(b){var a=h[b];"weight"===a.levelSize.unit&&(a=a.levelSize.value,h[b].levelSize={unit:"pixels",value:a/f*l})});a.forEach(function(b){h[b].levelSize={value:0,unit:"pixels"}})}return h},t=function(a,c){var f=c.mapIdToNode[a.parent],g=c.series,h=g.chart,p=g.points[a.i];f=I(a,{colors:g.options.colors||h&&h.options.colors,colorIndex:g.colorIndex,index:c.index,mapOptionsToLevel:c.mapOptionsToLevel,parentColor:f&&f.color,parentColorIndex:f&&
f.colorIndex,series:c.series,siblings:c.siblings});a.color=f.color;a.colorIndex=f.colorIndex;p&&(p.color=a.color,p.colorIndex=a.colorIndex,a.sliced=a.id!==c.idRoot?p.sliced:!1);return a};m("sunburst","treemap",{center:["50%","50%"],colorByPoint:!1,opacity:1,dataLabels:{allowOverlap:!0,defer:!0,rotationMode:"auto",style:{textOverflow:"ellipsis"}},rootId:void 0,levelIsConstant:!0,levelSize:{value:1,unit:"weight"},slicedOffset:10},{drawDataLabels:a.noop,drawPoints:function(){var a=this,g=a.mapOptionsToLevel,
h=a.shapeRoot,l=a.group,m=a.hasRendered,p=a.rootNode,b=a.idPreviousRoot,d=a.nodeMap,e=d[b],u=e&&e.shapeArgs;e=a.points;var n=a.startAndEndRadians,t=a.chart,r=t&&t.options&&t.options.chart||{},G="boolean"===typeof r.animation?r.animation:!0,q=a.center[3]/2,J=a.chart.renderer,w=!1,A=!1;if(r=!!(G&&m&&p!==b&&a.dataLabelsGroup)){a.dataLabelsGroup.attr({opacity:0});var C=function(){w=!0;a.dataLabelsGroup&&a.dataLabelsGroup.animate({opacity:1,visibility:"visible"})}}e.forEach(function(f){var e=f.node,k=
g[e.level];var r=f.shapeExisting||{};var v=e.shapeArgs||{},x=!(!e.visible||!e.shapeArgs);if(m&&G){var E={};var w={end:v.end,start:v.start,innerR:v.innerR,r:v.r,x:v.x,y:v.y};x?!f.graphic&&u&&(E=p===f.id?{start:n.start,end:n.end}:u.end<=v.start?{start:n.end,end:n.end}:{start:n.start,end:n.start},E.innerR=E.r=q):f.graphic&&(b===f.id?w={innerR:q,r:q}:h&&(w=h.end<=r.start?{innerR:q,r:q,start:n.end,end:n.end}:{innerR:q,r:q,start:n.start,end:n.start}));r=E}else w=v,r={};E=[v.plotX,v.plotY];if(!f.node.isLeaf)if(p===
f.id){var B=d[p];B=B.parent}else B=f.id;D(f,{shapeExisting:v,tooltipPos:E,drillId:B,name:""+(f.name||f.id||f.index),plotX:v.plotX,plotY:v.plotY,value:e.val,isNull:!x});B=f.options;e=z(v)?v:{};B=z(B)?B.dataLabels:{};k=z(k)?k.dataLabels:{};k=F({style:{}},k,B);var y;B=k.rotationMode;c(k.rotation)||("auto"===B&&(1>f.innerArcLength&&f.outerArcLength>e.radius?y=0:B=1<f.innerArcLength&&f.outerArcLength>1.5*e.radius?"parallel":"perpendicular"),"auto"!==B&&(y=e.end-(e.end-e.start)/2),k.style.width="parallel"===
B?Math.min(2.5*e.radius,(f.outerArcLength+f.innerArcLength)/2):e.radius,"perpendicular"===B&&f.series.chart.renderer.fontMetrics(k.style.fontSize).h>f.outerArcLength&&(k.style.width=1),k.style.width=Math.max(k.style.width-2*(k.padding||0),1),y=y*N%180,"parallel"===B&&(y-=90),90<y?y-=180:-90>y&&(y+=180),k.rotation=y);0===k.rotation&&(k.rotation=.001);f.dlOptions=k;if(!A&&x){A=!0;var O=C}f.draw({animatableAttribs:w,attribs:D(r,!t.styledMode&&a.pointAttribs(f,f.selected&&"select")),onComplete:O,group:l,
renderer:J,shapeType:"arc",shapeArgs:v})});r&&A?(a.hasRendered=!1,a.options.dataLabels.defer=!0,x.prototype.drawDataLabels.call(a),a.hasRendered=!0,w&&C()):x.prototype.drawDataLabels.call(a)},pointAttribs:a.seriesTypes.column.prototype.pointAttribs,layoutAlgorithm:function(a,g,k){var f=a.start,h=a.end-f,p=a.val,b=a.x,d=a.y,e=k&&z(k.levelSize)&&c(k.levelSize.value)?k.levelSize.value:0,l=a.r,m=l+e,r=k&&c(k.slicedOffset)?k.slicedOffset:0;return(g||[]).reduce(function(a,c){var g=1/p*c.val*h,k=f+g/2,n=
b+Math.cos(k)*r;k=d+Math.sin(k)*r;c={x:c.sliced?n:b,y:c.sliced?k:d,innerR:l,r:m,radius:e,start:f,end:f+g};a.push(c);f=c.end;return a},[])},setShapeArgs:function(a,c,k){var f=[],g=k[a.level+1];a=a.children.filter(function(a){return a.visible});f=this.layoutAlgorithm(c,a,g);a.forEach(function(a,b){b=f[b];var d=b.start+(b.end-b.start)/2,c=b.innerR+(b.r-b.innerR)/2,g=b.end-b.start;c=0===b.innerR&&6.28<g?{x:b.x,y:b.y}:{x:b.x+Math.cos(d)*c,y:b.y+Math.sin(d)*c};var h=a.val?a.childrenTotal>a.val?a.childrenTotal:
a.val:a.childrenTotal;this.points[a.i]&&(this.points[a.i].innerArcLength=g*b.innerR,this.points[a.i].outerArcLength=g*b.r);a.shapeArgs=F(b,{plotX:c.x,plotY:c.y+4*Math.abs(Math.cos(d))});a.values=F(b,{val:h});a.children.length&&this.setShapeArgs(a,a.values,k)},this)},translate:function(){var c=this,g=c.options,k=c.center=r.call(c),h=c.startAndEndRadians=A(g.startAngle,g.endAngle),l=k[3]/2,m=k[2]/2-l,b=M(c),d=c.nodeMap,e=d&&d[b],u={};c.shapeRoot=e&&e.shapeArgs;x.prototype.translate.call(c);var n=c.tree=
c.getTree();c.renderTraverseUpButton(b);d=c.nodeMap;e=d[b];var q=H(e.parent)?e.parent:"";var w=d[q];q=L({from:0<e.level?e.level:1,levels:c.options.levels,to:n.height,defaults:{colorByPoint:g.colorByPoint,dataLabels:g.dataLabels,levelIsConstant:g.levelIsConstant,levelSize:g.levelSize,slicedOffset:g.slicedOffset}});q=y(q,{diffRadius:m,from:0<e.level?e.level:1,to:n.height});C(n,{before:t,idRoot:b,levelIsConstant:g.levelIsConstant,mapOptionsToLevel:q,mapIdToNode:d,points:c.points,series:c});g=d[""].shapeArgs=
{end:h.end,r:l,start:h.start,val:e.val,x:k[0],y:k[1]};this.setShapeArgs(w,g,q);c.mapOptionsToLevel=q;c.data.forEach(function(b){u[b.id]&&a.error(31,!1,c.chart);u[b.id]=!0});u={}},animate:function(a){var c=this.chart,f=[c.plotWidth/2,c.plotHeight/2],h=c.plotLeft,l=c.plotTop;c=this.group;a?(a={translateX:f[0]+h,translateY:f[1]+l,scaleX:.001,scaleY:.001,rotation:10,opacity:.01},c.attr(a)):(a={translateX:h,translateY:l,scaleX:1,scaleY:1,rotation:0,opacity:1},c.animate(a,this.options.animation),this.animate=
null)},utils:{calculateLevelSizes:y,range:q}},{draw:w,shouldDraw:function(){return!this.isNull},isValid:function(){return!0}})});w(a,"masters/modules/sunburst.src.js",[],function(){})});
//# sourceMappingURL=sunburst.js.map