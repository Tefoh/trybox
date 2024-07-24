<?php

namespace Core\Repositories;

use Core\Enums\RoleEnum;

interface TransactionRepositoryInterface
{
    public function create(array $data);

    public function updateTransactionNumber($transaction, $transactionNumber);

    public function transactionNumberExists($transactionNum);

    public function markTransactionAsDone($transactionNum);
}