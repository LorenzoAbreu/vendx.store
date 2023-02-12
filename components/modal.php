<?php
  function modal($title, $text, $action_button_text, $action_button_click, $close_btn, $type) {
    $id = rand(0,999);

    echo "

      <div class='modal-container' id='modal-" . $id . "'>
        <div class='modal modal-" . $type . "'>
          <div class='modal-title-section'>
            <h3 class='modal-title'>" . $title . "</h3>
          </div>

          <div class='modal-content'>
            <p class='modal-text'>" . $text ."</p>
          </div>

          <div class='modal-buttons-section'>
            <a class='modal-button-action' href='" . $action_button_click . "'>" . $action_button_text . "</a>
          </div>
        </div>
      </div>
    
    ";
  }

?>

<link rel="stylesheet" href="modal.style.css">