function gettheDate() {
    Todays = new Date();
    TheDate = "Data" + (Todays.getDate()) + "." + (Todays.getMonth()+1) + "." + (Todays.getYear() - 100);
    document.getElementById("data").innerHTML = TheDate;
}

var timerID = null;
var timerRunning = false;

function stopclock() {
    if (timerRunning) {
        clearTimeout(timerID);
    }
    timerRunning = false;
}

function startclock() {
    stopclock();
    gettheDate();
    showtime();
}

function showtime() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    var timeValue = "Czas" + (hours  );
    timeValue += ((minutes < 10) ? ":0" : ":") + minutes;
    timeValue += ((seconds < 10) ? ":0" : ":") + seconds;
    
    document.getElementById("zegarek").innerHTML = timeValue;
    timerID = setTimeout("showtime()", 1000);
    timerRunning = true;
}
