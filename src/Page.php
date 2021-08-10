<?php

namespace Olsgreen\SageBusinessCloud\Accounting;

use Olsgreen\AbstractApi\Client;

class Page extends AbstractEndpoint
{
    protected $totalItems;

    protected $itemsPerPage;

    protected $currentPage;

    protected $totalPages;

    protected $nextUrl;

    protected $previousUrl;

    protected $items;

    public function __construct(
        Client $client,
        array $items,
        $totalItems,
        $currentPage,
        $itemsPerPage,
        $nextUrl,
        $previousUrl
    ) {
        $this->items = $items;

        $this->totalItems = intval($totalItems);

        $this->currentPage = intval($currentPage);

        $this->itemsPerPage = intval($itemsPerPage);

        $this->totalPages = intval(ceil($this->totalItems / $this->itemsPerPage));

        $this->nextUrl = (string) $nextUrl;

        $this->previousUrl = (string) $previousUrl;

        parent::__construct($client);
    }

    public static function createFromResponseArray(Client $client, array $response): self
    {
        return new static(
            $client,
            $response['$items'],
            $response['$total'],
            $response['$page'],
            $response['$itemsPerPage'],
            $response['$next'],
            $response['$back']
        );
    }

    public function itemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    public function totalItems(): int
    {
        return $this->totalItems;
    }

    public function totalPages(): int
    {
        return $this->totalPages;
    }

    public function currentPage(): int
    {
        return $this->currentPage;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function isFirstPage(): bool
    {
        return empty($this->previousUrl);
    }

    public function isLastPage(): bool
    {
        return empty($this->nextUrl);
    }

    public function nextPage(): ?self
    {
        if ($this->nextUrl) {
            [$path, $parameters] = $this->parsePath($this->nextUrl);

            return static::createFromResponseArray($this->client, $this->_get($path, $parameters));
        }

        return null;
    }

    public function previousPage(): ?self
    {
        if ($this->previousUrl) {
            [$path, $parameters] = $this->parsePath($this->previousUrl);

            return static::createFromResponseArray($this->client, $this->_get($path, $parameters));
        }

        return null;
    }

    private function parsePath(string $path): array
    {
        [$url, $parameterString] = explode('?', $path);

        parse_str($parameterString, $parameters);

        return [$url, $parameters];
    }

    public function toArray(): array
    {
        return [
            'totalItems'   => $this->totalItems,
            'itemsPerPage' => $this->itemsPerPage,
            'currentPage'  => $this->currentPage,
            'totalPages'   => $this->totalPages,
            'nextUrl'      => $this->nextUrl,
            'previousUrl'  => $this->previousUrl,
            'items'        => $this->items,
        ];
    }
}
