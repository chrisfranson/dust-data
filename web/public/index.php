<!DOCTYPE HTML>
<html>
<body>
    <span id="uptime"></span><br>
    <span id="tstamp"></span>

    <br><br>
    <button onclick="start()">Connect</button>

    <script type="text/javascript">
    function start() {

        document.getElementById("uptime").innerHTML = "Waiting for data...";
        var deviceID = "<<hex device id here>>";
        var accessToken = "<<hex access token here>>";
        var eventSource = new EventSource("https://api.spark.io/v1/devices/" + deviceID + "/events/?access_token=" + accessToken);

        eventSource.addEventListener('open', function(e) {
            console.log("Opened!"); },false);

        eventSource.addEventListener('error', function(e) {
            console.log("Errored!"); },false);

        eventSource.addEventListener('Uptime', function(e) {
            var parsedData = JSON.parse(e.data);
            var tempSpan = document.getElementById("uptime");
            var tsSpan   = document.getElementById("tstamp");
            tempSpan.innerHTML = "Core: " + parsedData.coreid + " uptime: " + parsedData.data + " (h:m:s)";
            tempSpan.style.fontSize = "28px";
            tsSpan.innerHTML = "At timestamp " + parsedData.published_at;
            tsSpan.style.fontSize = "9px";
        }, false);
    }
    </script>
</body>
</html>