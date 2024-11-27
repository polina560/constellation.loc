<?php

namespace common\enums;

enum Type: int implements DictionaryInterface
{

    use DictionaryTrait;

    case Custom = 0;
    case Prepared = 10;

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return match ($this) {
            self::Custom => 'Пользовательский',
            self::Prepared => 'Подготовленный'
        };
    }

    /**
     * {@inheritdoc}
     */
    public function color(): string
    {
        return match ($this) {
            self::Custom => 'var(--bs-primary)',
            self::Prepared => 'var(--bs-success)'
        };
    }
}
