<?php declare(strict_types=1);

namespace Shopware\Api\User\Event\User;

use Shopware\Api\Entity\Search\AggregationResult;
use Shopware\Context\Struct\TranslationContext;
use Shopware\Framework\Event\NestedEvent;

class UserAggregationResultLoadedEvent extends NestedEvent
{
    public const NAME = 'user.aggregation.result.loaded';

    /**
     * @var AggregationResult
     */
    protected $result;

    public function __construct(AggregationResult $result)
    {
        $this->result = $result;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getContext(): TranslationContext
    {
        return $this->result->getContext();
    }

    public function getResult(): AggregationResult
    {
        return $this->result;
    }
}