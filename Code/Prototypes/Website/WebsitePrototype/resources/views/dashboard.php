<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link rel="stylesheet" href="../resources/css/dashboard.css" type="text/css">
</head>

<body>
<a id="logout-button" href="index.php?action=logout">Logout</a>
<h1>Dashboard</h1>

<!-- Filter Date Range -->
<form id="filter-form" method="GET">
    <div class="filter-container">
        <label for="sensor-select">Select Sensor:</label>
        <select id="sensor-select" name="sensor">
            <?php
            foreach($sensorsList as $sval) {
                ?>
                <option value="<?php echo $sval->getSensorCode(); ?>"><?php echo $sval->getSensorCode(); ?></option>
            <?php
            }
            ?>
        </select>

        <input type="hidden" id="action" name="action" value="filterRefresh">
        <label for="from-date">From Date:</label>
        <input type="date" id="from-date" name="from-date">
        <label for="to-date">To Date:</label>
        <input type="date" id="to-date" name="to-date">
        <button type="submit">Go</button>
    </div>
</form>

<table id="sortable-table">
    <thead>
    <tr>
        <th onclick="sortTable(0)">Date & Time</th>
        <th onclick="sortTable(1)">Water Temp</th>
        <th onclick="sortTable(2)">Air Temp</th>
        <th onclick="sortTable(3)">Humidity</th>
        <th onclick="sortTable(4)">CO2</th>
        <th onclick="sortTable(5)">pH</th>
        <th onclick="sortTable(6)">Nutrient</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(!isset($dataList) || is_null($dataList)) { ?>
    <tr>
        <td>NO DATA</td>
        <td>NO DATA</td>
        <td>NO DATA</td>
        <td>NO DATA</td>
        <td>NO DATA</td>
        <td>NO DATA</td>
        <td>NO DATA</td>
    </tr> <?php
    }
    else {
        foreach($dataList as $cval) { ?>
            <tr>
                <td><?php echo $cval->getDateTime()->format('Y-m-d').' '.$cval->getDateTime()->format('H:i:s'); ?></td>
                <td><?php echo $cval->getWaterTemp(); ?>°C</td>
                <td><?php echo $cval->getAirTemp(); ?>°C</td>
                <td><?php echo $cval->getHumidity(); ?>%</td>
                <td><?php echo $cval->getCO2(); ?> ppm</td>
                <td><?php echo $cval->getPH(); ?></td>
                <td><?php echo $cval->getNutrient(); ?> ppm</td>
            </tr>
        <?php
        }
    }?>
    </tbody>
</table>

<script src="../resources/js/dashboard.js"></script>
</body>
</html>
