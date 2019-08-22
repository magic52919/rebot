<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="refresh" content="3600" />

    <title>GMOP Monitor!!!</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" rel="stylesheet">
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="http://code.highcharts.com/highcharts.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script>
        var i = -0;
        $(document).ready(function() {


            htmlobj = $.ajax({
                method: "GET",
                url: "test.php",
                async: false
            });
            console.log(htmlobj);
            msg = JSON.parse(htmlobj.responseText);
            // Bet_number = msg.results[0].series[0].values[0][2];
            Bet_number = msg.body.data[0].amount;

            console.log(msg.body.data);

            var date10 = new Date(msg.body.data[0].creation_date);
            Y = date10.getFullYear() + '-';
            M = (date10.getMonth() + 1 < 10 ? '0' + (date10.getMonth() + 1) : date10.getMonth() + 1) + '-';
            D = date10.getDate() + ' ';
            h = date10.getHours() + ':';
            m = date10.getMinutes();
            if (m < 10) {
                m = '0' + m;
            }
            if (D < 10) {
                D = '0' + D;
            }

            var chart = {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in IE < IE 10.
                marginRight: 10,
                events: {
                    load: function() {
                        var series = this.series[0];
                        setInterval(function() {

                            htmlobj = $.ajax({
                                type : "GET",
                                url: "test.php",
                                async: false
                            });
                            msg1 = JSON.parse(htmlobj.responseText);
                            Bet_number1 = msg1.body.data[0].amount;

                            for (a = 0; a >= 0; a--) {
                                var x = (new Date(msg1.body.data[a].creation_date)).getTime()-10800000,
                                    y = parseInt(msg1.body.data[0].amount);
                                series.addPoint([x, y], true, true);
                                console.log(x,y);
                            }
                            console.log(111);
                        }, 120000); //一分鐘呼叫一次新的數據

                    }
                }
            };
            var title = {
                //text: '最後更新時間:'+ Y+M+D+h+m
                text: 'AIO總人數'
            }
            var xAxis = {
                type: 'datetime',

                tickInterval: 600000 //一個區間10分鐘
            };
            var yAxis = {
                title: {
                    text: '人數'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080/',
                    dashStyle: 'longdashdot',
                    value: 5.5
                }]
            };
            var tooltip = {
                formatter: function() {
                    return '<b>' + this.series.name + '</b><br/>' +
                        Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                        Highcharts.numberFormat(this.y);

                }
            };
            var plotOptions = {
                area: {
                    pointStart: 1940,
                    marker: {
                        enabled: false,
                        symbol: 'circle',
                        radius: 2,
                        states: {
                            hover: {
                                enabled: true
                            }
                        }
                    }
                }
            };
            var legend = {
                enabled: false
            };
            var exporting = {
                enabled: false
            };
            var series = [{
                name: '人數',
                data: (function() {
                    // generate an array of random data
                    var date = new Date(msg.body.data[0].creation_date);
                    var data = [],time = (date.getTime()-28800000),i;
                    for (i = 0; i <= 60; i ++) {
                        data.push({
                            x: time + (i) * 300000, 
                            y: parseInt(msg.body.data[i].amount)
                        });
                    }
                    return data;
                }())
            }];

            var json = {};
            json.chart = chart;
            json.title = title;
            json.tooltip = tooltip;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.legend = legend;
            json.exporting = exporting;
            json.series = series;
            json.plotOptions = plotOptions;


            Highcharts.setOptions({
                global: {
                    useUTC: false
                }
            });
            $('#jojo').highcharts(json);

        });
    </script>
</head>


<body>
    <div id="jojo"style="width: 96%; height: 25%; margin: 10 auto"></div>
</body>