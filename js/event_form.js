/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Other/javascript.js to edit this template
 */

/*
 Web System
 
 Music Society
 Author:Leong Kuan Fei
 Date: 11/8/2022
 
 Filename: event_form.js
 
 */

/*get the event type to open some input field and generate id*/
function eType() {
    var eTypeID = document.getElementById("eTypeID").value;
    if (eTypeID === "CC") {
        var eNum = document.getElementById("eNumCC").value;
        document.getElementById("eventID").value = "CC" + eNum;
        document.getElementById("startTime").disabled = false;
        document.getElementById("endTime").disabled = false;
        document.getElementById("dSTime").disabled = true;
        document.getElementById("dETime").disabled = true;
        document.getElementById("defaultSelect").selected = "true";
        document.getElementById("capacity").disabled = false;
        document.getElementById("dCP").disabled = true;
        document.getElementById("price").value = 15;
        document.getElementById("fees").value = 15;
    } else if (eTypeID === "CP") {
        var eNum = document.getElementById("eNumCP").value;
        document.getElementById("eventID").value = "CP" + eNum;
        document.getElementById("startTime").disabled = true;
        document.getElementById("dSTime").disabled = false;
        document.getElementById("startTime").selectedIndex = 0;
        document.getElementById("endTime").disabled = true;
        document.getElementById("dETime").disabled = false;
        document.getElementById("endTime").selectedIndex = 0;
        document.getElementById("defaultSelect").selected = "true";
        document.getElementById("capacity").disabled = true;
        document.getElementById("dCP").disabled = false;
        document.getElementById("duration").value = "";
        document.getElementById("price").value = 2;
        document.getElementById("fees").value = 2;
    } else if (eTypeID === "WS") {
        var eNum = document.getElementById("eNumWS").value;
        document.getElementById("eventID").value = "WS" + eNum;
        document.getElementById("startTime").disabled = false;
        document.getElementById("endTime").disabled = false;
        document.getElementById("dSTime").disabled = true;
        document.getElementById("dETime").disabled = true;
        document.getElementById("defaultSelect").selected = "true";
        document.getElementById("capacity").disabled = false;
        document.getElementById("dCP").disabled = true;
        document.getElementById("price").value = 300;
        document.getElementById("fees").value = 300;
    } else {
        document.getElementById("eTypeID").selectedIndex = 0;
        document.getElementById("eventID").value = "";
        document.getElementById("startTime").disabled = false;
        document.getElementById("endTime").disabled = false;
        document.getElementById("dSTime").disabled = true;
        document.getElementById("dETime").disabled = true;
        document.getElementById("defaultSelect").selected = "true";
        document.getElementById("capacity").disabled = false;
        document.getElementById("dCP").disabled = true;
        document.getElementById("price").value = "";
        document.getElementById("fees").value = "";
    }
}

/*calculate the duration*/
function time() {
    var sTime = document.getElementById("startTime").value;
    var eTime = document.getElementById("endTime").value;

    if (sTime < eTime) {
        if (sTime > 0 && eTime > 0) {
            var duration = (eTime - sTime) / 100;
            document.getElementById("duration").value = duration;
        } else {
            document.getElementById("duration").value = "";
        }
    } else {
        document.getElementById("duration").value = "";
    }
}