"use strict";

function InitHeightInvertedCanvas(CanvasContext, CanvasHeight) 
{
    CanvasContext.setTransform(1, 0, 0, -1, 0, 0);
    CanvasContext.translate(0, -CanvasHeight);
}

function ClearCanvas(CanvasContext, CanvasWidth, CanvasHeight) 
{
    CanvasContext.fillStyle = "rgba(255,255,255,1)";
    CanvasContext.fillRect(0, 0, CanvasWidth, CanvasHeight);
}