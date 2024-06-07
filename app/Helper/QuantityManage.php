<?php

namespace App\Helper;

use App\Models\BookQuantity;

class QuantityManage
{
    /**
     * Check if the requested quantity of a book is available.
     *
     * @param int $bookId
     * @return bool
     */
    public static function isQuantityAvailable(int $bookId): bool
    {
        $totalQuantity = BookQuantity::where('book_id', $bookId)
            ->where('status', 'activate')
            ->sum('current_qty');

        if ($totalQuantity > 0) {
            return true;
        }

        return false;
    }
}
