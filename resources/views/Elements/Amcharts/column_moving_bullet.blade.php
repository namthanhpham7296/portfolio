<?php
    $dom_id         = $dom_id ?? 'chartdiv';
    $chart_title    = $chart_title ?? 'Chart';
    $chart_value    = $chart_value ?? 'value';
    $chart_label    = $chart_label ?? 'label';
?>
<script>
    am5.ready(function() {

// Create root element
// https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new("<?php echo $dom_id?>");

// Set themes
// https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
            am5themes_Animated.new(root)
        ]);



// Create chart
// https://www.amcharts.com/docs/v5/charts/xy-chart/
        chart = root.container.children.push(
            am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "none",
                wheelY: "none",
                paddingLeft: 50,
                paddingRight: 40
            })
        );

// Create axes
// https://www.amcharts.com/docs/v5/charts/xy-chart/axes/

        var yRenderer = am5xy.AxisRendererY.new(root, {});
        yRenderer.grid.template.set("visible", false);

        yAxis = chart.yAxes.push(
            am5xy.CategoryAxis.new(root, {
                categoryField: "name",
                renderer: yRenderer,
                paddingRight:40
            })
        );

        var xRenderer = am5xy.AxisRendererX.new(root, {});
        xRenderer.grid.template.set("strokeDasharray", [3]);

        xAxis = chart.xAxes.push(
            am5xy.ValueAxis.new(root, {
                min: 0,
                renderer: xRenderer
            })
        );

// Add series
// https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        series = chart.series.push(
            am5xy.ColumnSeries.new(root, {
                name: "<?php echo $chart_title;?>",
                xAxis: xAxis,
                yAxis: yAxis,
                valueXField: "<?php echo $chart_value;?>",
                categoryYField: "<?php echo $chart_label;?>",
                sequencedInterpolation: true,
                calculateAggregates: true,
                maskBullets: false,
                tooltip: am5.Tooltip.new(root, {
                    dy: -30,
                    pointerOrientation: "vertical",
                    labelText: "{valueX}"
                })
            })
        );

        series.columns.template.setAll({
            strokeOpacity: 0,
            cornerRadiusBR: 10,
            cornerRadiusTR: 10,
            cornerRadiusBL: 10,
            cornerRadiusTL: 10,
            maxHeight: 42,
            fillOpacity: 0.8
        });

        var currentlyHovered;

        series.columns.template.events.on("pointerover", function(e) {
            handleHover(e.target.dataItem);
        });

        series.columns.template.events.on("pointerout", function(e) {
            handleOut();
        });

        function handleHover(dataItem) {
            if (dataItem && currentlyHovered != dataItem) {
                handleOut();
                currentlyHovered = dataItem;
                var bullet = dataItem.bullets[0];
                bullet.animate({
                    key: "locationX",
                    to: 1,
                    duration: 600,
                    easing: am5.ease.out(am5.ease.cubic)
                });
            }
        }

        function handleOut() {
            if (currentlyHovered) {
                var bullet = currentlyHovered.bullets[0];
                bullet.animate({
                    key: "locationX",
                    to: 0,
                    duration: 600,
                    easing: am5.ease.out(am5.ease.cubic)
                });
            }
        }


        var circleTemplate = am5.Template.new({});

        series.bullets.push(function(root, series, dataItem) {
            var bulletContainer = am5.Container.new(root, {});
            var circle = bulletContainer.children.push(
                am5.Circle.new(
                    root,
                    {
                        radius: 24
                    },
                    circleTemplate
                )
            );

            var maskCircle = bulletContainer.children.push(
                am5.Circle.new(root, { radius: 27 })
            );

            // only containers can be masked, so we add image to another container
            var imageContainer = bulletContainer.children.push(
                am5.Container.new(root, {
                    mask: maskCircle
                })
            );

            var image = imageContainer.children.push(
                am5.Picture.new(root, {
                    templateField: "pictureSettings",
                    centerX: am5.p50,
                    centerY: am5.p50,
                    radius: 26,
                    width: 26,
                    height: 26
                })
            );

            return am5.Bullet.new(root, {
                locationX: 0,
                sprite: bulletContainer
            });
        });

// heatrule
        series.set("heatRules", [
            {
                dataField: "valueX",
                min: am5.color(0xe5dc36),
                max: am5.color(0x5faa46),
                target: series.columns.template,
                key: "fill"
            },
            {
                dataField: "valueX",
                min: am5.color(0xe5dc36),
                max: am5.color(0x5faa46),
                target: circleTemplate,
                key: "fill"
            }
        ]);

        series.data.setAll(dataChart);
        yAxis.data.setAll(dataChart);

        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineX.set("visible", false);
        cursor.lineY.set("visible", false);

        cursor.events.on("cursormoved", function() {
            var dataItem = series.get("tooltip").dataItem;
            if (dataItem) {
                handleHover(dataItem)
            }
            else {
                handleOut();
            }
        });

// Make stuff animate on load
// https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear();
        chart.appear(1000, 100);

    }); // end am5.ready()
</script>