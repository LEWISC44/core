Dear {{ isset($recipientName) ? $recipientName : $recipient->name }},

{{  strip_tags($body) }}

Regards,
VATSIM UK