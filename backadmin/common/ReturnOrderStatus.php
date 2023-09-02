<?php

/**
 * Note this class is in front end and also in backend
 * Change here should be done in both classes
 */
abstract class ReturnOrderStatus
{
    const RETURN_PENDING = 1;
    const RETURN_ACCEPTED = 2;
    const RETURN_IN_TRANSIT = 3;
    const RETURN_DELIVERED = 4;
    const RETURN_REJECTED = 5;
}

