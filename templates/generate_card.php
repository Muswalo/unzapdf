<?php
function generate_card($imgSrc, $title, $author, $timeAgo, $rec, $id)
{
    echo '<div class="row row-cols-1 row-cols-md-3 g-4" style="margin-top: 7px; margin-bottom: 6px;">';
    echo '<div class="col card" style="flex-direction: row;">';
    echo '<div class="h-100">';
    echo '<img src="' . $imgSrc . '" class="card-img-top" alt="..." style="width: 100px; height: 117px; object-fit: cover; border-radius: 0;">';
    echo '</div>';
    echo '<div>';
    echo '<div class="card-body px-2 py-2 p-0">';
    echo '<h5 class="card-title">' . $title . '</h5>';
    echo '<div class="icons">';
    echo '<span class="icon" onclick="increment(\'' . $id . '\')"><i class="fas fa-star" style="color: lightslategrey"></i><span id="rec_' . $id . '">' . $rec . '</span></span>';
    echo '<span class="icon"><i class="fas fa-share-alt" style="color: lightslategrey"></i></span>';
    echo '<span class="icon"><span style="font-size: 15px; padding: 5px; padding-left: 9px; padding-right: 9px; background-color: #999a; border-radius: 5px">Download</span></span>';
    echo '</div>';
    echo '<div class="border-top" style="margin-top: 17px;">';
    echo '<small>' . $timeAgo . ' by <strong>' . $author . '</strong></small>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
