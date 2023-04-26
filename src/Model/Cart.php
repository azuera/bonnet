<?php
namespace Model;
class Cart
{
    protected $content = [];

    public function __construct()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $this->content = $_SESSION['cart'];
    }

    public function getContent(): array
    {
        return $this->content;
    }

    public function setContent(array $content): void
    {
        $this->content = $content;
    }

    public function plus(int $index): self
    {

        if (!isset($this->content[$index])) {
            $this->content[$index] = 0;
        }
        $this->content[$index]++;
        return $this;
    }

    public function min(int $index): self
    {

        if (isset($this->content[$index])) {
            $this->content[$index]--;

        }

        if ($this->content[$index] <= 0) {
            unset($this->content[$index]);
        }
        return $this;
    }

    public function delete(int $index): self
    {
        if (isset($this->content[$index])) {
            unset($this->content[$index]);
        }

        return $this;
    }

    public function  empty(): self
    {
        $this->content = [];
        return $this;
    }

    public function save(): self
    {
        $_SESSION['cart'] = $this->getContent();
        return $this;
    }
/* $getdata = $_GET cest just plus propre!!*/
    public function handle(array $getData): bool
    {
        if (isset($getData['index'])) {
            $index = $getData['index'];


            $mode = 'plus';
            if (isset($getData['mode'])) {
                $mode = $getData['mode'];
            }


            switch ($mode) {
                case 'plus':
                    $this->plus($index);

                    break;
                case 'min':
                    $this->min($index);

                    break;
                case 'delete':
                    $this->delete($index);
                    break;

            }
            $this->save();

            return true;
        }
        if (isset($getData['mode']) && $getData['mode'] == 'empty') {
            $this->empty();
            $this->save();
            return true;
        }
        return false;
    }
}

