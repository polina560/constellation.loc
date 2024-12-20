<?php

namespace common\enums;

/**
 * Class ModerationStatus
 *
 * @package common\enums
 * @author m.kropukhinsky <m.kropukhinsky@peppers-studio.ru>
 */
enum ModerationStatus: int implements DictionaryInterface
{
    use DictionaryTrait;

    case UnderReview = 0;
    case Approved = 10;
    case Rejected = 20;

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return match ($this) {
            self::UnderReview => 'На проверке',
            self::Approved => 'Одобрено',
            self::Rejected => 'Отклонено'
        };
    }

    /**
     * {@inheritdoc}
     */
    public function color(): string
    {
        return match ($this) {
            self::UnderReview => 'var(--bs-body-color)',
            self::Approved => 'var(--bs-success)',
            self::Rejected => 'var(--bs-danger)'
        };
    }
}
