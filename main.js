function bar(id, values) {
    var canvas = document.getElementById(id);
    var ctx = canvas.getContext("2d");
    ctx.fillStyle = "white";
    ctx.fillRect(0,0, canvas.width, canvas.height-canvas.height*0.2);
    var barWidth = (1/values.length)*(1/2)*(canvas.width);
    var x = 50;
    for (var i = 0;i <= (canvas.height-(canvas.height*0.2)); i+=(canvas.height*0.1)) {
        ctx.moveTo(0,i);
        ctx.lineTo(canvas.width, i);
        ctx.stroke();
    }
    for(var i = 0; i < values.length; i++) {
        var val = values[i].val*100*6;
        var hue = (360 * i) / values.length;
        ctx.fillStyle = "hsl(" + hue + ", 100%, 70%)";
        ctx.fillRect(x, canvas.height - val -(canvas.height*0.2), barWidth, val);
        var txt = ' ' + values[i].lbl + ' ';
        ctx.font = "15px Arial";
        ctx.strokeText(txt, x, canvas.height-50);
        x += barWidth+50;
    }
    ctx.strokeRect(0,-(canvas.height*0.2),canvas.width, canvas.height);
    ctx.fill();
}
