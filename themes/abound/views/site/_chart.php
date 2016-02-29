            <?php
                $this->widget(
                    'yiiwheels.widgets.highcharts.WhHighCharts',
                    array(
                        'pluginOptions' => array(
                                "chart"=>array(
                                        "type"=>'pie'
                                    ),
                                "title"=>"Leads and status report",
                                "pie"=>array(
                                        "allowPointSelect"=>true,
                                        "cursor"=>'pointer',
                                        "dataLabels"=>array(
                                                'enabled'=> false,
                                            ),
                                        "showInLegend"=>true
                                    ),
                                "series"=>array(
                                        array(
                                                "Name"=>"Brands",
                                                "colorByPoint"=>true,
                                                "data"=>$chartDataProvider
                                            )
                                    )
                            ),
                    )
                );
            ?>