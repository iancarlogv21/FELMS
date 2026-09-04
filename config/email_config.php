<?php
// config/email_config.php

define('SMTP_HOST', $_ENV['SMTP_HOST'] ?? getenv('SMTP_HOST') ?? 'smtp.sendgrid.net');
define('SMTP_USERNAME', $_ENV['SMTP_USERNAME'] ?? getenv('SMTP_USERNAME') ?? 'apikey');
define('SMTP_PASSWORD', $_ENV['SMTP_PASSWORD'] ?? getenv('SMTP_PASSWORD') ?? 'SG.39SZtVxhQdW6HUr2TMt-2g.ME-cU3Jmvm5m7jgXzud9Qx0MawdYzcP0J3C041qkya');
define('SMTP_PORT', $_ENV['SMTP_PORT'] ?? getenv('SMTP_PORT')?? 465);
define('SMTP_ENCRYPTION', $_ENV['SMTP_ENCRYPTION'] ?? getenv('SMTP_ENCRYPTION') ?? 'ssl');
define('SENDER_EMAIL', $_ENV['SENDER_EMAIL'] ?? getenv('SENDER_EMAIL') ?? 'iancarlogv21@gmail.com');
define('SENDER_NAME', $_ENV['SENDER_NAME'] ?? getenv('SENDER_NAME') ?? 'Fast & Efficient LMS');