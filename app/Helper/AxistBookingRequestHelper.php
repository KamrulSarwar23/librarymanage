<?php

namespace App\Helper;

use App\Models\BookingRequest;
use App\Models\Borrow;

class AxistBookingRequestHelper
{
    /**
     * Check if a booking request exists for the given book ID.
     *
     * @param int $bookId
     * @return bool
     */
    public static function existsForBook(int $bookId, int $userId): bool
    {
        return Borrow::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->whereNotIn('status', ['return', 'reject'])
            ->exists();
    }
}
