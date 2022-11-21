/**
 * Скрипт главной страницы модуля Inventoriz
 * 2022.11.18 (c) Павел Сатин
 */




    function onLoadIndexPage() {

        // $.ajaxSetup({
        //     async: false,
        // });

        var inventorizUrl = $('#inventoriz-index').attr('data-api-url');

        // var dataManufacturer = [];
        // var dataOS = [];


        dataManufacturer = getDataFromInventoriz(inventorizUrl + '/api/v1/reports/computers/properties/113'); //86
        dataOS = getDataFromInventoriz(inventorizUrl + '/api/v1/reports/computers/properties/15');
        dataCPU = getDataFromInventoriz(inventorizUrl + '/api/v1/reports/computers/properties/4');
        // dataRAM = getDataFromInventoriz(inventorizUrl + '/api/v1/reports/computers/properties/88');
        dataUpdated = getDataFromInventorizUpdated(inventorizUrl + '/api/v1/reports/computers/last_updated?limit=30');

        // console.log(dataUpdated);


        google.charts.load("current", { packages: ["corechart"] });
        google.charts.setOnLoadCallback(drawChartManufacturers);
        google.charts.setOnLoadCallback(drawChartOS);
        google.charts.setOnLoadCallback(drawChartCPU);

        google.charts.setOnLoadCallback(drawChartUpdated);



        // setTimeout(function(){
            $('#tableComputers').DataTable({
                ajax: inventorizUrl + '/api/v1/reports/computers/list',
                columns: [
                    { width: '20%',
                        render: function(data) {
                            data = '<a href="inventoriz/tree?host=' + data + '">' + data + '</a>';
                            return data;
                        } },
                    { width: '15%' },
                    { width: '28%' },
                    { width: '27%' },
                    { width: '10%', className: 'dt-body-right' }
                ],
                language: {
                    url: '/icingaweb2/img/inventoriz/datatables/ru.json'
                }
            });
            // }, 1000);
        

    }



    function drawChartManufacturers() {
        var data = google.visualization.arrayToDataTable(dataManufacturer);
        var options = {
            width: '100%',
            title: 'Производители',
            pieHole: 0.4,
            chartArea: {
                left: 0,
                height: 250,
                width: 600
            },
            legend: {
                maxLines: 2,
            }
        };
        var chart = new google.visualization.PieChart(document.getElementById('chartManufacturers'));
        chart.draw(data, options);
    }

    function drawChartOS() {
        var data = google.visualization.arrayToDataTable(dataOS);
        var options = {
            width: '100%',
            title: 'Операционные системы',
            pieHole: 0.4,
            chartArea: {
                left: 0,
                height: 250,
                width: 600
            },
            legend: {
                maxLines: 2,
            }
        };
        var chart = new google.visualization.PieChart(document.getElementById('chartOS'));
        chart.draw(data, options);
    }

    function drawChartCPU() {
        var data = google.visualization.arrayToDataTable(dataCPU);
        var options = {
            width: '100%',
            title: 'Процессоры',
            pieHole: 0.4,
            chartArea: {
                left: 0,
                height: 250,
                width: 600
            },
            legend: {
                maxLines: 2,
            }
        };
        var chart = new google.visualization.PieChart(document.getElementById('chartCPU'));
        chart.draw(data, options);
    }

    function drawChartRAM() {
        var data = google.visualization.arrayToDataTable(dataRAM);
        var options = {
            width: '100%',
            title: 'Оперативная память, Мб',
            pieHole: 0.4,
            chartArea: {
                left: 0,
                height: 250,
                width: 600
            },
            height: 300,
            width: 600,
            legend: {
                maxLines: 2,
            }
        };
        var chart = new google.visualization.PieChart(document.getElementById('chartRAM'));
        chart.draw(data, options);
    }


    function drawChartUpdated() {
        var data = google.visualization.arrayToDataTable(dataUpdated);

        var options = {
            width: '100%',
            title: 'Последние опросы',
            // hAxis: {title: 'Дата',  titleTextStyle: {color: '#333'}},
            // vAxis: {title: 'Компьютеры', minValue: 0},
            curveType: 'function',
            chartArea: {
                left: 0,
                height: 250,
                width: 600
            },
            legend: { position: 'none' },


        };

        var chart = new google.visualization.LineChart(document.getElementById('chartUpdated'));
        // var chart = new google.visualization.AreaChart(document.getElementById('chartUpdated'));
        chart.draw(data, options);
    }


    function getDataFromInventoriz(dataUrl) {
        var arrValues = [];
        $.ajax({
            type: "GET",
            url: dataUrl,
            success: function (data) {
                // console.log(data);
                var result = [];
                data.reduce(function (res, dataR) {
                    if (!res[dataR.value]) {
                        res[dataR.value] = { Manufacturer: dataR.value, qty: 0 };
                        result.push(res[dataR.value])
                    }
                    res[dataR.value].qty += 1;
                    return res;
                }, {});

                arrValues.push(['Наименование', 'Количество']);
                $.each(result, function (key, value) {
                    arrValues.push([value.Manufacturer, value.qty]);
                });

            },
            error: function (jqXHR, text, error) {
                console.log(error);
            }
        });
        return arrValues;
    }

    function getDataFromInventorizUpdated(dataUrl) {
        var arrValues = [];
        $.ajax({
            type: "GET",
            url: dataUrl,
            success: function (data) {
                // console.log(data);
                var result = [];

                arrValues.push(['Дата', 'Компьютеры']);
                $.each(data, function (key, value) {
                    arrValues.push([value.date, value.total]);
                });

            },
            error: function (jqXHR, text, error) {
                console.log(error);
            }
        });
        return arrValues;
    }




