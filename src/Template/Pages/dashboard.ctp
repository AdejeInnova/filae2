<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <b>ImPyme</b> Adeje
        <small>Control panel</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $totalCompanies ?></h3>
                    <p>Empresas</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <?php
                    echo $this->Html->link(
                        'More info <i class="fa fa-arrow-circle-right"></i>',
                        [
                            'controller' => 'companies',
                            'action' => 'index'
                        ],
                        [
                            'escape' => false,
                            'class' => 'small-box-footer'
                        ]
                    );
                ?>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $totalLocales ?></h3>
                    <p>Locales</p>
                </div>
                <div class="icon">
                    <i class="ion ion-star"></i>
                </div>
                <?php
                echo $this->Html->link(
                    'More info <i class="fa fa-arrow-circle-right"></i>',
                    [
                        'controller' => 'locales',
                        'action' => 'index'
                    ],
                    [
                        'escape' => false,
                        'class' => 'small-box-footer'
                    ]
                );
                ?>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->
<?php
/*$this->Html->css([
    'AdminLTE./plugins/iCheck/flat/blue',
    'AdminLTE./plugins/morris/morris',
    'AdminLTE./plugins/jvectormap/jquery-jvectormap-1.2.2',
    'AdminLTE./plugins/datepicker/datepicker3',
    'AdminLTE./plugins/daterangepicker/daterangepicker-bs3',
    'AdminLTE./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min'
],
    ['block' => 'css']);

$this->Html->script([
    'https://code.jquery.com/ui/1.11.4/jquery-ui.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js',
    'AdminLTE./plugins/morris/morris.min',
    'AdminLTE./plugins/sparkline/jquery.sparkline.min',
    'AdminLTE./plugins/jvectormap/jquery-jvectormap-1.2.2.min',
    'AdminLTE./plugins/jvectormap/jquery-jvectormap-world-mill-en',
    'AdminLTE./plugins/knob/jquery.knob',
    'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js',
    'AdminLTE./plugins/datepicker/bootstrap-datepicker',
    'AdminLTE./plugins/daterangepicker/daterangepicker',
    'AdminLTE./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min',
],
    ['block' => 'script']);*/
?>

<?php $this->start('scriptBotton'); ?>
<script type="text/javascript">
    /*var area = new Morris.Area({
        element: 'revenue-chart',
        resize: true,
        data: [
            {y: '2011 Q1', item1: 2666, item2: 2666},
            {y: '2011 Q2', item1: 2778, item2: 2294},
            {y: '2011 Q3', item1: 4912, item2: 1969},
            {y: '2011 Q4', item1: 3767, item2: 3597},
            {y: '2012 Q1', item1: 6810, item2: 1914},
            {y: '2012 Q2', item1: 5670, item2: 4293},
            {y: '2012 Q3', item1: 4820, item2: 3795},
            {y: '2012 Q4', item1: 15073, item2: 5967},
            {y: '2013 Q1', item1: 10687, item2: 4460},
            {y: '2013 Q2', item1: 8432, item2: 5713}
        ],
        xkey: 'y',
        ykeys: ['item1', 'item2'],
        labels: ['Item 1', 'Item 2'],
        lineColors: ['#a0d0e0', '#3c8dbc'],
        hideHover: 'auto'
    });
    var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: [
            {y: '2011 Q1', item1: 2666},
            {y: '2011 Q2', item1: 2778},
            {y: '2011 Q3', item1: 4912},
            {y: '2011 Q4', item1: 3767},
            {y: '2012 Q1', item1: 6810},
            {y: '2012 Q2', item1: 5670},
            {y: '2012 Q3', item1: 4820},
            {y: '2012 Q4', item1: 15073},
            {y: '2013 Q1', item1: 10687},
            {y: '2013 Q2', item1: 8432}
        ],
        xkey: 'y',
        ykeys: ['item1'],
        labels: ['Item 1'],
        lineColors: ['#efefef'],
        lineWidth: 2,
        hideHover: 'auto',
        gridTextColor: "#fff",
        gridStrokeWidth: 0.4,
        pointSize: 4,
        pointStrokeColors: ["#efefef"],
        gridLineColor: "#efefef",
        gridTextFamily: "Open Sans",
        gridTextSize: 10
    });

    //Donut Chart
    var donut = new Morris.Donut({
        element: 'sales-chart',
        resize: true,
        colors: ["#3c8dbc", "#f56954", "#00a65a"],
        data: [
            {label: "Download Sales", value: 12},
            {label: "In-Store Sales", value: 30},
            {label: "Mail-Order Sales", value: 20}
        ],
        hideHover: 'auto'
    });

    //Fix for charts under tabs
    $('.box ul.nav a').on('shown.bs.tab', function () {
        area.redraw();
        donut.redraw();
        line.redraw();
    });

    //jvectormap data
    var visitorsData = {
        "US": 398, //USA
        "SA": 400, //Saudi Arabia
        "CA": 1000, //Canada
        "DE": 500, //Germany
        "FR": 760, //France
        "CN": 300, //China
        "AU": 700, //Australia
        "BR": 600, //Brazil
        "IN": 800, //India
        "GB": 320, //Great Britain
        "RU": 3000 //Russia
    };
    //World map by jvectormap
    $('#world-map').vectorMap({
        map: 'world_mill_en',
        backgroundColor: "transparent",
        regionStyle: {
            initial: {
                fill: '#e4e4e4',
                "fill-opacity": 1,
                stroke: 'none',
                "stroke-width": 0,
                "stroke-opacity": 1
            }
        },
        series: {
            regions: [{
                values: visitorsData,
                scale: ["#92c1dc", "#ebf4f9"],
                normalizeFunction: 'polynomial'
            }]
        },
        onRegionLabelShow: function (e, el, code) {
            if (typeof visitorsData[code] != "undefined")
                el.html(el.html() + ': ' + visitorsData[code] + ' new visitors');
        }
    });*/

    /* jQueryKnob */
    //$(".knob").knob();

    /* The todo list plugin */
    /*$(".todo-list").todolist({
        onCheck: function (ele) {
            window.console.log("The element has been checked");
            return ele;
        },
        onUncheck: function (ele) {
            window.console.log("The element has been unchecked");
            return ele;
        }
    });*/

    //bootstrap WYSIHTML5 - text editor
    //$(".textarea").wysihtml5();

    /*$('.daterange').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
    }, function (start, end) {
        window.alert("You chose: " + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });*/

    //The Calender
    //$("#calendar").datepicker();

    //SLIMSCROLL FOR CHAT WIDGET
    /*$('#chat-box').slimScroll({
        height: '250px'
    });*/

</script>
<?php  $this->end(); ?>
