<?php
include "common/config.php";    
include "common/check_login.php";
include "common/common_code.php";
?>
<!DOCTYPE html>
<html lang="en"> 
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>EMI | <?php echo $company_title;?></title>
    <meta name="google-site-verification" content="Y920H2Ng2YNytsEBYLPnZlELKdBYlr_3bxZ7mBmlPfI"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:keyword" content="<?php echo $company_title;?>" />
    <meta property="og:title" content="<?php echo $company_title;?>" />
    <meta property="og:description" content="<?php echo $company_title;?>" />
    <meta name="p:domain_verify" content="970c34ed80814dd6863224a4cfdaee0d"/>
    <meta name="robots" content="noindex, follow" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="32x32" />
    <link rel="icon" href="<?php echo $base_url_images; ?>fevicon.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="<?php echo $base_url_images; ?>fevicon.png" />
    <meta name="msapplication-TileImage" content="<?php echo $base_url_images; ?>fevicon.png" />
    <?php include "common/header-css.php";?>
    <script src="<?php echo $base_url_js ?>highcharts.6.0.3.min.js"></script>
    <link rel="stylesheet" href="<?php echo $base_url_css ?>calculator-dsl-3.0.0.css">
    <link rel="stylesheet" href="<?php echo $base_url_css ?>bootstrap.min.css">
</head>
<body class="custom-cursor">
   <div class="page-wrapper">
   <?php include 'common/header.php';?>
       <section class="page-header">
            <div class="page-header-bg" style="background-image: url(<?php echo $base_url_images ?>backgrounds/page-header-bg.jpg)">
            </div>
            <div class="page-header-shape-1"><img src="<?php echo $base_url_images ?>shapes/page-header-shape-1.png" alt=""></div>
            <div class="container">
                <div class="page-header__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="index.html">Home</a></li>
                        <li><span>/</span></li>
                        <li>EMI details</li>
                    </ul>
                    <h2>Emi details</h2>
                </div>
            </div>
        </section>
     <section class="news-two">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                   <div id="calc" class="col-sm-12" style="border: 1px solid #eaeaea"></div>
                </div>
                <div class="col-md-4">
                   <h3 style="text-align: center;">Payment Breakup</h3>
                   <div id="container">&nbsp;</div>
                </div>
            </div>  
        </div>      
     </section>
   <?php include 'common/footer.php';?>
   <?php include 'common/footer-js.php';?>
   <script type="text/javascript" src="<?php echo $base_url_js ?>calculator-dsl-3.0.0.js"></script>
    <script async="">
      var carloanConfig = {
        selector: "#calc",
        calculatorData: {
            title: "Loan EMI calculator",
            fields: {
                a: {
                    title: "Select loan amount",
                    type: "number",
                    value: "200000",
                    max: "20000000",
                    min: "100000",
                    isCurrency: true,
                    currency: "₹",
                    isCurrencySuffix: false,
                    hide: false,
                    editValue: false,
                    disabled: false,
                },
                b: {
                    title: "Number of months",
                    type: "slider",
                    value: "12",
                    max: "500",
                    min: "12",
                    unit: "MONTHS",
                    stepValue: 1,
                    hide: !1,
                    editValue: !1,
                    disabled: !1,
                },
                c: {
                    title: "Interest rate",
                    type: "slider",
                    value: "8",
                    max: "18",
                    min: "8",
                    stepValue: 0.05,
                    unit: "%",
                    hide: !1,
                    disabled: !1,
                },
                d: {
                    title: "EMI payable",
                    type: "output",
                    formula: function(fields){
                        var loanAmount = fields.a.value;
                        var numberOfMonths = fields.b.value;
                        var rateOfInterest = fields.c.value;
                        var monthlyInterestRatio = rateOfInterest / 100 / 12;

                        var top = Math.pow(1 + monthlyInterestRatio, numberOfMonths);
                        var bottom = top - 1;
                        var sp = top / bottom;
                        var emi = loanAmount * monthlyInterestRatio * sp;

                        return emi;
                    },
                    customHtml: function(value) {
                        return (
                            "<label>EMI Payable is </label><span>₹" +
                            addCommas(value.toFixed(0)) +
                            "</span>"
                        );
                    },
                },
                e: {
                    title: "Total Interest is",
                    type: "output",
                    formula: "INT((b * d) - a)",
                    isCurrency: true,
                    currency: "₹",
                    isCurrencySuffix: false,
                    class: "total-deposit"
                },
                f: {
                    title: "Payable amount",
                    type: "output",
                    formula: "INT(b*d)",
                    isCurrency: true,
                    currency: "₹",
                    isCurrencySuffix: false,
                },
                g : {
                    type: "output",
                    formula : function(fields){
                        var chart = new Highcharts.Chart({
                            
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                renderTo: 'container'

                            },
                            tooltip: {
                                formatter: function() {
                                        return '<b>' + this.point.name + '</b>: ₹' + addCommas(this.y);
                                }
                            },
                            legend: {
                                enabled: true,
                                labelFormatter: function() {
                                    return '<span>' + this.name + ': </span><b> ₹' + addCommas(this.y) + '<br/>';
                                }
                            },
                            title:{
                            text:''
                            },
                            credits: {
                            enabled: false
                            },
                            plotOptions: {
                                pie: {
                                    colors: [
                                '#89D6FF',
                                '#FBB750',
                                ],
                                    allowPointSelect: true,
                                    showInLegend:true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: false,
                                        color: '#314259',
                                        connectorColor: '#314259',
                                        formatter: function() {
                                        return this.key + ' Value: ₹' + addCommas(this.y);
                                        }
                                    },
                                    shadow: true,
                                }
                            },
                            series: [{
                                type: 'pie',
                                name: 'Amount',
                                data: [
                                    ['Principal',   eval(fields.a.value)],
                                    ['Interest',     eval(fields.e.value.toFixed(0))]
                                ],
                                animation: false,
                            }]
                        }); 
                    },
                    hide: true,
                },
                table: {
                    title: "Monthly Repayment Schedule",
                    type: "table",
                    formula: function(fields){
                        var detailDesc = [["Payment No.","Begining Balance", "EMI", "Principal", "Interest", "Ending Balance"]];

                        var bb = parseInt(fields.a.value);
                        var int_dd = 0;
                        var pre_dd = 0;
                        var end_dd = 0;
                        for (var j = 1; j <= fields.b.value; j++) {
                            int_dd = bb * (fields.c.value / 100 / 12);
                            pre_dd = fields.d.value.toFixed(2) - int_dd.toFixed(2);
                            end_dd = bb - pre_dd.toFixed(2);

                            var rowArr = [
                                j,
                                "₹" + addCommas(bb.toFixed(0)),
                                "₹" + addCommas(fields.d.value.toFixed(0)),
                                "₹" + addCommas(pre_dd.toFixed(0)),
                                "₹" + addCommas(int_dd.toFixed(0)),
                                "₹" + addCommas(end_dd.toFixed(0)),
                                
                            ]
                            
                            detailDesc.push(rowArr);
                            bb = bb - pre_dd.toFixed(2);
                        }
                        
                        return detailDesc;
                    },
                    class: "steampunk-table"
                },
            },
        },
    };
    emi = new Calc(carloanConfig);
    emi.init();
    document.querySelectorAll("table.steampunk-table")[0].parentElement.classList.add("table-responsive");
    </script>
 </body>    
</html>