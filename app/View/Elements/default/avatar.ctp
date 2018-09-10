<?php

$width = empty($avatarOptions['width']) ? 100 : $avatarOptions['width'];
$height = empty($avatarOptions['height']) ? 100 : $avatarOptions['height'];
$crop = empty($avatarOptions['crop']) ? false : $avatarOptions['crop'];
$class = empty($avatarOptions['class']) ? false : $avatarOptions['class'];
switch ($userProfile) {
    case!empty($userProfile['avatar']):
        echo $this->image->thumb('/files/user/' . $userProfile['avatar'], array('width' => $width, 'height' => $height, 'crop' => $crop), array('class' => $class));
        break;
    case!empty($userProfile['avatar_url']):

         echo '<div class="avatarBg" style="'
        . 'background-image: url(' . $userProfile['avatar_url'] . '); '
        . 'width: ' . $width . 'px; height: ' . $height . 'px;'
        . '"></div>';
        break;
    case!empty($userProfile['activity_avatar_url']):
        //echo '<img alt scr="'.$userProfile['activity_avatar_url']. '" class="timeline-img pull-left" />';
        echo $this->Html->image($userProfile['activity_avatar_url'], array('width' => $width, 'height' => $height, 'class' => 'timeline-img pull-left'));
        break;
    case!empty($userProfile['photo']):
        echo $this->image->thumb('/files/personalaim/' . $userProfile['photo'], array('width' => $width, 'height' => $height, 'crop' => $crop), array('class' => $class));
        break;
    case!empty($userProfile['photo_url']):
        echo $this->Html->image($userProfile['photo_url'], array('width' => $width, 'height' => $height, 'class' => $class));
        break;
    default:
        echo $this->Html->image('/assets/admin/pages/media/profile/avatar.png', array('width' => $width, 'height' => $height, 'class' => $class));
        break;
}
?>