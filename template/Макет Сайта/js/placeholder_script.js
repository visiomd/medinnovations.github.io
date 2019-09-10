// JavaScript Document


var options = {
  imgSrc1:"images/slider-home/liver-nativ.png",
  imgSrc2:"images/slider-home/liver-color.png",
  containerName : "placeholder",
  columns:6,
  rows:4,
  margin:1
}

document.getElementsByTagName("BODY")[0].onresize = function() {VenetianBlinds(options)};


function VenetianBlinds(defaults)
{
  var cols = defaults.columns;
  var rows = defaults.rows;
  var margin = defaults.margin;
  var img1 = defaults.imgSrc1;
  var img2 = defaults.imgSrc2;
  var placeholder = document.getElementsByClassName(defaults.containerName)[0];
  var directionX, directionY;
  placeholder.innerHTML = "";
  //document.getElementsByClassName(defaults.containerName).innerHTML = "";

  var cell, blind, blindImg, cell;
  var bgImg, rot;
  var colL, rowT;
  var arrColL = new Array(cols)
  var arrrowT = new Array(rows);
  var arrColW = new Array(cols);
	templen = 0;
	for (var i=0; i<cols; i++)
		{
			
			var max = Math.round(((placeholder.offsetWidth - templen) / (cols-i)) * 1.35);
			var min = Math.round(((placeholder.offsetWidth - templen) / (cols-i)) * 0.65);
			arrColW[i] = Math.round(Math.random() * (max - min) + min)  - margin;
			arrColL[i] = templen;
			templen += arrColW[i] + margin; 
			/**
			arrColW[i] = (placeholder.offsetWidth / cols) - margin;
			arrColL[i] = (arrColW[i] + margin) * i;
			**/
		}
  var arrRowH = new Array(rows);
	templen = 0;
	for (var i=0; i<rows; i++)
		{
			
			var max = Math.round(((placeholder.offsetHeight - templen) / (rows-i)) * 1.35);
			var min = Math.round(((placeholder.offsetHeight - templen) / (rows-i)) * 0.65);
			arrRowH[i] = Math.round(Math.random() * (max - min) + min)  - margin; 
			arrrowT[i] = templen;
			templen += arrRowH[i] + margin;
			/**
			arrRowH[i] = (placeholder.offsetHeight / rows) - margin;
			arrrowT[i] = (arrRowH[i] + margin) * i;
			**/
		}
  //var arrColW[i] = (placeholder.offsetWidth / cols) - margin;
  //var arrRowH[b] = (placeholder.offsetHeight / rows) - margin;
  for (var i=0; i < cols; i++)
    {
		for (var b=0; b < rows; b++)
			{
				
				
			  cell = document.createElement('div');
			  cell.className = "cell";
			  cell.style.width = arrColW[i] + "px";
			  cell.style.left = arrColL[i] + "px";
			  cell.style.height = arrRowH[b] + "px";
			  cell.style.top = arrrowT[b] + "px";
			  placeholder.appendChild(cell); 

			  for (var j=0; j<4; j++)
				{
				  blind = document.createElement('div');
				  blind.className = "blind";
				  blind.style.width = arrColW[i] + "px";
				  blind.style.height = arrRowH[b] + "px";
				  blindImg = document.createElement('div');
				  blindImg.className = "blindImg";

				  switch (j){
					 case 0:
						TweenMax.set(blind, {rotationY: "0"});
						bgImg = img1;
						break;
					case 1:
						TweenMax.set(blind, {rotationY: "90"});
						bgImg = img2;
						break;
					 case 2: 
						  TweenMax.set(blind, {rotationY: "180"});
						  bgImg = img1;
						  break;              
					  case 3:
						  TweenMax.set(blind, {rotationY: "270"});
						  bgImg = img2;
						  break;
				  }
				  blindImg.style.width = placeholder.offsetWidth + "px";
				  blindImg.style.height = placeholder.offsetHeight + "px";
				  blindImg.style.backgroundImage = "url("+bgImg+")";
				  blindImg.style.left = -arrColL[i] + "px";
				  blindImg.style.top = -arrrowT[b] + "px";
				  cell.appendChild(blind);
				  blind.appendChild(blindImg);

				  TweenMax.set(blind, { transformOrigin:"50% 50% 0%" , transformStyle: "preserve-3d"});
				}

			  TweenMax.set(cell, {transformStyle:"preserve-3d", transformPerspective:1000, rotationY:0});

			   cell.addEventListener("mouseenter", function(event){
					var elem = event.currentTarget;
					var rotY = elem._gsTransform.rotationY;
				   	console.log(rotY);
					if(directionX > 0){
					  TweenMax.to(elem, 1, {rotationY:Math.floor(rotY/90)*90+90, transformOrigin: "50% 50% 0%" , ease:Back.easeOut});
					}else{
					  TweenMax.to(elem, 1, {rotationY:Math.floor(rotY/90)*90-90, transformOrigin:"50% 50% 0%" , ease:Back.easeOut});
					}
			  });
				
			  cell.addEventListener("touchmove", function(event){
					var elem = document.elementFromPoint(directionX, directionY);
					elem = elem.parentNode;
					elem = elem.parentNode;
				  console.log(elem);
					var rotY = elem._gsTransform.rotationY;

					if(directionX > 0){
					  TweenMax.to(elem, 1, {rotationY:Math.floor(rotY/90)*90+90, transformOrigin:"50% 50% 0%", ease:Back.easeOut});
					}else{
					  TweenMax.to(elem, 1, {rotationY:Math.floor(rotY/90)*90-90, transformOrigin:"50% 50% 0%", ease:Back.easeOut});
					}
			  });
				
			}
      
    } 
      document.addEventListener('mousemove', function (event) {
      directionX = event.movementX || event.mozMovementX || event.webkitMovementX || 0;
      directionY = event.movementY || event.mozMovementY || event.webkitMovementY || 0;
		  
    });
	  document.addEventListener('touchstart', function (event) {
      directionX = event.targetTouches[0].clientX || event.targetTouches[0].mozClientX || event.targetTouches[0].webkitClientX || 0;
      directionY = event.targetTouches[0].clientY || event.targetTouches[0].mozClientY || event.targetTouches[0].webkitClientY || 0;
		  
    });
	  document.addEventListener('touchmove', function (event) {
      directionX = event.targetTouches[0].clientX || event.targetTouches[0].mozClientX || event.targetTouches[0].webkitClientX || 0;
      directionY = event.targetTouches[0].clientY || event.targetTouches[0].mozClientY || event.targetTouches[0].webkitClientY || 0;


    });
}
VenetianBlinds(options);

window.addEventListener("resize", VenetianBlinds(options));

 



