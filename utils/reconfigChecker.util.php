<?php
function isConfigured(): bool {
    return file_exists(__DIR__ . '/../.env') && getenv('DB_HOST') !== false;
}
