<?php

namespace App\Enums\Email;

enum EmailTypeEnum:int
{
    // User Authentication Related
    case ACCOUNT_VERIFICATION=0;
    case PASSWORD_RESET=1;
    case EMAIL_VERIFICATION_REQUEST=2;
    case ACCOUNT_SUSPENSION=3;
    // Event Registeration/Booking
    case REGISTRATION_CONFIRMATION=4;
    case TICKET_PURCHASE_RECEIPTS=5;
    case REGISTRATION_UPDATE=6;
    case WAITLIST_NOTIFICATION=7;
    // Event Communication
    case EVENT_INVITATION=8;
    case EVENT_REMINDER=9;
    case EVENT_SCHEDULE_UPDATES=10;
    case LOCATION_CHANGES=11;
    case EVENT_CANCELLATION_NOTIFICATION=12;
    case FOLLOW_UPS=13;
    case FEEDBACK_REQUEST=14;
    case PERSONALIZED_EVENT_NOTIFICATON=15;
    // Payment Related
    case PAYMENT_CONFIRMATION=16;
    case PAYMENT_FAILED_NOTIFICATION=17;
    case REFUND_NOTIFICATION=18;
    case INVOICE_EMAIL=19;
}