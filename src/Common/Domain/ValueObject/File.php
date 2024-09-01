<?php

namespace App\Common\Domain\ValueObject;

use Assert\Assert;

class File extends ValueObject
{
    /**
     * @var string
     */
    protected $file;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $mimeType;

    /**
     * @var string|null
     */
    protected $extension;

    /**
     * @var int|null
     */
    protected $size;

    /**
     * File Constructor
     *
     * @param string $file
     * @param string $name
     * @param string|null $mimeType
     * @param string|null $extension
     * @param int|null $size
     */
    public function __construct(string $file, string $name, ?string $mimeType, ?string $extension, ?int $size)
    {
        Assert::that($file)
            ->notEmpty()
            ->url();

        Assert::that($name)
            ->notEmpty();

        $this->file = $file;
        $this->name = $name;
        $this->mimeType = $mimeType;
        $this->extension = $extension;
        $this->size = $size;
    }

    /**
     * @return  string
     */
    public function getFile(): string
    {
        return $this->file;
    }

    /**
     * @return  string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return  string|null
     */
    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * @return  string|null
     */
    public function getExtension(): ?string
    {
        return $this->extension;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param ValueObject $object
     *
     * @return boolean
     */
    public function equals(ValueObject $object): bool
    {
        if ($object instanceof File) {
            return $this->getFile() === $object->getFile();
        }

        return false;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->getFile();
    }

    /**
     * @return self|null
     */
    public function __invoke(): ?self
    {
        if ($this->file === null || $this->name === null) {
            return null;
        }

        return $this;
    }
}
