<?php 

                    if (count($errors) > 0) {
                        
                        echo "<div class='text-center mx-1 bg-danger p-1 text-white'> ";
                        foreach($errors as $errores){
                            echo  strtoupper($errores);
                            //echo "<li class='fas fa-exclamation-circle'> " . strtoupper(($errores)) . " </li> ";
                        }
                        echo "</div>";
                    }


              ?>