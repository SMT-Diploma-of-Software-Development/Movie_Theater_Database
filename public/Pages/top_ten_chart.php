<?php
require_once '../../private/initialize.php';
?>
<?php
$topTen = find_top_ten_movies();
$topTenArray = [];
$i = 1;
$maxValue;
while ($movie = mysqli_fetch_assoc($topTen)) {
    //cut movie title to short string
    $title = substr($movie['title'], 0, 11) . ".." . $i;
    $topTenArray['"' . $title . '"'] = $movie['finalRating'];
    if ($i == 1) {
        $maxValue = $movie['finalRating'];
    }
    $i++;
}

// Image dimensions
$imageWidth = 1300;
$imageHeight = 600;

// Grid dimensions and placement within image
$gridTop = 50;
$gridLeft = 50;
$gridBottom = 500;
$gridRight = 1200;
$gridHeight = $gridBottom - $gridTop;
$gridWidth = $gridRight - $gridLeft;

// Bar and line width
$lineWidth = 2;
$barWidth = 20;

// Font settings
$font = dirname(__FILE__) . '/VeraIt.ttf';
$fontSize = 10;

// Margin between label and axis
$labelMargin = 8;

// Max value on y-axis
//$yMaxValue = (int) ($maxValue / 10) * 10 + 10;
$yMaxValue = 5;

// Distance between grid lines on y-axis
$yLabelSpan = 1;

// Init image
$chart = imagecreate($imageWidth, $imageHeight);

// Setup colors
$backgroundColor = imagecolorallocate($chart, 255, 255, 255); //white
$axisColor = imagecolorallocate($chart, 0, 0, 0);
$labelColor = $axisColor;
$gridColor = imagecolorallocate($chart, 212, 212, 212);
$barColor = imagecolorallocate($chart, 47, 133, 217);

imagefill($chart, 0, 0, $backgroundColor);

imagesetthickness($chart, $lineWidth);


for ($i = 0; $i <= $yMaxValue; $i += $yLabelSpan) {

    $y = $gridBottom - $i * $gridHeight / $yMaxValue;

    //    draw the line
    imageline($chart, $gridLeft, $y, $gridRight, $y, $gridColor);

    //    draw right aligned label
    $labelBox = imagettfbbox($fontSize, 0, $font, strval($i));
    $labelWidth = $labelBox[4] - $labelBox[0];

    $labelX = $gridLeft - $labelWidth - $labelMargin;
    $labelY = $y + $fontSize / 2;

    imagettftext($chart, $fontSize, 0, $labelX, $labelY, $labelColor, $font, strval($i));
}

imageline($chart, $gridLeft, $gridTop, $gridLeft, $gridBottom, $axisColor);
imageline($chart, $gridLeft, $gridBottom, $gridRight, $gridBottom, $axisColor);

$barSpacing = $gridWidth / count($topTenArray);
$itemX = $gridLeft + $barSpacing / 2;


foreach ($topTenArray as $key => $value) {
    $x1 = $itemX - $barWidth / 2;
    $y1 = $gridBottom - $value / $yMaxValue * $gridHeight;
    $x2 = $itemX + $barWidth / 2;
    $y2 = $gridBottom - 1;


    imagefilledrectangle($chart, $x1, $y1, $x2, $y2, $barColor);

    // Draw the label
    $labelBox = imagettfbbox($fontSize, 0, $font, $key);
    $labelWidth = $labelBox[4] - $labelBox[0];

    $labelX = $itemX - $labelWidth / 2;
    $labelY = $gridBottom + $labelMargin + $fontSize;

    imagettftext($chart, $fontSize, 0, $labelX, $labelY, $labelColor, $font, $key);

    $itemX += $barSpacing;
}

//draw axis title
imagestring($chart, $fontSize, 0, 10, "Rating", $axisColor);
imagestring($chart, $fontSize, 500, 550, "Movies", $axisColor);

$currentTime = time();
//$imgName = 'chart' . $currentTime . '.png';
$imgName = 'chart.png';
imagepng($chart, $imgName);
// add ? and time behind img URL enforce browser update chart when chart is changed
echo "<img src='" . $imgName . "?" . time() . "' style='width:100%'' onclick='onClick(this)' class='w3-hover-opacity' alt='Top ten Chart' id='topTenImg'>";

imagedestroy($chart);
?>
