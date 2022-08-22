@extends('layouts.app')

@section('breadcrumb')
 <div class="page-title-box">
  <h4 class="page-title">Home </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('frontend')}}">Home</a></li>

    </ol>
</div>
@endsection

@section('content')
<div class="container-fluid">
          <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    @if (session('final_success'))
                                        <div class="alert alert-success">
                                            {{ session('final_success') }}
                                        </div>
                                    @endif
                                    {{-- {{ url()->previous() }} --}}
                                    <h4 class="header-title mb-4">System Overview</h4>
                                    <img width="100%" height="100%" src="{{ asset('uploads/profile-pic/DBpic.jpg')}}" alt="">
                                    {{-- <div class="row">
                                        <div class="col-sm-6 col-lg-6 col-xl-3">
                                            <div class="card-box mb-0 widget-chart-two">
                                                <div class="float-right">
                                                    <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                                           data-fgColor="#0acf97" value="{{ $total_users}}" data-skin="tron" data-angleOffset="180"
                                                           data-readOnly=true data-thickness=".1"/>
                                                </div>
                                                <div class="widget-chart-two-content">
                                                    <p class="text-muted mb-0 mt-2">Total Users</p>
                                                    <h3 class="">
                                                        <i class="fa fa-users"></i> {{ $total_users}}
                                                    </h3>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-lg-6 col-xl-3">
                                            <div class="card-box mb-0 widget-chart-two">
                                                <div class="float-right">
                                                    <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                                           data-fgColor="#f9bc0b" value="{{ $total_admin}}" data-skin="tron" data-angleOffset="180"
                                                           data-readOnly=true data-thickness=".1"/>
                                                </div>
                                                <div class="widget-chart-two-content">
                                                    <p class="text-muted mb-0 mt-2">Total Admin</p>
                                                    <h3 class="">
                                                         <i class="fa fa-user-secret"></i> {{ $total_admin}}
                                                    </h3>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-lg-6 col-xl-3">
                                            <div class="card-box mb-0 widget-chart-two">
                                                <div class="float-right">
                                                    <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                                           data-fgColor="#f1556c" value="{{ $total_customers}}" data-skin="tron" data-angleOffset="180"
                                                           data-readOnly=true data-thickness=".1"/>
                                                </div>
                                                <div class="widget-chart-two-content">
                                                    <p class="text-muted mb-0 mt-2">Total Customers</p>
                                                    <h3 class="">
                                                        <i class="fa fa-user"></i> {{ $total_customers}}
                                                    </h3>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-lg-6 col-xl-3">
                                            <div class="card-box mb-0 widget-chart-two">
                                                <div class="float-right">
                                                    <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                                           data-fgColor="#000000" value="{{ $total_vendor}}" data-skin="tron" data-angleOffset="180"
                                                           data-readOnly=true data-thickness=".1"/>
                                                </div>
                                                <div class="widget-chart-two-content">
                                                    <p class="text-muted mb-0 mt-2">Total Vendor</p>
                                                    <h3 class="">
                                                        <i class="fa fa-user"></i> {{ $total_vendor}}
                                                    </h3>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-lg-6 col-xl-3">
                                            <div class="card-box mb-0 widget-chart-two">
                                                <div class="float-right">
                                                    <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                                           data-fgColor="#2d7bf4" value="60" data-skin="tron" data-angleOffset="180"
                                                           data-readOnly=true data-thickness=".1"/>
                                                </div>
                                                <div class="widget-chart-two-content">
                                                    <p class="text-muted mb-0 mt-2">Total Revenue</p>
                                                    <h3 class="">$32,540</h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div> --}}
                                    <!-- end row -->
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="col-lg-8">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title">Admin VS Customers</h4>


                                    <div id="donut-chart">
                                        <div id="donut-chart-container" class="flot-chart mt-5" style="height: 340px;">
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div> --}}
                        <!-- end row -->
</div>
@endsection

@section('footer_script')
<script>
    /**
 * Theme: Highdmin - Responsive Bootstrap 4 Admin Dashboard
 * Author: Coderthemes
 * Module/App: Flot-Chart
 */

! function($) {
    "use strict";

    var FlotChart = function() {
        this.$body = $("body")
        this.$realData = []
    };

    //creates plot graph
    FlotChart.prototype.createPlotGraph = function(selector, data1, data2, data3, labels, colors, borderColor, bgColor) {
        //shows tooltip
        function showTooltip(x, y, contents) {
            $('<div id="tooltip" class="tooltipflot">' + contents + '</div>').css({
                position : 'absolute',
                top : y + 5,
                left : x + 5
            }).appendTo("body").fadeIn(200);
        }


        $.plot($(selector), [{
            data : data1,
            label : labels[0],
            color : colors[0]
        }, {
            data : data2,
            label : labels[1],
            color : colors[1]
        },
            {
                data : data3,
                label : labels[2],
                color : colors[2]
            }], {
            series : {
                lines : {
                    show : true,
                    fill : true,
                    lineWidth : 2,
                    fillColor : {
                        colors : [{
                            opacity : 0.5
                        }, {
                            opacity : 0.5
                        }, {
                            opacity: 0.8
                        }]
                    }
                },
                points : {
                    show : true
                },
                shadowSize : 0
            },

            grid : {
                hoverable : true,
                clickable : true,
                borderColor : borderColor,
                tickColor : "#f9f9f9",
                borderWidth : 1,
                labelMargin : 30,
                backgroundColor : bgColor
            },
            legend : {
                position: "ne",
                margin : [0, -32],
                noColumns : 0,
                labelBoxBorderColor : null,
                labelFormatter : function(label, series) {
                    // just add some space to labes
                    return '' + label + '&nbsp;&nbsp;';
                },
                width : 30,
                height : 2
            },
            yaxis : {
                axisLabel: "Daily Visits",
                tickColor : '#f5f5f5',
                font : {
                    color : '#bdbdbd'
                }
            },
            xaxis : {
                axisLabel: "Last Days",
                tickColor : '#f5f5f5',
                font : {
                    color : '#bdbdbd'
                }
            },
            tooltip : true,
            tooltipOpts : {
                content : '%s: Value of %x is %y',
                shifts : {
                    x : -60,
                    y : 25
                },
                defaultTheme : false
            },
            splines: {
                show: true,
                tension: 0.1, // float between 0 and 1, defaults to 0.5
                lineWidth: 1 // number, defaults to 2
            }
        });
    },
        //end plot graph

        //creates Donut Chart
        FlotChart.prototype.createDonutGraph = function(selector, labels, datas, colors) {
            var data = [{
                label : labels[0],
                data : datas[0]
            }, {
                label : labels[1],
                data : datas[1]
            }, {
                label : labels[2],
                data : datas[2]
            },{
                label : labels[3],
                data : datas[3]
            }, {
                label : labels[4],
                data : datas[4]
            }];
            var options = {
                series : {
                    pie : {
                        show : true,
                        innerRadius : 0.7
                    }
                },
                legend : {
                    position: "sw",
                    margin : [0, 0],
                    noColumns : 2,
                    show : false,
                    labelFormatter : function(label, series) {
                        return '<div style="font-size:14px;">&nbsp;' + label + '</div>'
                    },
                    labelBoxBorderColor : null,
                    width : 20
                },
                grid : {
                    hoverable : true,
                    clickable : true
                },
                colors : colors,
                tooltip : true,
                tooltipOpts : {
                    content : "%s, %p.0%"
                }
            };

            $.plot($(selector), data, options);
        },
        //creates Combine Chart
        FlotChart.prototype.createCombineGraph = function(selector, ticks, labels, datas) {

            var data = [{
                label : labels[0],
                data : datas[0],
                lines : {
                    show : true,
                    fill : true
                },
                points : {
                    show : true
                }
            }, {
                label : labels[1],
                data : datas[1],
                lines : {
                    show : true
                },
                points : {
                    show : true
                }
            }, {
                label : labels[2],
                data : datas[2],
                bars : {
                    show : true
                }
            }];
            var options = {
                series : {
                    shadowSize : 0
                },
                grid : {
                    hoverable : true,
                    clickable : true,
                    tickColor : "#f9f9f9",
                    borderWidth : 1,
                    borderColor : "#eeeeee"
                },
                colors : ['#e3eaef','#f1556c','#02c0ce'],
                tooltip : true,
                tooltipOpts : {
                    defaultTheme : false
                },
                legend : {
                    position : "ne",
                    margin : [0, -32],
                    noColumns : 0,
                    labelBoxBorderColor : null,
                    labelFormatter : function(label, series) {
                        // just add some space to labes
                        return '' + label + '&nbsp;&nbsp;';
                    },
                    width : 30,
                    height : 2
                },
                yaxis : {
                    axisLabel: "Point Value (1000)",
                    tickColor : '#f5f5f5',
                    font : {
                        color : '#bdbdbd'
                    }
                },
                xaxis : {
                    axisLabel: "Daily Hours",
                    ticks: ticks,
                    tickColor : '#f5f5f5',
                    font : {
                        color : '#bdbdbd'
                    }
                }
            };

            $.plot($(selector), data, options);
        },

        //initializing various charts and components
        FlotChart.prototype.init = function() {
            //Donut pie graph data
            var donutlabels = ["Total Admin", "Total Customers", "Total Vendor",];
            var donutdatas = [{{ $total_admin}}, {{ $total_customers}}, {{ $total_vendor}}];
            var donutcolors = ['#2d7bf4','#f1556c', '#000000'];
            this.createDonutGraph("#donut-chart #donut-chart-container", donutlabels, donutdatas, donutcolors);

        },

                //init flotchart
                $.FlotChart = new FlotChart, $.FlotChart.Constructor =
                FlotChart

        }(window.jQuery),

        //initializing flotchart
            function($) {
                "use strict";
                $.FlotChart.init()
            }(window.jQuery);

        </script>
        @endsection
