<?php

namespace App\Repositories;

use App\Models\Transaction;
use Core\Repositories\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{

    public function create(array $data)
    {
        return Transaction::query()
            ->create($data);
    }

    public function updateTransactionNumber($transaction, $transactionNumber)
    {
        return Transaction::query()
            ->where('id', $transaction['id'])
            ->first()
            ->update([
                'transaction_number' => $transactionNumber
            ]);
    }
}
