$(document).ready(function() {
    init_chart(
        [{
            period: '2010'
            , iphone: 50
            , ipad: 80
            , itouch: 20
        }, {
                period: '2011'
                , iphone: 130
                , ipad: 100
                , itouch: 80
        }, {
                period: '2012'
                , iphone: 80
                , ipad: 60
                , itouch: 70
        }, {
                period: '2013'
                , iphone: 70
                , ipad: 200
                , itouch: 140
        }, {
                period: '2014'
                , iphone: 180
                , ipad: 150
                , itouch: 140
        }, {
                period: '2015'
                , iphone: 105
                , ipad: 100
                , itouch: 80
        }
            , {
                period: '2016'
                , iphone: 250
                , ipad: 150
                , itouch: 200
        }],
        [{
            period: '2010'
            , iphone: 50
            , ipad: 80
            , itouch: 20
        }, {
                period: '2011'
                , iphone: 130
                , ipad: 100
                , itouch: 80
        }, {
                period: '2012'
                , iphone: 80
                , ipad: 60
                , itouch: 70
        }, {
                period: '2013'
                , iphone: 70
                , ipad: 200
                , itouch: 140
        }, {
                period: '2014'
                , iphone: 180
                , ipad: 150
                , itouch: 140
        }, {
                period: '2015'
                , iphone: 105
                , ipad: 100
                , itouch: 80
        }
            , {
                period: '2016'
                , iphone: 250
                , ipad: 150
                , itouch: 200
        }],
        [{
            period: '2010'
            , iphone: 50
            , ipad: 80
            , itouch: 20
        }, {
                period: '2011'
                , iphone: 130
                , ipad: 100
                , itouch: 80
        }, {
                period: '2012'
                , iphone: 80
                , ipad: 60
                , itouch: 70
        }, {
                period: '2013'
                , iphone: 70
                , ipad: 200
                , itouch: 140
        }, {
                period: '2014'
                , iphone: 180
                , ipad: 150
                , itouch: 140
        }, {
                period: '2015'
                , iphone: 105
                , ipad: 100
                , itouch: 80
        }
            , {
                period: '2016'
                , iphone: 250
                , ipad: 150
                , itouch: 200
        }]
    );
    return;
    // real data from server
    $.ajax({
        url: site_url + 'dashboard/ajax_prev_month_visit',
        dataType: 'json',
        success: function(resp) {
            if (resp.status) {
                init_chart(
                    resp.user_data,
                    resp.bet_data,
                    resp.financial_data
                );
            } else {
                console.log(resp.error);
            }
        }
    });
});

function init_chart(user_data, bet_data, financial_data) {
    if($('#users-chart').length > 0) {
        Morris.Area({
            element: 'users-chart'
            , data: user_data
            , xkey: 'period'
            , ykeys: ['iphone', 'ipad']
            , labels: ['iphone', 'ipad']
            , pointSize: 3
            , fillOpacity: 0
            , pointStrokeColors: ['#00bfc7', '#fb9678']
            , behaveLikeLine: true
            , gridLineColor: '#e0e0e0'
            , lineWidth: 3
            , hideHover: 'auto'
            , lineColors: ['#00bfc7', '#fb9678']
            , resize: true
        });
    }

    if ($('#bets-chart').length > 0) {
        Morris.Area({
            element: 'bets-chart'
            , data: bet_data
            , xkey: 'period'
            , ykeys: ['iphone', 'ipad']
            , labels: ['iphone', 'ipad']
            , pointSize: 3
            , fillOpacity: 0
            , pointStrokeColors: ['#00bfc7', '#fb9678']
            , behaveLikeLine: true
            , gridLineColor: '#e0e0e0'
            , lineWidth: 3
            , hideHover: 'auto'
            , lineColors: ['#00bfc7', '#fb9678']
            , resize: true
        });
    }

    if ($('#financial-chart').length > 0) {
        Morris.Area({
            element: 'financial-chart'
            , data: financial_data
            , xkey: 'period'
            , ykeys: ['iphone', 'ipad']
            , labels: ['iphone', 'ipad']
            , pointSize: 3
            , fillOpacity: 0
            , pointStrokeColors: ['#00bfc7', '#fb9678']
            , behaveLikeLine: true
            , gridLineColor: '#e0e0e0'
            , lineWidth: 3
            , hideHover: 'auto'
            , lineColors: ['#00bfc7', '#fb9678']
            , resize: true
        });
    }
}