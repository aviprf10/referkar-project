<?php

/**
 * Note this class is in front end and also in backend
 * Change here should be done in both classes
 */
abstract class OrderStatus
{
    const NEW_ORDER = 0;
    const TO_BE_PICKED = 1;
    const DISPATCH = 2;
    const TO_HANDOVER = 3;
    const IN_TRANSIT = 4;
    const MANUAL = 5;
    const DELIVERED = 6;
    const RETURN_ORDER = 7;
    const REJECTED = 8;
    const CANCEL_BY_BUYER = 9;
    const UNDELIVERED = 10;
}

