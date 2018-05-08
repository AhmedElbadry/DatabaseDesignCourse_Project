<?php
session_start();
if (isset($_SESSION['logged']) && $_SESSION['type'] == 'e') {
    // put structure here
    
} else {
    echo "Please log in first to see this page.";
}