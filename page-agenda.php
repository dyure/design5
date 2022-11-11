<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        .time {
            font-family: Arial;
            font-size: 10px;
            line-height: 11px;
        }
        .subject {
            font-family: Arial;
            font-size: 14px;
            line-height: 15px;
        }
        .s_active {
            color: #830836;
            cursor: pointer;
        }
        .agenda {
            display: none;
            font-family: Arial;
            font-size: 12px;
            line-height: 13px;
            padding-left: 30px;
        }
    </style>
</head>
<?php
    $arrMonth_r = array(1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля', 5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа', 9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря');
    $days = ['(воскресенье)', '(понедельник)', '(вторник)', '(среда)', '(четверг)', '(пятница)', '(суббота)'];
    $arrayAnnounce = file_get_contents('http://law.sobranie.info/sgw.nsf/api.xsp/events');
    $itemAnnounce = json_decode($arrayAnnounce, true);
    for ($i=count($itemAnnounce)-1; $i>=0; $i--) {
        $announceTime = substr($itemAnnounce[$i]['EventTimeText'], -5);
        $announceFullDate = substr($itemAnnounce[$i]['EventDateText'], 0, 10) . ' ' . $announceTime;  
        $aFD = substr($itemAnnounce[$i]['EventDateTime'], 0, 10);   
        if (strtotime($announceFullDate) > time()) {
            $hideAnnounce = '';
        } else {
            $hideAnnounce = 'style="display:none;"';
        }
?>
    <div id="anonsId_<?php echo $itemAnnounce[$i]['id']; ?>" <?php echo $hideAnnounce; ?>>
        <div class="time">
            <?php echo (int) substr($announceFullDate, 0, 2) . ' ' . $arrMonth_r[(int) substr($announceFullDate, 3, 2)] . ' ' . $days[ date("w", strtotime($aFD))] .' в ' . $announceTime . ',<br> ' . $itemAnnounce[$i]['EventPlace']; ?>
        </div>
<?php
        $arrAgendaAnnounce = file_get_contents('http://law.sobranie.info/sgw.nsf/api.xsp/agenda?id=' . $itemAnnounce[$i]['id']);
        $itmAgendaAnnounce = json_decode($arrAgendaAnnounce, true);
        if ($itmAgendaAnnounce != null) {
            //
?>
            <div id="<?php echo $itemAnnounce[$i]['id']; ?>" class="subject s_active" onclick="return ChangeClass(this);">
                <p><?php echo $itemAnnounce[$i]['Subject']; ?></p>
            </div>
<?php
            echo '<div class="agenda" id="#_' . $itemAnnounce[$i]['id'] . '">';
            foreach ($itmAgendaAnnounce as $bbb) {
                echo '<h4>' . $bbb['ItemNumber'] . '. ' .  $bbb['Subject'] . '</h4>';
            }
            echo '</div>';
        } else {
?>
            <div class="subject">
                <p id="<?php echo $itemAnnounce[$i]['id']; ?>"><?php echo $itemAnnounce[$i]['Subject']; ?></p>
            </div>
<?php
        }
?>
    </div>
    <script>
        function ChangeClass(Element) {
            if (document.getElementById('#_' + Element.id).style.display == 'none') {
                document.getElementById('#_' + Element.id).style.display = 'block';
            } else {
                document.getElementById('#_' + Element.id).style.display = 'none';
            }
            return false;
        }
    </script>
<?php
    }
?>
