<?php

namespace M4h45amu7x;

use DateTime;

/**
 * Class Amount represents an amount with its local equivalent.
 */
class Amount
{
    private ?int $amount;
    private ?LocalAmount $local;

    /**
     * Amount constructor.
     *
     * @param int|null $amount
     * @param LocalAmount|null $local
     */
    public function __construct(?int $amount, ?LocalAmount $local)
    {
        $this->amount = $amount;
        $this->local = $local;
    }

    /**
     * Get the amount.
     *
     * @return int|null
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * Get the local amount.
     *
     * @return LocalAmount|null
     */
    public function getLocalAmount(): ?LocalAmount
    {
        return $this->local;
    }
}

/**
 * Class LocalAmount represents an amount with its currency.
 */
class LocalAmount
{
    private ?int $amount;
    private ?string $currency;

    /**
     * LocalAmount constructor.
     *
     * @param int|null $amount
     * @param string|null $currency
     */
    public function __construct(?int $amount, ?string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * Get the amount.
     *
     * @return int|null
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * Get the currency.
     *
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }
}

/**
 * Class Bank represents bank information.
 */
class Bank
{
    private ?string $id;
    private ?string $name;
    private ?string $short;

    /**
     * Bank constructor.
     *
     * @param string|null $id
     * @param string|null $name
     * @param string|null $short
     */
    public function __construct(?string $id, ?string $name, ?string $short)
    {
        $this->id = $id;
        $this->name = $name;
        $this->short = $short;
    }

    /**
     * Get the bank ID.
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Get the bank name.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Get the short name of the bank.
     *
     * @return string|null
     */
    public function getShort(): ?string
    {
        return $this->short;
    }
}

/**
 * Class AccountName represents account name in different languages.
 */
class AccountName
{
    private ?string $th;
    private ?string $en;

    /**
     * AccountName constructor.
     *
     * @param string|null $th
     * @param string|null $en
     */
    public function __construct(?string $th, ?string $en)
    {
        $this->th = $th;
        $this->en = $en;
    }

    /**
     * Get the account name in Thai.
     *
     * @return string|null
     */
    public function getTH(): ?string
    {
        return $this->th;
    }

    /**
     * Get the account name in English.
     *
     * @return string|null
     */
    public function getEN(): ?string
    {
        return $this->en;
    }
}

/**
 * Class AccountBank represents account details including account type and number.
 */
class AccountBank
{
    private string $type;
    private string $account;

    /**
     * AccountBank constructor.
     *
     * @param string $type
     * @param string $account
     */
    public function __construct(string $type, string $account)
    {
        $this->type = $type;
        $this->account = $account;
    }

    /**
     * Get the account type.
     *
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Get the account number.
     *
     * @return string|null
     */
    public function getAccount(): ?string
    {
        return $this->account;
    }
}

/**
 * Class Receiver represents receiver information including account details and merchant ID.
 */
class Receiver
{
    private AccountName $name;
    private ?AccountBank $bank;
    private ?AccountBank $proxy;
    private ?string $merchantId;

    /**
     * Receiver constructor.
     *
     * @param AccountName $name
     * @param AccountBank|null $bank
     * @param AccountBank|null $proxy
     * @param string|null $merchantId
     */
    public function __construct(AccountName $name, ?AccountBank $bank, ?AccountBank $proxy, ?string $merchantId)
    {
        $this->name = $name;
        $this->bank = $bank;
        $this->proxy = $proxy;
        $this->merchantId = $merchantId;
    }

    /**
     * Get the receiver's name.
     *
     * @return AccountName
     */
    public function getName(): AccountName
    {
        return $this->name;
    }

    /**
     * Get the receiver's bank details.
     *
     * @return AccountBank|null
     */
    public function getBank(): ?AccountBank
    {
        return $this->bank;
    }

    /**
     * Get the receiver's proxy details.
     *
     * @return AccountBank|null
     */
    public function getProxy(): ?AccountBank
    {
        return $this->proxy;
    }

    /**
     * Get the merchant ID.
     *
     * @return string|null
     */
    public function getMerchantId(): ?string
    {
        return $this->merchantId;
    }
}

/**
 * Class Response represents a response from a transaction, including status, transaction reference, date,
 * amount, fee, references, sender and receiver information.
 */
class Response
{
    private int $status;
    private array $data;

    /**
     * Response constructor.
     *
     * @param int $status
     * @param array $data
     */
    public function __construct(int $status, array $data)
    {
        $this->status = $status;
        $this->data = $data;
    }

    /**
     * Get the response status.
     *
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * Get the slip payload.
     *
     * @return string
     */
    public function getPayload(): string
    {
        return $this->data['payload'];
    }

    /**
     * Get the transaction reference.
     *
     * @return string
     */
    public function getTransRef(): string
    {
        return $this->data['transRef'];
    }

    /**
     * Get the transaction date.
     *
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return new DateTime($this->data['date']);
    }

    /**
     * Get the transaction amount.
     *
     * @return Amount
     */
    public function getAmount(): Amount
    {
        return new Amount($this->data['amount']['amount'], new LocalAmount($this->data['amount']['local']['amount'], $this->data['amount']['local']['currency']));
    }

    /**
     * Get the transaction fee.
     *
     * @return int
     */
    public function getFee(): int
    {
        return $this->data['fee'];
    }

    /**
     * Get reference 1.
     *
     * @return string
     */
    public function getRef1(): string
    {
        return $this->data['ref1'];
    }

    /**
     * Get reference 2.
     *
     * @return string
     */
    public function getRef2(): string
    {
        return $this->data['ref2'];
    }

    /**
     * Get reference 3.
     *
     * @return string
     */
    public function getRef3(): string
    {
        return $this->data['ref3'];
    }

    /**
     * Get sender information.
     *
     * @return Receiver
     */
    public function getSender(): Receiver
    {
        $senderData = $this->data['sender'];
        $accountData = $senderData['account'];

        return new Receiver(
            new AccountName($accountData['name']['th'], $accountData['name']['en']),
            $accountData['bank'] ? new AccountBank($accountData['bank']['type'], $accountData['bank']['account']) : null,
            $senderData['proxy'] ? new AccountBank($senderData['proxy']['type'], $senderData['proxy']['account']) : null,
            $senderData['merchantId']
        );
    }

    /**
     * Get receiver information.
     *
     * @return Receiver
     */
    public function getReceiver(): Receiver
    {
        $receiverData = $this->data['receiver'];
        $accountData = $receiverData['account'];

        return new Receiver(
            new AccountName($accountData['name']['th'], $accountData['name']['en']),
            $accountData['bank'] ? new AccountBank($accountData['bank']['type'], $accountData['bank']['account']) : null,
            $receiverData['proxy'] ? new AccountBank($receiverData['proxy']['type'], $receiverData['proxy']['account']) : null,
            $receiverData['merchantId']
        );
    }
}
