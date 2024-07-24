<?php

namespace App\Repositories;

use App\Models\Transaction;
use Core\Enums\TransactionStatusEnum;
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

    public function transactionNumberExists($transactionNum)
    {
        return Transaction::query()
            ->where('transaction_number', $transactionNum)
            ->exists();
    }

    public function markTransactionAsDone($transactionNum)
    {
        $transaction = Transaction::query()
            ->where('transaction_number', $transactionNum)
            ->first();

        $transaction->update([
            'status' => TransactionStatusEnum::DONE
        ]);

        return $transaction->fresh()->toArray();
    }
}
