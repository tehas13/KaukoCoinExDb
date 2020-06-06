<?php

function inputElement($placeholder, $name, $value)
{
    $element = "
        
        <div class=\"input-group mb-2\">
                        <input type=\"text\" name='$name' value='$value' autocomplete=\"off\" placeholder='$placeholder' class=\"form-control\" id=\"inlineFormInputGroup\" placeholder=\"Username\">
                    </div>
    
    ";
    echo $element;
}


function buttonElement($btnid, $styleclass, $text, $name, $attr)
{
    $btn = "
        <button name='$name' '$attr' class='$styleclass' id='$btnid'>$text</button>
    ";
    echo $btn;
}