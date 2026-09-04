<?php
// config/email_config.php

// Public settings (These are fine to keep as text)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USERNAME', 'iancarlogv21@gmail.com'); 
define('SMTP_PORT', 587); 
define('SMTP_ENCRYPTION', 'tls'); 
define('SENDER_EMAIL', 'iancarlogv21@gmail.com');
define('SENDER_NAME', 'Fast & Efficient LMS');

// Secure settings (These pull from Railway's "Variables" tab)
define('SMTP_PASSWORD', $_ENV['SMTP_PASSWORD'] ?? getenv('SMTP_PASSWORD') ?: ''); 
define('SENDGRID_API_KEY', $_ENV['SENDGRID_API_KEY'] ?? getenv('SENDGRID_API_KEY') ?: '');