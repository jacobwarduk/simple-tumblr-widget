<?php

/*
 * Simple Tumblr Widget
 *
 * I don't get why everybody's Tumblr widgets are so complicated when it's as simple as this!
 *
 * Copyright (c) 2014 Jacob Ward (http://www.jacobward.co.uk)
 *
 * Licensed under the MIT (http://opensource.org/licenses/MIT) and GPL (http://www.gnu.org/copyleft/gpl.html) licenses.
 *
 */


    class SimpleTumblrWidget {
            
            // Constructor setting the attributes and building the widget
            function __construct($user, $number, $width) {
                $this->user = $user;
                $this->number = $number;
                $this->width = $width;
                $this->buildWidget();
            }
            
            // Method to build the widget
            private function buildWidget() {
                $this->widget .= '<script type="text/javascript" src="http://' . $this->user . '.tumblr.com/api/read/json?number=' . $this->number . '&type=photo"></script>';
                
                $this->widget .= '<table><tr>'; // Open the table
                
                // For each of the returned images
                for ($i = 0; $i <= $this->number; $i++) {
                    
                    // If the image is divisible by the table width
                    if (($i % $this->width) == 0 && ($i != 0)) {
                        $this->widget .= '</tr><tr>';   // Start a new table row
                    }
                    
                    // Add the empty 'a' and 'img' tags ready for population
                    $this->widget .= '<td><a target="_BLANK" id="tumblr-url-' . $this->user . '-' . $i . '" href=""><img id="tumblr-photo-' . $this->user . '-' . $i . '" src="" alt="" /></a></td>';
                    
                }
                
                $this->widget .=  '</tr></table>';  // Close the table
                
                $this->widget .= '<script type="text/javascript">'; // Open JS tag
                
                // For each of the returned images
                for ($i = 0; $i <= $this->number; $i++) {
                
                    $this->widget .= 'document.getElementById("tumblr-photo-' . $this->user . '-' . $i . '").setAttribute("src", tumblr_api_read.posts[' . $i . ']["photo-url-75"]); document.getElementById("tumblr-url-' . $this->user . '-' . $i . '").setAttribute("href", tumblr_api_read.posts[' . $i . ']["url-with-slug"]);';  // // Set the image src attribute with the photo URL and set the image link attribute with the image URL
                
                }
                
                $this->widget .= '</script>';   // Close JS tag
                
            }
            
            // Method to display the widget
            public function displayWidget() {
                // If the widget is built
                if ($this->widget) {   
                    echo $this->widget; // Echo out the built widget
                } else {
                    return false;
                }
            }
        
    }

?>